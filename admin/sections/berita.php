<?php
$action = $_GET['action'] ?? 'list';
$edit_id = (int)($_GET['id'] ?? 0);

$berita_data = [
    ['id'=>1,'judul'=>'Pendaftaran PPDB Jalur Prestasi dan Reguler 2025/2026 Resmi Dibuka','kategori'=>'PPDB','status'=>'Terbit','tgl'=>'20 Apr 2025','views'=>1234],
    ['id'=>2,'judul'=>'Siswa SMKN 1 Adiwerna Raih Juara 1 LKS Bidang Web Technology','kategori'=>'Prestasi','status'=>'Terbit','tgl'=>'15 Apr 2025','views'=>3521],
    ['id'=>3,'judul'=>'Kunjungan Industri Jurusan RPL ke PT. Gojek Indonesia','kategori'=>'Kegiatan','status'=>'Terbit','tgl'=>'10 Apr 2025','views'=>892],
    ['id'=>4,'judul'=>'Jadwal UTS Semester Genap 2024/2025','kategori'=>'Akademik','status'=>'Draft','tgl'=>'5 Apr 2025','views'=>2100],
    ['id'=>5,'judul'=>'Tim AKL Juara 2 Olimpiade Akuntansi Tingkat Jawa Tengah','kategori'=>'Prestasi','status'=>'Terbit','tgl'=>'1 Apr 2025','views'=>754],
    ['id'=>6,'judul'=>'Pelatihan Kurikulum Merdeka untuk Seluruh Guru','kategori'=>'Kegiatan','status'=>'Draft','tgl'=>'28 Mar 2025','views'=>445],
];

$edit_item = $edit_id ? array_values(array_filter($berita_data, fn($b) => $b['id'] === $edit_id))[0] ?? null : null;
?>

<?php if ($action === 'add' || $action === 'edit'): ?>

<!-- Form Tambah / Edit Berita -->
<div class="flex items-center gap-3 mb-6">
    <a href="?menu=berita" class="text-stone-400 hover:text-stone-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </a>
    <h2 class="font-heading font-bold text-stone-900 text-xl"><?= $action === 'add' ? 'Tambah Berita Baru' : 'Edit Berita' ?></h2>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-5">
        <div class="bg-white rounded-2xl border border-stone-200 p-6 space-y-4">
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1.5">Judul Berita <span class="text-orange-500">*</span></label>
                <input type="text" id="judul" value="<?= htmlspecialchars($edit_item['judul'] ?? '') ?>"
                       class="w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 transition"
                       placeholder="Judul berita yang menarik...">
                <p class="text-stone-400 text-xs mt-1"><span id="judul-count">0</span>/100 karakter</p>
                <script>
                const judul = document.getElementById('judul');
                const counter = document.getElementById('judul-count');
                function updateCount() { counter.textContent = judul.value.length; counter.style.color = judul.value.length > 100 ? 'red' : ''; }
                judul?.addEventListener('input', updateCount);
                updateCount();
                </script>
            </div>
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1.5">Ringkasan / Excerpt</label>
                <textarea rows="3" class="w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 transition resize-none"
                          placeholder="Ringkasan singkat artikel (2-3 kalimat)..."></textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-stone-700 mb-1.5">Konten Artikel <span class="text-orange-500">*</span></label>
                <!-- Simple toolbar -->
                <div class="border border-stone-200 rounded-xl overflow-hidden">
                    <div class="flex gap-1 p-2 bg-stone-50 border-b border-stone-200 flex-wrap">
                        <?php
                        $toolbar = [['B','bold'],['I','italic'],['U','underline'],['|',''],['H2','heading'],['🔗','link'],['• List','list']];
                        foreach ($toolbar as $btn): if ($btn[0]==='|'): ?>
                        <span class="w-px bg-stone-200 mx-1 self-stretch"></span>
                        <?php else: ?>
                        <button type="button" class="px-2.5 py-1 text-xs font-semibold text-stone-600 hover:bg-white hover:shadow-sm rounded-lg transition-all">
                            <?= $btn[0] ?>
                        </button>
                        <?php endif; endforeach; ?>
                    </div>
                    <textarea rows="12" class="w-full px-4 py-3 text-sm text-stone-700 focus:outline-none resize-none"
                              placeholder="Tulis konten berita di sini...

