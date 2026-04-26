<?php
// Included by admin/index.php — session & BASE_URL already available
require_once ROOT_DIR . '/config/settings.php';

$cfg       = getSettings();
$tab       = $_GET['tab']    ?? 'sekolah';
$status    = $_GET['status'] ?? '';
$s         = $cfg['sekolah'];
$k         = $cfg['kontak'];
$sm        = $cfg['sosmed'];
$p         = $cfg['ppdb'];
$ticker    = $cfg['ticker'];
$adm       = $cfg['admin'];
$seo       = $cfg['seo'];

$tabs = [
    'sekolah'  => ['icon' => '🏫', 'label' => 'Informasi Sekolah'],
    'kontak'   => ['icon' => '📍', 'label' => 'Kontak & Lokasi'],
    'sosmed'   => ['icon' => '📱', 'label' => 'Media Sosial'],
    'ppdb'     => ['icon' => '🎓', 'label' => 'PPDB'],
    'ticker'   => ['icon' => '📢', 'label' => 'Ticker'],
    'seo'      => ['icon' => '🔍', 'label' => 'SEO'],
    'keamanan' => ['icon' => '🔒', 'label' => 'Keamanan'],
];

$status_messages = [
    'success'           => ['bg'=>'bg-green-50','border'=>'border-green-200','text'=>'text-green-800','icon'=>'✅','msg'=>'Pengaturan berhasil disimpan.'],
    'error'             => ['bg'=>'bg-red-50','border'=>'border-red-200','text'=>'text-red-800','icon'=>'❌','msg'=>'Gagal menyimpan. Periksa izin file config/settings.json.'],
    'wrong_password'    => ['bg'=>'bg-red-50','border'=>'border-red-200','text'=>'text-red-800','icon'=>'🔐','msg'=>'Password saat ini tidak sesuai.'],
    'password_mismatch' => ['bg'=>'bg-red-50','border'=>'border-red-200','text'=>'text-red-800','icon'=>'⚠️','msg'=>'Password baru dan konfirmasi tidak cocok.'],
    'password_too_short'=> ['bg'=>'bg-red-50','border'=>'border-red-200','text'=>'text-red-800','icon'=>'⚠️','msg'=>'Password baru minimal 8 karakter.'],
];

function field(string $name, string $label, string $value, string $type='text', string $placeholder='', bool $required=false, string $hint=''): void {
    $req = $required ? '<span class="text-orange-500">*</span>' : '';
    $ph  = $placeholder ? "placeholder=\"$placeholder\"" : '';
    echo "<div>";
    echo "<label class='block text-sm font-semibold text-stone-700 mb-1.5'>$label $req</label>";
    echo "<input type='$type' name='$name' value='" . htmlspecialchars($value) . "' $ph class='w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm text-stone-800 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent transition'>";
    if ($hint) echo "<p class='text-stone-400 text-xs mt-1'>$hint</p>";
    echo "</div>";
}

function textarea(string $name, string $label, string $value, int $rows=3, string $hint=''): void {
    echo "<div>";
    echo "<label class='block text-sm font-semibold text-stone-700 mb-1.5'>$label</label>";
    echo "<textarea name='$name' rows='$rows' class='w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm text-stone-800 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-transparent transition resize-none'>" . htmlspecialchars($value) . "</textarea>";
    if ($hint) echo "<p class='text-stone-400 text-xs mt-1'>$hint</p>";
    echo "</div>";
}

function sectionCard(string $icon, string $title, string $body = ''): void {
    echo "<div class='bg-stone-50 border border-stone-100 rounded-2xl p-5'>";
    echo "<div class='flex items-center gap-2 mb-4'><span class='text-xl'>$icon</span><h4 class='font-heading font-bold text-stone-900 text-sm'>$title</h4></div>";
    echo $body;
    echo "</div>";
}
?>

<!-- ── Page Header ───────────────────────────────────────────────────── -->
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="font-heading font-bold text-stone-900 text-xl">Pengaturan Website</h2>
        <p class="text-stone-400 text-sm mt-0.5">Kelola semua konfigurasi website dan sistem PPDB</p>
    </div>
    <?php if ($cfg['ppdb']['aktif']): ?>
    <div class="flex items-center gap-2 bg-green-50 border border-green-200 rounded-xl px-4 py-2">
        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
        <span class="text-green-700 text-sm font-semibold">PPDB Aktif</span>
    </div>
    <?php else: ?>
    <div class="flex items-center gap-2 bg-red-50 border border-red-200 rounded-xl px-4 py-2">
        <span class="w-2 h-2 rounded-full bg-red-500"></span>
        <span class="text-red-700 text-sm font-semibold">PPDB Nonaktif</span>
    </div>
    <?php endif; ?>
</div>

