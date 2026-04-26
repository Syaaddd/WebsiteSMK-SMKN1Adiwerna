<?php
$page_title = 'Program Keahlian';
$active_nav = 'jurusan';
require_once '../config/database.php';
include '../includes/header.php';
include '../includes/navbar.php';

$jurusan = [
    [
        'id'=>'tkj','kode'=>'TKJ','icon'=>'🖥️','kelas'=>'icon-tkj',
        'nama'=>'Teknik Komputer & Jaringan',
        'desc'=>'Program keahlian yang mempersiapkan siswa dalam bidang instalasi, konfigurasi, dan manajemen jaringan komputer.',
        'detail'=>'Siswa TKJ mempelajari infrastruktur jaringan, keamanan siber, server management, virtualisasi, dan teknologi cloud. Lulusan siap bekerja sebagai Network Engineer, System Administrator, dan IT Support.',
        'keahlian'=>['Instalasi Jaringan LAN/WAN','Konfigurasi Router & Switch','Keamanan Jaringan (Cybersecurity)','Server Linux & Windows','Virtualisasi & Cloud Computing','Troubleshooting Hardware & Software'],
        'sertifikasi'=>['Cisco CCNA','Mikrotik MTCNA','CompTIA Network+'],
        'karir'=>['Network Engineer','System Administrator','IT Support Specialist','Cybersecurity Analyst'],
        'rombel'=>9,'siswa'=>324,
    ],
    [
        'id'=>'rpl','kode'=>'RPL','icon'=>'💻','kelas'=>'icon-rpl',
        'nama'=>'Rekayasa Perangkat Lunak',
        'desc'=>'Mencetak pengembang aplikasi handal yang menguasai web, mobile, dan desktop development.',
        'detail'=>'Program RPL mengajarkan pemrograman berbagai bahasa, desain UI/UX, database management, dan metodologi pengembangan perangkat lunak modern. Siswa dilatih mengerjakan proyek nyata.',
        'keahlian'=>['Pemrograman Web (PHP, Laravel, React)','Mobile Development (Android/Flutter)','Database (MySQL, PostgreSQL)','UI/UX Design','Version Control (Git)','RESTful API Development'],
        'sertifikasi'=>['Junior Web Developer BNSP','Android Developer','Oracle Database'],
        'karir'=>['Web Developer','Mobile Developer','UI/UX Designer','Software Engineer'],
        'rombel'=>9,'siswa'=>324,
    ],
    [
        'id'=>'akl','kode'=>'AKL','icon'=>'📊','kelas'=>'icon-akl',
        'nama'=>'Akuntansi & Keuangan Lembaga',
        'desc'=>'Mempersiapkan tenaga ahli keuangan yang kompeten dalam pembukuan, perpajakan, dan keuangan digital.',
        'detail'=>'Siswa AKL mempelajari siklus akuntansi lengkap, perpajakan, analisis laporan keuangan, dan penggunaan software akuntansi modern seperti MYOB dan Accurate.',
        'keahlian'=>['Siklus Akuntansi Perusahaan','Perpajakan (PPh, PPN)','Software MYOB & Accurate','Analisis Laporan Keuangan','Perbankan Dasar','Akuntansi Biaya'],
        'sertifikasi'=>['Teknisi Akuntansi BNSP','Brevet Pajak A&B','MYOB Certified User'],
        'karir'=>['Akuntan','Staff Perpajakan','Auditor','Analis Keuangan'],
        'rombel'=>9,'siswa'=>324,
    ],
    [
        'id'=>'mm','kode'=>'MM','icon'=>'🎬','kelas'=>'icon-mm',
        'nama'=>'Multimedia',
        'desc'=>'Mengembangkan kreativitas siswa dalam desain grafis, fotografi, videografi, dan animasi.',
        'detail'=>'Program MM membekali siswa dengan keahlian desain visual, produksi konten digital, animasi 2D/3D, dan editing video profesional. Tersedia studio foto dan video berstandar industri.',
        'keahlian'=>['Desain Grafis (Photoshop, Illustrator)','Videografi & Video Editing','Animasi 2D/3D (Blender)','Fotografi Profesional','Desain Website (Figma)','Produksi Konten Digital'],
        'sertifikasi'=>['Desainer Grafis Madya BNSP','Adobe Certified Associate','DKV Professional'],
        'karir'=>['Desainer Grafis','Motion Graphic Artist','Content Creator','Videografer'],
        'rombel'=>9,'siswa'=>324,
    ],
    [
        'id'=>'otkp','kode'=>'OTKP','icon'=>'🗂️','kelas'=>'icon-otkp',
        'nama'=>'Otomatisasi Tata Kelola Perkantoran',
        'desc'=>'Mempersiapkan tenaga administrasi profesional yang mahir dalam pengelolaan perkantoran modern.',
        'detail'=>'Siswa OTKP mempelajari manajemen korespondensi, pengarsipan digital, otomatisasi perkantoran, dan teknologi komunikasi bisnis untuk mendukung efisiensi administrasi.',
        'keahlian'=>['Korespondensi Bisnis','Manajemen Kearsipan Digital','Aplikasi Perkantoran (Ms. Office)','Komunikasi Bisnis','Pelayanan Prima','Manajemen Agenda & Rapat'],
        'sertifikasi'=>['Sekretaris Profesional BNSP','Microsoft Office Specialist'],
        'karir'=>['Sekretaris','Staf Administrasi','Operator Perkantoran','HRD Staff'],
        'rombel'=>9,'siswa'=>324,
    ],
    [
        'id'=>'bdp','kode'=>'BDP','icon'=>'🛒','kelas'=>'icon-bdp',
        'nama'=>'Bisnis Daring & Pemasaran',
        'desc'=>'Mendidik wirausahawan dan pemasar digital yang handal di era e-commerce dan digital marketing.',
        'detail'=>'Program BDP membekali siswa dengan strategi pemasaran digital, pengelolaan toko online, analitik bisnis, dan keterampilan kewirausahaan untuk bersaing di pasar digital.',
        'keahlian'=>['Digital Marketing (SEO, SEM)','Manajemen Media Sosial','E-Commerce (Shopee, Tokopedia)','Perencanaan Bisnis','Analitik Data Pemasaran','Customer Relationship Management'],
        'sertifikasi'=>['Marketer Digital BNSP','Google Ads','Facebook Blueprint'],
        'karir'=>['Digital Marketer','E-Commerce Specialist','Wirausaha','Brand Manager'],
        'rombel'=>9,'siswa'=>324,
    ],
    [
        'id'=>'tb','kode'=>'TB','icon'=>'👗','kelas'=>'icon-tb',
        'nama'=>'Tata Busana',
        'desc'=>'Mencetak desainer fashion dan tenaga terampil di industri tekstil dan garmen.',
        'detail'=>'Siswa Tata Busana mempelajari desain pakaian, teknik menjahit tingkat lanjut, pemilihan bahan, hingga manajemen bisnis fashion untuk bersaing di industri mode.',
        'keahlian'=>['Desain Busana & Sketsa Mode','Teknik Menjahit Tingkat Lanjut','Pemilihan & Pengelolaan Bahan','Draping & Tailoring','Digital Fashion Design','Bisnis Fashion'],
        'sertifikasi'=>['Penjahit Profesional BNSP','Desainer Busana Muda'],
        'karir'=>['Desainer Busana','Penjahit Profesional','Wirausaha Fashion','QC Garmen'],
        'rombel'=>9,'siswa'=>324,
    ],
    [
        'id'=>'tpm','kode'=>'TBSM','icon'=>'⚙️','kelas'=>'icon-tpm',
        'nama'=>'Teknik & Bisnis Sepeda Motor',
        'desc'=>'Mempersiapkan teknisi otomotif roda dua yang kompeten dan pengusaha bengkel profesional.',
        'detail'=>'Program TBSM membekali siswa dengan kemampuan perawatan, perbaikan, dan diagnostik kendaraan roda dua terbaru, termasuk kendaraan listrik, serta manajemen bisnis bengkel.',
        'keahlian'=>['Perawatan & Perbaikan Mesin Motor','Sistem Kelistrikan Sepeda Motor','Teknologi Fuel Injection (EFI)','Sepeda Motor Listrik (EV)','K3 Bengkel','Manajemen Bengkel'],
        'sertifikasi'=>['Teknisi Sepeda Motor BNSP','Honda Technical Training','Yamaha Technical Academy'],
        'karir'=>['Teknisi Bengkel','Service Advisor','Wirausaha Bengkel','QC Manufaktur Otomotif'],
        'rombel'=>9,'siswa'=>324,
    ],
];
?>

