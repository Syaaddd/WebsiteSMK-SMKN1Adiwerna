<?php
$page_title = 'Tenaga Pendidik';
$active_nav = 'guru';
require_once '../config/database.php';
include '../includes/header.php';
include '../includes/navbar.php';

$guru_data = [
    ['nama'=>'Drs. H. Ahmad Fauzi, M.Pd.','jabatan'=>'Kepala Sekolah','jurusan'=>'Manajemen Pendidikan','emoji'=>'👨‍💼','nip'=>'196804251994031002'],
    ['nama'=>'Dra. Sri Wahyuni, M.Si.','jabatan'=>'Waka Kurikulum','jurusan'=>'Kimia','emoji'=>'👩‍🏫','nip'=>'197002141994032001'],
    ['nama'=>'Hendra Setiawan, S.Pd., M.Pd.','jabatan'=>'Waka Kesiswaan','jurusan'=>'Pendidikan Jasmani','emoji'=>'👨‍🏫','nip'=>'197508122000121002'],
    ['nama'=>'Dra. Nurul Hidayah','jabatan'=>'Waka Sarana Prasarana','jurusan'=>'Administrasi Perkantoran','emoji'=>'👩‍💼','nip'=>'196906151994032004'],
    ['nama'=>'Agus Santoso, S.Kom., M.T.','jabatan'=>'Ketua Jurusan TKJ','jurusan'=>'Teknik Komputer & Jaringan','emoji'=>'👨‍💻','nip'=>'198003042003121001'],
    ['nama'=>'Dewi Rahayu, S.Pd., M.Kom.','jabatan'=>'Ketua Jurusan RPL','jurusan'=>'Rekayasa Perangkat Lunak','emoji'=>'👩‍💻','nip'=>'198209152006042001'],
    ['nama'=>'Bambang Irawan, S.E., M.Ak.','jabatan'=>'Ketua Jurusan AKL','jurusan'=>'Akuntansi & Keuangan','emoji'=>'👨‍💼','nip'=>'197706252001121002'],
    ['nama'=>'Rina Kusumawati, S.Pd.','jabatan'=>'Ketua Jurusan MM','jurusan'=>'Multimedia','emoji'=>'👩‍🎨','nip'=>'198412202008012003'],
    ['nama'=>'Siti Aminah, S.Pd., M.Pd.','jabatan'=>'Guru BK','jurusan'=>'Bimbingan Konseling','emoji'=>'👩‍🏫','nip'=>'197901302001122003'],
    ['nama'=>'Drs. Supriyadi','jabatan'=>'Guru Produktif TKJ','jurusan'=>'Jaringan Komputer','emoji'=>'👨‍💻','nip'=>'196808041994031005'],
    ['nama'=>'Ahmad Ridwan, S.T.','jabatan'=>'Guru Produktif RPL','jurusan'=>'Pemrograman Web','emoji'=>'👨‍💻','nip'=>'198511142008011002'],
    ['nama'=>'Eni Sulistyowati, S.Pd.','jabatan'=>'Guru Produktif AKL','jurusan'=>'Perpajakan','emoji'=>'👩‍🏫','nip'=>'198208072006042002'],
];
?>

<div class="pt-16">

<section class="bg-stone-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_70%_50%,rgba(249,115,22,0.1)_0%,transparent_65%)]"></div>
    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-14 relative z-10">
        <div class="flex items-center gap-2 text-stone-400 text-sm mb-3">
            <a href="<?= BASE_URL ?>/" class="hover:text-white transition-colors">Beranda</a>
            <span>›</span>
            <span class="text-orange-400">Tenaga Pendidik</span>
        </div>
        <h1 class="font-heading text-4xl lg:text-5xl font-black text-white mb-3">Tenaga <span class="text-orange-500">Pendidik</span></h1>
        <p class="text-stone-300 max-w-xl">Guru-guru kompeten dan berpengalaman yang berkomitmen memberikan pendidikan terbaik untuk setiap siswa SMKN 1 Adiwerna.</p>
    </div>
    <div class="h-px bg-gradient-to-r from-orange-500 via-orange-400/30 to-transparent"></div>
</section>

<main class="max-w-7xl mx-auto px-4 lg:px-8 py-12">

    <!-- Stats Guru -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10 reveal">
        <?php
        $stats = [
            ['val'=>'120+','label'=>'Total Guru & Staff','icon'=>'👥'],
            ['val'=>'85%','label'=>'Kualifikasi S1/S2','icon'=>'🎓'],
            ['val'=>'15','label'=>'Guru Bersertifikat Industri','icon'=>'🏅'],
            ['val'=>'30+','label'=>'Rata-rata Pengalaman (Thn)','icon'=>'⏳'],
        ];
        foreach ($stats as $s): ?>
        <div class="bg-white rounded-2xl border border-stone-200 p-5 text-center card-hover">
            <div class="text-3xl mb-2"><?= $s['icon'] ?></div>
            <div class="font-heading font-black text-orange-500 text-2xl"><?= $s['val'] ?></div>
            <div class="text-stone-500 text-xs mt-0.5"><?= $s['label'] ?></div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Grid Guru -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        <?php foreach ($guru_data as $g): ?>
        <div class="bg-white rounded-2xl border border-stone-200 p-5 text-center card-hover reveal">
            <div class="w-16 h-16 bg-stone-100 rounded-2xl flex items-center justify-center text-4xl mx-auto mb-3">
                <?= $g['emoji'] ?>
            </div>
            <div class="font-semibold text-stone-900 text-sm leading-snug mb-1"><?= $g['nama'] ?></div>
            <span class="badge badge-orange mb-2"><?= $g['jabatan'] ?></span><br>
            <div class="text-stone-500 text-xs mt-2"><?= $g['jurusan'] ?></div>
            <div class="text-stone-300 text-[10px] mt-1">NIP. <?= $g['nip'] ?></div>
        </div>
        <?php endforeach; ?>
        <!-- Card tambah placeholder -->
        <div class="bg-stone-50 rounded-2xl border border-dashed border-stone-300 p-5 text-center flex flex-col items-center justify-center gap-2 reveal">
            <div class="w-16 h-16 bg-stone-100 rounded-2xl flex items-center justify-center text-3xl">➕</div>
            <div class="text-stone-400 text-sm">& 100+ guru lainnya</div>
        </div>
    </div>

</main>

<?php include '../includes/footer.php'; ?>
