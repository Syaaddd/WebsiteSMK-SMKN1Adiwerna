<?php
session_start();
require_once dirname(__DIR__) . '/config/database.php';
require_once dirname(__DIR__) . '/config/settings.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: ' . BASE_URL . '/admin/login.php');
    exit;
}

$active_menu = $_GET['menu'] ?? 'dashboard';

$section_map = [
    'dashboard'  => 'sections/dashboard.php',
    'berita'     => 'sections/berita.php',
    'ppdb'       => 'sections/ppdb-data.php',
    'pengaturan' => 'sections/pengaturan.php',
];

$menu_titles = [
    'dashboard'  => 'Dashboard',
    'berita'     => 'Berita & Pengumuman',
    'agenda'     => 'Agenda Sekolah',
    'ppdb'       => 'Data Pendaftar PPDB',
    'galeri'     => 'Galeri',
    'guru'       => 'Data Guru',
    'pengaturan' => 'Pengaturan Website',
];

$cfg = getSettings();
$ppdb_active = $cfg['ppdb']['aktif'] ?? false;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($menu_titles[$active_menu] ?? 'Admin') ?> — Admin SMKN 1 Adiwerna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Sora:wght@700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-heading { font-family: 'Sora', sans-serif; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: #f97316; border-radius: 2px; }
        .badge { display:inline-block; padding:.15rem .55rem; border-radius:9999px; font-size:.7rem; font-weight:600; }
        .badge-orange { background:#fed7aa; color:#c2410c; }
        .badge-green  { background:#d1fae5; color:#065f46; }
        .badge-blue   { background:#bfdbfe; color:#1d4ed8; }
        .badge-gray   { background:#e5e5e5; color:#525252; }
        details summary::-webkit-details-marker { display:none; }
    </style>
</head>
<body class="bg-stone-100 flex min-h-screen">

<!-- ── Sidebar ────────────────────────────────────────────────────── -->
<aside id="sidebar" class="w-60 bg-stone-900 min-h-screen flex flex-col fixed left-0 top-0 bottom-0 z-30 transition-transform duration-300">

    <!-- Brand -->
    <div class="p-5 border-b border-stone-700/50 flex items-center justify-between">
        <a href="?menu=dashboard" class="flex items-center gap-3">
            <div class="w-9 h-9 bg-orange-500 rounded-xl flex items-center justify-center shadow-md shadow-orange-900/30">
                <span class="font-heading font-black text-white text-xs">S1A</span>
            </div>
            <div>
                <div class="text-white font-bold text-sm leading-tight">Admin Panel</div>
                <div class="text-stone-400 text-[11px]">SMKN 1 Adiwerna</div>
            </div>
        </a>
    </div>

    <!-- Nav -->
    <nav class="flex-1 px-3 py-4 overflow-y-auto space-y-0.5">
        <?php
        $menus = [
            ['id'=>'dashboard','icon'=>'🏠','label'=>'Dashboard'],
            ['id'=>'berita','icon'=>'📰','label'=>'Berita & Pengumuman'],
            ['id'=>'agenda','icon'=>'📅','label'=>'Agenda Sekolah'],
            ['id'=>'ppdb','icon'=>'🎓','label'=>'Data PPDB'],
            ['id'=>'galeri','icon'=>'🖼️','label'=>'Galeri'],
            ['id'=>'guru','icon'=>'👥','label'=>'Data Guru'],
            ['separator'=>true],
            ['id'=>'pengaturan','icon'=>'⚙️','label'=>'Pengaturan'],
        ];
        foreach ($menus as $m):
            if (isset($m['separator'])): ?>
            <div class="border-t border-stone-700/40 my-2"></div>
            <?php continue; endif; ?>
            <a href="?menu=<?= $m['id'] ?>"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-colors <?= $active_menu === $m['id'] ? 'bg-orange-500/20 text-orange-400 font-semibold' : 'text-stone-400 hover:bg-stone-800 hover:text-white' ?>">
                <span class="text-base"><?= $m['icon'] ?></span>
                <span><?= $m['label'] ?></span>
                <?php if ($m['id'] === 'ppdb'): ?>
                    <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded-full <?= $ppdb_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' ?>">
                        <?= $ppdb_active ? 'ON' : 'OFF' ?>
                    </span>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <!-- Footer -->
    <div class="p-4 border-t border-stone-700/50 space-y-1">
        <div class="flex items-center gap-2.5 px-3 py-2 mb-1">
            <div class="w-7 h-7 bg-orange-500 rounded-lg flex items-center justify-center text-white font-bold text-xs flex-shrink-0">
                <?= strtoupper(substr($_SESSION['admin_user'] ?? 'A', 0, 1)) ?>
            </div>
            <div class="min-w-0">
                <div class="text-white text-xs font-semibold truncate"><?= htmlspecialchars($_SESSION['admin_user'] ?? 'Admin') ?></div>
                <div class="text-stone-500 text-[10px]">Administrator</div>
            </div>
        </div>
        <a href="<?= BASE_URL ?>/" target="_blank" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-stone-400 hover:bg-stone-800 hover:text-white text-xs transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            Lihat Website
        </a>
        <a href="logout.php" class="flex items-center gap-2.5 px-3 py-2 rounded-xl text-red-400 hover:bg-red-900/20 text-xs transition-colors">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
            Logout
        </a>
    </div>
</aside>

<!-- ── Main ───────────────────────────────────────────────────────── -->
<div class="ml-60 flex-1 flex flex-col min-h-screen">

    <!-- Top Bar -->
    <header class="bg-white border-b border-stone-200 px-6 py-3.5 flex items-center justify-between sticky top-0 z-20">
        <div class="flex items-center gap-3">
            <!-- Mobile toggle -->
            <button id="sidebar-toggle" class="lg:hidden text-stone-500 hover:text-stone-700 p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            <!-- Breadcrumb -->
            <div class="flex items-center gap-1.5 text-sm">
                <a href="?menu=dashboard" class="text-stone-400 hover:text-stone-700 transition-colors">Admin</a>
                <span class="text-stone-300">›</span>
                <span class="text-stone-700 font-semibold"><?= htmlspecialchars($menu_titles[$active_menu] ?? ucfirst($active_menu)) ?></span>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <!-- PPDB Status Pill -->
            <a href="?menu=pengaturan&tab=ppdb" class="hidden sm:flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full <?= $ppdb_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                <span class="w-1.5 h-1.5 rounded-full <?= $ppdb_active ? 'bg-green-500 animate-pulse' : 'bg-red-500' ?>"></span>
                PPDB <?= $ppdb_active ? 'Aktif' : 'Nonaktif' ?>
            </a>
            <!-- Date -->
            <span class="hidden md:block text-stone-400 text-xs"><?= date('l, d F Y') ?></span>
            <!-- Avatar -->
            <div class="w-8 h-8 bg-orange-500 rounded-xl flex items-center justify-center text-white font-bold text-sm">
                <?= strtoupper(substr($_SESSION['admin_user'] ?? 'A', 0, 1)) ?>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="flex-1 p-6">
        <?php
        $section_file = isset($section_map[$active_menu])
            ? __DIR__ . '/' . $section_map[$active_menu]
            : null;

        if ($section_file && file_exists($section_file)) {
            include $section_file;
        } else {
            // Placeholder for sections not yet built
        ?>
        <div class="bg-white rounded-2xl border border-stone-200 p-14 text-center max-w-lg mx-auto">
            <div class="text-6xl mb-4">🚧</div>
            <h2 class="font-heading font-bold text-stone-900 text-xl mb-2">Sedang Dikembangkan</h2>
            <p class="text-stone-500 text-sm mb-6">Halaman <strong><?= htmlspecialchars($menu_titles[$active_menu] ?? $active_menu) ?></strong> sedang dalam pengembangan dan akan segera tersedia.</p>
            <a href="?menu=dashboard" class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2.5 rounded-xl transition-colors text-sm">
                ← Kembali ke Dashboard
            </a>
        </div>
        <?php } ?>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-stone-100 px-6 py-3 flex items-center justify-between text-xs text-stone-400">
        <span>© <?= date('Y') ?> SMKN 1 Adiwerna Admin Panel</span>
        <span>v1.0.0</span>
    </footer>
</div>

<script>
// Mobile sidebar toggle
document.getElementById('sidebar-toggle')?.addEventListener('click', () => {
    document.getElementById('sidebar').classList.toggle('-translate-x-full');
});

// Auto-dismiss alerts after 5 seconds
setTimeout(() => {
    document.querySelectorAll('[data-alert]').forEach(el => {
        el.style.transition = 'opacity 0.5s';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 500);
    });
}, 5000);
</script>
</body>
</html>
