
<?php
// Session sudah dimulai oleh aplikasi. Gunakan fallback jika diperlukan.
if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}

// Buat token CSRF jika belum ada.
if (
    session_status() === PHP_SESSION_ACTIVE &&
    (
        empty($_SESSION['pengaduan_csrf']) ||
        !is_string($_SESSION['pengaduan_csrf'])
    )
) {
    $_SESSION['pengaduan_csrf'] = bin2hex(random_bytes(32));
}

$csrfToken = session_status() === PHP_SESSION_ACTIVE
    ? ($_SESSION['pengaduan_csrf'] ?? '')
    : '';

// Baca konfigurasi lokal. Secret tidak pernah dikirim ke HTML.
$configPath = __DIR__ . '/../../../config/pengaduan_security.local.php';
$securityConfig = is_file($configPath) ? require $configPath : [];

if (!is_array($securityConfig)) {
    $securityConfig = [];
}

$turnstileConfig = is_array($securityConfig['turnstile'] ?? null)
    ? $securityConfig['turnstile']
    : [];

$siteKey = $securityConfig['turnstile_site_key']
    ?? $securityConfig['site_key']
    ?? $turnstileConfig['site_key']
    ?? '';

$secretKey = $securityConfig['turnstile_secret_key']
    ?? $securityConfig['secret_key']
    ?? $turnstileConfig['secret_key']
    ?? '';

$hmacSecret = $securityConfig['rate_limit_hmac_secret']
    ?? $securityConfig['hmac_secret']
    ?? $securityConfig['ip_hash_secret']
    ?? '';
    
$allowedHostnames = $securityConfig['allowed_hostnames']
    ?? $securityConfig['hostnames']
    ?? ['desapadangan.site', 'www.desapadangan.site'];

$turnstileReady =
    is_string($siteKey) &&
    trim($siteKey) !== '' &&
    is_string($secretKey) &&
    trim($secretKey) !== '' &&
    is_string($hmacSecret) &&
    strlen($hmacSecret) >= 32 &&
    is_array($allowedHostnames) &&
    !empty($allowedHostnames) &&
    $csrfToken !== '';

$siteKey = is_string($siteKey) ? trim($siteKey) : '';
$siteKeyJs = json_encode(
    $siteKey,
    JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP
);

// Gunakan base path, bukan hostname dari request, untuk action formulir.
$scriptDirectory = dirname($_SERVER['SCRIPT_NAME'] ?? '/index.php');
$basePath = rtrim($scriptDirectory, '/\\');

if ($basePath === '.' || $basePath === '/') {
    $basePath = '';
}

$formAction = $basePath . '/index.php?url=pengaduan/store';

// Ambil pesan flash satu kali setelah redirect.
$flash = null;

if (session_status() === PHP_SESSION_ACTIVE) {
    $flash = $_SESSION['pengaduan_flash'] ?? null;
    unset($_SESSION['pengaduan_flash']);
}

$flashType = is_array($flash) ? ($flash['type'] ?? '') : '';
$flashMessage = is_array($flash) && is_string($flash['message'] ?? null)
    ? $flash['message']
    : '';

$flashClass = $flashType === 'success'
    ? 'bg-green-50 border-green-200 text-green-800'
    : 'bg-red-50 border-red-200 text-red-700';

$showFlash = in_array($flashType, ['success', 'error'], true)
    && $flashMessage !== '';
?>

<!-- Tombol Pengaduan -->
<div class="reveal-right relative">
    <button
        type="button"
        onclick="toggleModal('pengaduanModal')"
        class="bg-[#2F855A] hover:bg-green-700 text-white w-12 h-12 md:w-auto md:h-auto md:px-6 md:py-3 rounded-full shadow-xl font-semibold flex items-center justify-center md:gap-2 transform transition-all duration-200 hover:-translate-y-1"
        aria-haspopup="dialog"
        aria-controls="pengaduanModal"
    >
        <span class="flex items-center justify-center">
            <svg width="20" height="20" viewBox="0 0 24 23"
                fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path
                    d="M3 10H6C7.10457 10 8 10.8954 8 12V15C8 16.1046 7.10457 17 6 17H5C3.89543 17 3 16.1046 3 15V10ZM3 10C3 5.02944 7.02944 1 12 1C16.9706 1 21 5.02944 21 10M21 10V15M21 10H18C16.8954 10 16 10.8954 16 12V15C16 16.1046 16.8954 17 18 17H19C20.1046 17 21 16.1046 21 15ZM21 15V17C21 18.0609 20.5786 19.0783 19.8284 19.8284C19.0783 20.5786 18.0609 21 17 21H12"
                    stroke="white" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </span>
        <span class="hidden md:inline text-sm md:text-base">
            Pengaduan Desa
        </span>
    </button>