<!-- ── Status Banner ─────────────────────────────────────────────────── -->
<?php if ($status && isset($status_messages[$status])): $msg = $status_messages[$status]; ?>
<div class="<?= $msg['bg'] ?> <?= $msg['border'] ?> border rounded-2xl px-5 py-4 mb-6 flex items-center gap-3">
    <span class="text-xl flex-shrink-0"><?= $msg['icon'] ?></span>
    <span class="<?= $msg['text'] ?> text-sm font-semibold"><?= $msg['msg'] ?></span>
    <button onclick="this.closest('div').remove()" class="ml-auto text-stone-400 hover:text-stone-600 text-lg leading-none">×</button>
</div>
<?php endif; ?>

<!-- ── Tab Navigation ────────────────────────────────────────────────── -->
<div class="flex gap-1.5 flex-wrap mb-7 bg-white border border-stone-200 rounded-2xl p-1.5">
    <?php foreach ($tabs as $key => $t): ?>
    <a href="?menu=pengaturan&tab=<?= $key ?>"
       class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold transition-all <?= $tab === $key ? 'bg-orange-500 text-white shadow-md shadow-orange-200' : 'text-stone-500 hover:bg-stone-50 hover:text-stone-800' ?>">
        <span><?= $t['icon'] ?></span>
        <span class="hidden sm:inline"><?= $t['label'] ?></span>
    </a>
    <?php endforeach; ?>
</div>

<!-- ══════════════════════════════════════════════════════════════════════
     TAB: INFORMASI SEKOLAH
══════════════════════════════════════════════════════════════════════ -->
<?php if ($tab === 'sekolah'): ?>
<form method="POST" action="save-settings.php">
    <input type="hidden" name="_section" value="sekolah">
    <div class="space-y-5">

        <!-- Identitas -->
        <div class="bg-white rounded-2xl border border-stone-200 p-6">
            <div class="flex items-center gap-2 mb-5 pb-4 border-b border-stone-100">
                <span class="text-xl">🏫</span>
                <h3 class="font-heading font-bold text-stone-900">Identitas Sekolah</h3>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <?php field('nama','Nama Sekolah',$s['nama'],'text','SMKN 1 Adiwerna',true) ?>
                <?php field('akreditasi','Akreditasi',$s['akreditasi'],'text','A, B, C') ?>
                <?php field('tahun_berdiri','Tahun Berdiri',$s['tahun_berdiri'],'text','1968') ?>
                <?php field('npsn','NPSN',$s['npsn'],'text','20327921') ?>
                <?php field('nss','NSS',$s['nss'],'text','401032801001') ?>
            </div>
            <div class="grid gap-4 mt-4">
                <?php field('tagline','Tagline / Motto',$s['tagline'],'text','Membentuk Generasi...','true','Tampil di hero halaman utama') ?>
                <?php textarea('deskripsi','Deskripsi Singkat',$s['deskripsi'],3,'Tampil di footer dan meta description') ?>
            </div>
        </div>

        <!-- Pimpinan -->
        <div class="bg-white rounded-2xl border border-stone-200 p-6">
            <div class="flex items-center gap-2 mb-5 pb-4 border-b border-stone-100">
                <span class="text-xl">👨‍💼</span>
                <h3 class="font-heading font-bold text-stone-900">Kepala Sekolah</h3>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <?php field('kepala_sekolah','Nama Kepala Sekolah',$s['kepala_sekolah'],'text','Nama lengkap + gelar') ?>
                <?php field('nip_kepala','NIP',$s['nip_kepala'],'text','18 digit NIP') ?>
            </div>
        </div>

        <!-- Statistik Hero -->
        <div class="bg-white rounded-2xl border border-stone-200 p-6">
            <div class="flex items-center gap-2 mb-5 pb-4 border-b border-stone-100">
                <span class="text-xl">📊</span>
                <h3 class="font-heading font-bold text-stone-900">Statistik (Tampil di Hero Beranda)</h3>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <?php field('total_siswa','Total Siswa',$s['total_siswa'],'text','2.400+','false','Contoh: 2.400+') ?>
                <?php field('total_guru','Guru & Staff',$s['total_guru'],'text','120+','false','Contoh: 120+') ?>
                <?php field('program_keahlian','Program Keahlian',$s['program_keahlian'],'text','8','false','Angka saja') ?>
                <?php field('tingkat_kelulusan','Kelulusan',$s['tingkat_kelulusan'],'text','95%','false','Contoh: 95%') ?>
            </div>
            <!-- Live Preview -->
            <div class="mt-5 pt-4 border-t border-stone-100">
                <p class="text-xs text-stone-400 mb-3 font-semibold uppercase tracking-wide">Preview di Hero</p>
                <div class="bg-stone-900 rounded-xl p-4 grid grid-cols-4 gap-4">
                    <?php foreach(['total_siswa'=>'Total Siswa','total_guru'=>'Guru & Staff','program_keahlian'=>'Prog. Keahlian','tingkat_kelulusan'=>'Kelulusan'] as $k2 => $l2): ?>
                    <div class="text-center">
                        <div class="font-heading font-black text-orange-500 text-xl" id="prev_<?= $k2 ?>"><?= htmlspecialchars($s[$k2]) ?></div>
                        <div class="text-stone-500 text-xs mt-0.5"><?= $l2 ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <script>
            ['total_siswa','total_guru','program_keahlian','tingkat_kelulusan'].forEach(id => {
                const inp = document.querySelector(`[name="${id}"]`);
                const prev = document.getElementById('prev_' + id);
                if (inp && prev) inp.addEventListener('input', () => prev.textContent = inp.value || '–');
            });
            </script>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-8 py-3 rounded-xl transition-colors flex items-center gap-2 shadow-md shadow-orange-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                Simpan Informasi Sekolah
            </button>
        </div>
    </div>
