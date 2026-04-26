<?php
require_once ROOT_DIR . '/config/settings.php';
$cfg = getSettings();
$ppdb_cfg = $cfg['ppdb'];
$filter_status  = $_GET['filter_status']  ?? '';
$filter_jurusan = $_GET['filter_jurusan'] ?? '';

$pendaftar = [
    ['id'=>1,'nama'=>'Ahmad Fauzan','sekolah'=>'SMPN 1 Adiwerna','jurusan'=>'RPL','tgl'=>'2025-04-20','hp'=>'08123456789','email'=>'ahmad@gmail.com','status'=>'Diverifikasi'],
    ['id'=>2,'nama'=>'Siti Rahayu','sekolah'=>'MTsN 2 Tegal','jurusan'=>'AKL','tgl'=>'2025-04-20','hp'=>'08234567890','email'=>'siti@gmail.com','status'=>'Baru'],
    ['id'=>3,'nama'=>'Budi Santoso','sekolah'=>'SMPN 3 Tegal','jurusan'=>'TKJ','tgl'=>'2025-04-19','hp'=>'08345678901','email'=>'budi@gmail.com','status'=>'Diverifikasi'],
    ['id'=>4,'nama'=>'Dewi Anggraini','sekolah'=>'SMP Muhammadiyah 1','jurusan'=>'MM','tgl'=>'2025-04-19','hp'=>'08456789012','email'=>'dewi@gmail.com','status'=>'Menunggu'],
    ['id'=>5,'nama'=>'Riko Prasetyo','sekolah'=>'SMPN 1 Dukuhwaru','jurusan'=>'TBSM','tgl'=>'2025-04-18','hp'=>'08567890123','email'=>'riko@gmail.com','status'=>'Diverifikasi'],
    ['id'=>6,'nama'=>'Lina Kartika','sekolah'=>'MTsN 1 Tegal','jurusan'=>'TB','tgl'=>'2025-04-18','hp'=>'08678901234','email'=>'lina@gmail.com','status'=>'Baru'],
    ['id'=>7,'nama'=>'Dani Hermawan','sekolah'=>'SMPN 2 Adiwerna','jurusan'=>'OTKP','tgl'=>'2025-04-17','hp'=>'08789012345','email'=>'dani@gmail.com','status'=>'Ditolak'],
    ['id'=>8,'nama'=>'Fitri Nur','sekolah'=>'SMPN 4 Tegal','jurusan'=>'BDP','tgl'=>'2025-04-17','hp'=>'08890123456','email'=>'fitri@gmail.com','status'=>'Menunggu'],
];

$filtered = array_filter($pendaftar, function($p) use ($filter_status, $filter_jurusan) {
    return (!$filter_status  || $p['status']  === $filter_status)
        && (!$filter_jurusan || $p['jurusan'] === $filter_jurusan);
});

// Counts per status
$counts = ['Semua'=>count($pendaftar),'Baru'=>0,'Diverifikasi'=>0,'Menunggu'=>0,'Ditolak'=>0];
foreach ($pendaftar as $p) { if (isset($counts[$p['status']])) $counts[$p['status']]++; }

$sc = ['Baru'=>'bg-blue-100 text-blue-700','Diverifikasi'=>'bg-green-100 text-green-700','Menunggu'=>'bg-yellow-100 text-yellow-700','Ditolak'=>'bg-red-100 text-red-700'];
?>

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="font-heading font-bold text-stone-900 text-xl">Data Pendaftar PPDB</h2>
        <p class="text-stone-400 text-sm mt-0.5">Tahun Ajaran <?= htmlspecialchars($ppdb_cfg['tahun_ajaran']) ?></p>
    </div>
    <div class="flex gap-2">
        <button onclick="exportCSV()" class="flex items-center gap-2 bg-green-50 hover:bg-green-500 text-green-600 hover:text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors border border-green-200 hover:border-green-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Export CSV
        </button>
        <a href="?menu=pengaturan&tab=ppdb" class="flex items-center gap-2 bg-orange-50 hover:bg-orange-500 text-orange-600 hover:text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition-colors border border-orange-200 hover:border-orange-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Atur PPDB
        </a>
    </div>
</div>

