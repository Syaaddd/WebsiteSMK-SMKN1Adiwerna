<?php
$page_title = 'Detail Berita';
$active_nav = 'berita';
require_once '../config/database.php';

$id = (int)($_GET['id'] ?? 1);

$berita_db = [
    1 => [
        'id'=>1,'kategori'=>'PPDB','tag_class'=>'badge-orange',
        'title'=>'Pendaftaran PPDB Jalur Prestasi dan Reguler 2025/2026 Resmi Dibuka',
        'date'=>'20 April 2025','author'=>'Humas SMKN 1 Adiwerna','views'=>1234,
        'img_emoji'=>'🎓','color'=>'from-orange-100 to-amber-50',
        'content'=>'<p>SMK Negeri 1 Adiwerna dengan bangga mengumumkan bahwa <strong>Penerimaan Peserta Didik Baru (PPDB) Tahun Pelajaran 2025/2026</strong> resmi dibuka mulai tanggal <strong>1 Mei 2025</strong>.</p>
<p>Pendaftaran dibuka melalui dua jalur:</p>
<ul>
<li><strong>Jalur Prestasi:</strong> Diperuntukkan bagi calon siswa yang memiliki prestasi akademik maupun non-akademik (seni, olahraga, lomba, dll.) yang dibuktikan dengan sertifikat atau piagam penghargaan.</li>
<li><strong>Jalur Reguler:</strong> Penerimaan berdasarkan nilai rapor SMP/MTs dan tes kemampuan dasar.</li>
</ul>
<p>Kuota total yang tersedia adalah <strong>288 kursi</strong> yang terbagi dalam 8 program keahlian, masing-masing 36 kursi atau 1 rombongan belajar per program.</p>
<h3>Jadwal PPDB 2025/2026</h3>
<ul>
<li>Pendaftaran Online: 1 – 20 Mei 2025</li>
<li>Verifikasi Berkas: 21 – 25 Mei 2025</li>
<li>Pengumuman Seleksi: 28 Mei 2025</li>
<li>Daftar Ulang: 29 Mei – 5 Juni 2025</li>
</ul>
<p>Untuk informasi lebih lengkap, silakan kunjungi halaman PPDB atau hubungi panitia melalui kontak yang tersedia.</p>',
    ],
    2 => [
        'id'=>2,'kategori'=>'Prestasi','tag_class'=>'badge-green',
        'title'=>'Siswa SMKN 1 Adiwerna Raih Juara 1 LKS Bidang Web Technology Tingkat Nasional',
        'date'=>'15 April 2025','author'=>'Humas SMKN 1 Adiwerna','views'=>3521,
        'img_emoji'=>'🏆','color'=>'from-green-100 to-emerald-50',
        'content'=>'<p>Kebanggan besar bagi keluarga besar SMK Negeri 1 Adiwerna! <strong>Ahmad Rizki Pratama</strong>, siswa kelas XII RPL 2, berhasil meraih <strong>Medali Emas</strong> dalam Lomba Kompetensi Siswa (LKS) SMK Nasional 2025 bidang <em>Web Technology</em> yang diselenggarakan di Jakarta Convention Center pada 10-14 April 2025.</p>
<p>Dalam kompetisi bergengsi yang diikuti oleh 34 provinsi ini, Ahmad berhasil mengungguli ratusan peserta terbaik dari seluruh Indonesia dengan membuat sebuah aplikasi web full-stack dalam waktu terbatas.</p>
<p>"Saya berlatih keras selama 6 bulan didampingi guru pembimbing. Kuncinya adalah konsisten dan jangan menyerah," ujar Ahmad dalam wawancara setelah pengumuman.</p>
<p>Kepala Sekolah SMKN 1 Adiwerna, Drs. H. Ahmad Fauzi, M.Pd., menyampaikan rasa bangganya atas prestasi yang diraih siswa tersebut dan berjanji akan terus meningkatkan kualitas pembinaan siswa berprestasi.</p>',
    ],
];

$artikel = $berita_db[$id] ?? $berita_db[1];
$page_title = mb_substr($artikel['title'], 0, 60);

include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="pt-16">