</form>

<!-- ══════════════════════════════════════════════════════════════════════
     TAB: KONTAK & LOKASI
══════════════════════════════════════════════════════════════════════ -->
<?php elseif ($tab === 'kontak'): ?>
<form method="POST" action="save-settings.php">
    <input type="hidden" name="_section" value="kontak">
    <div class="space-y-5">

        <div class="bg-white rounded-2xl border border-stone-200 p-6">
            <div class="flex items-center gap-2 mb-5 pb-4 border-b border-stone-100">
                <span class="text-xl">📍</span>
                <h3 class="font-heading font-bold text-stone-900">Alamat Sekolah</h3>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <?php field('alamat','Nama Jalan / Alamat',$k['alamat'],'text','Jl. Dewi Sartika No.1') ?>
                <?php field('kode_pos','Kode Pos',$k['kode_pos'],'text','52194') ?>
                <?php field('kecamatan','Kecamatan',$k['kecamatan'],'text','Adiwerna') ?>
                <?php field('kabupaten','Kabupaten / Kota',$k['kabupaten'],'text','Kabupaten Tegal') ?>
                <?php field('provinsi','Provinsi',$k['provinsi'],'text','Jawa Tengah') ?>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-stone-200 p-6">
            <div class="flex items-center gap-2 mb-5 pb-4 border-b border-stone-100">
                <span class="text-xl">📞</span>
                <h3 class="font-heading font-bold text-stone-900">Kontak</h3>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <?php field('telepon','Telepon',$k['telepon'],'text','(0283) 444555') ?>
                <?php field('whatsapp','Nomor WhatsApp',$k['whatsapp'],'text','6281234567890','false','Format internasional tanpa +, cth: 6281234567890') ?>
                <?php field('email','Email Resmi',$k['email'],'email','info@sekolah.sch.id') ?>
                <?php field('website','Website',$k['website'],'text','www.smkn1adiwerna.sch.id') ?>
                <?php field('jam_layanan','Jam Layanan',$k['jam_layanan'],'text','Senin–Jumat: 07.00 – 15.30') ?>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-stone-200 p-6">
            <div class="flex items-center gap-2 mb-5 pb-4 border-b border-stone-100">
                <span class="text-xl">🗺️</span>
                <h3 class="font-heading font-bold text-stone-900">Google Maps</h3>
            </div>
            <div class="space-y-4">
                <?php field('maps_link','URL Google Maps',$k['maps_link'],'url','https://maps.google.com/...','false','Link tombol "Buka di Google Maps" di halaman kontak') ?>
                <?php textarea('maps_embed','Embed Code iframe Maps',$k['maps_embed'],5,'Tempel kode &lt;iframe src="..."&gt; dari Google Maps → Share → Embed a map') ?>
                <?php if (!empty($k['maps_embed'])): ?>
                <div>
                    <p class="text-xs text-stone-400 mb-2 font-semibold uppercase tracking-wide">Preview Map</p>
                    <div class="rounded-xl overflow-hidden border border-stone-200 aspect-video">
                        <?= $k['maps_embed'] ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-8 py-3 rounded-xl transition-colors flex items-center gap-2 shadow-md shadow-orange-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                Simpan Kontak & Lokasi
            </button>
        </div>
    </div>
</form>

<!-- ══════════════════════════════════════════════════════════════════════
     TAB: MEDIA SOSIAL
