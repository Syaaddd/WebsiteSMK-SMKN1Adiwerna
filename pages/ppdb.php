<?php
require_once '../config/database.php';
include '../includes/header.php'; // sets $_SITE
include '../includes/navbar.php';
$_ppdb   = $_SITE['ppdb']    ?? [];
$_sekolah_cfg = $_SITE['sekolah'] ?? [];
$ta       = htmlspecialchars($_ppdb['tahun_ajaran']     ?? '2025/2026');
$tgl_buka = $_ppdb['tgl_buka']   ?? '';
$tgl_tutup= $_ppdb['tgl_tutup']  ?? '';
$tgl_pengumuman  = $_ppdb['tgl_pengumuman']   ?? '';
$tgl_daftar_ulang= $_ppdb['tgl_daftar_ulang'] ?? '';
$kuota    = (int)($_ppdb['kuota_per_jurusan'] ?? 36);
$jml_prodi= (int)($_sekolah_cfg['program_keahlian'] ?? 8);
$total_kuota = $kuota * $jml_prodi;
$ppdb_aktif  = !empty($_ppdb['aktif']);
$catatan     = htmlspecialchars($_ppdb['catatan'] ?? '');

$page_title = 'PPDB Online ' . $ta;
$active_nav = 'ppdb';

$success = false;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = ['nama_lengkap','asal_sekolah','tahun_lulus','pilihan_jurusan','nama_orang_tua','no_hp','email','alamat'];
    $data = [];
    foreach ($fields as $f) {
        $val = trim($_POST[$f] ?? '');
        if (empty($val)) {
            $errors[$f] = 'Field ini wajib diisi.';
        } else {
            $data[$f] = htmlspecialchars($val);
        }
    }
    if (empty($errors)) {
        $success = true;
    }
}
?>

<div class="pt-16">

<!-- Hero -->
<section class="bg-stone-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_70%_50%,rgba(249,115,22,0.12)_0%,transparent_65%)]"></div>
    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-14 relative z-10">
        <div class="flex items-center gap-2 text-stone-400 text-sm mb-3">
            <a href="<?= BASE_URL ?>/" class="hover:text-white transition-colors">Beranda</a>
            <span>›</span>
            <span class="text-orange-400">PPDB 2025/2026</span>
        </div>
        <div class="flex items-start justify-between gap-6 flex-wrap">
            <div>
                <div class="inline-flex items-center gap-2 bg-orange-500/15 border border-orange-500/25 rounded-full px-3 py-1 mb-4">
                    <span class="w-2 h-2 rounded-full <?= $ppdb_aktif ? 'bg-orange-500 pulse-dot' : 'bg-red-400' ?>"></span>
                    <span class="text-orange-400 text-xs font-medium">
                        <?= $ppdb_aktif
                            ? 'Pendaftaran Dibuka — ' . ($tgl_buka ? date('j M', strtotime($tgl_buka)) : '') . ' s/d ' . ($tgl_tutup ? date('j M Y', strtotime($tgl_tutup)) : '')
                            : 'PPDB Saat Ini Tidak Aktif' ?>
                    </span>
                </div>
                <h1 class="font-heading text-4xl lg:text-5xl font-black text-white mb-3">PPDB <span class="text-orange-500"><?= $ta ?></span></h1>
                <p class="text-stone-300 max-w-xl">Penerimaan Peserta Didik Baru SMK Negeri 1 Adiwerna Tahun Pelajaran 2025/2026. Raih masa depanmu di sekolah unggulan Kabupaten Tegal.</p>
            </div>
            <div class="flex gap-4 flex-wrap">
                <?php
                $countdown = [['label'=>'Hari','val'=>'05'],['label'=>'Jam','val'=>'12'],['label'=>'Menit','val'=>'30']];
                foreach ($countdown as $c): ?>
                <div class="bg-stone-800/70 border border-stone-700 rounded-xl px-5 py-3 text-center">
                    <div class="font-heading font-black text-orange-500 text-3xl"><?= $c['val'] ?></div>
                    <div class="text-stone-400 text-xs mt-0.5"><?= $c['label'] ?></div>
                </div>
                <?php endforeach; ?>
                <div class="bg-stone-800/70 border border-stone-700 rounded-xl px-5 py-3 text-center self-end">
                    <div class="text-stone-400 text-xs mb-0.5">Sisa Waktu</div>
                    <div class="text-orange-400 text-xs font-semibold">Daftar Sekarang!</div>
                </div>
            </div>
        </div>
    </div>
    <div class="h-px bg-gradient-to-r from-orange-500 via-orange-400/30 to-transparent"></div>
