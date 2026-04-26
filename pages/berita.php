<?php
$page_title = 'Berita & Pengumuman';
$active_nav = 'berita';
require_once '../config/database.php';
include '../includes/header.php';
include '../includes/navbar.php';

$kategori_filter = $_GET['kategori'] ?? 'semua';

$berita = [
    ['id'=>1,'kategori'=>'PPDB','tag_class'=>'badge-orange','title'=>'Pendaftaran PPDB Jalur Prestasi dan Reguler 2025/2026 Resmi Dibuka','excerpt'=>'SMK Negeri 1 Adiwerna membuka pendaftaran peserta didik baru (PPDB) untuk tahun pelajaran 2025/2026 melalui jalur prestasi dan reguler mulai tanggal 1 Mei 2025.','date'=>'20 Apr 2025','views'=>'1.2k','img_emoji'=>'🎓','color'=>'from-orange-100 to-amber-50'],
    ['id'=>2,'kategori'=>'Prestasi','tag_class'=>'badge-green','title'=>'Siswa SMKN 1 Adiwerna Raih Juara 1 LKS Bidang Web Technology Tingkat Nasional','excerpt'=>'Bangga! Ahmad Rizki Pratama, siswa kelas XII RPL, berhasil meraih medali emas dalam ajang Lomba Kompetensi Siswa (LKS) SMK Nasional 2025 bidang Web Technology yang diselenggarakan di Jakarta.','date'=>'15 Apr 2025','views'=>'3.5k','img_emoji'=>'🏆','color'=>'from-green-100 to-emerald-50'],
    ['id'=>3,'kategori'=>'Kegiatan','tag_class'=>'badge-blue','title'=>'Kunjungan Industri Jurusan RPL ke PT. Gojek Indonesia, Jakarta','excerpt'=>'Sebanyak 85 siswa jurusan Rekayasa Perangkat Lunak mengikuti kunjungan industri ke kantor pusat PT. Gojek Indonesia di Jakarta untuk mengenal langsung ekosistem teknologi startup unicorn Indonesia.','date'=>'10 Apr 2025','views'=>'892','img_emoji'=>'🚌','color'=>'from-blue-100 to-sky-50'],
    ['id'=>4,'kategori'=>'Akademik','tag_class'=>'badge-gray','title'=>'Jadwal Ujian Tengah Semester Genap Tahun Pelajaran 2024/2025','excerpt'=>'Berikut adalah jadwal resmi Ujian Tengah Semester (UTS) Genap Tahun Pelajaran 2024/2025 untuk seluruh kelas. Ujian akan dilaksanakan mulai tanggal 12 Mei hingga 17 Mei 2025.','date'=>'5 Apr 2025','views'=>'2.1k','img_emoji'=>'📋','color'=>'from-stone-100 to-gray-50'],
    ['id'=>5,'kategori'=>'Prestasi','tag_class'=>'badge-green','title'=>'Tim AKL SMKN 1 Raih Juara 2 Olimpiade Akuntansi Tingkat Jawa Tengah','excerpt'=>'Tim Akuntansi SMKN 1 Adiwerna berhasil meraih juara kedua dalam Olimpiade Akuntansi tingkat Jawa Tengah yang diselenggarakan di Universitas Diponegoro Semarang.','date'=>'1 Apr 2025','views'=>'754','img_emoji'=>'🥈','color'=>'from-purple-100 to-violet-50'],
    ['id'=>6,'kategori'=>'Kegiatan','tag_class'=>'badge-blue','title'=>'Pelatihan Implementasi Kurikulum Merdeka untuk Seluruh Guru SMKN 1','excerpt'=>'SMKN 1 Adiwerna menyelenggarakan pelatihan intensif implementasi Kurikulum Merdeka bagi seluruh tenaga pendidik untuk meningkatkan kualitas pembelajaran di era baru pendidikan Indonesia.','date'=>'28 Mar 2025','views'=>'445','img_emoji'=>'📚','color'=>'from-teal-100 to-cyan-50'],
    ['id'=>7,'kategori'=>'Pengumuman','tag_class'=>'badge-orange','title'=>'Pengumuman Hasil Seleksi Penerimaan Beasiswa Unggulan 2025','excerpt'=>'Kepada seluruh siswa yang telah mendaftar program Beasiswa Unggulan Kementerian Pendidikan, berikut adalah daftar nama siswa yang lulus seleksi administrasi dan berhak mengikuti tahap berikutnya.','date'=>'25 Mar 2025','views'=>'1.8k','img_emoji'=>'📢','color'=>'from-yellow-100 to-amber-50'],
    ['id'=>8,'kategori'=>'Prestasi','tag_class'=>'badge-green','title'=>'Juara Harapan 1 Kompetisi Robot Nasional 2025, Tim TKJ SMKN 1','excerpt'=>'Tim robotika TKJ SMKN 1 Adiwerna berhasil meraih Juara Harapan 1 dalam Kompetisi Robot Nasional 2025 yang diikuti oleh 150 tim dari seluruh Indonesia.','date'=>'20 Mar 2025','views'=>'623','img_emoji'=>'🤖','color'=>'from-indigo-100 to-blue-50'],
    ['id'=>9,'kategori'=>'Kegiatan','tag_class'=>'badge-blue','title'=>'Peringatan Hari Kartini: Fashion Show Tata Busana 2025','excerpt'=>'Dalam rangka memperingati Hari Kartini, Jurusan Tata Busana SMKN 1 Adiwerna menggelar fashion show bertema "Kartini Modern Berkarya" yang menampilkan karya busana rancangan siswa kelas XII.','date'=>'21 Apr 2025','views'=>'1.1k','img_emoji'=>'👗','color'=>'from-pink-100 to-rose-50'],
];

