<?php
session_start();
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/config/settings.php';

// Guard
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: ' . BASE_URL . '/admin/login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/admin/index.php?menu=pengaturan');
    exit;
}

$section  = $_POST['_section']  ?? '';
$redirect = BASE_URL . '/admin/index.php?menu=pengaturan&tab=' . $section;

$settings = getSettings();
$ok = false;

// Store raw values — htmlspecialchars only when rendering HTML output
function clean(string $key, string $default = ''): string {
    return trim($_POST[$key] ?? $default);
}

switch ($section) {

    // ── Informasi Sekolah ────────────────────────────────────────────
    case 'sekolah':
        $settings['sekolah'] = [
            'nama'              => clean('nama'),
            'tagline'           => clean('tagline'),
            'deskripsi'         => clean('deskripsi'),
            'npsn'              => clean('npsn'),
            'nss'               => clean('nss'),
            'akreditasi'        => clean('akreditasi'),
            'tahun_berdiri'     => clean('tahun_berdiri'),
            'kepala_sekolah'    => clean('kepala_sekolah'),
            'nip_kepala'        => clean('nip_kepala'),
            'total_siswa'       => clean('total_siswa'),
            'total_guru'        => clean('total_guru'),
            'program_keahlian'  => clean('program_keahlian'),
            'tingkat_kelulusan' => clean('tingkat_kelulusan'),
        ];
        $ok = saveSettings($settings);
        break;

    // ── Kontak & Lokasi ──────────────────────────────────────────────
    case 'kontak':
        $settings['kontak'] = [
            'alamat'      => clean('alamat'),
            'kode_pos'    => clean('kode_pos'),
            'kecamatan'   => clean('kecamatan'),
            'kabupaten'   => clean('kabupaten'),
            'provinsi'    => clean('provinsi'),
            'telepon'     => clean('telepon'),
            'whatsapp'    => preg_replace('/\D/', '', clean('whatsapp')),
            'email'       => filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL),
            'website'     => clean('website'),
            'jam_layanan' => clean('jam_layanan'),
            'maps_link'   => clean('maps_link'),
            'maps_embed'  => trim($_POST['maps_embed'] ?? ''),
        ];
        $ok = saveSettings($settings);
        break;

    // ── Media Sosial ─────────────────────────────────────────────────
    case 'sosmed':
        $settings['sosmed'] = [
            'facebook'  => clean('facebook'),
            'instagram' => clean('instagram'),
            'youtube'   => clean('youtube'),
            'tiktok'    => clean('tiktok'),
        ];
        $ok = saveSettings($settings);
        break;

    // ── PPDB ─────────────────────────────────────────────────────────
    case 'ppdb':
        $settings['ppdb'] = [
            'aktif'            => isset($_POST['aktif']),
            'tahun_ajaran'     => clean('tahun_ajaran'),
            'tgl_buka'         => clean('tgl_buka'),
            'tgl_tutup'        => clean('tgl_tutup'),
            'tgl_pengumuman'   => clean('tgl_pengumuman'),
            'tgl_daftar_ulang' => clean('tgl_daftar_ulang'),
            'kuota_per_jurusan'=> max(1, (int)($_POST['kuota_per_jurusan'] ?? 36)),
            'catatan'          => clean('catatan'),
        ];
        $ok = saveSettings($settings);
        break;

    // ── Ticker ───────────────────────────────────────────────────────
    case 'ticker':
        $raw  = $_POST['ticker'] ?? [];
        $items = array_values(array_filter(array_map(function($v) {
            return htmlspecialchars(trim($v), ENT_QUOTES, 'UTF-8');
        }, (array) $raw)));
        $settings['ticker'] = $items;
        $ok = saveSettings($settings);
        break;

    // ── SEO ──────────────────────────────────────────────────────────
    case 'seo':
        $settings['seo'] = [
            'meta_description' => clean('meta_description'),
            'meta_keywords'    => clean('meta_keywords'),
            'google_analytics' => clean('google_analytics'),
        ];
        $ok = saveSettings($settings);
        break;

    // ── Keamanan (ganti password / username) ─────────────────────────
    case 'keamanan':
        $current  = $_POST['current_password'] ?? '';
        $new_pass = $_POST['new_password']      ?? '';
        $confirm  = $_POST['confirm_password']  ?? '';
        $new_user = trim($_POST['username']      ?? '');

        if ($current !== $settings['admin']['password']) {
            header('Location: ' . $redirect . '&status=wrong_password');
            exit;
        }
        if ($new_pass && $new_pass !== $confirm) {
            header('Location: ' . $redirect . '&status=password_mismatch');
            exit;
        }
        if (strlen($new_pass) > 0 && strlen($new_pass) < 8) {
            header('Location: ' . $redirect . '&status=password_too_short');
            exit;
        }
        if ($new_user) {
            $settings['admin']['username'] = htmlspecialchars($new_user, ENT_QUOTES, 'UTF-8');
            $_SESSION['admin_user'] = $settings['admin']['username'];
        }
        if ($new_pass) {
            $settings['admin']['password'] = $new_pass;
        }
        $ok = saveSettings($settings);
        break;

    default:
        header('Location: ' . BASE_URL . '/admin/index.php?menu=pengaturan');
        exit;
}

header('Location: ' . $redirect . '&status=' . ($ok ? 'success' : 'error'));
exit;
