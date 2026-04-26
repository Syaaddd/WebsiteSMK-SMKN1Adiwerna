<?php
$page_title = '';
$active_nav = 'index';
require_once './config/database.php';
include './includes/header.php'; // sets $_SITE
include './includes/navbar.php';
$_s = $_SITE['sekolah'] ?? [];
$_ticker = $_SITE['ticker'] ?? [];

$berita = [
    ['id'=>1,'tag'=>'PPDB','tag_class'=>'badge-orange','title'=>'Pendaftaran PPDB Jalur Prestasi Dibuka Mulai 1 Mei','date'=>'20 Apr 2025','color'=>'from-orange-500/20 to-orange-300/10','img'=>'🎓'],
    ['id'=>2,'tag'=>'Prestasi','tag_class'=>'badge-green','title'=>'Siswa SMKN 1 Adiwerna Raih Juara 1 LKS Nasional','date'=>'15 Apr 2025','color'=>'from-green-500/20 to-green-300/10','img'=>'🏆'],
    ['id'=>3,'tag'=>'Kegiatan','tag_class'=>'badge-blue','title'=>'Kunjungan Industri Jurusan RPL ke Jakarta','date'=>'10 Apr 2025','color'=>'from-blue-500/20 to-blue-300/10','img'=>'🚌'],
    ['id'=>4,'tag'=>'Akademik','tag_class'=>'badge-gray','title'=>'Jadwal UTS Semester Genap 2024/2025 Telah Dirilis','date'=>'5 Apr 2025','color'=>'from-stone-500/20 to-stone-300/10','img'=>'📋'],
    ['id'=>5,'tag'=>'Prestasi','tag_class'=>'badge-green','title'=>'Tim SMKN 1 Juara Olimpiade Akuntansi Tingkat Provinsi','date'=>'1 Apr 2025','color'=>'from-purple-500/20 to-purple-300/10','img'=>'🥇'],
    ['id'=>6,'tag'=>'Kegiatan','tag_class'=>'badge-blue','title'=>'Pelatihan Guru Implementasi Kurikulum Merdeka','date'=>'28 Mar 2025','color'=>'from-teal-500/20 to-teal-300/10','img'=>'📚'],
];

$jurusan = [
    ['icon'=>'🖥️','kelas'=>'icon-tkj','kode'=>'TKJ','nama'=>'Teknik Komputer & Jaringan','desc'=>'Infrastruktur jaringan, keamanan siber, server management'],
    ['icon'=>'💻','kelas'=>'icon-rpl','kode'=>'RPL','nama'=>'Rekayasa Perangkat Lunak','desc'=>'Pengembangan aplikasi web, mobile, dan desktop'],
    ['icon'=>'📊','kelas'=>'icon-akl','kode'=>'AKL','nama'=>'Akuntansi & Keuangan Lembaga','desc'=>'Pembukuan, perpajakan, dan keuangan digital'],
    ['icon'=>'🎬','kelas'=>'icon-mm','kode'=>'MM','nama'=>'Multimedia','desc'=>'Desain grafis, videografi, animasi 2D/3D'],
    ['icon'=>'🗂️','kelas'=>'icon-otkp','kode'=>'OTKP','nama'=>'Otomatisasi Tata Kelola Perkantoran','desc'=>'Manajemen administrasi, korespondensi & arsip digital'],
    ['icon'=>'🛒','kelas'=>'icon-bdp','kode'=>'BDP','nama'=>'Bisnis Daring & Pemasaran','desc'=>'E-commerce, digital marketing, dan manajemen ritel'],
    ['icon'=>'👗','kelas'=>'icon-tb','kode'=>'TB','nama'=>'Tata Busana','desc'=>'Desain fashion, menjahit, dan tekstil kreatif'],
    ['icon'=>'⚙️','kelas'=>'icon-tpm','kode'=>'TPM','nama'=>'Teknik & Bisnis Sepeda Motor','desc'=>'Perawatan, perbaikan, dan bisnis otomotif roda dua'],
];

$agenda = [
    ['day'=>'01','month'=>'MEI','title'=>'Pembukaan PPDB 2025/2026','loc'=>'Online & Kantor Sekolah','badge'=>'PPDB','badge_class'=>'bg-orange-100 text-orange-700'],
    ['day'=>'12','month'=>'MEI','title'=>'Ujian Tengah Semester Genap 2024/2025','loc'=>'Seluruh Ruang Kelas','badge'=>'Akademik','badge_class'=>'bg-stone-100 text-stone-600'],
    ['day'=>'20','month'=>'MEI','title'=>'Peringatan Hari Kebangkitan Nasional','loc'=>'Lapangan Upacara','badge'=>'Upacara','badge_class'=>'bg-blue-100 text-blue-700'],
    ['day'=>'28','month'=>'MEI','title'=>'Pelepasan Siswa Kelas XII Tahun 2024/2025','loc'=>'Aula SMKN 1 Adiwerna','badge'=>'Seremonial','badge_class'=>'bg-purple-100 text-purple-700'],
];
?>