══════════════════════════════════════════════════════════════════════ -->
<?php elseif ($tab === 'sosmed'): ?>
<form method="POST" action="save-settings.php">
    <input type="hidden" name="_section" value="sosmed">
    <div class="bg-white rounded-2xl border border-stone-200 p-6">
        <div class="flex items-center gap-2 mb-5 pb-4 border-b border-stone-100">
            <span class="text-xl">📱</span>
            <h3 class="font-heading font-bold text-stone-900">Akun Media Sosial</h3>
            <span class="ml-auto text-xs text-stone-400">Isi dengan URL lengkap atau '#' jika belum ada</span>
        </div>
        <div class="space-y-4">
            <?php
            $sosmed_items = [
                ['name'=>'facebook','icon'=>'📘','label'=>'Facebook','placeholder'=>'https://facebook.com/smkn1adiwerna','color'=>'bg-blue-50'],
                ['name'=>'instagram','icon'=>'📸','label'=>'Instagram','placeholder'=>'https://instagram.com/smkn1adiwerna','color'=>'bg-pink-50'],
                ['name'=>'youtube','icon'=>'▶️','label'=>'YouTube','placeholder'=>'https://youtube.com/@smkn1adiwerna','color'=>'bg-red-50'],
                ['name'=>'tiktok','icon'=>'🎵','label'=>'TikTok','placeholder'=>'https://tiktok.com/@smkn1adiwerna','color'=>'bg-stone-50'],
            ];
            foreach ($sosmed_items as $item): ?>
            <div class="flex items-center gap-4 <?= $item['color'] ?> rounded-xl p-4">
                <div class="text-3xl w-10 text-center flex-shrink-0"><?= $item['icon'] ?></div>
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-stone-700 mb-1"><?= $item['label'] ?></label>
                    <input type="url" name="<?= $item['name'] ?>" value="<?= htmlspecialchars($sm[$item['name']]) ?>"
                           placeholder="<?= $item['placeholder'] ?>"
                           class="w-full px-3 py-2.5 bg-white border border-stone-200 rounded-xl text-sm text-stone-800 focus:outline-none focus:ring-2 focus:ring-orange-400 transition">
                </div>
                <?php if ($sm[$item['name']] && $sm[$item['name']] !== '#'): ?>
                <a href="<?= htmlspecialchars($sm[$item['name']]) ?>" target="_blank"
                   class="flex-shrink-0 text-xs text-orange-500 hover:text-orange-600 font-semibold">
                    Buka ↗
                </a>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-8 py-3 rounded-xl transition-colors flex items-center gap-2 shadow-md shadow-orange-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                Simpan Media Sosial
            </button>
        </div>
    </div>
</form>

<!-- ══════════════════════════════════════════════════════════════════════
     TAB: PPDB
