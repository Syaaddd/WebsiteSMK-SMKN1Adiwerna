<?php
require_once ROOT_DIR . '/config/settings.php';
$cfg = getSettings();
$ppdb_aktif = $cfg['ppdb']['aktif'] ?? false;
?>

<!-- Stats Row -->
<div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
    <?php
    $stats = [
        ['label'=>'Total Berita','val'=>'24','change'=>'+3','period'=>'bulan ini','icon'=>'📰','color'=>'blue','href'=>'?menu=berita'],
        ['label'=>'Pendaftar PPDB','val'=>'142','change'=>'+28','period'=>'minggu ini','icon'=>'🎓','color'=>'green','href'=>'?menu=ppdb'],
        ['label'=>'Agenda Mendatang','val'=>'4','change'=>'','period'=>'bulan ini','icon'=>'📅','color'=>'orange','href'=>'?menu=agenda'],
        ['label'=>'Pesan Masuk','val'=>'8','change'=>'2 baru','period'=>'belum dibaca','icon'=>'✉️','color'=>'purple','href'=>'?menu=pesan'],
    ];
    $color_map = [
        'blue'   => ['bg'=>'bg-blue-50','text'=>'text-blue-600','badge'=>'bg-blue-100 text-blue-700'],
        'green'  => ['bg'=>'bg-green-50','text'=>'text-green-600','badge'=>'bg-green-100 text-green-700'],
        'orange' => ['bg'=>'bg-orange-50','text'=>'text-orange-600','badge'=>'bg-orange-100 text-orange-700'],
        'purple' => ['bg'=>'bg-purple-50','text'=>'text-purple-600','badge'=>'bg-purple-100 text-purple-700'],
    ];
    foreach ($stats as $stat):
        $c = $color_map[$stat['color']];
    ?>
    <a href="<?= $stat['href'] ?>" class="bg-white rounded-2xl border border-stone-200 p-5 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-3">
            <span class="text-2xl"><?= $stat['icon'] ?></span>
            <?php if ($stat['change']): ?>
            <span class="px-2 py-0.5 rounded-lg text-xs font-semibold <?= $c['badge'] ?>"><?= $stat['change'] ?></span>
            <?php endif; ?>
        </div>
        <div class="font-heading font-black text-stone-900 text-3xl mb-0.5"><?= $stat['val'] ?></div>
        <div class="text-stone-500 text-sm"><?= $stat['label'] ?></div>
        <div class="text-stone-400 text-xs mt-0.5"><?= $stat['period'] ?></div>
    </a>
    <?php endforeach; ?>
</div>

<!-- PPDB Status Banner -->
<?php if (!$ppdb_aktif): ?>
<div class="bg-amber-50 border border-amber-300 rounded-2xl p-4 mb-6 flex items-center gap-4">
    <span class="text-2xl flex-shrink-0">⚠️</span>
    <div class="flex-1">
        <div class="font-semibold text-amber-800">PPDB Sedang Nonaktif</div>
        <div class="text-amber-700 text-sm">Formulir pendaftaran tidak bisa diakses calon siswa.</div>
    </div>
    <a href="?menu=pengaturan&tab=ppdb" class="bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors flex-shrink-0">
        Aktifkan PPDB →
    </a>
</div>
<?php endif; ?>

