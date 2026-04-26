<?php
$page_title = 'Profil Sekolah';
$active_nav = 'profil';
require_once '../config/database.php';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="pt-16">

<!-- Page Hero -->
<section class="bg-stone-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_70%_50%,rgba(249,115,22,0.1)_0%,transparent_65%)]"></div>
    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-14 relative z-10">
        <div class="flex items-center gap-2 text-stone-400 text-sm mb-3">
            <a href="<?= BASE_URL ?>/" class="hover:text-white transition-colors">Beranda</a>
            <span>›</span>
            <span class="text-orange-400">Profil Sekolah</span>
        </div>
        <h1 class="font-heading text-4xl lg:text-5xl font-black text-white mb-3">Profil <span class="text-orange-500">Sekolah</span></h1>
        <p class="text-stone-300 max-w-2xl">Mengenal lebih dalam SMK Negeri 1 Adiwerna — sejarah, visi misi, dan komitmen kami dalam mencetak generasi unggul.</p>
    </div>
    <div class="h-px bg-gradient-to-r from-orange-500 via-orange-400/30 to-transparent"></div>
</section>

<main class="max-w-7xl mx-auto px-4 lg:px-8 py-12 space-y-16">

    <!-- Identitas Sekolah -->
    <section class="reveal grid lg:grid-cols-2 gap-10 items-start">
        <div>
            <h2 class="font-heading text-2xl font-bold text-stone-900 section-title mb-5">Identitas Sekolah</h2>
            <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
                <?php
                $identitas = [
                    ['label'=>'Nama Sekolah','value'=>'SMK Negeri 1 Adiwerna'],
                    ['label'=>'NPSN','value'=>'20327921'],
                    ['label'=>'NSS','value'=>'401032801001'],
                    ['label'=>'Alamat','value'=>'Jl. Dewi Sartika No.1, Adiwerna'],
                    ['label'=>'Kecamatan','value'=>'Adiwerna'],
                    ['label'=>'Kabupaten/Kota','value'=>'Kabupaten Tegal'],
                    ['label'=>'Provinsi','value'=>'Jawa Tengah'],
                    ['label'=>'Kode Pos','value'=>'52194'],
                    ['label'=>'Telepon','value'=>'(0283) 444555'],
                    ['label'=>'Email','value'=>'info@smkn1adiwerna.sch.id'],
                    ['label'=>'Website','value'=>'www.smkn1adiwerna.sch.id'],
                    ['label'=>'Status Sekolah','value'=>'Negeri'],
                    ['label'=>'Akreditasi','value'=>'A (Unggul)'],
                    ['label'=>'Tahun Berdiri','value'=>'1968'],
                ];
                foreach ($identitas as $i => $row): ?>
                <div class="flex <?= $i % 2 === 0 ? 'bg-stone-50' : 'bg-white' ?> px-5 py-3 gap-4 text-sm <?= $i !== count($identitas)-1 ? 'border-b border-stone-100' : '' ?>">
                    <span class="text-stone-500 w-40 flex-shrink-0"><?= $row['label'] ?></span>
                    <span class="text-stone-900 font-medium"><?= $row['value'] ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="space-y-6">
            <!-- Kepala Sekolah -->
            <div class="bg-white rounded-2xl border border-stone-200 p-6">
                <h3 class="font-heading font-bold text-stone-900 mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 bg-orange-100 rounded-lg flex items-center justify-center text-sm">👤</span>
                    Kepala Sekolah
                </h3>
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 bg-stone-100 rounded-2xl flex items-center justify-center text-3xl">👨‍💼</div>
                    <div>
                        <div class="font-bold text-stone-900 text-lg">Drs. H. Ahmad Fauzi, M.Pd.</div>
                        <div class="text-stone-500 text-sm">NIP. 196804251994031002</div>
                        <div class="mt-2">
                            <span class="badge badge-orange">Kepala Sekolah</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Siswa -->
            <div class="bg-white rounded-2xl border border-stone-200 p-6">
                <h3 class="font-heading font-bold text-stone-900 mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 bg-orange-100 rounded-lg flex items-center justify-center text-sm">📊</span>
                    Statistik Sekolah
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <?php
                    $stats = [
                        ['label'=>'Total Siswa','value'=>'2.400+','icon'=>'👥'],
                        ['label'=>'Guru & Staff','value'=>'120+','icon'=>'👨‍🏫'],
                        ['label'=>'Program Keahlian','value'=>'8','icon'=>'🎓'],
                        ['label'=>'Rombel','value'=>'72','icon'=>'🏫'],
                    ];
                    foreach ($stats as $s): ?>
                    <div class="bg-stone-50 rounded-xl p-4 text-center">
                        <div class="text-2xl mb-1"><?= $s['icon'] ?></div>
                        <div class="font-heading font-black text-orange-500 text-2xl"><?= $s['value'] ?></div>
                        <div class="text-stone-500 text-xs mt-0.5"><?= $s['label'] ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Sejarah -->
    <section class="reveal">
        <h2 class="font-heading text-2xl font-bold text-stone-900 section-title mb-6">Sejarah Singkat</h2>
        <div class="bg-white rounded-2xl border border-stone-200 p-8">
            <div class="prose prose-stone max-w-none text-stone-600 leading-relaxed space-y-4 text-sm">
                <p>SMK Negeri 1 Adiwerna berdiri pada tahun <strong class="text-stone-900">1968</strong> dengan nama STM Negeri Adiwerna. Sekolah ini merupakan salah satu sekolah kejuruan tertua di Kabupaten Tegal yang telah berkontribusi besar dalam mencetak tenaga terampil siap kerja di berbagai bidang industri.</p>
                <p>Seiring perkembangan zaman dan kebutuhan industri yang terus berubah, sekolah ini terus bertransformasi baik dari sisi kurikulum, fasilitas, maupun program keahlian yang ditawarkan. Pada era reformasi, sekolah ini resmi berganti nama menjadi <strong class="text-stone-900">SMK Negeri 1 Adiwerna</strong> sesuai dengan kebijakan pemerintah.</p>
                <p>Saat ini SMKN 1 Adiwerna telah meraih <strong class="text-stone-900">Akreditasi A (Unggul)</strong> dan menjadi sekolah kejuruan unggulan di Kabupaten Tegal. Dengan didukung oleh fasilitas modern, tenaga pengajar kompeten, dan kemitraan luas dengan dunia industri, SMKN 1 Adiwerna terus berkomitmen menghasilkan lulusan yang kompeten dan berdaya saing tinggi.</p>
                <p>Hingga kini, SMKN 1 Adiwerna telah meluluskan lebih dari <strong class="text-stone-900">30.000 alumni</strong> yang tersebar di berbagai sektor industri, instansi pemerintah, maupun wirausaha mandiri di seluruh Indonesia dan mancanegara.</p>
            </div>

            <!-- Timeline -->
            <div class="mt-8 pt-8 border-t border-stone-100">
                <h4 class="font-semibold text-stone-900 mb-5">Tonggak Sejarah</h4>
                <div class="space-y-4">
                    <?php
                    $tonggak = [
                        ['year'=>'1968','text'=>'Berdiri sebagai STM Negeri Adiwerna dengan 2 program keahlian'],
                        ['year'=>'1985','text'=>'Penambahan program keahlian dan pembangunan gedung baru'],
                        ['year'=>'2000','text'=>'Berganti nama menjadi SMK Negeri 1 Adiwerna'],
                        ['year'=>'2010','text'=>'Meraih Akreditasi A untuk pertama kalinya'],
                        ['year'=>'2018','text'=>'Membuka 8 program keahlian sesuai kebutuhan industri 4.0'],
                        ['year'=>'2023','text'=>'Implementasi Kurikulum Merdeka dan program Teaching Factory'],
                    ];
                    foreach ($tonggak as $t): ?>
                    <div class="flex gap-4 items-start">
                        <div class="w-16 flex-shrink-0 text-right">
                            <span class="font-heading font-bold text-orange-500 text-sm"><?= $t['year'] ?></span>
                        </div>
                        <div class="w-px bg-orange-200 flex-shrink-0 self-stretch mx-1"></div>
                        <div class="text-stone-600 text-sm pb-2"><?= $t['text'] ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="reveal grid md:grid-cols-2 gap-6">
        <div class="bg-stone-900 rounded-2xl p-8 relative overflow-hidden">
            <div class="absolute -top-8 -right-8 w-32 h-32 bg-orange-500/10 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <div class="w-10 h-10 bg-orange-500/20 border border-orange-500/30 rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
                <h2 class="font-heading text-2xl font-black text-white mb-4">Visi</h2>
                <p class="text-stone-300 text-sm leading-relaxed italic">
                    "Menjadi sekolah kejuruan unggulan yang menghasilkan lulusan berkarakter, kompeten, berwawasan global, dan berdaya saing tinggi di era industri 4.0."
                </p>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-stone-200 p-8">
            <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center mb-4">
                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
            <h2 class="font-heading text-2xl font-black text-stone-900 mb-4">Misi</h2>
            <ol class="space-y-3">
                <?php
                $misi = [
                    'Menyelenggarakan pendidikan kejuruan yang relevan dengan kebutuhan industri dan dunia kerja.',
                    'Mengembangkan kurikulum berbasis kompetensi dan karakter yang selaras dengan Kurikulum Merdeka.',
                    'Membina tenaga pendidik yang profesional, inovatif, dan berorientasi pada perkembangan teknologi.',
                    'Membangun kemitraan strategis dengan industri, perguruan tinggi, dan lembaga internasional.',
                    'Menciptakan lingkungan belajar yang kondusif, inklusif, dan berbasis nilai-nilai Pancasila.',
                    'Meningkatkan mutu lulusan yang siap kerja, berwirausaha, atau melanjutkan ke jenjang pendidikan tinggi.',
                ];
                foreach ($misi as $idx => $m): ?>
                <li class="flex gap-3 text-sm text-stone-600">
                    <span class="w-5 h-5 rounded-full bg-orange-500 text-white flex-shrink-0 flex items-center justify-center text-xs font-bold"><?= $idx+1 ?></span>
                    <?= $m ?>
                </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>

    <!-- Fasilitas -->
    <section class="reveal">
        <h2 class="font-heading text-2xl font-bold text-stone-900 section-title mb-6">Fasilitas Sekolah</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php
            $fasilitas = [
                ['icon'=>'💻','nama'=>'Lab Komputer','detail'=>'6 laboratorium, 240 unit PC terbaru'],
                ['icon'=>'📡','nama'=>'Lab Jaringan','detail'=>'Peralatan Cisco & Mikrotik profesional'],
                ['icon'=>'🎨','nama'=>'Studio Multimedia','detail'=>'Peralatan foto, video, dan editing'],
                ['icon'=>'📚','nama'=>'Perpustakaan','detail'=>'8.000+ koleksi buku dan digital library'],
                ['icon'=>'⚽','nama'=>'Lapangan Olahraga','detail'=>'Lapangan sepak bola, basket, voli'],
                ['icon'=>'🍽️','nama'=>'Kantin','detail'=>'Area makan higienis dan nyaman'],
                ['icon'=>'🏥','nama'=>'Klinik Sekolah','detail'=>'Layanan kesehatan siswa 5 hari/minggu'],
                ['icon'=>'🛡️','nama'=>'Ruang BK','detail'=>'Bimbingan konseling & karir siswa'],
                ['icon'=>'🖨️','nama'=>'Teaching Factory','detail'=>'Praktik industri nyata di sekolah'],
                ['icon'=>'🅿️','nama'=>'Area Parkir','detail'=>'Parkir luas & aman untuk 500 motor'],
                ['icon'=>'📶','nama'=>'WiFi Campus','detail'=>'Internet cepat di seluruh area sekolah'],
                ['icon'=>'🎭','nama'=>'Aula Serbaguna','detail'=>'Kapasitas 800 orang, AC & sound system'],
            ];
            foreach ($fasilitas as $f): ?>
            <div class="bg-white rounded-2xl border border-stone-200 p-5 card-hover">
                <div class="text-3xl mb-3"><?= $f['icon'] ?></div>
                <div class="font-semibold text-stone-900 text-sm mb-1"><?= $f['nama'] ?></div>
                <div class="text-stone-500 text-xs leading-relaxed"><?= $f['detail'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Nilai-nilai Sekolah -->
    <section class="reveal bg-stone-900 rounded-3xl p-8 lg:p-12">
        <h2 class="font-heading text-2xl font-black text-white text-center mb-2">Nilai-Nilai SMKN 1 Adiwerna</h2>
        <p class="text-stone-400 text-center text-sm mb-8">Landasan karakter yang kami tanamkan kepada setiap siswa</p>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <?php
            $nilai = [
                ['icon'=>'💪','label'=>'Integritas'],
                ['icon'=>'🌟','label'=>'Unggul'],
                ['icon'=>'🤝','label'=>'Kolaboratif'],
                ['icon'=>'💡','label'=>'Inovatif'],
                ['icon'=>'🌍','label'=>'Berwawasan Global'],
                ['icon'=>'❤️','label'=>'Berkarakter'],
            ];
            foreach ($nilai as $n): ?>
            <div class="bg-stone-800/60 border border-stone-700/50 rounded-2xl p-5 text-center hover:border-orange-500/30 hover:bg-stone-800 transition-all">
                <div class="text-3xl mb-2"><?= $n['icon'] ?></div>
                <div class="text-white font-semibold text-sm"><?= $n['label'] ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<?php include '../includes/footer.php'; ?>