══════════════════════════════════════════════════════════════════════ -->
<?php elseif ($tab === 'ppdb'): ?>
<form method="POST" action="save-settings.php">
    <input type="hidden" name="_section" value="ppdb">
    <div class="space-y-5">

        <!-- Status Toggle Card -->
        <div class="bg-white rounded-2xl border <?= $p['aktif'] ? 'border-green-300' : 'border-red-300' ?> p-6">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 <?= $p['aktif'] ? 'bg-green-100' : 'bg-red-100' ?> rounded-2xl flex items-center justify-center text-3xl">
                        <?= $p['aktif'] ? '🟢' : '🔴' ?>
                    </div>
                    <div>
                        <h3 class="font-heading font-bold text-stone-900 text-lg">Status Pendaftaran PPDB</h3>
                        <p class="text-stone-500 text-sm">Tahun Ajaran <?= htmlspecialchars($p['tahun_ajaran']) ?></p>
                    </div>
                </div>
                <!-- Toggle Switch -->
                <label class="flex items-center gap-3 cursor-pointer select-none">
                    <span class="text-sm font-semibold <?= $p['aktif'] ? 'text-green-700' : 'text-stone-500' ?>">
                        <?= $p['aktif'] ? 'DIBUKA' : 'DITUTUP' ?>
                    </span>
                    <div class="relative">
                        <input type="checkbox" name="aktif" id="ppdb_toggle" class="sr-only peer" <?= $p['aktif'] ? 'checked' : '' ?>>
                        <div class="w-12 h-6 bg-stone-200 rounded-full peer peer-checked:bg-green-500 transition-colors"></div>
                        <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform peer-checked:translate-x-6"></div>
                    </div>
                </label>
            </div>
            <!-- Warning -->
            <div id="ppdb_warning" class="<?= $p['aktif'] ? 'hidden' : '' ?> mt-4 bg-red-50 border border-red-200 rounded-xl px-4 py-2.5 text-red-700 text-sm flex items-center gap-2">
                <span>⚠️</span> PPDB nonaktif — formulir di halaman PPDB tidak dapat diakses calon pendaftar.
            </div>
            <script>
            const toggle = document.getElementById('ppdb_toggle');
            const warn   = document.getElementById('ppdb_warning');
            toggle.addEventListener('change', () => {
                warn.classList.toggle('hidden', toggle.checked);
                toggle.closest('.flex').querySelector('span').textContent = toggle.checked ? 'DIBUKA' : 'DITUTUP';
                toggle.closest('.flex').querySelector('span').className = 'text-sm font-semibold ' + (toggle.checked ? 'text-green-700' : 'text-stone-500');
            });
            </script>
        </div>

        <!-- Jadwal & Detail -->
        <div class="bg-white rounded-2xl border border-stone-200 p-6">
            <div class="flex items-center gap-2 mb-5 pb-4 border-b border-stone-100">
                <span class="text-xl">📅</span>
                <h3 class="font-heading font-bold text-stone-900">Jadwal PPDB</h3>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <?php field('tahun_ajaran','Tahun Ajaran',$p['tahun_ajaran'],'text','2025/2026',true) ?>
                <?php field('kuota_per_jurusan','Kuota per Jurusan',(string)$p['kuota_per_jurusan'],'number','36',true,'Jumlah siswa yang diterima per program keahlian') ?>
                <?php field('tgl_buka','Tanggal Buka Pendaftaran',$p['tgl_buka'],'date','',true) ?>
                <?php field('tgl_tutup','Tanggal Tutup Pendaftaran',$p['tgl_tutup'],'date','',true) ?>
                <?php field('tgl_pengumuman','Tanggal Pengumuman Seleksi',$p['tgl_pengumuman'],'date') ?>
                <?php field('tgl_daftar_ulang','Tanggal Mulai Daftar Ulang',$p['tgl_daftar_ulang'],'date') ?>
            </div>

            <!-- Kuota Visual -->
            <?php
            $jurusan_list = ['TKJ','RPL','AKL','MM','OTKP','BDP','TB','TBSM'];
            $total_kuota = count($jurusan_list) * (int)$p['kuota_per_jurusan'];
            ?>
            <div class="mt-5 pt-4 border-t border-stone-100">
                <p class="text-xs text-stone-400 mb-3 font-semibold uppercase tracking-wide">Proyeksi Kuota Total</p>
                <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 flex items-center gap-6">
                    <div class="text-center">
                        <div class="font-heading font-black text-orange-600 text-3xl"><?= $total_kuota ?></div>
                        <div class="text-stone-500 text-xs">Total Kursi</div>
                    </div>
                    <div class="grid grid-cols-4 gap-2 flex-1">
                        <?php foreach ($jurusan_list as $j): ?>
                        <div class="text-center bg-white rounded-lg p-2 border border-orange-100">
                            <div class="font-bold text-stone-900 text-sm" id="kuota_<?= strtolower($j) ?>"><?= $p['kuota_per_jurusan'] ?></div>
                            <div class="text-stone-400 text-[10px]"><?= $j ?></div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <script>
                document.querySelector('[name="kuota_per_jurusan"]')?.addEventListener('input', function() {
                    document.querySelectorAll('[id^="kuota_"]').forEach(el => el.textContent = this.value || 0);
                    document.querySelector('.font-heading.text-orange-600.text-3xl').textContent = (parseInt(this.value)||0) * <?= count($jurusan_list) ?>;
                });
                </script>
            </div>
        </div>

        <!-- Catatan -->
        <div class="bg-white rounded-2xl border border-stone-200 p-6">
            <div class="flex items-center gap-2 mb-4">
                <span class="text-xl">📝</span>
                <h3 class="font-heading font-bold text-stone-900">Catatan / Pengumuman PPDB</h3>
            </div>
            <?php textarea('catatan','Catatan Tambahan (opsional)',$p['catatan'],4,'Tampil sebagai info tambahan di halaman PPDB. Kosongkan jika tidak ada.') ?>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-8 py-3 rounded-xl transition-colors flex items-center gap-2 shadow-md shadow-orange-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                Simpan Pengaturan PPDB
            </button>
        </div>
    </div>
</form>

<!-- ══════════════════════════════════════════════════════════════════════
     TAB: TICKER