<!-- Stats PPDB -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-6">
    <?php
    $stat_colors = [
        'Semua'=>'bg-stone-900 text-white',
        'Baru'=>'bg-blue-50 text-blue-700 border border-blue-200',
        'Diverifikasi'=>'bg-green-50 text-green-700 border border-green-200',
        'Menunggu'=>'bg-yellow-50 text-yellow-700 border border-yellow-200',
        'Ditolak'=>'bg-red-50 text-red-700 border border-red-200',
    ];
    foreach ($counts as $label => $count):
    ?>
    <a href="?menu=ppdb&filter_status=<?= $label === 'Semua' ? '' : $label ?>"
       class="rounded-2xl p-4 text-center <?= $stat_colors[$label] ?> <?= ($filter_status === $label || ($label === 'Semua' && !$filter_status)) ? 'ring-2 ring-orange-500' : '' ?> hover:shadow-md transition-shadow">
        <div class="font-heading font-black text-2xl"><?= $count ?></div>
        <div class="text-xs mt-0.5 font-medium opacity-80"><?= $label ?></div>
    </a>
    <?php endforeach; ?>
</div>

<!-- Progress per Jurusan -->
<div class="bg-white rounded-2xl border border-stone-200 p-5 mb-5">
    <h4 class="font-heading font-bold text-stone-900 text-sm mb-4">Peta Pendaftar per Program Keahlian</h4>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <?php
        $jurusan_list = ['TKJ','RPL','AKL','MM','OTKP','BDP','TB','TBSM'];
        foreach ($jurusan_list as $j):
            $count_j = count(array_filter($pendaftar, fn($p) => $p['jurusan'] === $j));
            $quota = $ppdb_cfg['kuota_per_jurusan'];
            $pct = $quota > 0 ? min(100, round($count_j / $quota * 100)) : 0;
            $bar_color = $pct >= 90 ? 'bg-red-500' : ($pct >= 70 ? 'bg-orange-500' : 'bg-green-500');
        ?>
        <div class="bg-stone-50 rounded-xl p-3">
            <div class="flex justify-between items-center mb-1.5">
                <span class="font-bold text-stone-900 text-xs"><?= $j ?></span>
                <span class="text-xs text-stone-500"><?= $count_j ?>/<?= $quota ?></span>
            </div>
            <div class="h-1.5 bg-stone-200 rounded-full overflow-hidden">
                <div class="h-full <?= $bar_color ?> rounded-full transition-all" style="width:<?= $pct ?>%"></div>
            </div>
            <div class="text-[10px] text-stone-400 mt-1"><?= $pct ?>% terisi</div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Filter & Search -->
<div class="bg-white rounded-2xl border border-stone-200 p-4 mb-4 flex flex-wrap gap-3 items-center">
    <div class="flex-1 min-w-40 relative">
        <svg class="w-4 h-4 text-stone-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <input type="text" id="search-ppdb" placeholder="Cari nama pendaftar..."
               class="w-full pl-9 pr-3 py-2 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 transition">
    </div>
    <select id="filter-ppdb-jurusan" class="px-3 py-2 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
        <option value="">Semua Jurusan</option>
        <?php foreach ($jurusan_list as $j): ?>
        <option value="<?= $j ?>" <?= $filter_jurusan === $j ? 'selected' : '' ?>><?= $j ?></option>
        <?php endforeach; ?>
    </select>
</div>

