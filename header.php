<?php
$themeDir = __DIR__;
if (is_file($themeDir . '/functions.php')) {
    require_once $themeDir . '/functions.php';
}
$seo = $seo ?? [];
$site = $site ?? [];
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$canonical = $seo['canonical'] ?? ((isset($_SERVER['HTTP_HOST']) ? ('https://' . $_SERVER['HTTP_HOST']) : '') . $currentPath);
$pageTitle = $seo['title'] ?? ($site['name'] ?? '');
$pageDesc = $seo['description'] ?? ($site['tagline'] ?? '');
$logo = $site['logo'] ?? '';
$orgName = $site['name'] ?? 'Food B2B Supplier';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= h($pageTitle) ?></title>
    <meta name="description" content="<?= h($pageDesc) ?>">
    <?php if (!empty($seo['keywords'])): ?>
        <meta name="keywords" content="<?= h($seo['keywords']) ?>">
    <?php endif; ?>
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="<?= h($canonical) ?>">
    <meta property="og:title" content="<?= h($pageTitle) ?>">
    <meta property="og:description" content="<?= h($pageDesc) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= h($canonical) ?>">
    <?php if (!empty($site['og_image'])): ?>
        <meta property="og:image" content="<?= h($site['og_image']) ?>">
    <?php endif; ?>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= h($pageTitle) ?>">
    <meta name="twitter:description" content="<?= h($pageDesc) ?>">
    <?php if (!empty($site['favicon'])): ?>
        <link rel="icon" type="image/x-icon" href="<?= h($site['favicon']) ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/style.css">
    <?= render_google_translate_head($site) ?>
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": <?= json_encode($orgName, JSON_UNESCAPED_UNICODE) ?>,
          "url": <?= json_encode(base_url(), JSON_UNESCAPED_UNICODE) ?>,
          "logo": <?= json_encode($logo ? asset_url($logo) : '', JSON_UNESCAPED_UNICODE) ?>
        }
    </script>
</head>
<body>
<?= render_google_translate_alert($site) ?>
<div class="food-topbar">
    <div class="food-container food-topbar-inner">
        <?php if (!empty($site['company_email'])): ?>
            <a href="mailto:<?= h($site['company_email']) ?>"><i class="fa-regular fa-envelope"></i> <?= h($site['company_email']) ?></a>
        <?php endif; ?>
        <?php if (!empty($site['company_phone'])): ?>
            <a href="tel:<?= h(preg_replace('/\s+/', '', $site['company_phone'])) ?>"><i class="fa-solid fa-phone"></i> <?= h($site['company_phone']) ?></a>
        <?php endif; ?>
    </div>
</div>
<header class="food-header" id="food-header">
    <div class="food-container food-nav-wrap">
        <a href="<?= url('/') ?>" class="food-brand" aria-label="<?= h($orgName) ?>">
            <?php if (!empty($logo)): ?>
                <img src="<?= asset_url(h($logo)) ?>" alt="<?= h($orgName) ?>" loading="eager">
            <?php else: ?>
                <span class="food-brand-badge"><i class="fa-solid fa-leaf"></i></span>
            <?php endif; ?>
            <span class="food-brand-name"><?= h($orgName) ?></span>
        </a>

        <button class="food-menu-btn" id="food-menu-btn" type="button" aria-label="toggle menu" aria-expanded="false" aria-controls="food-nav-menu">
            <span></span><span></span><span></span>
        </button>

        <nav class="food-nav" id="food-nav-menu">
            <a href="<?= url('/') ?>" class="<?= $currentPath === '/' ? 'is-active' : '' ?>">Home</a>
            <a href="<?= url('/products') ?>" class="<?= strpos($currentPath, '/products') === 0 ? 'is-active' : '' ?>">Products</a>
            <a href="<?= url('/cases') ?>" class="<?= strpos($currentPath, '/cases') === 0 ? 'is-active' : '' ?>">Cases</a>
            <a href="<?= url('/blog') ?>" class="<?= strpos($currentPath, '/blog') === 0 ? 'is-active' : '' ?>">Blog</a>
            <a href="<?= url('/about') ?>" class="<?= $currentPath === '/about' ? 'is-active' : '' ?>">About Us</a>
            <a href="<?= url('/contact') ?>" class="<?= $currentPath === '/contact' ? 'is-active' : '' ?>">Contact</a>
            <?= render_google_translate_nav_item($site, 'food-cta', 'food-translate-item') ?>
            <a href="<?= url('/contact') ?>" class="food-cta">Request Quote</a>
        </nav>
    </div>
</header>
<main class="food-main">