══════════════════════════════════════════════════════════════════════ -->
<?php elseif ($tab === 'ticker'): ?>
<form method="POST" action="save-settings.php" id="ticker-form">
    <input type="hidden" name="_section" value="ticker">
    <div class="space-y-5">

        <!-- Live Preview -->
        <div class="bg-orange-500 rounded-2xl px-5 py-3 overflow-hidden flex items-center gap-4">
            <div class="bg-white text-orange-700 text-xs font-black px-3 py-1 rounded flex-shrink-0 uppercase tracking-wide">Preview</div>
            <div class="overflow-hidden flex-1 relative">
                <div id="ticker-preview" class="text-white text-sm font-medium whitespace-nowrap truncate">
                    <?= htmlspecialchars(implode('  •  ', $ticker)) ?>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-stone-200 p-6">
            <div class="flex items-center justify-between mb-5 pb-4 border-b border-stone-100">
                <div class="flex items-center gap-2">
                    <span class="text-xl">📢</span>
                    <h3 class="font-heading font-bold text-stone-900">Daftar Teks Ticker</h3>
                </div>
                <button type="button" id="add-ticker" class="flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                    Tambah Baris
                </button>
            </div>

            <div id="ticker-list" class="space-y-3">
                <?php foreach ($ticker as $idx => $item): ?>
                <div class="ticker-row flex items-center gap-3 bg-stone-50 rounded-xl p-3 group" draggable="true">
                    <div class="text-stone-300 cursor-grab active:cursor-grabbing flex-shrink-0">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M7 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm6 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM7 8a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm6 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-6 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm6 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg>
                    </div>
                    <span class="bg-orange-100 text-orange-700 text-xs font-bold w-6 h-6 rounded-lg flex items-center justify-center flex-shrink-0"><?= $idx+1 ?></span>
                    <input type="text" name="ticker[]" value="<?= htmlspecialchars($item) ?>"
                           class="flex-1 bg-white border border-stone-200 rounded-xl px-3 py-2 text-sm text-stone-800 focus:outline-none focus:ring-2 focus:ring-orange-400 transition ticker-input">
                    <button type="button" class="remove-ticker flex-shrink-0 w-8 h-8 rounded-xl bg-red-50 hover:bg-red-500 text-red-500 hover:text-white transition-colors flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <?php endforeach; ?>
            </div>

            <p class="text-stone-400 text-xs mt-4 flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Teks akan berputar otomatis di bagian atas halaman. Drag ⠿ untuk mengurutkan ulang.
            </p>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-8 py-3 rounded-xl transition-colors flex items-center gap-2 shadow-md shadow-orange-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                Simpan Ticker
            </button>
        </div>
    </div>
</form>

<script>
// Add ticker row
document.getElementById('add-ticker')?.addEventListener('click', () => {
    const list = document.getElementById('ticker-list');
    const count = list.children.length;
    const row = document.createElement('div');
    row.className = 'ticker-row flex items-center gap-3 bg-stone-50 rounded-xl p-3 group';
    row.draggable = true;
    row.innerHTML = `
        <div class="text-stone-300 cursor-grab flex-shrink-0">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M7 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm6 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM7 8a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm6 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-6 6a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm6 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/></svg>
        </div>
        <span class="bg-orange-100 text-orange-700 text-xs font-bold w-6 h-6 rounded-lg flex items-center justify-center flex-shrink-0">${count+1}</span>
        <input type="text" name="ticker[]" value="" placeholder="Tulis teks pengumuman..."
               class="flex-1 bg-white border border-stone-200 rounded-xl px-3 py-2 text-sm text-stone-800 focus:outline-none focus:ring-2 focus:ring-orange-400 transition ticker-input">
        <button type="button" class="remove-ticker flex-shrink-0 w-8 h-8 rounded-xl bg-red-50 hover:bg-red-500 text-red-500 hover:text-white transition-colors flex items-center justify-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    `;
    list.appendChild(row);
    row.querySelector('input').focus();
    bindRemove(row);
    updatePreview();
});

// Remove row
function bindRemove(row) {
    row.querySelector('.remove-ticker')?.addEventListener('click', () => {
        if (document.querySelectorAll('.ticker-row').length > 1) {
            row.remove();
            updateNumbers();
            updatePreview();
        }
    });
}
document.querySelectorAll('.ticker-row').forEach(bindRemove);

// Update preview
function updatePreview() {
    const vals = [...document.querySelectorAll('.ticker-input')].map(i => i.value).filter(v => v.trim());
    const preview = document.getElementById('ticker-preview');
    if (preview) preview.textContent = vals.join('  •  ') || '(kosong)';
}
document.querySelectorAll('.ticker-input').forEach(inp => inp.addEventListener('input', updatePreview));

// Update numbers
function updateNumbers() {
    document.querySelectorAll('.ticker-row').forEach((row, i) => {
        const badge = row.querySelector('.bg-orange-100');
        if (badge) badge.textContent = i + 1;
    });
}

// Drag to reorder
let dragSrc = null;
document.getElementById('ticker-list').addEventListener('dragstart', e => { dragSrc = e.target.closest('.ticker-row'); });
document.getElementById('ticker-list').addEventListener('dragover', e => { e.preventDefault(); const t = e.target.closest('.ticker-row'); if (t && t !== dragSrc) { t.parentNode.insertBefore(dragSrc, t); } });
document.getElementById('ticker-list').addEventListener('dragend', () => { updateNumbers(); updatePreview(); dragSrc = null; });
</script>

<!-- ══════════════════════════════════════════════════════════════════════
     TAB: SEO
