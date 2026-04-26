<?php
$current = basename($_SERVER['PHP_SELF'], '.php');
$nav_items = [
    ['id' => 'index',  'label' => 'Beranda',  'url' => BASE_URL . '/'],
    ['id' => 'profil', 'label' => 'Profil',   'url' => BASE_URL . '/pages/profil.php'],
    ['id' => 'jurusan','label' => 'Jurusan',  'url' => BASE_URL . '/pages/jurusan.php'],
    ['id' => 'berita', 'label' => 'Berita',   'url' => BASE_URL . '/pages/berita.php'],
    ['id' => 'ppdb',   'label' => 'PPDB 2025','url' => BASE_URL . '/pages/ppdb.php'],
    ['id' => 'kontak', 'label' => 'Kontak',   'url' => BASE_URL . '/pages/kontak.php'],
];
$active_nav = $active_nav ?? $current;
?>
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 bg-stone-900">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
            <a href="<?= BASE_URL ?>/" class="flex items-center gap-3 flex-shrink-0">
                <div class="w-9 h-9 bg-orange-500 rounded-lg flex items-center justify-center shadow-md shadow-orange-900/30">
                    <span class="font-heading font-black text-white text-xs tracking-tight">S1A</span>
                </div>
                <div class="hidden sm:block">
                    <div class="text-white font-bold text-sm leading-tight"><?= htmlspecialchars($_SITE['sekolah']['nama'] ?? 'SMKN 1 Adiwerna') ?></div>
                    <div class="text-stone-400 text-[11px]"><?= htmlspecialchars(($_SITE['kontak']['kabupaten'] ?? 'Kab. Tegal') . ', ' . ($_SITE['kontak']['provinsi'] ?? 'Jawa Tengah')) ?></div>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden md:flex items-center gap-1">
                <?php foreach ($nav_items as $item): ?>
                    <a href="<?= $item['url'] ?>"
                       class="px-3 py-2 rounded-lg text-sm transition-colors duration-150 <?= $active_nav === $item['id'] ? 'text-orange-400 font-semibold bg-orange-500/10' : 'text-stone-300 hover:text-white hover:bg-stone-700' ?>">
                        <?= $item['label'] ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- CTA + Mobile Button -->
            <div class="flex items-center gap-2">
                <a href="<?= BASE_URL ?>/pages/ppdb.php"
                   class="hidden md:inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors shadow-sm shadow-orange-900/20">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15.232 5.232l3.536 3.536M9 13l6.5-6.5m0 0a2.121 2.121 0 013 3L12 16H9v-3z"/></svg>
                    Daftar PPDB
                </a>
                <button id="mobile-menu-btn" class="md:hidden text-stone-300 hover:text-white p-2 rounded-lg hover:bg-stone-700 transition-colors" aria-label="Menu">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden bg-stone-900 border-t border-stone-700/50">
        <div class="max-w-7xl mx-auto px-4 py-3 space-y-1">
            <?php foreach ($nav_items as $item): ?>
                <a href="<?= $item['url'] ?>"
                   class="flex items-center px-3 py-2.5 rounded-lg text-sm transition-colors <?= $active_nav === $item['id'] ? 'bg-orange-500/15 text-orange-400 font-semibold' : 'text-stone-300 hover:bg-stone-700 hover:text-white' ?>">
                    <?= $item['label'] ?>
                </a>
            <?php endforeach; ?>
            <div class="pt-2 border-t border-stone-700/50">
                <a href="<?= BASE_URL ?>/pages/ppdb.php" class="flex items-center justify-center gap-2 w-full bg-orange-500 hover:bg-orange-600 text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition-colors">
                    Daftar PPDB 2025
                </a>
            </div>
        </div>
    </div>
</nav>