<div class="grid lg:grid-cols-3 gap-6 mb-6">

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl border border-stone-200 p-6">
        <h3 class="font-heading font-bold text-stone-900 mb-4 flex items-center gap-2"><span>⚡</span> Aksi Cepat</h3>
        <div class="space-y-2">
            <?php
            $actions = [
                ['label'=>'Tambah Berita Baru','href'=>'?menu=berita&action=add','icon'=>'📰','color'=>'hover:bg-orange-50 hover:text-orange-700'],
                ['label'=>'Tambah Agenda','href'=>'?menu=agenda&action=add','icon'=>'📅','color'=>'hover:bg-blue-50 hover:text-blue-700'],
                ['label'=>'Lihat Semua Pendaftar','href'=>'?menu=ppdb','icon'=>'🎓','color'=>'hover:bg-green-50 hover:text-green-700'],
                ['label'=>'Pengaturan PPDB','href'=>'?menu=pengaturan&tab=ppdb','icon'=>'⚙️','color'=>'hover:bg-stone-50 hover:text-stone-900'],
                ['label'=>'Edit Ticker Pengumuman','href'=>'?menu=pengaturan&tab=ticker','icon'=>'📢','color'=>'hover:bg-purple-50 hover:text-purple-700'],
            ];
            foreach ($actions as $a): ?>
            <a href="<?= $a['href'] ?>" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-stone-600 transition-colors <?= $a['color'] ?>">
                <span class="text-lg"><?= $a['icon'] ?></span>
                <?= $a['label'] ?>
                <svg class="w-4 h-4 ml-auto text-stone-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="bg-white rounded-2xl border border-stone-200 p-6">
        <h3 class="font-heading font-bold text-stone-900 mb-4 flex items-center gap-2"><span>🕐</span> Aktivitas Terbaru</h3>
        <?php
        $activities = [
            ['text'=>'Pendaftar baru: Siti Rahayu (RPL)','time'=>'5 menit lalu','dot'=>'bg-green-400'],
            ['text'=>'Berita diterbitkan: LKS Nasional 2025','time'=>'2 jam lalu','dot'=>'bg-blue-400'],
            ['text'=>'Pesan kontak dari Bpk. Hadi Santoso','time'=>'5 jam lalu','dot'=>'bg-orange-400'],
            ['text'=>'Pengaturan PPDB diperbarui','time'=>'kemarin','dot'=>'bg-stone-400'],
            ['text'=>'Agenda UTS telah ditambahkan','time'=>'2 hari lalu','dot'=>'bg-purple-400'],
        ];
        ?>
        <div class="space-y-3">
            <?php foreach ($activities as $a): ?>
            <div class="flex items-start gap-3">
                <span class="w-2 h-2 rounded-full <?= $a['dot'] ?> mt-1.5 flex-shrink-0"></span>
                <div>
                    <div class="text-stone-700 text-sm"><?= $a['text'] ?></div>
                    <div class="text-stone-400 text-xs mt-0.5"><?= $a['time'] ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Info Pengaturan Saat Ini -->
    <div class="bg-white rounded-2xl border border-stone-200 p-6">
        <h3 class="font-heading font-bold text-stone-900 mb-4 flex items-center gap-2"><span>⚙️</span> Konfigurasi Aktif</h3>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between items-center py-2 border-b border-stone-50">
                <span class="text-stone-500">Status PPDB</span>
                <?php if ($ppdb_aktif): ?>
                <span class="flex items-center gap-1.5 text-green-600 font-semibold"><span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>Aktif</span>
                <?php else: ?>
                <span class="flex items-center gap-1.5 text-red-500 font-semibold"><span class="w-2 h-2 rounded-full bg-red-500"></span>Nonaktif</span>
                <?php endif; ?>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-stone-50">
                <span class="text-stone-500">Tahun Ajaran</span>
                <span class="text-stone-900 font-semibold"><?= htmlspecialchars($cfg['ppdb']['tahun_ajaran']) ?></span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-stone-50">
                <span class="text-stone-500">Kuota/Jurusan</span>
                <span class="text-stone-900 font-semibold"><?= $cfg['ppdb']['kuota_per_jurusan'] ?> kursi</span>
            </div>
            <div class="flex justify-between items-center py-2 border-b border-stone-50">
                <span class="text-stone-500">Tutup PPDB</span>
                <span class="text-stone-900 font-semibold"><?= date('d M Y', strtotime($cfg['ppdb']['tgl_tutup'])) ?></span>
            </div>
            <div class="flex justify-between items-center py-2">
                <span class="text-stone-500">Ticker Items</span>
                <span class="text-stone-900 font-semibold"><?= count($cfg['ticker']) ?> baris</span>
            </div>
        </div>
        <a href="?menu=pengaturan" class="mt-4 block text-center text-orange-500 hover:text-orange-600 text-sm font-semibold transition-colors">
            Kelola Pengaturan →
        </a>
    </div>
</div>

<!-- Tabel PPDB Terbaru -->
<div class="bg-white rounded-2xl border border-stone-200 p-6">
    <div class="flex items-center justify-between mb-5">
        <h3 class="font-heading font-bold text-stone-900 flex items-center gap-2"><span>🎓</span> Pendaftar PPDB Terbaru</h3>
        <a href="?menu=ppdb" class="text-orange-500 hover:text-orange-600 text-sm font-semibold transition-colors">Lihat Semua →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-stone-100">
                    <th class="text-left text-stone-500 font-semibold py-2 pr-4">Nama</th>
                    <th class="text-left text-stone-500 font-semibold py-2 pr-4">Jurusan</th>
                    <th class="text-left text-stone-500 font-semibold py-2 pr-4">Asal Sekolah</th>
                    <th class="text-left text-stone-500 font-semibold py-2 pr-4">Tanggal</th>
                    <th class="text-left text-stone-500 font-semibold py-2">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-50">
                <?php
                $rows = [
                    ['nama'=>'Ahmad Fauzan','jurusan'=>'RPL','sekolah'=>'SMPN 1 Adiwerna','tgl'=>'20 Apr 2025','status'=>'Diverifikasi'],
                    ['nama'=>'Siti Rahayu','jurusan'=>'AKL','sekolah'=>'MTsN 2 Tegal','tgl'=>'20 Apr 2025','status'=>'Baru'],
                    ['nama'=>'Budi Santoso','jurusan'=>'TKJ','sekolah'=>'SMPN 3 Tegal','tgl'=>'19 Apr 2025','status'=>'Diverifikasi'],
                    ['nama'=>'Dewi Anggraini','jurusan'=>'MM','sekolah'=>'SMP Muhammadiyah 1','tgl'=>'19 Apr 2025','status'=>'Menunggu'],
                    ['nama'=>'Riko Prasetyo','jurusan'=>'TBSM','sekolah'=>'SMPN 1 Dukuhwaru','tgl'=>'18 Apr 2025','status'=>'Diverifikasi'],
                ];
                $sc = ['Baru'=>'bg-blue-100 text-blue-700','Diverifikasi'=>'bg-green-100 text-green-700','Menunggu'=>'bg-yellow-100 text-yellow-700','Ditolak'=>'bg-red-100 text-red-700'];
                foreach ($rows as $r): ?>
                <tr class="hover:bg-stone-50">
                    <td class="py-3 pr-4 text-stone-900 font-medium"><?= $r['nama'] ?></td>
                    <td class="py-3 pr-4"><span class="bg-orange-100 text-orange-700 px-2 py-0.5 rounded-lg text-xs font-bold"><?= $r['jurusan'] ?></span></td>
                    <td class="py-3 pr-4 text-stone-500"><?= $r['sekolah'] ?></td>
                    <td class="py-3 pr-4 text-stone-400 text-xs"><?= $r['tgl'] ?></td>
                    <td class="py-3">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold <?= $sc[$r['status']] ?? '' ?>"><?= $r['status'] ?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