<div class="pt-16">

<!-- ===== HERO ===== -->
<section class="bg-stone-900 relative overflow-hidden hero-bg-pattern">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-orange-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 -left-16 w-72 h-72 bg-orange-500/5 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[radial-gradient(ellipse_at_60%_40%,rgba(249,115,22,0.07)_0%,transparent_65%)]"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-20 lg:py-28 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-flex items-center gap-2 bg-orange-500/10 border border-orange-500/20 rounded-full px-4 py-1.5 mb-6">
                    <span class="w-2 h-2 rounded-full bg-orange-500 pulse-dot"></span>
                    <span class="text-orange-400 text-sm font-medium">Akreditasi <?= htmlspecialchars($_s['akreditasi'] ?? 'A') ?> — Sekolah Unggulan</span>
                </div>
                <h1 class="font-heading text-4xl lg:text-5xl xl:text-6xl font-black text-white leading-tight mb-5">
                    <?= nl2br(htmlspecialchars($_s['tagline'] ?? 'Membentuk Generasi Terampil & Berkarakter')) ?>
                </h1>
                <p class="text-stone-300 text-base lg:text-lg leading-relaxed mb-8 max-w-lg">
                    <?= htmlspecialchars($_s['deskripsi'] ?? '') ?>
                </p>
                <div class="flex flex-wrap gap-3 mb-10">
                    <a href="<?= BASE_URL ?>/pages/ppdb.php"
                       class="inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-xl transition-all shadow-lg shadow-orange-900/30 hover:shadow-orange-900/50 hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Daftar PPDB 2025
                    </a>
                    <a href="<?= BASE_URL ?>/pages/jurusan.php"
                       class="inline-flex items-center gap-2 text-white font-semibold px-6 py-3 rounded-xl border border-white/20 hover:bg-white/10 transition-all">
                        Lihat Jurusan
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
                <!-- Stats -->
                <div class="grid grid-cols-4 gap-4 pt-8 border-t border-white/8">
                    <div class="stat-item">
                        <div class="font-heading text-2xl lg:text-3xl font-black text-orange-500"><?= htmlspecialchars($_s['total_siswa'] ?? '2.400+') ?></div>
                        <div class="text-stone-500 text-xs mt-1">Total Siswa</div>
                    </div>
                    <div class="stat-item" style="animation-delay:0.1s">
                        <div class="font-heading text-2xl lg:text-3xl font-black text-orange-500"><?= htmlspecialchars($_s['total_guru'] ?? '120+') ?></div>
                        <div class="text-stone-500 text-xs mt-1">Guru & Staff</div>
                    </div>
                    <div class="stat-item" style="animation-delay:0.2s">
                        <div class="font-heading text-2xl lg:text-3xl font-black text-orange-500"><?= htmlspecialchars($_s['program_keahlian'] ?? '8') ?></div>
                        <div class="text-stone-500 text-xs mt-1">Prog. Keahlian</div>
                    </div>
                    <div class="stat-item" style="animation-delay:0.3s">
                        <div class="font-heading text-2xl lg:text-3xl font-black text-orange-500"><?= htmlspecialchars($_s['tingkat_kelulusan'] ?? '95%') ?></div>
                        <div class="text-stone-500 text-xs mt-1">Kelulusan</div>
                    </div>
                </div>
            </div>

            <!-- Hero visual card -->
            <div class="hidden lg:block">
                <div class="relative">
                    <div class="bg-stone-800/60 backdrop-blur rounded-2xl border border-stone-700/50 p-6 space-y-4">
                        <div class="flex items-center gap-3 pb-4 border-b border-stone-700/50">
                            <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <div>
                                <div class="text-white font-semibold text-sm">Info PPDB 2025/2026</div>
                                <div class="text-orange-400 text-xs flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-orange-400 inline-block"></span>Pendaftaran Dibuka</div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <?php foreach(array_slice($jurusan, 0, 4) as $j): ?>
                            <div class="flex items-center gap-2.5 bg-stone-700/40 rounded-xl p-3 hover:bg-stone-700/60 transition-colors cursor-default">
                                <span class="text-xl"><?= $j['icon'] ?></span>
                                <div>
                                    <div class="text-white text-xs font-semibold"><?= $j['kode'] ?></div>
                                    <div class="text-stone-400 text-[11px] leading-tight"><?= explode(' ', $j['nama'])[0] ?></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="<?= BASE_URL ?>/pages/ppdb.php" class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold py-2.5 rounded-xl transition-colors">
                            Daftar Sekarang →
                        </a>
                    </div>
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 bg-orange-500/10 rounded-full blur-2xl"></div>
                    <div class="absolute -top-4 -left-4 w-20 h-20 bg-orange-500/10 rounded-full blur-2xl"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="h-px bg-gradient-to-r from-orange-500 via-orange-400/50 to-transparent"></div>
