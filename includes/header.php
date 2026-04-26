<?php
if (!defined('BASE_URL')) {
    require_once dirname(__DIR__) . '/config/database.php';
}
if (!function_exists('getSettings')) {
    require_once ROOT_DIR . '/config/settings.php';
}
$_SITE = getSettings();
$_sekolah = $_SITE['sekolah'] ?? [];
$_seo     = $_SITE['seo']     ?? [];

$_site_name = htmlspecialchars($_sekolah['nama']    ?? 'SMKN 1 Adiwerna');
$_tagline   = htmlspecialchars($_sekolah['tagline'] ?? 'Membentuk Generasi Terampil & Berkarakter');
$_meta_desc = htmlspecialchars($_seo['meta_description'] ?? 'Website resmi SMK Negeri 1 Adiwerna, Kabupaten Tegal, Jawa Tengah.');
$_meta_kw   = htmlspecialchars($_seo['meta_keywords']    ?? 'SMKN 1 Adiwerna, SMK Tegal');
$_ga_id     = trim($_seo['google_analytics'] ?? '');

$page_title_full = isset($page_title) && $page_title
    ? htmlspecialchars($page_title) . ' — ' . $_site_name
    : $_site_name . ' — ' . $_tagline;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title_full ?></title>
    <meta name="description" content="<?= $_meta_desc ?>">
    <meta name="keywords" content="<?= $_meta_kw ?>">
    <meta property="og:title" content="<?= $page_title_full ?>">
    <meta property="og:description" content="<?= $_meta_desc ?>">
    <meta property="og:type" content="website">
    <?php if ($_ga_id): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars($_ga_id) ?>"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?= htmlspecialchars($_ga_id) ?>');</script>
    <?php endif; ?>
    <link rel="icon" type="image/svg+xml" href="<?= BASE_URL ?>/assets/images/favicon.svg">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui'],
                        heading: ['Sora', 'ui-sans-serif'],
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body class="bg-stone-100 font-sans text-stone-700 antialiased">