Anda dapat menggunakan format teks biasa. Untuk pengembangan lebih lanjut, dapat diintegrasikan dengan editor TinyMCE atau CKEditor."></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar form -->
    <div class="space-y-4">
        <div class="bg-white rounded-2xl border border-stone-200 p-5">
            <h4 class="font-semibold text-stone-900 text-sm mb-4">Publikasi</h4>
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-semibold text-stone-500 mb-1">Status</label>
                    <select class="w-full px-3 py-2 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                        <option value="draft">Draft</option>
                        <option value="publish" selected>Terbitkan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-stone-500 mb-1">Tanggal Terbit</label>
                    <input type="date" value="<?= date('Y-m-d') ?>" class="w-full px-3 py-2 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                </div>
                <div class="flex gap-2 pt-2 border-t border-stone-100">
                    <button type="button" class="flex-1 bg-stone-100 hover:bg-stone-200 text-stone-700 text-sm font-semibold py-2 rounded-xl transition-colors">
                        Simpan Draft
                    </button>
                    <button type="button" onclick="alert('Fitur ini memerlukan koneksi database')" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold py-2 rounded-xl transition-colors">
                        Terbitkan
                    </button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-stone-200 p-5">
            <h4 class="font-semibold text-stone-900 text-sm mb-4">Kategori & Tag</h4>
            <div class="space-y-3">
                <div>
                    <label class="block text-xs font-semibold text-stone-500 mb-1">Kategori</label>
                    <select class="w-full px-3 py-2 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
                        <?php foreach (['PPDB','Prestasi','Kegiatan','Akademik','Pengumuman'] as $kat): ?>
                        <option value="<?= $kat ?>" <?= ($edit_item['kategori'] ?? '') === $kat ? 'selected' : '' ?>><?= $kat ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-stone-500 mb-1">Gambar Utama (Emoji/Ikon)</label>
                    <input type="text" placeholder="🎓" class="w-full px-3 py-2 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400" value="🎓">
                    <p class="text-stone-400 text-[10px] mt-1">Sementara menggunakan emoji. Upload gambar akan ditambahkan.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php else: ?>

<!-- Daftar Berita -->
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="font-heading font-bold text-stone-900 text-xl">Berita & Pengumuman</h2>
        <p class="text-stone-400 text-sm mt-0.5">Kelola semua artikel berita dan pengumuman sekolah</p>
    </div>
    <a href="?menu=berita&action=add" class="flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold text-sm px-5 py-2.5 rounded-xl transition-colors shadow-md shadow-orange-100">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
        Tulis Berita
    </a>
</div>

<!-- Filter & Search -->
<div class="bg-white rounded-2xl border border-stone-200 p-4 mb-5 flex flex-wrap gap-3 items-center">
    <div class="flex-1 min-w-48 relative">
        <svg class="w-4 h-4 text-stone-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        <input type="text" placeholder="Cari judul berita..." id="search-berita"
               class="w-full pl-9 pr-3 py-2 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 transition">
    </div>
    <select id="filter-status" class="px-3 py-2 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
        <option value="">Semua Status</option>
        <option value="Terbit">Terbit</option>
        <option value="Draft">Draft</option>
    </select>
    <select id="filter-kat" class="px-3 py-2 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
        <option value="">Semua Kategori</option>
        <?php foreach (['PPDB','Prestasi','Kegiatan','Akademik','Pengumuman'] as $kat): ?>
        <option value="<?= $kat ?>"><?= $kat ?></option>
        <?php endforeach; ?>
    </select>
</div>