$semua_kategori = ['semua','PPDB','Prestasi','Kegiatan','Akademik','Pengumuman'];

$filtered = $kategori_filter === 'semua' ? $berita : array_filter($berita, fn($b) => $b['kategori'] === $kategori_filter);
$featured = array_shift($berita);
?>

<div class="pt-16">

<!-- Page Hero -->
<section class="bg-stone-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_70%_50%,rgba(249,115,22,0.1)_0%,transparent_65%)]"></div>
    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-14 relative z-10">
        <div class="flex items-center gap-2 text-stone-400 text-sm mb-3">
            <a href="<?= BASE_URL ?>/" class="hover:text-white transition-colors">Beranda</a>
            <span>›</span>
            <span class="text-orange-400">Berita & Pengumuman</span>
        </div>
        <h1 class="font-heading text-4xl lg:text-5xl font-black text-white mb-3">Berita & <span class="text-orange-500">Pengumuman</span></h1>
        <p class="text-stone-300 max-w-2xl">Informasi terkini seputar kegiatan, prestasi, akademik, dan pengumuman resmi SMKN 1 Adiwerna.</p>
    </div>
    <div class="h-px bg-gradient-to-r from-orange-500 via-orange-400/30 to-transparent"></div>
</section>

<main class="max-w-7xl mx-auto px-4 lg:px-8 py-10">

    <!-- Filter Tabs -->
    <div class="flex flex-wrap gap-2 mb-8">
        <?php foreach ($semua_kategori as $kat): ?>
        <a href="?kategori=<?= $kat ?>"
           class="px-4 py-2 rounded-xl text-sm font-semibold transition-all <?= $kategori_filter === $kat ? 'bg-orange-500 text-white shadow-md shadow-orange-200' : 'bg-white border border-stone-200 text-stone-600 hover:border-orange-300 hover:text-orange-500' ?>">
            <?= ucfirst($kat) ?>
        </a>
        <?php endforeach; ?>
    </div>

    <!-- Featured Article -->
    <?php if ($featured): ?>
    <a href="<?= BASE_URL ?>/pages/berita-detail.php?id=<?= $featured['id'] ?>" class="group block mb-8">
        <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden card-hover">
            <div class="flex flex-col lg:flex-row">
                <div class="lg:w-96 h-56 lg:h-auto bg-gradient-to-br <?= $featured['color'] ?> flex items-center justify-center text-8xl flex-shrink-0">
                    <?= $featured['img_emoji'] ?>
                </div>
                <div class="p-8 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-3 mb-3">
                            <span class="badge <?= $featured['tag_class'] ?>"><?= $featured['kategori'] ?></span>
                            <span class="text-stone-400 text-xs flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <?= $featured['views'] ?> dilihat
                            </span>
                        </div>
                        <h2 class="font-heading text-2xl font-bold text-stone-900 group-hover:text-orange-600 transition-colors mb-3 leading-snug">
                            <?= $featured['title'] ?>
                        </h2>
                        <p class="text-stone-500 text-sm leading-relaxed line-clamp-3"><?= $featured['excerpt'] ?></p>
                    </div>
                    <div class="flex items-center justify-between mt-5 pt-5 border-t border-stone-100">
                        <div class="flex items-center gap-1.5 text-stone-400 text-xs">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <?= $featured['date'] ?>
                        </div>
                        <span class="text-orange-500 text-sm font-semibold group-hover:gap-2 flex items-center gap-1 transition-all">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <?php endif; ?>

    <!-- News Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        <?php
        $items = $kategori_filter === 'semua' ? $berita : array_filter($berita, fn($b) => $b['kategori'] === $kategori_filter);
        foreach ($items as $b):
        ?>
        <a href="<?= BASE_URL ?>/pages/berita-detail.php?id=<?= $b['id'] ?>"
           class="bg-white rounded-2xl border border-stone-200 overflow-hidden card-hover group flex flex-col">
            <div class="h-44 bg-gradient-to-br <?= $b['color'] ?> flex items-center justify-center text-5xl">
                <?= $b['img_emoji'] ?>
            </div>
            <div class="p-5 flex flex-col flex-1">
                <div class="flex items-center justify-between mb-3">
                    <span class="badge <?= $b['tag_class'] ?>"><?= $b['kategori'] ?></span>
                    <span class="text-stone-400 text-xs"><?= $b['views'] ?> dilihat</span>
                </div>
                <h3 class="font-semibold text-stone-900 text-sm leading-snug mb-2 group-hover:text-orange-600 transition-colors flex-1">
                    <?= $b['title'] ?>
                </h3>
                <p class="text-stone-500 text-xs leading-relaxed mb-3 line-clamp-2"><?= $b['excerpt'] ?></p>
                <div class="mt-auto flex items-center gap-1.5 text-stone-400 text-xs pt-3 border-t border-stone-100">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <?= $b['date'] ?>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <!-- Pagination placeholder -->
    <div class="flex justify-center mt-10 gap-2">
        <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-orange-500 text-white text-sm font-bold">1</span>
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-stone-200 text-stone-600 text-sm hover:border-orange-300 transition-colors">2</a>
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-stone-200 text-stone-600 text-sm hover:border-orange-300 transition-colors">3</a>
        <span class="w-10 h-10 flex items-center justify-center text-stone-400 text-sm">...</span>
        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-stone-200 text-stone-600 text-sm hover:border-orange-300 transition-colors">8</a>
    </div>

</main>

<?php include '../includes/footer.php'; ?>