</section>

<!-- ===== TICKER ===== -->
<div class="bg-orange-500 py-2.5 overflow-hidden flex items-center gap-4">
    <div class="flex-shrink-0 bg-white text-orange-700 text-xs font-black px-3 py-1 rounded ml-4 uppercase tracking-wide">Info Terbaru</div>
    <div class="overflow-hidden flex-1 relative">
        <div class="ticker-track text-white text-sm font-medium gap-8 flex">
            <?php foreach ($_ticker as $item): ?>
            <span><?= htmlspecialchars($item) ?></span>
            <span class="text-orange-200">•</span>
            <?php endforeach; ?>
            <?php if (empty($_ticker)): ?>
            <span>Selamat datang di website resmi <?= htmlspecialchars($_s['nama'] ?? 'SMKN 1 Adiwerna') ?></span>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- ===== MAIN CONTENT ===== -->
<main class="max-w-7xl mx-auto px-4 lg:px-8 py-12 space-y-16">

    <!-- BERITA -->
    <section class="reveal">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-heading text-2xl font-bold text-stone-900 section-title">Berita & Pengumuman</h2>
            <a href="<?= BASE_URL ?>/pages/berita.php" class="text-orange-500 hover:text-orange-600 text-sm font-semibold flex items-center gap-1 transition-colors">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php foreach ($berita as $i => $b): ?>
            <a href="<?= BASE_URL ?>/pages/berita.php?id=<?= $b['id'] ?>"
               class="bg-white rounded-2xl border border-stone-200 overflow-hidden card-hover group <?= $i === 0 ? 'md:col-span-2 lg:col-span-1' : '' ?>">
                <div class="h-40 bg-gradient-to-br <?= $b['color'] ?> flex items-center justify-center text-5xl">
                    <?= $b['img'] ?>
                </div>
                <div class="p-4">
                    <span class="badge <?= $b['tag_class'] ?> mb-2"><?= $b['tag'] ?></span>
                    <h3 class="font-semibold text-stone-900 text-sm leading-snug mb-2 group-hover:text-orange-600 transition-colors"><?= $b['title'] ?></h3>
                    <div class="flex items-center gap-1.5 text-stone-400 text-xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <?= $b['date'] ?>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- JURUSAN -->
    <section class="reveal">
        <div class="flex items-center justify-between mb-6">
            <h2 class="font-heading text-2xl font-bold text-stone-900 section-title">Program Keahlian</h2>
            <a href="<?= BASE_URL ?>/pages/jurusan.php" class="text-orange-500 hover:text-orange-600 text-sm font-semibold flex items-center gap-1 transition-colors">
                Selengkapnya
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <?php foreach ($jurusan as $j): ?>
            <a href="<?= BASE_URL ?>/pages/jurusan.php#<?= strtolower($j['kode']) ?>"
               class="bg-white rounded-2xl border border-stone-200 p-5 card-hover group flex flex-col gap-3">
                <div class="w-12 h-12 rounded-xl <?= $j['kelas'] ?> flex items-center justify-center text-2xl">
                    <?= $j['icon'] ?>
                </div>
                <div>
                    <div class="text-xs font-bold text-orange-500 mb-0.5"><?= $j['kode'] ?></div>
                    <div class="font-semibold text-stone-900 text-sm leading-snug group-hover:text-orange-600 transition-colors mb-1"><?= $j['nama'] ?></div>
                    <div class="text-stone-500 text-xs leading-relaxed"><?= $j['desc'] ?></div>
                </div>
                <div class="mt-auto flex items-center gap-1 text-orange-500 text-xs font-semibold">
                    Selengkapnya <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- AGENDA + KEUNGGULAN side by side -->
    <div class="grid lg:grid-cols-3 gap-8 reveal">

        <!-- AGENDA -->
        <div class="lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-heading text-2xl font-bold text-stone-900 section-title">Agenda Sekolah</h2>
                <a href="#" class="text-orange-500 hover:text-orange-600 text-sm font-semibold flex items-center gap-1 transition-colors">
                    Kalender
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="space-y-3">
                <?php foreach ($agenda as $a): ?>
                <div class="bg-white rounded-2xl border border-stone-200 p-4 flex gap-4 items-start card-hover">
                    <div class="bg-stone-900 rounded-xl px-3 py-2 text-center flex-shrink-0 min-w-[52px]">
                        <div class="font-heading font-black text-orange-500 text-xl leading-none"><?= $a['day'] ?></div>
                        <div class="text-stone-400 text-[10px] uppercase tracking-wide mt-0.5"><?= $a['month'] ?></div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-semibold text-stone-900 text-sm mb-1"><?= $a['title'] ?></div>
                        <div class="flex items-center gap-1.5 text-stone-400 text-xs mb-2">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <?= $a['loc'] ?>
                        </div>
                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold <?= $a['badge_class'] ?>"><?= $a['badge'] ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- KEUNGGULAN -->
        <div>
            <h2 class="font-heading text-2xl font-bold text-stone-900 section-title mb-6">Keunggulan Kami</h2>
            <div class="space-y-3">
                <?php
                $keunggulan = [
                    ['icon'=>'🏅','title'=>'Akreditasi A','desc'=>'Terakreditasi A oleh BAN-SM dengan nilai tertinggi di Kab. Tegal'],
                    ['icon'=>'🤝','title'=>'Mitra Industri','desc'=>'Kerjasama dengan 50+ perusahaan nasional dan multinasional'],
                    ['icon'=>'💼','title'=>'Serapan Kerja Tinggi','desc'=>'95% lulusan terserap kerja dalam 6 bulan setelah lulus'],
                    ['icon'=>'🎖️','title'=>'Prestasi Nasional','desc'=>'Juara LKS tingkat nasional selama 5 tahun berturut-turut'],
                    ['icon'=>'🏫','title'=>'Fasilitas Modern','desc'=>'Lab komputer, bengkel, studio multimedia berstandar industri'],
                ];
                foreach ($keunggulan as $k): ?>
                <div class="bg-white rounded-xl border border-stone-200 p-4 flex gap-3 items-start card-hover">
                    <span class="text-2xl flex-shrink-0"><?= $k['icon'] ?></span>
                    <div>
                        <div class="font-semibold text-stone-900 text-sm mb-0.5"><?= $k['title'] ?></div>
                        <div class="text-stone-500 text-xs leading-relaxed"><?= $k['desc'] ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- CTA BANNER -->
    <section class="reveal bg-stone-900 rounded-3xl overflow-hidden relative">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_30%_50%,rgba(249,115,22,0.15)_0%,transparent_70%)]"></div>
        <div class="absolute -right-10 -top-10 w-56 h-56 bg-orange-500/5 rounded-full blur-3xl"></div>
        <div class="relative z-10 p-8 lg:p-12 flex flex-col lg:flex-row items-center justify-between gap-8">
            <div>
                <div class="inline-flex items-center gap-2 bg-orange-500/10 border border-orange-500/20 rounded-full px-3 py-1 mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500 pulse-dot"></span>
                    <span class="text-orange-400 text-xs font-medium">Pendaftaran Dibuka — Mulai 1 Mei 2025</span>
                </div>
                <h2 class="font-heading text-3xl lg:text-4xl font-black text-white mb-3">
                    Siap Bergabung Bersama<br><span class="text-orange-500">SMKN 1 Adiwerna?</span>
                </h2>
                <p class="text-stone-400 text-base max-w-lg">Raih masa depan cerah bersama ribuan alumni sukses kami. Daftar sekarang dan pilih program keahlian impianmu.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-3 flex-shrink-0">
                <a href="<?= BASE_URL ?>/pages/ppdb.php"
                   class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-8 py-4 rounded-2xl transition-all shadow-xl shadow-orange-900/30 hover:-translate-y-0.5 text-center whitespace-nowrap">
                    Daftar PPDB 2025 →
                </a>
                <a href="<?= BASE_URL ?>/pages/profil.php"
                   class="bg-stone-800 hover:bg-stone-700 text-white font-semibold px-6 py-4 rounded-2xl transition-colors border border-stone-700 text-center whitespace-nowrap">
                    Kenali Sekolah Kami
                </a>
            </div>
        </div>
    </section>

</main>

<?php include './includes/footer.php'; ?>