<main class="max-w-7xl mx-auto px-4 lg:px-8 py-10">
    <div class="grid lg:grid-cols-3 gap-8">

        <!-- Article -->
        <article class="lg:col-span-2">
            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-stone-400 text-sm mb-5">
                <a href="<?= BASE_URL ?>/" class="hover:text-stone-700 transition-colors">Beranda</a>
                <span>›</span>
                <a href="<?= BASE_URL ?>/pages/berita.php" class="hover:text-stone-700 transition-colors">Berita</a>
                <span>›</span>
                <span class="text-stone-700 truncate max-w-48"><?= htmlspecialchars(mb_substr($artikel['title'],0,40)) ?>...</span>
            </div>

            <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
                <!-- Featured image -->
                <div class="h-64 bg-gradient-to-br <?= $artikel['color'] ?> flex items-center justify-center text-9xl">
                    <?= $artikel['img_emoji'] ?>
                </div>

                <div class="p-8">
                    <div class="flex items-center flex-wrap gap-3 mb-4">
                        <span class="badge <?= $artikel['tag_class'] ?>"><?= $artikel['kategori'] ?></span>
                        <span class="text-stone-400 text-xs flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <?= $artikel['date'] ?>
                        </span>
                        <span class="text-stone-400 text-xs flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <?= number_format($artikel['views']) ?> dilihat
                        </span>
                    </div>
                    <h1 class="font-heading text-2xl lg:text-3xl font-black text-stone-900 leading-tight mb-4"><?= htmlspecialchars($artikel['title']) ?></h1>
                    <div class="flex items-center gap-2 pb-6 mb-6 border-b border-stone-100">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center text-sm">✍️</div>
                        <div>
                            <div class="text-stone-900 text-sm font-semibold"><?= htmlspecialchars($artikel['author']) ?></div>
                            <div class="text-stone-400 text-xs">Penulis Resmi</div>
                        </div>
                    </div>
                    <div class="prose prose-stone prose-sm max-w-none text-stone-600 leading-relaxed
                        [&_h3]:font-heading [&_h3]:font-bold [&_h3]:text-stone-900 [&_h3]:text-lg [&_h3]:mt-6 [&_h3]:mb-3
                        [&_p]:mb-4
                        [&_ul]:list-disc [&_ul]:pl-5 [&_ul]:space-y-1.5 [&_ul]:mb-4
                        [&_strong]:text-stone-900 [&_strong]:font-semibold">
                        <?= $artikel['content'] ?>
                    </div>

                    <!-- Share -->
                    <div class="mt-8 pt-6 border-t border-stone-100 flex items-center gap-3">
                        <span class="text-stone-500 text-sm">Bagikan:</span>
                        <button onclick="navigator.clipboard.writeText(window.location.href)" class="px-3 py-1.5 bg-stone-100 hover:bg-stone-200 text-stone-600 text-xs rounded-lg transition-colors flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            Salin Link
                        </button>
                        <a href="https://wa.me/?text=<?= urlencode($artikel['title'] . ' - ' . BASE_URL . '/pages/berita-detail.php?id=' . $id) ?>" target="_blank"
                           class="px-3 py-1.5 bg-green-50 hover:bg-green-100 text-green-700 text-xs rounded-lg transition-colors flex items-center gap-1.5">
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <a href="<?= BASE_URL ?>/pages/berita.php" class="text-orange-500 hover:text-orange-600 text-sm font-semibold flex items-center gap-1 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Kembali ke Daftar Berita
                </a>
            </div>
        </article>

        <!-- Sidebar -->
        <aside class="space-y-6">
            <div class="bg-white rounded-2xl border border-stone-200 p-5">
                <h3 class="font-heading font-bold text-stone-900 mb-4 section-title text-base">Berita Terkini</h3>
                <?php
                $other = [
                    ['id'=>2,'title'=>'Siswa Raih Juara 1 LKS Nasional','date'=>'15 Apr 2025','emoji'=>'🏆'],
                    ['id'=>3,'title'=>'Kunjungan Industri RPL ke Jakarta','date'=>'10 Apr 2025','emoji'=>'🚌'],
                    ['id'=>4,'title'=>'Jadwal UTS Semester Genap 2024/2025','date'=>'5 Apr 2025','emoji'=>'📋'],
                    ['id'=>5,'title'=>'Juara 2 Olimpiade Akuntansi Jateng','date'=>'1 Apr 2025','emoji'=>'🥈'],
                ];
                foreach ($other as $o): ?>
                <a href="?id=<?= $o['id'] ?>" class="flex items-start gap-3 py-3 border-b border-stone-50 last:border-0 hover:bg-stone-50 rounded-xl px-2 -mx-2 transition-colors group">
                    <span class="text-2xl flex-shrink-0 mt-0.5"><?= $o['emoji'] ?></span>
                    <div>
                        <div class="text-stone-800 text-xs font-semibold leading-snug group-hover:text-orange-600 transition-colors"><?= $o['title'] ?></div>
                        <div class="text-stone-400 text-[11px] mt-1"><?= $o['date'] ?></div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>

            <div class="bg-stone-900 rounded-2xl p-6 relative overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_70%_30%,rgba(249,115,22,0.15)_0%,transparent_70%)]"></div>
                <div class="relative z-10">
                    <div class="text-2xl mb-3">🎓</div>
                    <h3 class="font-heading font-bold text-white mb-2">PPDB 2025/2026</h3>
                    <p class="text-stone-400 text-xs mb-4">Pendaftaran dibuka 1 Mei 2025. Daftarkan dirimu sekarang!</p>
                    <a href="<?= BASE_URL ?>/pages/ppdb.php" class="block w-full text-center bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold py-2.5 rounded-xl transition-colors">
                        Info PPDB →
                    </a>
                </div>
            </div>
        </aside>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