══════════════════════════════════════════════════════════════════════ -->
<?php elseif ($tab === 'seo'): ?>
<form method="POST" action="save-settings.php">
    <input type="hidden" name="_section" value="seo">
    <div class="space-y-5">

        <div class="bg-white rounded-2xl border border-stone-200 p-6">
            <div class="flex items-center gap-2 mb-5 pb-4 border-b border-stone-100">
                <span class="text-xl">🔍</span>
                <h3 class="font-heading font-bold text-stone-900">Optimasi Mesin Pencari (SEO)</h3>
            </div>
            <div class="space-y-4">
                <!-- SERP Preview -->
                <div class="bg-stone-50 rounded-xl p-4 border border-stone-100 mb-2">
                    <p class="text-xs text-stone-400 mb-2 font-semibold uppercase tracking-wide">Preview Google Search</p>
                    <div class="space-y-1">
                        <div id="seo-title-preview" class="text-blue-600 text-base font-medium truncate"><?= htmlspecialchars($s['nama']) ?> — <?= htmlspecialchars($s['tagline']) ?></div>
                        <div class="text-green-700 text-xs"><?= htmlspecialchars($k['website']) ?></div>
                        <div id="seo-desc-preview" class="text-stone-600 text-sm leading-snug line-clamp-2"><?= htmlspecialchars($seo['meta_description']) ?></div>
                    </div>
                </div>
                <?php textarea('meta_description','Meta Description',$seo['meta_description'],3,'Idealnya 150-160 karakter. Tampil di hasil pencarian Google.') ?>
                <?php field('meta_keywords','Meta Keywords',$seo['meta_keywords'],'text','kata kunci, dipisah koma','false','Gunakan kata kunci relevan, dipisah koma') ?>
                <?php field('google_analytics','Google Analytics Measurement ID',$seo['google_analytics'],'text','G-XXXXXXXXXX','false','Contoh: G-XXXXXXXXXX atau UA-XXXXXXXX-X. Kosongkan jika tidak dipakai.') ?>

                <script>
                const descInp = document.querySelector('[name="meta_description"]');
                const descPrev = document.getElementById('seo-desc-preview');
                if(descInp && descPrev) descInp.addEventListener('input', () => descPrev.textContent = descInp.value);
                </script>

                <!-- Character counters -->
                <div class="flex gap-4 text-xs text-stone-400">
                    <span id="desc-count">Meta Description: <strong id="desc-chars">0</strong>/160 karakter</span>
                </div>
                <script>
                (function() {
                    const inp = document.querySelector('[name="meta_description"]');
                    const counter = document.getElementById('desc-chars');
                    if (!inp || !counter) return;
                    function update() {
                        const len = inp.value.length;
                        counter.textContent = len;
                        counter.parentElement.className = 'text-xs ' + (len > 160 ? 'text-red-500' : len > 120 ? 'text-orange-500' : 'text-stone-400');
                    }
                    inp.addEventListener('input', update);
                    update();
                })();
                </script>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-8 py-3 rounded-xl transition-colors flex items-center gap-2 shadow-md shadow-orange-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                Simpan Pengaturan SEO
            </button>
        </div>
    </div>
</form>

<!-- ══════════════════════════════════════════════════════════════════════
     TAB: KEAMANAN