<!-- Tabel Berita -->
<div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
    <table class="w-full text-sm" id="berita-table">
        <thead class="bg-stone-50 border-b border-stone-200">
            <tr>
                <th class="text-left text-stone-500 font-semibold px-5 py-3">Judul</th>
                <th class="text-left text-stone-500 font-semibold px-4 py-3 hidden md:table-cell">Kategori</th>
                <th class="text-left text-stone-500 font-semibold px-4 py-3 hidden lg:table-cell">Tanggal</th>
                <th class="text-left text-stone-500 font-semibold px-4 py-3 hidden lg:table-cell">Views</th>
                <th class="text-left text-stone-500 font-semibold px-4 py-3">Status</th>
                <th class="text-left text-stone-500 font-semibold px-4 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-stone-100" id="berita-tbody">
            <?php
            $kat_colors = ['PPDB'=>'badge-orange','Prestasi'=>'badge-green','Kegiatan'=>'badge-blue','Akademik'=>'badge-gray','Pengumuman'=>'badge-orange'];
            foreach ($berita_data as $b):
            ?>
            <tr class="hover:bg-stone-50 berita-row" data-status="<?= $b['status'] ?>" data-kategori="<?= $b['kategori'] ?>">
                <td class="px-5 py-3.5">
                    <div class="font-semibold text-stone-900 text-sm leading-snug max-w-xs truncate"><?= htmlspecialchars($b['judul']) ?></div>
                    <div class="text-stone-400 text-xs mt-0.5">#<?= $b['id'] ?></div>
                </td>
                <td class="px-4 py-3.5 hidden md:table-cell">
                    <span class="badge <?= $kat_colors[$b['kategori']] ?? 'badge-gray' ?>"><?= $b['kategori'] ?></span>
                </td>
                <td class="px-4 py-3.5 text-stone-500 text-xs hidden lg:table-cell"><?= $b['tgl'] ?></td>
                <td class="px-4 py-3.5 hidden lg:table-cell">
                    <span class="text-stone-600 text-xs font-medium flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <?= number_format($b['views']) ?>
                    </span>
                </td>
                <td class="px-4 py-3.5">
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold <?= $b['status']==='Terbit' ? 'bg-green-100 text-green-700' : 'bg-stone-100 text-stone-600' ?>">
                        <?= $b['status'] ?>
                    </span>
                </td>
                <td class="px-4 py-3.5">
                    <div class="flex items-center gap-1.5">
                        <a href="?menu=berita&action=edit&id=<?= $b['id'] ?>" class="w-8 h-8 bg-blue-50 hover:bg-blue-500 text-blue-500 hover:text-white rounded-lg flex items-center justify-center transition-colors" title="Edit">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <button onclick="confirmDelete(<?= $b['id'] ?>, '<?= htmlspecialchars(mb_substr($b['judul'],0,30)) ?>...')" class="w-8 h-8 bg-red-50 hover:bg-red-500 text-red-500 hover:text-white rounded-lg flex items-center justify-center transition-colors" title="Hapus">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="px-5 py-3 border-t border-stone-100 flex items-center justify-between text-xs text-stone-400">
        <span>Menampilkan <?= count($berita_data) ?> artikel</span>
        <div class="flex gap-1">
            <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-orange-500 text-white font-bold">1</span>
            <a href="#" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-stone-100 transition-colors">2</a>
        </div>
    </div>
</div>

<script>
// Live search & filter
const searchInp = document.getElementById('search-berita');
const statusSel = document.getElementById('filter-status');
const katSel    = document.getElementById('filter-kat');
function filterTable() {
    const q   = searchInp?.value.toLowerCase() ?? '';
    const st  = statusSel?.value ?? '';
    const kat = katSel?.value ?? '';
    document.querySelectorAll('.berita-row').forEach(row => {
        const text  = row.querySelector('td').textContent.toLowerCase();
        const rowSt = row.dataset.status;
        const rowKt = row.dataset.kategori;
        const show  = (!q || text.includes(q)) && (!st || rowSt === st) && (!kat || rowKt === kat);
        row.classList.toggle('hidden', !show);
    });
}
[searchInp, statusSel, katSel].forEach(el => el?.addEventListener('input', filterTable));

function confirmDelete(id, title) {
    if (confirm(`Hapus berita:\n"${title}"\n\nTindakan ini tidak dapat dibatalkan.`)) {
        alert('Fitur hapus memerlukan koneksi database. ID: ' + id);
    }
}
</script>

<?php endif; ?>
