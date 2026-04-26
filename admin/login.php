<?php
session_start();
if (!defined('BASE_URL')) require_once dirname(__DIR__) . '/config/database.php';
if (!function_exists('getSettings')) require_once ROOT_DIR . '/config/settings.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']) {
    header('Location: ' . BASE_URL . '/admin/index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $cfg_admin = getSettings()['admin'] ?? [];
    $valid_user = $cfg_admin['username'] ?? 'admin';
    $valid_pass = $cfg_admin['password'] ?? 'smkn1adiwerna2025';
    if ($username === $valid_user && $password === $valid_pass) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_user'] = $username;
        header('Location: ' . BASE_URL . '/admin/index.php');
        exit;
    } else {
        $error = 'Username atau password salah. Silakan coba lagi.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — SMKN 1 Adiwerna</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Sora:wght@700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-heading { font-family: 'Sora', sans-serif; }
        .form-input {
            width: 100%; padding: 0.625rem 0.875rem;
            border: 1.5px solid #d4d4d4; border-radius: 0.5rem;
            font-size: 0.875rem; color: #3f3f3f; background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s; outline: none;
        }
        .form-input:focus { border-color: #f97316; box-shadow: 0 0 0 3px rgba(249,115,22,0.1); }
    </style>
</head>
<body class="min-h-screen bg-stone-900 flex items-center justify-center p-4">
    <div class="w-full max-w-sm">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-xl shadow-orange-900/40">
                <span class="font-heading font-black text-white text-xl">S1A</span>
            </div>
            <h1 class="font-heading font-black text-white text-2xl">Admin Panel</h1>
            <p class="text-stone-400 text-sm mt-1">SMKN 1 Adiwerna</p>
        </div>

        <!-- Form -->
        <div class="bg-stone-800 rounded-2xl border border-stone-700 p-7">
            <?php if ($error): ?>
            <div class="bg-red-900/40 border border-red-700/50 rounded-xl px-4 py-3 mb-5 flex items-center gap-2">
                <svg class="w-4 h-4 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span class="text-red-400 text-sm"><?= htmlspecialchars($error) ?></span>
            </div>
            <?php endif; ?>
            <form method="POST">
                <div class="space-y-4">
                    <div>
                        <label class="block text-stone-300 text-sm font-semibold mb-1.5">Username</label>
                        <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                               class="form-input bg-stone-700 border-stone-600 text-white placeholder-stone-400 focus:border-orange-500"
                               placeholder="admin"
                               style="background:#374151;border-color:#4B5563;color:#fff;" required>
                    </div>
                    <div>
                        <label class="block text-stone-300 text-sm font-semibold mb-1.5">Password</label>
                        <input type="password" name="password"
                               class="form-input"
                               style="background:#374151;border-color:#4B5563;color:#fff;"
                               placeholder="••••••••" required>
                    </div>
                    <button type="submit"
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-xl transition-colors mt-2">
                        Masuk ke Dashboard
                    </button>
                </div>
            </form>
            <div class="mt-5 pt-4 border-t border-stone-700 text-center">
                <a href="<?= BASE_URL ?>/" class="text-stone-400 hover:text-white text-sm transition-colors flex items-center justify-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    Kembali ke Website
                </a>
            </div>
        </div>
        <p class="text-stone-600 text-xs text-center mt-4">© <?= date('Y') ?> SMKN 1 Adiwerna</p>
    </div>
</body>
</html>
