<?php
// $_SITE is set by header.php; if footer included standalone, load it
if (!isset($_SITE)) {
    if (!function_exists('getSettings')) require_once ROOT_DIR . '/config/settings.php';
    $_SITE = getSettings();
}
$_kontak = $_SITE['kontak'] ?? [];
$_sosmed = $_SITE['sosmed'] ?? [];
$_nama   = htmlspecialchars($_SITE['sekolah']['nama'] ?? 'SMKN 1 Adiwerna');
$_kab    = htmlspecialchars(($_kontak['kabupaten'] ?? '') . ', ' . ($_kontak['provinsi'] ?? ''));
$_alamat = htmlspecialchars($_kontak['alamat']      ?? '');
$_kodepos= htmlspecialchars($_kontak['kode_pos']    ?? '');
$_telp   = htmlspecialchars($_kontak['telepon']     ?? '');
$_email  = htmlspecialchars($_kontak['email']       ?? '');
$_jam    = htmlspecialchars($_kontak['jam_layanan'] ?? '');
$_deskripsi = htmlspecialchars($_SITE['sekolah']['deskripsi'] ?? '');
$_fb  = htmlspecialchars($_sosmed['facebook']  ?? '#');
$_ig  = htmlspecialchars($_sosmed['instagram'] ?? '#');
$_yt  = htmlspecialchars($_sosmed['youtube']   ?? '#');
$_tt  = htmlspecialchars($_sosmed['tiktok']    ?? '#');
?>
<footer class="bg-stone-900 text-stone-400">
    <div class="max-w-7xl mx-auto px-4 lg:px-8 pt-14 pb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-10">

            <!-- Brand -->
            <div class="lg:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center shadow-lg shadow-orange-900/30">
                        <span class="font-heading font-black text-white text-sm">S1A</span>
                    </div>
                    <div>
                        <div class="text-white font-bold text-base"><?= $_nama ?></div>
                        <div class="text-stone-500 text-xs"><?= $_kab ?></div>
                    </div>
                </div>
                <p class="text-stone-400 text-sm leading-relaxed mb-5 max-w-sm">
                    <?= $_deskripsi ?>
                </p>
                <div class="flex gap-2">
                    <a href="<?= $_fb ?>" class="w-9 h-9 bg-stone-700 hover:bg-orange-500 rounded-lg flex items-center justify-center transition-colors group" title="Facebook">
                        <svg class="w-4 h-4 text-stone-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    <a href="<?= $_ig ?>" class="w-9 h-9 bg-stone-700 hover:bg-orange-500 rounded-lg flex items-center justify-center transition-colors group" title="Instagram">
                        <svg class="w-4 h-4 text-stone-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                    </a>
                    <a href="<?= $_yt ?>" class="w-9 h-9 bg-stone-700 hover:bg-orange-500 rounded-lg flex items-center justify-center transition-colors group" title="YouTube">
                        <svg class="w-4 h-4 text-stone-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white"/></svg>
                    </a>
                    <a href="<?= $_tt ?>" class="w-9 h-9 bg-stone-700 hover:bg-orange-500 rounded-lg flex items-center justify-center transition-colors group" title="TikTok">
                        <svg class="w-4 h-4 text-stone-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.3 6.3 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.7a8.18 8.18 0 004.78 1.52V6.76a4.85 4.85 0 01-1.01-.07z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Navigasi -->
            <div>
                <h4 class="text-orange-500 font-bold text-xs uppercase tracking-widest mb-4">Navigasi</h4>
                <div class="space-y-2">
                    <a href="<?= BASE_URL ?>/" class="block text-sm text-stone-400 hover:text-white transition-colors">Beranda</a>
                    <a href="<?= BASE_URL ?>/pages/profil.php" class="block text-sm text-stone-400 hover:text-white transition-colors">Profil Sekolah</a>
                    <a href="<?= BASE_URL ?>/pages/jurusan.php" class="block text-sm text-stone-400 hover:text-white transition-colors">Program Keahlian</a>
                    <a href="<?= BASE_URL ?>/pages/berita.php" class="block text-sm text-stone-400 hover:text-white transition-colors">Berita & Pengumuman</a>
                    <a href="<?= BASE_URL ?>/pages/ppdb.php" class="block text-sm text-stone-400 hover:text-white transition-colors">PPDB Online 2025</a>
                    <a href="<?= BASE_URL ?>/pages/guru.php" class="block text-sm text-stone-400 hover:text-white transition-colors">Tenaga Pendidik</a>
                    <a href="<?= BASE_URL ?>/pages/kontak.php" class="block text-sm text-stone-400 hover:text-white transition-colors">Kontak Kami</a>
                </div>
            </div>

            <!-- Kontak -->
            <div>
                <h4 class="text-orange-500 font-bold text-xs uppercase tracking-widest mb-4">Kontak</h4>
                <div class="space-y-3">
                    <div class="flex items-start gap-2.5">
                        <svg class="w-4 h-4 text-orange-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-sm leading-relaxed"><?= $_alamat ?><?= $_kodepos ? ', ' . $_kodepos : '' ?></span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="tel:<?= htmlspecialchars(preg_replace('/[^0-9+]/', '', $_kontak['telepon'] ?? '')) ?>" class="text-sm hover:text-white transition-colors"><?= $_telp ?></a>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:<?= $_email ?>" class="text-sm hover:text-white transition-colors"><?= $_email ?></a>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <svg class="w-4 h-4 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-sm"><?= $_jam ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-stone-700/50 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
            <span class="text-stone-500 text-xs">© <?= date('Y') ?> <?= $_nama ?>. Hak cipta dilindungi.</span>
            <div class="flex items-center gap-4">
                <span class="text-stone-600 text-xs">Dikembangkan dengan ❤ untuk pendidikan</span>
                <a href="<?= BASE_URL ?>/admin/" class="text-stone-600 hover:text-stone-400 text-xs transition-colors">Admin</a>
            </div>
        </div>
    </div>
</footer>
<script src="<?= BASE_URL ?>/assets/js/main.js"></script>
</body>
</html>