</section>

<main class="max-w-7xl mx-auto px-4 lg:px-8 py-12 space-y-14">

    <!-- Info Cards -->
    <section class="grid grid-cols-2 md:grid-cols-4 gap-4 reveal">
        <?php
        $info = [
            ['icon'=>'🏫','label'=>'Program Keahlian','val'=>$jml_prodi . ' Jurusan'],
            ['icon'=>'🪑','label'=>'Total Kuota','val'=>$total_kuota . ' Kursi'],
            ['icon'=>'📅','label'=>'Batas Daftar','val'=> $tgl_tutup ? date('j M Y', strtotime($tgl_tutup)) : '—'],
            ['icon'=>'✅','label'=>'Biaya Daftar','val'=>'GRATIS'],
        ];
        foreach ($info as $i): ?>
        <div class="bg-white rounded-2xl border border-stone-200 p-5 text-center card-hover">
            <div class="text-3xl mb-2"><?= $i['icon'] ?></div>
            <div class="font-heading font-black text-orange-500 text-lg"><?= $i['val'] ?></div>
            <div class="text-stone-500 text-xs mt-0.5"><?= $i['label'] ?></div>
        </div>
        <?php endforeach; ?>
    </section>

    <!-- Jadwal PPDB -->
    <section class="reveal">
        <h2 class="font-heading text-2xl font-bold text-stone-900 section-title mb-6">Jadwal PPDB</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <?php
            $jadwal = [
                ['no'=>1,'tahap'=>'Pendaftaran Online','tgl'=>'1 – 20 Mei 2025','status'=>'aktif','icon'=>'📝'],
                ['no'=>2,'tahap'=>'Verifikasi Berkas & Seleksi','tgl'=>'21 – 25 Mei 2025','status'=>'mendatang','icon'=>'✅'],
                ['no'=>3,'tahap'=>'Pengumuman Hasil Seleksi','tgl'=>'28 Mei 2025','status'=>'mendatang','icon'=>'📢'],
                ['no'=>4,'tahap'=>'Daftar Ulang & Pembayaran','tgl'=>'29 Mei – 5 Juni 2025','status'=>'mendatang','icon'=>'🏷️'],
                ['no'=>5,'tahap'=>'Orientasi Siswa Baru (MOS)','tgl'=>'16 – 18 Juli 2025','status'=>'mendatang','icon'=>'🎒'],
                ['no'=>6,'tahap'=>'Awal Tahun Pelajaran 2025/2026','tgl'=>'21 Juli 2025','status'=>'mendatang','icon'=>'🎓'],
            ];
            foreach ($jadwal as $j): ?>
            <div class="bg-white rounded-2xl border <?= $j['status'] === 'aktif' ? 'border-orange-300 bg-orange-50/30' : 'border-stone-200' ?> p-5 flex items-center gap-4">
                <div class="w-12 h-12 <?= $j['status'] === 'aktif' ? 'bg-orange-500' : 'bg-stone-100' ?> rounded-xl flex items-center justify-center text-2xl flex-shrink-0">
                    <?= $j['icon'] ?>
                </div>
                <div class="flex-1">
                    <div class="font-semibold text-stone-900 text-sm mb-0.5"><?= $j['tahap'] ?></div>
                    <div class="text-stone-500 text-xs flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <?= $j['tgl'] ?>
                    </div>
                </div>
                <?php if ($j['status'] === 'aktif'): ?>
                <span class="flex-shrink-0 px-2.5 py-1 bg-orange-500 text-white text-[10px] font-bold rounded-full uppercase tracking-wide">Buka</span>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Persyaratan -->
    <section class="reveal grid md:grid-cols-2 gap-8">
        <div>
            <h2 class="font-heading text-2xl font-bold text-stone-900 section-title mb-5">Persyaratan Pendaftaran</h2>
            <div class="bg-white rounded-2xl border border-stone-200 p-6 space-y-3">
                <?php
                $syarat = [
                    'Fotokopi Ijazah / Surat Keterangan Lulus SMP/MTs (dilegalisir)',
                    'Fotokopi rapor SMP/MTs semester 1–5 (dilegalisir)',
                    'Fotokopi Akta Kelahiran',
                    'Fotokopi Kartu Keluarga (KK)',
                    'Fotokopi KTP orang tua/wali',
                    'Pas foto ukuran 3×4 berwarna sebanyak 4 lembar',
                    'Sertifikat prestasi (jika mendaftar jalur prestasi)',
                    'Surat Keterangan Sehat dari dokter/puskesmas',
                ];
                foreach ($syarat as $idx => $s): ?>
                <div class="flex items-start gap-3 text-sm text-stone-600 py-1.5 <?= $idx !== count($syarat)-1 ? 'border-b border-stone-50' : '' ?>">
                    <span class="w-5 h-5 bg-orange-100 rounded-full text-orange-600 flex-shrink-0 flex items-center justify-center font-bold text-xs"><?= $idx+1 ?></span>
                    <?= $s ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div>
            <h2 class="font-heading text-2xl font-bold text-stone-900 section-title mb-5">Kuota per Program</h2>
            <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
                <?php
                $kuota = [
                    ['kode'=>'TKJ','nama'=>'Teknik Komputer & Jaringan','kuota'=>36],
                    ['kode'=>'RPL','nama'=>'Rekayasa Perangkat Lunak','kuota'=>36],
                    ['kode'=>'AKL','nama'=>'Akuntansi & Keuangan Lembaga','kuota'=>36],
                    ['kode'=>'MM','nama'=>'Multimedia','kuota'=>36],
                    ['kode'=>'OTKP','nama'=>'Otomatisasi Tata Kelola Perkantoran','kuota'=>36],
                    ['kode'=>'BDP','nama'=>'Bisnis Daring & Pemasaran','kuota'=>36],
                    ['kode'=>'TB','nama'=>'Tata Busana','kuota'=>36],
                    ['kode'=>'TBSM','nama'=>'Teknik & Bisnis Sepeda Motor','kuota'=>36],
                ];
                foreach ($kuota as $i => $k): ?>
                <div class="flex items-center gap-3 px-5 py-3 <?= $i % 2 === 0 ? 'bg-stone-50' : 'bg-white' ?> <?= $i !== count($kuota)-1 ? 'border-b border-stone-100' : '' ?>">
                    <span class="font-bold text-orange-500 text-xs w-12 flex-shrink-0"><?= $k['kode'] ?></span>
                    <span class="text-stone-700 text-xs flex-1"><?= $k['nama'] ?></span>
                    <span class="text-stone-900 font-semibold text-sm"><?= $k['kuota'] ?></span>
                    <span class="text-stone-400 text-xs">kursi</span>
                </div>
                <?php endforeach; ?>
                <div class="px-5 py-3 bg-orange-50 border-t border-orange-200 flex justify-between items-center">
                    <span class="font-bold text-stone-900 text-sm">Total Kuota</span>
                    <span class="font-heading font-black text-orange-600 text-lg">288 Kursi</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Pendaftaran -->
    <section class="reveal" id="form-daftar">
        <h2 class="font-heading text-2xl font-bold text-stone-900 section-title mb-6">Form Pendaftaran Online</h2>

        <?php if ($success): ?>
        <div class="bg-green-50 border border-green-200 rounded-2xl p-6 flex items-start gap-4 mb-6" data-alert>
            <div class="text-3xl">✅</div>
            <div>
                <div class="font-semibold text-green-800 mb-1">Pendaftaran Berhasil Dikirim!</div>
                <div class="text-green-700 text-sm">Data pendaftaran Anda telah kami terima. Tim PPDB akan menghubungi Anda dalam 2 hari kerja untuk konfirmasi selanjutnya. Harap pantau email dan WhatsApp Anda.</div>
            </div>
        </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl border border-stone-200 p-8">
            <form method="POST" action="#form-daftar" novalidate>
                <div class="grid md:grid-cols-2 gap-5">

                    <!-- Nama Lengkap -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-stone-700 mb-1.5">Nama Lengkap Calon Siswa <span class="text-orange-500">*</span></label>
                        <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($_POST['nama_lengkap'] ?? '') ?>"
                               class="form-input <?= isset($errors['nama_lengkap']) ? 'border-red-400' : '' ?>"
                               placeholder="Masukkan nama lengkap sesuai akta kelahiran">
                        <?php if (isset($errors['nama_lengkap'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['nama_lengkap'] ?></p><?php endif; ?>
                    </div>

                    <!-- Asal Sekolah -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-1.5">Asal Sekolah (SMP/MTs) <span class="text-orange-500">*</span></label>
                        <input type="text" name="asal_sekolah" value="<?= htmlspecialchars($_POST['asal_sekolah'] ?? '') ?>"
                               class="form-input <?= isset($errors['asal_sekolah']) ? 'border-red-400' : '' ?>"
                               placeholder="Nama SMP/MTs asal">
                        <?php if (isset($errors['asal_sekolah'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['asal_sekolah'] ?></p><?php endif; ?>
                    </div>

                    <!-- Tahun Lulus -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-1.5">Tahun Lulus <span class="text-orange-500">*</span></label>
                        <select name="tahun_lulus" class="form-input <?= isset($errors['tahun_lulus']) ? 'border-red-400' : '' ?>">
                            <option value="">-- Pilih Tahun --</option>
                            <?php for($y=2025; $y>=2020; $y--): ?>
                            <option value="<?= $y ?>" <?= ($_POST['tahun_lulus'] ?? '') == $y ? 'selected' : '' ?>><?= $y ?></option>
                            <?php endfor; ?>
                        </select>
                        <?php if (isset($errors['tahun_lulus'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['tahun_lulus'] ?></p><?php endif; ?>
                    </div>

                    <!-- Pilihan Jurusan -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-stone-700 mb-1.5">Pilihan Program Keahlian <span class="text-orange-500">*</span></label>
                        <select name="pilihan_jurusan" class="form-input <?= isset($errors['pilihan_jurusan']) ? 'border-red-400' : '' ?>">
                            <option value="">-- Pilih Program Keahlian --</option>
                            <?php
                            $pilihan = ['TKJ - Teknik Komputer & Jaringan','RPL - Rekayasa Perangkat Lunak','AKL - Akuntansi & Keuangan Lembaga','MM - Multimedia','OTKP - Otomatisasi Tata Kelola Perkantoran','BDP - Bisnis Daring & Pemasaran','TB - Tata Busana','TBSM - Teknik & Bisnis Sepeda Motor'];
                            foreach ($pilihan as $p): ?>
                            <option value="<?= $p ?>" <?= ($_POST['pilihan_jurusan'] ?? '') === $p ? 'selected' : '' ?>><?= $p ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['pilihan_jurusan'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['pilihan_jurusan'] ?></p><?php endif; ?>
                    </div>

                    <!-- Nama Orang Tua -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-1.5">Nama Orang Tua/Wali <span class="text-orange-500">*</span></label>
                        <input type="text" name="nama_orang_tua" value="<?= htmlspecialchars($_POST['nama_orang_tua'] ?? '') ?>"
                               class="form-input <?= isset($errors['nama_orang_tua']) ? 'border-red-400' : '' ?>"
                               placeholder="Nama lengkap orang tua/wali">
                        <?php if (isset($errors['nama_orang_tua'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['nama_orang_tua'] ?></p><?php endif; ?>
                    </div>

                    <!-- No HP -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-1.5">No. WhatsApp Aktif <span class="text-orange-500">*</span></label>
                        <input type="tel" name="no_hp" value="<?= htmlspecialchars($_POST['no_hp'] ?? '') ?>"
                               class="form-input <?= isset($errors['no_hp']) ? 'border-red-400' : '' ?>"
                               placeholder="Contoh: 08123456789">
                        <?php if (isset($errors['no_hp'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['no_hp'] ?></p><?php endif; ?>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-1.5">Email <span class="text-orange-500">*</span></label>
                        <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                               class="form-input <?= isset($errors['email']) ? 'border-red-400' : '' ?>"
                               placeholder="email@contoh.com">
                        <?php if (isset($errors['email'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['email'] ?></p><?php endif; ?>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-sm font-semibold text-stone-700 mb-1.5">Alamat Lengkap <span class="text-orange-500">*</span></label>
                        <input type="text" name="alamat" value="<?= htmlspecialchars($_POST['alamat'] ?? '') ?>"
                               class="form-input <?= isset($errors['alamat']) ? 'border-red-400' : '' ?>"
                               placeholder="Jl. ... No. ..., Desa/Kel, Kecamatan, Kab/Kota">
                        <?php if (isset($errors['alamat'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['alamat'] ?></p><?php endif; ?>
                    </div>

                </div>

                <div class="mt-6 pt-5 border-t border-stone-100 flex flex-col sm:flex-row gap-3 items-start">
                    <button type="submit"
                            class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-8 py-3 rounded-xl transition-colors shadow-md shadow-orange-100 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Kirim Pendaftaran
                    </button>
                    <p class="text-stone-400 text-xs self-center">
                        Dengan mendaftar, Anda menyetujui <a href="#" class="text-orange-500 hover:underline">syarat dan ketentuan</a> PPDB SMKN 1 Adiwerna.
                    </p>
                </div>
            </form>
        </div>
    </section>

    <!-- FAQ -->
    <section class="reveal">
        <h2 class="font-heading text-2xl font-bold text-stone-900 section-title mb-6">Pertanyaan Umum (FAQ)</h2>
        <div class="space-y-3">
            <?php
            $faqs = [
                ['q'=>'Apakah pendaftaran PPDB dikenakan biaya?','a'=>'Tidak, pendaftaran PPDB SMKN 1 Adiwerna sepenuhnya GRATIS. Tidak ada biaya yang dipungut dalam proses seleksi.'],
                ['q'=>'Apakah bisa mendaftar lebih dari satu program keahlian?','a'=>'Untuk tahun 2025, setiap calon siswa hanya dapat mendaftar pada satu program keahlian. Pilih dengan cermat sesuai minat dan bakat Anda.'],
                ['q'=>'Bagaimana sistem penilaian seleksi?','a'=>'Seleksi dilakukan berdasarkan nilai rapor SMP/MTs semester 1-5, prestasi akademik dan non-akademik, serta tes kemampuan dasar (untuk jalur tertentu).'],
                ['q'=>'Apakah ada seragam khusus atau biaya peralatan praktik?','a'=>'Informasi mengenai seragam dan peralatan praktik akan disampaikan pada saat daftar ulang. Sekolah berupaya menyediakan peralatan praktik secara komunal.'],
                ['q'=>'Bagaimana jika tidak lolos seleksi?','a'=>'Calon siswa yang tidak lolos dapat mengikuti jalur penerimaan berikutnya atau menghubungi panitia PPDB untuk konsultasi lebih lanjut.'],
            ];
            foreach ($faqs as $idx => $faq): ?>
            <details class="bg-white rounded-2xl border border-stone-200 overflow-hidden group">
                <summary class="flex items-center justify-between px-6 py-4 cursor-pointer select-none text-sm font-semibold text-stone-900 hover:text-orange-600 transition-colors list-none">
                    <?= $faq['q'] ?>
                    <svg class="w-5 h-5 text-stone-400 flex-shrink-0 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </summary>
                <div class="px-6 pb-4 text-sm text-stone-600 leading-relaxed border-t border-stone-100 pt-3"><?= $faq['a'] ?></div>
            </details>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<?php include '../includes/footer.php'; ?>