</div>

<!-- Modal Form Pengaduan -->
<div
    id="pengaduanModal"
    class="hidden fixed inset-0 z-[60] bg-black/60 flex items-center justify-end p-4 overflow-y-auto pt-24 pb-10 backdrop-blur-sm transition-opacity duration-300"
    role="dialog"
    aria-modal="true"
    aria-labelledby="pengaduanTitle"
    data-has-flash="<?= $showFlash ? '1' : '0' ?>"
>
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-6 md:p-8 relative max-h-[90vh] overflow-y-auto">

        <!-- Tombol Tutup -->
        <button
            type="button"
            onclick="toggleModal('pengaduanModal')"
            class="absolute top-4 right-4 bg-gray-100 hover:bg-gray-200 text-gray-700 w-9 h-9 rounded-xl flex items-center justify-center text-lg font-bold transition-colors"
            aria-label="Tutup formulir pengaduan"
        >
            &times;
        </button>

        <!-- Header -->
        <div class="text-center mb-6 pr-6 pl-6">
            <h3 id="pengaduanTitle" class="text-2xl font-bold text-[#172033] mb-1">
                Pengaduan Desa
            </h3>
            <p class="text-xs md:text-sm text-gray-500">
                Sampaikan pengaduan atau keluhan Anda kepada Pemerintah Desa Padangan.
            </p>
        </div>

        <?php if ($showFlash): ?>
            <div
                class="mb-4 rounded-xl border p-3 text-sm <?= $flashClass ?>"
                role="<?= $flashType === 'error' ? 'alert' : 'status' ?>"
                aria-live="polite"
            >
                <?= htmlspecialchars($flashMessage, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <?php if (!$turnstileReady): ?>
            <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-700" role="alert">
                Formulir pengaduan sementara belum siap digunakan karena konfigurasi keamanan belum lengkap. Silakan hubungi admin desa.
            </div>
        <?php endif; ?>

        <form
            action="<?= htmlspecialchars($formAction, ENT_QUOTES, 'UTF-8') ?>"
            method="POST"
            enctype="multipart/form-data"
            id="formPengaduan"
        >
            <input
                type="hidden"
                name="csrf_token"
                value="<?= htmlspecialchars((string) $csrfToken, ENT_QUOTES, 'UTF-8') ?>"
            >

            <input
                type="hidden"
                name="form_started_at"
                id="pengaduanFormStartedAt"
                value="0"
            >

            <!-- Honeypot: harus selalu kosong, ditujukan untuk mendeteksi bot -->
            <div
                style="position:absolute; left:-10000px; top:auto; width:1px; height:1px; overflow:hidden;"
                aria-hidden="true"
            >
                <label for="pengaduanWebsite">Jangan isi kolom ini</label>
                <input
                    type="text"
                    id="pengaduanWebsite"
                    name="website"
                    value=""
                    tabindex="-1"
                    autocomplete="off"
                >
            </div>

            <!-- Nama -->
            <div class="mb-4">
                <label for="pengaduanNama" class="block text-sm font-bold text-[#172033] mb-1.5">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="pengaduanNama"
                    name="nama"
                    required
                    maxlength="100"
                    autocomplete="name"
                    class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm"
                    placeholder="Nama lengkap Anda"
                >
            </div>

            <!-- Kontak -->
            <div class="mb-4">
                <label for="pengaduanKontak" class="block text-sm font-bold text-[#172033] mb-1.5">
                    No. Telp/WhatsApp <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="pengaduanKontak"
                    name="kontak"
                    required
                    maxlength="50"
                    autocomplete="tel"
                    class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm"
                    placeholder="08123456789"
                >
            </div>

            <!-- Judul -->
            <div class="mb-4">
                <label for="pengaduanJudul" class="block text-sm font-bold text-[#172033] mb-1.5">
                    Judul Laporan <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="pengaduanJudul"
                    name="judul"
                    required
                    maxlength="150"
                    class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm"
                    placeholder="Contoh: Lampu jalan mati di RT 02"
                >
            </div>

            <!-- Isi -->
            <div class="mb-4">
                <label for="pengaduanIsi" class="block text-sm font-bold text-[#172033] mb-1.5">
                    Uraian Pengaduan <span class="text-red-500">*</span>
                </label>
                <textarea
                    id="pengaduanIsi"
                    name="isi"
                    required
                    maxlength="5000"
                    rows="4"
                    class="w-full border border-gray-200 rounded-xl p-3 focus:ring-2 focus:ring-[#2F855A] outline-none text-sm text-gray-700 bg-white shadow-sm resize-none"
                    placeholder="Tuliskan detail laporan Anda secara lengkap..."
                ></textarea>
            </div>

            <!-- Lampiran -->
            <div class="mb-5">
                <label for="inputFoto" class="block text-sm font-bold text-[#172033] mb-1.5">
                    Lampiran Foto
                    <span class="text-xs font-normal text-gray-500">
                        (Maks. 3 foto, maks. 5 MB per foto)
                    </span>
                </label>

                <input
                    type="file"
                    id="inputFoto"
                    name="foto[]"
                    multiple
                    accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                    class="w-full border border-gray-200 rounded-xl p-2.5 text-sm bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#2F855A] file:text-white hover:file:bg-green-700 cursor-pointer"
                >

                <div
                    id="fileErrorMsg"
                    class="hidden mt-2 p-2.5 bg-red-50 border border-red-200 text-red-600 text-xs rounded-xl"
                    role="alert"
                    aria-live="polite"
                >
                    <span id="errorText"></span>
                </div>

                <p class="text-[11px] text-gray-400 mt-1">
                    Format yang didukung: JPG, JPEG, PNG. Total seluruh foto maksimal 15 MB.
                </p>

                <div id="previewContainer" class="flex gap-3 mt-3 flex-wrap"></div>
            </div>

            <!-- Verifikasi Turnstile -->
            <?php if ($turnstileReady): ?>
                <div class="mb-5">
                    <p class="text-sm font-semibold text-[#172033] mb-2">
                        Verifikasi keamanan
                    </p>
                    <div id="turnstilePengaduan"></div>
                    <p class="text-xs text-gray-500 mt-2">
                        Selesaikan verifikasi sebelum mengirim pengaduan.
                    </p>
                </div>
            <?php endif; ?>

            <!-- Status validasi dari browser -->
            <div
                id="pengaduanClientMessage"
                class="hidden mb-4 rounded-xl border border-red-200 bg-red-50 p-3 text-sm text-red-700"
                role="alert"
                aria-live="polite"
            ></div>

            <!-- Tombol Kirim -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    id="pengaduanSubmitButton"
                    <?= !$turnstileReady ? 'disabled' : '' ?>
                    class="bg-[#2F855A] hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed text-white font-semibold px-6 py-3 rounded-xl transition-colors flex items-center gap-2 shadow-md cursor-pointer"
                >
                    <svg width="19" height="19" viewBox="0 0 19 19"
                        fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path
                            d="M17.5448 1.12458L8.42817 10.2404M11.4465 17.4071C11.4782 17.486 11.5332 17.5533 11.6042 17.6C11.6753 17.6468 11.7589 17.6706 11.8439 17.6684C11.9289 17.6663 12.0112 17.6381 12.0797 17.5879C12.1482 17.5376 12.1998 17.4675 12.2273 17.3871L17.644 1.55375C17.6707 1.47991 17.6758 1.4 17.6587 1.32338C17.6416 1.24675 17.603 1.17658 17.5475 1.12106C17.492 1.06555 17.4218 1.02699 17.3452 1.00991C17.2686 0.992822 17.1887 0.997911 17.1148 1.02458L1.2815 6.44125C1.20108 6.46883 1.13103 6.52035 1.08073 6.58889C1.03044 6.65744 1.00231 6.73972 1.00014 6.82471C0.99796 6.9097 1.02183 6.99332 1.06855 7.06435C1.11527 7.13538 1.1826 7.19042 1.2615 7.22208L7.86984 9.87208C8.07874 9.95572 8.26855 10.0808 8.42781 10.2398C8.58707 10.3987 8.71249 10.5883 8.7965 10.7971L11.4465 17.4071Z"
                            stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                        />
                    </svg>
                    <span id="pengaduanSubmitLabel">Kirim</span>
                </button>
            </div>
        </form>
    </div>
</div>

<?php if ($turnstileReady): ?>
<script>
(function () {
    const siteKey = <?= $siteKeyJs ?: '""' ?>;
    const modal = document.getElementById('pengaduanModal');

    window.pengaduanTurnstileWidgetId = null;

    window.renderPengaduanTurnstile = function (resetExisting) {
        if (
            !window.turnstile ||
            !modal ||
            modal.classList.contains('hidden')
        ) {
            return;
        }

        if (window.pengaduanTurnstileWidgetId !== null) {
            if (resetExisting) {
                try {
                    window.turnstile.reset(window.pengaduanTurnstileWidgetId);
                } catch (error) {
                    console.error('Turnstile reset failed.');
                }
            }
            return;
        }

        try {
            window.pengaduanTurnstileWidgetId = window.turnstile.render(
                '#turnstilePengaduan',
                {
                    sitekey: siteKey,
                    action: 'pengaduan',
                    'error-callback': function () {
                        showPengaduanMessage(
                            'Verifikasi keamanan mengalami kendala. Silakan coba lagi.'
                        );
                    },
                    'expired-callback': function () {
                        showPengaduanMessage(
                            'Verifikasi keamanan kedaluwarsa. Silakan verifikasi kembali.'
                        );
                    }
                }
            );
        } catch (error) {
            showPengaduanMessage(
                'Verifikasi keamanan belum dapat dimuat. Muat ulang halaman dan coba lagi.'
            );
        }
    };

    // Callback yang dipanggil setelah API Turnstile siap.
    window.onPengaduanTurnstileLoaded = function () {
        window.renderPengaduanTurnstile(false);
    };
})();
</script>
<script
    src="https://challenges.cloudflare.com/turnstile/v0/api.js?onload=onPengaduanTurnstileLoaded&render=explicit"
    async
    defer
></script>
<?php endif; ?>

<script>
(function () {
    const modal = document.getElementById('pengaduanModal');
    const form = document.getElementById('formPengaduan');
    const startedAt = document.getElementById('pengaduanFormStartedAt');
    const fileInput = document.getElementById('inputFoto');
    const errorBox = document.getElementById('fileErrorMsg');
    const errorText = document.getElementById('errorText');
    const previewContainer = document.getElementById('previewContainer');
    const submitButton = document.getElementById('pengaduanSubmitButton');
    const submitLabel = document.getElementById('pengaduanSubmitLabel');
    const clientMessage = document.getElementById('pengaduanClientMessage');

    if (!modal || !form || !startedAt || !fileInput) {
        return;
    }

    let selectedFiles = [];

    function showFileError(message) {
        errorText.textContent = message;
        errorBox.classList.remove('hidden');
    }

    function clearFileError() {
        errorBox.classList.add('hidden');
        errorText.textContent = '';
    }

    window.showPengaduanMessage = function (message) {
        clientMessage.textContent = message;
        clientMessage.classList.remove('hidden');
    };

    function clearPengaduanMessage() {
        clientMessage.textContent = '';
        clientMessage.classList.add('hidden');
    }

    function updateInputFiles() {
        const transfer = new DataTransfer();

        selectedFiles.forEach(function (file) {
            transfer.items.add(file);
        });

        fileInput.files = transfer.files;
    }

    function renderPreviews() {
        previewContainer.replaceChildren();

        selectedFiles.forEach(function (file, index) {
            const reader = new FileReader();

            reader.onload = function (event) {
                const wrapper = document.createElement('div');
                wrapper.className =
                    'relative w-20 h-20 rounded-xl border border-gray-200 overflow-hidden shadow-xs';

                const image = document.createElement('img');
                image.src = event.target.result;
                image.alt = 'Pratinjau foto ' + (index + 1);
                image.className = 'w-full h-full object-cover';

                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.textContent = '×';
                removeButton.setAttribute(
                    'aria-label',
                    'Hapus foto ' + (index + 1)
                );
                removeButton.className =
                    'absolute top-1 right-1 bg-red-600 hover:bg-red-700 text-white w-5 h-5 rounded-full flex items-center justify-center text-xs font-bold shadow-md cursor-pointer';

                removeButton.addEventListener('click', function () {
                    selectedFiles.splice(index, 1);
                    updateInputFiles();
                    renderPreviews();
                    clearFileError();
                });

                wrapper.appendChild(image);
                wrapper.appendChild(removeButton);
                previewContainer.appendChild(wrapper);
            };

            reader.readAsDataURL(file);
        });
    }

    fileInput.addEventListener('change', function (event) {
        clearFileError();

        const newFiles = Array.from(event.target.files || []);
        if (newFiles.length === 0) {
            return;
        }

        const candidateFiles = selectedFiles.concat(newFiles);

        if (candidateFiles.length > 3) {
            showFileError('Maksimal lampiran adalah 3 foto.');
            updateInputFiles();
            return;
        }

        const allowedTypes = ['image/jpeg', 'image/png'];
        const maxFileSize = 5 * 1024 * 1024;
        const maxTotalSize = 15 * 1024 * 1024;

        const unsupported = newFiles.some(function (file) {
            return !allowedTypes.includes(file.type);
        });

        if (unsupported) {
            showFileError('Format foto hanya boleh JPG, JPEG, atau PNG.');
            updateInputFiles();
            return;
        }

        const tooLarge = newFiles.some(function (file) {
            return file.size <= 0 || file.size > maxFileSize;
        });

        if (tooLarge) {
            showFileError('Setiap foto harus berukuran maksimal 5 MB.');
            updateInputFiles();
            return;
        }

        const totalSize = candidateFiles.reduce(function (total, file) {
            return total + file.size;
        }, 0);

        if (totalSize > maxTotalSize) {
            showFileError('Total ukuran seluruh foto maksimal 15 MB.');
            updateInputFiles();
            return;
        }

        selectedFiles = candidateFiles;
        updateInputFiles();
        renderPreviews();
    });

    // Mulai hitung waktu ketika modal dibuka, bukan saat halaman dimuat.
    function markFormOpened() {
        if (!modal.classList.contains('hidden')) {
            startedAt.value = String(Math.floor(Date.now() / 1000));
            clearPengaduanMessage();

            if (window.renderPengaduanTurnstile) {
                window.renderPengaduanTurnstile(true);
            }
        }
    }

    document
        .querySelectorAll('[onclick*="toggleModal(\'pengaduanModal\')"]')
        .forEach(function (button) {
            button.addEventListener('click', function () {
                window.setTimeout(markFormOpened, 0);
            });
        });

    // Buka kembali modal setelah controller mengarahkan pengguna ke formulir.
    function handleInitialModalState() {
        const hasFlash = modal.dataset.hasFlash === '1';

        if (window.location.hash === '#pengaduanModal' || hasFlash) {
            modal.classList.remove('hidden');
            markFormOpened();

            if (window.renderPengaduanTurnstile) {
                window.renderPengaduanTurnstile(false);
            }
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener(
            'DOMContentLoaded',
            handleInitialModalState,
            { once: true }
        );
    } else {
        handleInitialModalState();
    }

    form.addEventListener('submit', function (event) {
        clearPengaduanMessage();

        const responseField = form.querySelector(
            'input[name="cf-turnstile-response"]'
        );

        if (!responseField || !responseField.value) {
            event.preventDefault();
            showPengaduanMessage(
                'Selesaikan verifikasi keamanan sebelum mengirim pengaduan.'
            );
            return;
        }

        if (selectedFiles.length > 3) {
            event.preventDefault();
            showPengaduanMessage('Maksimal lampiran adalah 3 foto.');
            return;
        }

        if (submitButton) {
            submitButton.disabled = true;
        }

        if (submitLabel) {
            submitLabel.textContent = 'Mengirim...';
        }
    });
})();
</script>