══════════════════════════════════════════════════════════════════════ -->
<?php elseif ($tab === 'keamanan'): ?>
<div class="grid md:grid-cols-2 gap-5">

    <!-- Ganti Username -->
    <div class="bg-white rounded-2xl border border-stone-200 p-6">
        <div class="flex items-center gap-2 mb-5 pb-4 border-b border-stone-100">
            <span class="text-xl">👤</span>
            <h3 class="font-heading font-bold text-stone-900">Ganti Username</h3>
        </div>
        <form method="POST" action="save-settings.php">
            <input type="hidden" name="_section" value="keamanan">
            <input type="hidden" name="new_password" value="">
            <input type="hidden" name="confirm_password" value="">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-stone-700 mb-1.5">Username Saat Ini</label>
                    <div class="px-3 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-sm text-stone-600 font-mono">
                        <?= htmlspecialchars($adm['username']) ?>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-stone-700 mb-1.5">Username Baru <span class="text-orange-500">*</span></label>
                    <input type="text" name="username" value=""
                           class="w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 transition"
                           placeholder="Username baru">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-stone-700 mb-1.5">Konfirmasi Password Saat Ini <span class="text-orange-500">*</span></label>
                    <input type="password" name="current_password" required
                           class="w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 transition"
                           placeholder="••••••••">
                </div>
                <button type="submit" class="w-full bg-stone-800 hover:bg-stone-700 text-white font-semibold py-3 rounded-xl transition-colors">
                    Simpan Username
                </button>
            </div>
        </form>
    </div>

    <!-- Ganti Password -->
    <div class="bg-white rounded-2xl border border-stone-200 p-6">
        <div class="flex items-center gap-2 mb-5 pb-4 border-b border-stone-100">
            <span class="text-xl">🔑</span>
            <h3 class="font-heading font-bold text-stone-900">Ganti Password</h3>
        </div>
        <form method="POST" action="save-settings.php" id="pass-form">
            <input type="hidden" name="_section" value="keamanan">
            <input type="hidden" name="username" value="">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-stone-700 mb-1.5">Password Saat Ini <span class="text-orange-500">*</span></label>
                    <input type="password" name="current_password" required
                           class="w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 transition"
                           placeholder="••••••••">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-stone-700 mb-1.5">Password Baru <span class="text-orange-500">*</span></label>
                    <div class="relative">
                        <input type="password" name="new_password" id="new_pass" required minlength="8"
                               class="w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 transition pr-10"
                               placeholder="Min. 8 karakter">
                        <button type="button" onclick="togglePass('new_pass',this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-stone-400 hover:text-stone-600 text-xs">👁️</button>
                    </div>
                    <!-- Strength bar -->
                    <div class="mt-1.5">
                        <div class="h-1.5 bg-stone-100 rounded-full overflow-hidden">
                            <div id="strength-bar" class="h-full rounded-full transition-all duration-300 w-0"></div>
                        </div>
                        <p id="strength-label" class="text-xs text-stone-400 mt-0.5"></p>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-stone-700 mb-1.5">Konfirmasi Password Baru <span class="text-orange-500">*</span></label>
                    <div class="relative">
                        <input type="password" name="confirm_password" id="confirm_pass" required
                               class="w-full px-3 py-2.5 border border-stone-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 transition pr-10"
                               placeholder="Ulangi password baru">
                        <span id="match-icon" class="absolute right-3 top-1/2 -translate-y-1/2 text-sm hidden"></span>
                    </div>
                </div>
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-xl transition-colors">
                    Simpan Password Baru
                </button>
            </div>
        </form>
    </div>

    <!-- Info Keamanan -->
    <div class="md:col-span-2 bg-amber-50 border border-amber-200 rounded-2xl p-5 flex items-start gap-4">
        <span class="text-2xl flex-shrink-0">💡</span>
        <div>
            <p class="font-semibold text-amber-800 text-sm mb-1">Tips Keamanan</p>
            <ul class="text-amber-700 text-xs space-y-1 list-disc pl-4">
                <li>Gunakan password minimal 8 karakter dengan kombinasi huruf besar, kecil, angka, dan simbol.</li>
                <li>Jangan bagikan akun admin kepada pihak yang tidak berwenang.</li>
                <li>Logout dari admin panel setelah selesai bekerja.</li>
                <li>File settings tersimpan di <code class="bg-amber-100 px-1 rounded">config/settings.json</code> — pastikan izin file tidak bisa diakses publik.</li>
            </ul>
        </div>
    </div>
</div>

<script>
function togglePass(id, btn) {
    const inp = document.getElementById(id);
    inp.type = inp.type === 'password' ? 'text' : 'password';
    btn.textContent = inp.type === 'password' ? '👁️' : '🙈';
}

// Password strength
const newPass = document.getElementById('new_pass');
const bar = document.getElementById('strength-bar');
const lbl = document.getElementById('strength-label');
newPass?.addEventListener('input', () => {
    const v = newPass.value;
    let score = 0;
    if (v.length >= 8)  score++;
    if (v.length >= 12) score++;
    if (/[A-Z]/.test(v)) score++;
    if (/[0-9]/.test(v)) score++;
    if (/[^A-Za-z0-9]/.test(v)) score++;
    const levels = [
        {w:'0%',c:'bg-red-500',t:''},
        {w:'20%',c:'bg-red-500',t:'Sangat Lemah'},
        {w:'40%',c:'bg-orange-500',t:'Lemah'},
        {w:'60%',c:'bg-yellow-500',t:'Sedang'},
        {w:'80%',c:'bg-blue-500',t:'Kuat'},
        {w:'100%',c:'bg-green-500',t:'Sangat Kuat'},
    ];
    const lvl = levels[Math.min(score, 5)];
    bar.style.width = lvl.w;
    bar.className = `h-full rounded-full transition-all duration-300 ${lvl.c}`;
    lbl.textContent = lvl.t;
    lbl.style.color = '';
});

// Confirm match
const conf = document.getElementById('confirm_pass');
const icon = document.getElementById('match-icon');
conf?.addEventListener('input', () => {
    if (!conf.value) { icon.classList.add('hidden'); return; }
    icon.classList.remove('hidden');
    const match = conf.value === newPass?.value;
    icon.textContent = match ? '✅' : '❌';
    conf.style.borderColor = match ? '#22c55e' : '#ef4444';
});
</script>

<?php endif; ?>