<div class="pt-16">

<!-- Page Hero -->
<section class="bg-stone-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_70%_50%,rgba(249,115,22,0.1)_0%,transparent_65%)]"></div>
    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-14 relative z-10">
        <div class="flex items-center gap-2 text-stone-400 text-sm mb-3">
            <a href="<?= BASE_URL ?>/" class="hover:text-white transition-colors">Beranda</a>
            <span>›</span>
            <span class="text-orange-400">Program Keahlian</span>
        </div>
        <h1 class="font-heading text-4xl lg:text-5xl font-black text-white mb-3">Program <span class="text-orange-500">Keahlian</span></h1>
        <p class="text-stone-300 max-w-2xl">8 program keahlian yang dirancang sesuai kebutuhan industri, tersertifikasi nasional, dan siap membawa Anda ke karir impian.</p>
    </div>
    <div class="h-px bg-gradient-to-r from-orange-500 via-orange-400/30 to-transparent"></div>
</section>

<main class="max-w-7xl mx-auto px-4 lg:px-8 py-12">

    <!-- Quick Nav -->
    <div class="flex flex-wrap gap-2 mb-10">
        <?php foreach ($jurusan as $j): ?>
        <a href="#<?= $j['id'] ?>" class="px-4 py-2 bg-white border border-stone-200 rounded-xl text-sm font-semibold text-stone-600 hover:bg-orange-500 hover:text-white hover:border-orange-500 transition-all">
            <?= $j['kode'] ?>
        </a>
        <?php endforeach; ?>
    </div>

    <!-- Jurusan Cards -->
    <div class="space-y-8">
        <?php foreach ($jurusan as $idx => $j): ?>
        <div id="<?= $j['id'] ?>" class="bg-white rounded-2xl border border-stone-200 overflow-hidden card-hover reveal scroll-mt-20">
            <div class="flex flex-col lg:flex-row">
                <!-- Left accent -->
                <div class="lg:w-72 bg-stone-50 p-8 flex flex-col items-center justify-center text-center border-b lg:border-b-0 lg:border-r border-stone-100">
                    <div class="w-20 h-20 <?= $j['kelas'] ?> rounded-2xl flex items-center justify-center text-4xl mb-4 shadow-md">
                        <?= $j['icon'] ?>
                    </div>
                    <div class="font-heading font-black text-orange-500 text-lg"><?= $j['kode'] ?></div>
                    <div class="font-bold text-stone-900 text-base text-center leading-snug mb-3"><?= $j['nama'] ?></div>
                    <div class="flex gap-4 text-center">
                        <div>
                            <div class="font-heading font-black text-stone-900 text-xl"><?= $j['rombel'] ?></div>
                            <div class="text-stone-500 text-xs">Rombel</div>
                        </div>
                        <div class="w-px bg-stone-200"></div>
                        <div>
                            <div class="font-heading font-black text-stone-900 text-xl"><?= $j['siswa'] ?></div>
                            <div class="text-stone-500 text-xs">Siswa</div>
                        </div>
                    </div>
                </div>

                <!-- Right content -->
                <div class="flex-1 p-8">
                    <p class="text-stone-600 text-sm leading-relaxed mb-6"><?= $j['detail'] ?></p>
                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <h4 class="font-semibold text-stone-900 text-sm mb-3 flex items-center gap-2">
                                <span class="w-5 h-5 bg-orange-100 rounded-lg flex items-center justify-center text-xs">🔧</span>
                                Kompetensi Utama
                            </h4>
                            <ul class="space-y-1.5">
                                <?php foreach ($j['keahlian'] as $k): ?>
                                <li class="text-xs text-stone-600 flex items-start gap-1.5">
                                    <span class="text-orange-500 mt-0.5">›</span><?= $k ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold text-stone-900 text-sm mb-3 flex items-center gap-2">
                                <span class="w-5 h-5 bg-orange-100 rounded-lg flex items-center justify-center text-xs">🏅</span>
                                Sertifikasi
                            </h4>
                            <ul class="space-y-2">
                                <?php foreach ($j['sertifikasi'] as $s): ?>
                                <li class="badge badge-orange text-[10px]"><?= $s ?></li><br>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold text-stone-900 text-sm mb-3 flex items-center gap-2">
                                <span class="w-5 h-5 bg-orange-100 rounded-lg flex items-center justify-center text-xs">💼</span>
                                Prospek Karir
                            </h4>
                            <ul class="space-y-1.5">
                                <?php foreach ($j['karir'] as $k): ?>
                                <li class="text-xs text-stone-600 flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-400 flex-shrink-0"></span><?= $k ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6 pt-5 border-t border-stone-100 flex gap-3">
                        <a href="<?= BASE_URL ?>/pages/ppdb.php" class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors">
                            Daftar Program Ini
                        </a>
                        <a href="<?= BASE_URL ?>/pages/kontak.php" class="bg-stone-100 hover:bg-stone-200 text-stone-700 text-sm font-semibold px-5 py-2.5 rounded-xl transition-colors">
                            Tanya Info Lebih Lanjut
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Bottom CTA -->
    <div class="mt-12 bg-stone-900 rounded-3xl p-8 lg:p-12 text-center relative overflow-hidden reveal">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_50%_50%,rgba(249,115,22,0.1)_0%,transparent_70%)]"></div>
        <div class="relative z-10">
            <h2 class="font-heading text-3xl font-black text-white mb-3">Belum yakin memilih jurusan?</h2>
            <p class="text-stone-400 mb-6">Konsultasikan pilihan Anda dengan tim konselor kami. Gratis!</p>
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="<?= BASE_URL ?>/pages/kontak.php" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
                    Konsultasi Jurusan
                </a>
                <a href="<?= BASE_URL ?>/pages/ppdb.php" class="bg-stone-700 hover:bg-stone-600 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
                    Lihat Jadwal PPDB
                </a>
            </div>
        </div>
    </div>

</main>

<?php include '../includes/footer.php'; ?>