<!-- Tabel Pendaftar -->
<div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-stone-50 border-b border-stone-200">
            <tr>
                <th class="text-left text-stone-500 font-semibold px-5 py-3">Nama & Asal Sekolah</th>
                <th class="text-left text-stone-500 font-semibold px-4 py-3">Jurusan</th>
                <th class="text-left text-stone-500 font-semibold px-4 py-3 hidden md:table-cell">Kontak</th>
                <th class="text-left text-stone-500 font-semibold px-4 py-3 hidden lg:table-cell">Tgl Daftar</th>
                <th class="text-left text-stone-500 font-semibold px-4 py-3">Status</th>
                <th class="text-left text-stone-500 font-semibold px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100" id="ppdb-tbody">
            <?php foreach ($filtered as $p): ?>
            <tr class="hover:bg-stone-50 ppdb-row">
                <td class="px-5 py-3.5">
                    <div class="font-semibold text-stone-900"><?= htmlspecialchars($p['nama']) ?></div>
                    <div class="text-stone-400 text-xs mt-0.5"><?= htmlspecialchars($p['sekolah']) ?></div>
                </td>
                <td class="px-4 py-3.5">
                    <span class="bg-orange-100 text-orange-700 text-xs font-bold px-2 py-0.5 rounded-lg"><?= $p['jurusan'] ?></span>
                </td>
                <td class="px-4 py-3.5 hidden md:table-cell">
                    <div class="text-stone-700 text-xs"><?= htmlspecialchars($p['hp']) ?></div>
                    <div class="text-stone-400 text-xs"><?= htmlspecialchars($p['email']) ?></div>
                </td>
                <td class="px-4 py-3.5 text-stone-500 text-xs hidden lg:table-cell"><?= date('d M Y', strtotime($p['tgl'])) ?></td>
                <td class="px-4 py-3.5">
                    <select class="status-select text-xs font-semibold px-2 py-1 rounded-lg border-0 focus:ring-2 focus:ring-orange-400 outline-none <?= $sc[$p['status']] ?? '' ?>"
                            data-id="<?= $p['id'] ?>" onchange="changeStatus(this)">
                        <?php foreach (array_keys($sc) as $st): ?>
                        <option value="<?= $st ?>" <?= $p['status']===$st?'selected':'' ?>><?= $st ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td class="px-4 py-3.5">
                    <div class="flex items-center gap-1.5">
                        <button onclick="viewDetail(<?= $p['id'] ?>)" class="w-8 h-8 bg-blue-50 hover:bg-blue-500 text-blue-500 hover:text-white rounded-lg flex items-center justify-center transition-colors" title="Detail">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                        <a href="https://wa.me/<?= preg_replace('/\D/', '', $p['hp']) ?>" target="_blank"
                           class="w-8 h-8 bg-green-50 hover:bg-green-500 text-green-500 hover:text-white rounded-lg flex items-center justify-center transition-colors" title="WhatsApp">
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M11.989 0C5.376 0 0 5.374 0 11.988c0 2.115.549 4.101 1.517 5.831L.018 24l6.341-1.663a11.95 11.95 0 005.63 1.421h.005c6.614 0 11.989-5.374 11.989-11.988C24 5.374 18.603 0 11.989 0z" opacity=".3"/></svg>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="px-5 py-3 border-t border-stone-100 flex items-center justify-between">
        <span class="text-xs text-stone-400">Menampilkan <?= count($filtered) ?> dari <?= count($pendaftar) ?> pendaftar</span>
        <span class="text-xs text-stone-400">Total kuota: <?= count($jurusan_list) * $ppdb_cfg['kuota_per_jurusan'] ?> kursi</span>
    </div>
</div>

<script>
// Live search
document.getElementById('search-ppdb')?.addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('.ppdb-row').forEach(row => {
        row.classList.toggle('hidden', !row.querySelector('td').textContent.toLowerCase().includes(q));
    });
});
document.getElementById('filter-ppdb-jurusan')?.addEventListener('change', function() {
    const j = this.value;
    document.querySelectorAll('.ppdb-row').forEach(row => {
        const badge = row.querySelector('.bg-orange-100');
        row.classList.toggle('hidden', j && badge?.textContent.trim() !== j);
    });
});

function changeStatus(sel) {
    const colors = {
        'Baru':'bg-blue-100 text-blue-700',
        'Diverifikasi':'bg-green-100 text-green-700',
        'Menunggu':'bg-yellow-100 text-yellow-700',
        'Ditolak':'bg-red-100 text-red-700'
    };
    sel.className = `status-select text-xs font-semibold px-2 py-1 rounded-lg border-0 focus:ring-2 focus:ring-orange-400 outline-none ${colors[sel.value] || ''}`;
    // In production: send AJAX request to update DB
    console.log('Update status ID', sel.dataset.id, '->', sel.value);
}

function viewDetail(id) {
    alert('Detail pendaftar #' + id + '\nFitur detail lengkap memerlukan koneksi database.');
}

function exportCSV() {
    const rows = [['ID','Nama','Sekolah','Jurusan','Telepon','Email','Tanggal','Status']];
    document.querySelectorAll('.ppdb-row:not(.hidden)').forEach(row => {
        const cells = row.querySelectorAll('td');
        rows.push([
            row.querySelector('.text-xs.mt-0\\.5')?.textContent.replace('#','').trim() || '',
            cells[0]?.querySelector('.font-semibold')?.textContent.trim() || '',
            cells[0]?.querySelector('.text-stone-400')?.textContent.trim() || '',
            cells[1]?.querySelector('span')?.textContent.trim() || '',
            cells[2]?.querySelectorAll('div')[0]?.textContent.trim() || '',
            cells[2]?.querySelectorAll('div')[1]?.textContent.trim() || '',
            cells[3]?.textContent.trim() || '',
            cells[4]?.querySelector('select')?.value || '',
        ]);
    });
    const csv = rows.map(r => r.map(c => `"${c}"`).join(',')).join('\n');
    const blob = new Blob([csv], {type:'text/csv;charset=utf-8;'});
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'ppdb_<?= htmlspecialchars(str_replace('/','-',$ppdb_cfg['tahun_ajaran'])) ?>_' + new Date().toISOString().slice(0,10) + '.csv';
    a.click();
}
</script>
