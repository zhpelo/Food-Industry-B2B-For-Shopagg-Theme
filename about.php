<?php
$showItems = [];
if (!empty($site['company_show_json'])) {
    $showItems = is_array($site['company_show_json']) ? $site['company_show_json'] : json_decode($site['company_show_json'], true);
}
$certItems = [];
if (!empty($site['company_certificates_json'])) {
    $certItems = is_array($site['company_certificates_json']) ? $site['company_certificates_json'] : json_decode($site['company_certificates_json'], true);
}
?>
<section class="food-section-sm">
    <div class="food-container">
        <nav class="food-breadcrumb">
            <a href="<?= url('/') ?>">Home</a> / <span>About Us</span>
        </nav>
        <h1 class="food-title"><?= h($site['name'] ?? 'Company Profile') ?></h1>
        <p class="food-subtitle"><?= h($site['tagline'] ?? '') ?></p>
    </div>
</section>

<section class="food-section-sm" style="padding-top:1rem;">
    <div class="food-container food-grid-2">
        <article class="food-card">
            <div class="food-card-body">
                <h2 class="food-title" style="font-size:1.45rem;">Company Profile</h2>
                <p class="food-subtitle"><?= nl2br(h($site['company_bio'] ?? '')) ?></p>
                <ul style="margin-top:1rem;padding-left:1rem;">
                    <li>Business Type: <?= h($site['company_business_type'] ?? '-') ?></li>
                    <li>Main Products: <?= h($site['company_main_products'] ?? '-') ?></li>
                    <li>Year of Establishment: <?= h($site['company_year_established'] ?? '-') ?></li>
                    <li>Main Markets: <?= h($site['company_main_markets'] ?? '-') ?></li>
                </ul>
            </div>
        </article>
        <article class="food-card">
            <img src="<?= h($site['og_image'] ?? 'https://images.unsplash.com/photo-1593364491093-f290c6ddac80?auto=format&fit=crop&w=1200&q=80') ?>" alt="about us" loading="lazy">
            <div class="food-card-body">
                <h3>Why Choose Us</h3>
                <p>ISO Certified</p>
                <p>OEM & ODM</p>
                <p>R&D Team</p>
            </div>
        </article>
    </div>
</section>

<?php if (!empty($showItems)): ?>
<section class="food-section-sm">
    <div class="food-container">
        <h2 class="food-title" style="font-size:1.5rem;">Company Show</h2>
        <div class="food-grid-4">
            <?php foreach ($showItems as $item): ?>
                <?php if (!empty($item['img'])): ?>
                    <article class="food-card">
                        <img src="<?= asset_url(h($item['img'])) ?>" alt="<?= h($item['title'] ?? '') ?>" loading="lazy">
                        <div class="food-card-body"><h3><?= h($item['title'] ?? '') ?></h3></div>
                    </article>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($certItems)): ?>
<section class="food-section-sm">
    <div class="food-container">
        <h2 class="food-title" style="font-size:1.5rem;">Certificates</h2>
        <div class="food-grid-4">
            <?php foreach ($certItems as $item): ?>
                <?php if (!empty($item['img'])): ?>
                    <article class="food-card">
                        <img src="<?= asset_url(h($item['img'])) ?>" alt="<?= h($item['title'] ?? '') ?>" loading="lazy">
                        <div class="food-card-body"><h3><?= h($item['title'] ?? '') ?></h3></div>
                    </article>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
