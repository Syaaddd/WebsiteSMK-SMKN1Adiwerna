<?php
if (!defined('SETTINGS_FILE')) {
    define('SETTINGS_FILE', __DIR__ . '/settings.json');
}

function getSettings(): array {
    if (!file_exists(SETTINGS_FILE)) {
        $defaults = getDefaultSettings();
        saveSettings($defaults);
        return $defaults;
    }
    $json = file_get_contents(SETTINGS_FILE);
    $data = json_decode($json, true);
    return is_array($data) ? array_replace_recursive(getDefaultSettings(), $data) : getDefaultSettings();
}

function saveSettings(array $settings): bool {
    return (bool) file_put_contents(
        SETTINGS_FILE,
        json_encode($settings, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
    );
}

function getSetting(string $path, $default = null) {
    $settings = getSettings();
    foreach (explode('.', $path) as $key) {
        if (!is_array($settings) || !array_key_exists($key, $settings)) return $default;
        $settings = $settings[$key];
    }
    return $settings;
}

function getDefaultSettings(): array {
    return [
        'sekolah' => [
            'nama'             => 'SMKN 1 Adiwerna',
            'tagline'          => 'Membentuk Generasi Terampil & Berkarakter',
            'deskripsi'        => 'SMK Negeri 1 Adiwerna adalah sekolah kejuruan unggulan Akreditasi A di Kabupaten Tegal, Jawa Tengah.',
            'npsn'             => '20327921',
            'nss'              => '401032801001',
            'akreditasi'       => 'A',
            'tahun_berdiri'    => '1968',
            'kepala_sekolah'   => 'Drs. H. Ahmad Fauzi, M.Pd.',
            'nip_kepala'       => '196804251994031002',
            'total_siswa'      => '2.400+',
            'total_guru'       => '120+',
            'program_keahlian' => '8',
            'tingkat_kelulusan'=> '95%',
        ],
        'kontak' => [
            'alamat'      => 'Jl. Dewi Sartika No.1, Adiwerna',
            'kode_pos'    => '52194',
            'kecamatan'   => 'Adiwerna',
            'kabupaten'   => 'Kabupaten Tegal',
            'provinsi'    => 'Jawa Tengah',
            'telepon'     => '(0283) 444555',
            'whatsapp'    => '6282344555',
            'email'       => 'info@smkn1adiwerna.sch.id',
            'website'     => 'www.smkn1adiwerna.sch.id',
            'jam_layanan' => 'Senin–Jumat: 07.00 – 15.30 WIB',
            'maps_link'   => 'https://maps.google.com/?q=SMKN+1+Adiwerna+Tegal',
            'maps_embed'  => '',
        ],
        'sosmed' => [
            'facebook'  => '#',
            'instagram' => '#',
            'youtube'   => '#',
            'tiktok'    => '#',
        ],
        'ppdb' => [
            'aktif'              => true,
            'tahun_ajaran'       => '2025/2026',
            'tgl_buka'           => '2025-05-01',
            'tgl_tutup'          => '2025-05-20',
            'tgl_pengumuman'     => '2025-05-28',
            'tgl_daftar_ulang'   => '2025-05-29',
            'kuota_per_jurusan'  => 36,
            'catatan'            => '',
        ],
        'ticker' => [
            'Pendaftaran PPDB 2025/2026 dibuka mulai 1 Mei 2025',
            'Pengumuman kelulusan siswa kelas XII telah tersedia di website',
            'Lomba Kompetensi Siswa (LKS) tingkat Kab. Tegal — SMKN 1 raih 3 medali emas',
            'Jadwal UTS Semester Genap 2024/2025 telah diterbitkan',
            'Workshop Industri bersama PT. Astra International untuk siswa TKJ & RPL',
        ],
        'admin' => [
            'username' => 'admin',
            'password' => 'smkn1adiwerna2025',
        ],
        'seo' => [
            'meta_description' => 'Website resmi SMK Negeri 1 Adiwerna, Kabupaten Tegal, Jawa Tengah. Sekolah kejuruan unggulan Akreditasi A.',
            'meta_keywords'    => 'SMKN 1 Adiwerna, SMK Tegal, PPDB 2025, sekolah kejuruan tegal, SMK Adiwerna',
            'google_analytics' => '',
        ],
    ];
}
