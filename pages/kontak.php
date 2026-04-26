<?php
$page_title = 'Kontak Kami';
$active_nav = 'kontak';
require_once '../config/database.php';
include '../includes/header.php';
include '../includes/navbar.php';

$success = false;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fields = ['nama','email','subjek','pesan'];
    $data = [];
    foreach ($fields as $f) {
        $val = trim($_POST[$f] ?? '');
        if (empty($val)) $errors[$f] = 'Field ini wajib diisi.';
        else $data[$f] = htmlspecialchars($val);
    }
    if (empty($errors)) $success = true;
}
?>

<div class="pt-16">

<!-- Hero -->
<section class="bg-stone-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_70%_50%,rgba(249,115,22,0.1)_0%,transparent_65%)]"></div>
    <div class="max-w-7xl mx-auto px-4 lg:px-8 py-14 relative z-10">
        <div class="flex items-center gap-2 text-stone-400 text-sm mb-3">
            <a href="<?= BASE_URL ?>/" class="hover:text-white transition-colors">Beranda</a>
            <span>›</span>
            <span class="text-orange-400">Kontak Kami</span>
        </div>
        <h1 class="font-heading text-4xl lg:text-5xl font-black text-white mb-3">Hubungi <span class="text-orange-500">Kami</span></h1>
        <p class="text-stone-300 max-w-xl">Kami siap membantu Anda. Hubungi tim SMKN 1 Adiwerna untuk informasi PPDB, akademik, atau pertanyaan lainnya.</p>
    </div>
    <div class="h-px bg-gradient-to-r from-orange-500 via-orange-400/30 to-transparent"></div>
</section>

