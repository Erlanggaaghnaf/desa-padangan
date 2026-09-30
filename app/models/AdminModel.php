<?php

class AdminModel
{
    private $db;

    public function __construct()
    {
        require_once __DIR__ . '/../core/Database.php';
        $this->db = new Database();
    }

    public function hasRoleColumn(): bool
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare(
            "SELECT COUNT(*)
             FROM information_schema.COLUMNS
             WHERE TABLE_SCHEMA = DATABASE()
               AND TABLE_NAME = 'admin_users'
               AND COLUMN_NAME = 'role'"
        );
        $stmt->execute();

        return (int) $stmt->fetchColumn() > 0;
    }

    public function hasSetupStateTable(): bool
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare(
            "SELECT COUNT(*)
             FROM information_schema.TABLES
             WHERE TABLE_SCHEMA = DATABASE()
               AND TABLE_NAME = 'admin_setup_state'"
        );
        $stmt->execute();

        return (int) $stmt->fetchColumn() > 0;
    }

    public function countAdmins(): int
    {
        $conn = $this->db->getConnection();

        return (int) $conn->query(
            "SELECT COUNT(*) FROM admin_users"
        )->fetchColumn();
    }

    public function getSetupState(): ?array
    {
        if (!$this->hasSetupStateTable()) {
            return null;
        }

        $conn = $this->db->getConnection();
        $stmt = $conn->query(
            "SELECT id, setup_completed, completed_at, failed_attempts, last_failed_at, updated_at
             FROM admin_setup_state
             WHERE id = 1
             LIMIT 1"
        );
        $state = $stmt->fetch();

        return $state ?: null;
    }

    public function isSetupRateLimited(): bool
    {
        $state = $this->getSetupState();

        if (!$state) {
            return false;
        }

        $failedAttempts = (int) ($state['failed_attempts'] ?? 0);
        $lastFailedAt = $state['last_failed_at'] ?? null;

        if ($failedAttempts < 5 || !$lastFailedAt) {
            return false;
        }

        $lastFailureTimestamp = strtotime((string) $lastFailedAt);

        if ($lastFailureTimestamp === false) {
            return false;
        }

        if ((time() - $lastFailureTimestamp) < 900) {
            return true;
        }

        $this->resetSetupFailureCounter();

        return false;
    }

    public function registerSetupFailure(): void
    {
        if (!$this->hasSetupStateTable()) {
            return;
        }

        $conn = $this->db->getConnection();
        $stmt = $conn->prepare(
            "UPDATE admin_setup_state
             SET failed_attempts = failed_attempts + 1,
                 last_failed_at = CURRENT_TIMESTAMP,
                 updated_at = CURRENT_TIMESTAMP
             WHERE id = 1"
        );
        $stmt->execute();
    }

    public function resetSetupFailureCounter(): void
    {
        if (!$this->hasSetupStateTable()) {
            return;
        }

        $conn = $this->db->getConnection();
        $stmt = $conn->prepare(
            "UPDATE admin_setup_state
             SET failed_attempts = 0,
                 last_failed_at = NULL,
                 updated_at = CURRENT_TIMESTAMP
             WHERE id = 1"
        );
        $stmt->execute();
    }

    public function findByUsername($username)
    {
        $conn = $this->db->getConnection();
        $roleSelect = $this->hasRoleColumn()
            ? 'role'
            : "'admin' AS role";

        $stmt = $conn->prepare(
            "SELECT id, username, password_hash, {$roleSelect}, created_at, updated_at
             FROM admin_users
             WHERE username = :username
             LIMIT 1"
        );
        $stmt->execute([':username' => $username]);

        $admin = $stmt->fetch();

        return $admin ?: null;
    }

    public function findIdentityById($id)
    {
        $conn = $this->db->getConnection();

        if (!$this->hasRoleColumn()) {
            $stmt = $conn->prepare(
                "SELECT id, username, created_at, updated_at
                 FROM admin_users
                 WHERE id = :id
                 LIMIT 1"
            );
        } else {
            $stmt = $conn->prepare(
                "SELECT id, username, role, created_at, updated_at
                 FROM admin_users
                 WHERE id = :id
                 LIMIT 1"
            );
        }

        $stmt->execute([':id' => (int) $id]);

        $admin = $stmt->fetch();

        return $admin ?: null;
    }

    public function getAll()
    {
        $conn = $this->db->getConnection();
        $roleSelect = $this->hasRoleColumn()
            ? 'role'
            : "'admin' AS role";

        $stmt = $conn->query(
            "SELECT id, username, {$roleSelect}, created_at, updated_at
             FROM admin_users
             ORDER BY id ASC"
        );

        return $stmt->fetchAll();
    }

    public function findById($id)
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare(
            "SELECT id, username, created_at, updated_at
             FROM admin_users
             WHERE id = :id
             LIMIT 1"
        );
        $stmt->execute([':id' => (int) $id]);

        $admin = $stmt->fetch();

        return $admin ?: null;
    }

    public function findByIdWithPassword($id)
    {
        $conn = $this->db->getConnection();
        $roleSelect = $this->hasRoleColumn()
            ? ', role'
            : '';

        $stmt = $conn->prepare(
            "SELECT id, username, password_hash{$roleSelect}, created_at, updated_at
             FROM admin_users
             WHERE id = :id
             LIMIT 1"
        );
        $stmt->execute([':id' => (int) $id]);

        $admin = $stmt->fetch();

        return $admin ?: null;
    }

    public function usernameExists($username, $excludeId = 0)
    {
        $conn = $this->db->getConnection();

        if ((int) $excludeId > 0) {
            $stmt = $conn->prepare(
                "SELECT id
                 FROM admin_users
                 WHERE username = :username
                   AND id <> :exclude_id
                 LIMIT 1"
            );
            $stmt->execute([
                ':username' => $username,
                ':exclude_id' => (int) $excludeId,
            ]);
        } else {
            $stmt = $conn->prepare(
                "SELECT id
                 FROM admin_users
                 WHERE username = :username
                 LIMIT 1"
            );
            $stmt->execute([
                ':username' => $username,
            ]);
        }

        return (bool) $stmt->fetchColumn();
    }

    public function create($username, $passwordHash, $role = 'admin')
    {
        if (!$this->hasRoleColumn()) {
            throw new RuntimeException(
                'Kolom role belum tersedia. Migrasi database diperlukan.'
            );
        }

        if (!in_array($role, ['admin', 'superadmin'], true)) {
            throw new InvalidArgumentException('Role administrator tidak valid.');
        }

        $conn = $this->db->getConnection();
        $stmt = $conn->prepare(
            "INSERT INTO admin_users (username, password_hash, role)
             VALUES (:username, :password_hash, :role)"
        );

        return $stmt->execute([
            ':username' => $username,
            ':password_hash' => $passwordHash,
            ':role' => $role,
        ]);
    }

    public function createSuperadminAtomically($username, $passwordHash)
    {
        if (!$this->hasRoleColumn() || !$this->hasSetupStateTable()) {
            throw new RuntimeException(
                'Struktur setup administrator belum tersedia. Migrasi database diperlukan.'
            );
        }

        $conn = $this->db->getConnection();
        $lockName = 'desa_padangan_admin_setup';

        $lockStmt = $conn->prepare(
            'SELECT GET_LOCK(:lock_name, 10)'
        );
        $lockStmt->execute([
            ':lock_name' => $lockName,
        ]);

        if ((int) $lockStmt->fetchColumn() !== 1) {
            throw new RuntimeException(
                'Setup administrator sedang digunakan. Silakan coba lagi.'
            );
        }

        try {
            $conn->beginTransaction();

            $stateStmt = $conn->query(
                "SELECT setup_completed
                 FROM admin_setup_state
                 WHERE id = 1
                 LIMIT 1
                 FOR UPDATE"
            );
            $state = $stateStmt->fetch();

            if (!$state || (int) $state['setup_completed'] === 1) {
                $conn->rollBack();
                return false;
            }

            $count = (int) $conn->query(
                'SELECT COUNT(*) FROM admin_users'
            )->fetchColumn();

            if ($count > 0) {
                $conn->rollBack();
                return false;
            }

            $stmt = $conn->prepare(
                "INSERT INTO admin_users (username, password_hash, role)
                 VALUES (:username, :password_hash, 'superadmin')"
            );
            $stmt->execute([
                ':username' => $username,
                ':password_hash' => $passwordHash,
            ]);

            $completeStmt = $conn->prepare(
                "UPDATE admin_setup_state
                 SET setup_completed = 1,
                     completed_at = CURRENT_TIMESTAMP,
                     failed_attempts = 0,
                     last_failed_at = NULL,
                     updated_at = CURRENT_TIMESTAMP
                 WHERE id = 1"
            );
            $completeStmt->execute();

            $conn->commit();

            return true;
        } catch (Throwable $e) {
            if ($conn->inTransaction()) {
                $conn->rollBack();
            }

            throw $e;
        } finally {
            try {
                $release = $conn->prepare(
                    'SELECT RELEASE_LOCK(:lock_name)'
                );
                $release->execute([
                    ':lock_name' => $lockName,
                ]);
            } catch (Throwable $ignored) {
                // Detail pelepasan lock tidak ditampilkan kepada pengguna.
            }
        }
    }

    public function updateAccount($id, $username, $passwordHash = null)
    {
        $conn = $this->db->getConnection();

        if ($passwordHash !== null) {
            $stmt = $conn->prepare(
                "UPDATE admin_users
                 SET username = :username,
                     password_hash = :password_hash
                 WHERE id = :id"
            );

            return $stmt->execute([
                ':username' => $username,
                ':password_hash' => $passwordHash,
                ':id' => (int) $id,
            ]);
        }

        $stmt = $conn->prepare(
            "UPDATE admin_users
             SET username = :username
             WHERE id = :id"
        );

        return $stmt->execute([
            ':username' => $username,
            ':id' => (int) $id,
        ]);
    }

    public function deleteById($id): bool
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare(
            'DELETE FROM admin_users WHERE id = :id'
        );

        return $stmt->execute([
            ':id' => (int) $id,
        ]);
    }

    public function countByRole($role): int
    {
        if (!$this->hasRoleColumn()) {
            return 0;
        }

        $conn = $this->db->getConnection();
        $stmt = $conn->prepare(
            'SELECT COUNT(*) FROM admin_users WHERE role = :role'
        );
        $stmt->execute([
            ':role' => $role,
        ]);

        return (int) $stmt->fetchColumn();
    }
}