<main class="max-w-7xl mx-auto px-4 lg:px-8 py-12">

    <!-- Contact Info Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-12 reveal">
        <?php
        $contacts = [
            ['icon'=>'📍','label'=>'Alamat','val'=>'Jl. Dewi Sartika No.1, Adiwerna, Kab. Tegal 52194','link'=>null],
            ['icon'=>'📞','label'=>'Telepon','val'=>'(0283) 444555','link'=>'tel:+62283444555'],
            ['icon'=>'✉️','label'=>'Email','val'=>'info@smkn1adiwerna.sch.id','link'=>'mailto:info@smkn1adiwerna.sch.id'],
            ['icon'=>'⏰','label'=>'Jam Layanan','val'=>'Senin–Jumat: 07.00 – 15.30 WIB','link'=>null],
        ];
        foreach ($contacts as $c): ?>
        <div class="bg-white rounded-2xl border border-stone-200 p-5 card-hover">
            <div class="text-3xl mb-3"><?= $c['icon'] ?></div>
            <div class="text-stone-500 text-xs mb-1"><?= $c['label'] ?></div>
            <?php if ($c['link']): ?>
            <a href="<?= $c['link'] ?>" class="text-stone-900 font-semibold text-sm hover:text-orange-600 transition-colors"><?= $c['val'] ?></a>
            <?php else: ?>
            <div class="text-stone-900 font-semibold text-sm"><?= $c['val'] ?></div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="grid lg:grid-cols-2 gap-8 reveal">

        <!-- Map -->
        <div>
            <h2 class="font-heading text-2xl font-bold text-stone-900 section-title mb-5">Lokasi Sekolah</h2>
            <div class="bg-white rounded-2xl border border-stone-200 overflow-hidden">
                <div class="aspect-video bg-stone-100 flex flex-col items-center justify-center gap-3 relative">
                    <!-- Placeholder peta -->
                    <div class="absolute inset-0 bg-gradient-to-br from-stone-100 to-stone-200 flex flex-col items-center justify-center">
                        <div class="text-5xl mb-3">🗺️</div>
                        <div class="font-heading font-bold text-stone-700 text-lg">SMKN 1 Adiwerna</div>
                        <div class="text-stone-500 text-sm">Jl. Dewi Sartika No.1, Adiwerna</div>
                        <div class="text-stone-400 text-sm">Kabupaten Tegal, Jawa Tengah</div>
                        <a href="https://maps.google.com/?q=SMKN+1+Adiwerna+Tegal" target="_blank"
                           class="mt-4 bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-5 py-2 rounded-lg transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Buka di Google Maps
                        </a>
                    </div>
                </div>
                <div class="p-5 border-t border-stone-100">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-orange-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <div>
                            <div class="font-semibold text-stone-900 text-sm">SMK Negeri 1 Adiwerna</div>
                            <div class="text-stone-500 text-xs mt-0.5">Jl. Dewi Sartika No.1, Kec. Adiwerna, Kab. Tegal, Jawa Tengah 52194</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kontak Cepat via WhatsApp -->
            <div class="mt-5 bg-green-50 border border-green-200 rounded-2xl p-5 flex items-center gap-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">💬</div>
                <div class="flex-1">
                    <div class="font-semibold text-green-900 text-sm">Chat via WhatsApp</div>
                    <div class="text-green-700 text-xs mt-0.5">Respon lebih cepat melalui WA. Tersedia Senin–Jumat jam kerja.</div>
                </div>
                <a href="https://wa.me/6228344555" target="_blank"
                   class="bg-green-500 hover:bg-green-600 text-white text-sm font-semibold px-4 py-2 rounded-xl transition-colors flex-shrink-0">
                    Chat WA
                </a>
            </div>
        </div>

        <!-- Contact Form -->
        <div>
            <h2 class="font-heading text-2xl font-bold text-stone-900 section-title mb-5">Kirim Pesan</h2>
            <?php if ($success): ?>
            <div class="bg-green-50 border border-green-200 rounded-2xl p-5 mb-5 flex items-start gap-3" data-alert>
                <span class="text-2xl">✅</span>
                <div>
                    <div class="font-semibold text-green-800 text-sm">Pesan Berhasil Dikirim!</div>
                    <div class="text-green-700 text-xs mt-0.5">Tim kami akan merespons dalam 1-2 hari kerja melalui email atau telepon yang Anda cantumkan.</div>
                </div>
            </div>
            <?php endif; ?>
            <div class="bg-white rounded-2xl border border-stone-200 p-6">
                <form method="POST" novalidate>
                    <div class="space-y-4">
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-stone-700 mb-1.5">Nama Lengkap <span class="text-orange-500">*</span></label>
                                <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>"
                                       class="form-input <?= isset($errors['nama']) ? 'border-red-400' : '' ?>"
                                       placeholder="Nama Anda">
                                <?php if (isset($errors['nama'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['nama'] ?></p><?php endif; ?>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-stone-700 mb-1.5">Email <span class="text-orange-500">*</span></label>
                                <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                                       class="form-input <?= isset($errors['email']) ? 'border-red-400' : '' ?>"
                                       placeholder="email@Anda.com">
                                <?php if (isset($errors['email'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['email'] ?></p><?php endif; ?>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-stone-700 mb-1.5">Subjek <span class="text-orange-500">*</span></label>
                            <select name="subjek" class="form-input <?= isset($errors['subjek']) ? 'border-red-400' : '' ?>">
                                <option value="">-- Pilih Subjek --</option>
                                <?php
                                $subjek_opt = ['Informasi PPDB','Informasi Program Keahlian','Kerjasama Industri','Kunjungan Industri','Kegiatan Sekolah','Lainnya'];
                                foreach ($subjek_opt as $s): ?>
                                <option value="<?= $s ?>" <?= ($_POST['subjek'] ?? '') === $s ? 'selected' : '' ?>><?= $s ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($errors['subjek'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['subjek'] ?></p><?php endif; ?>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-stone-700 mb-1.5">Pesan <span class="text-orange-500">*</span></label>
                            <textarea name="pesan" rows="5"
                                      class="form-input resize-none <?= isset($errors['pesan']) ? 'border-red-400' : '' ?>"
                                      placeholder="Tuliskan pertanyaan atau pesan Anda di sini..."><?= htmlspecialchars($_POST['pesan'] ?? '') ?></textarea>
                            <?php if (isset($errors['pesan'])): ?><p class="text-red-500 text-xs mt-1"><?= $errors['pesan'] ?></p><?php endif; ?>
                        </div>
                        <button type="submit"
                                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-xl transition-colors flex items-center justify-center gap-2 shadow-md shadow-orange-100">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Kirim Pesan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Struktur kontak penting -->
    <section class="reveal mt-12">
        <h2 class="font-heading text-2xl font-bold text-stone-900 section-title mb-6">Kontak Penting</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php
            $penting = [
                ['nama'=>'Panitia PPDB','telp'=>'0812-3456-7890','whatsapp'=>true,'jabatan'=>'Penerimaan Siswa Baru'],
                ['nama'=>'TU / Tata Usaha','telp'=>'(0283) 444555','whatsapp'=>false,'jabatan'=>'Administrasi Umum'],
                ['nama'=>'Waka Humas','telp'=>'0813-2345-6789','whatsapp'=>true,'jabatan'=>'Kerjasama & Publikasi'],
                ['nama'=>'Waka Kesiswaan','telp'=>'0814-3456-7891','whatsapp'=>true,'jabatan'=>'Kegiatan & Organisasi Siswa'],
                ['nama'=>'BK (Bimbingan Konseling)','telp'=>'0815-4567-8902','whatsapp'=>true,'jabatan'=>'Konseling & Karir'],
                ['nama'=>'Perpustakaan','telp'=>'(0283) 444556','whatsapp'=>false,'jabatan'=>'Layanan Perpustakaan'],
            ];
            foreach ($penting as $p): ?>
            <div class="bg-white rounded-2xl border border-stone-200 p-5 flex items-start gap-3 card-hover">
                <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center text-xl flex-shrink-0">📋</div>
                <div>
                    <div class="font-semibold text-stone-900 text-sm"><?= $p['nama'] ?></div>
                    <div class="text-stone-500 text-xs mb-2"><?= $p['jabatan'] ?></div>
                    <div class="flex items-center gap-2">
                        <a href="tel:<?= preg_replace('/[^+0-9]/','',$p['telp']) ?>" class="text-orange-600 text-xs font-medium hover:underline"><?= $p['telp'] ?></a>
                        <?php if ($p['whatsapp']): ?>
                        <a href="https://wa.me/62<?= ltrim(preg_replace('/[^0-9]/','', $p['telp']), '0') ?>" target="_blank"
                           class="text-green-600 text-xs hover:text-green-700">WA</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

</main>

<?php include '../includes/footer.php'; ?>
