<?php
$products = $products ?? [];
$cases = $cases ?? [];
$carouselProducts = function_exists('food_get_carousel_products') ? food_get_carousel_products(4) : [];
$latestPosts = function_exists('food_get_latest_posts') ? food_get_latest_posts(3) : [];
$categories = [];
if (class_exists('\App\Models\Category')) {
    $categoryModel = new \App\Models\Category();
    $categories = $categoryModel->getTree('product');
}
$heroCover = $site['og_image'] ?? 'https://devtool.tech/api/placeholder/800/800';
?>

<section class="food-hero">
    <div class="food-container food-hero-inner">
        <div>
            <span class="food-badge"><i class="fa-solid fa-seedling"></i> Food Industry B2B</span>
            <h1 class="food-title"><?= h($site['name'] ?? 'Food Manufacturer') ?></h1>
            <p class="food-subtitle"><?= h($site['tagline'] ?? t('home_highlights')) ?></p>
            <div class="food-hero-actions">
                <a class="food-btn food-btn-primary" href="<?= url('/products') ?>"><?= h(t('section_featured_products')) ?></a>
                <a class="food-btn food-btn-soft" href="<?= url('/contact') ?>"><?= h(t('cta_quote')) ?></a>
            </div>
        </div>
        <div class="food-hero-media">
            <img src="<?= asset_url($heroCover) ?>" alt="<?= h($site['name'] ?? 'food supplier') ?>" loading="eager">
        </div>
    </div>
</section>

<section class="food-section-sm">
    <div class="food-container">
        <div class="food-feature-list">
            <article class="food-feature-item">
                <i class="fa-solid fa-shield-heart"></i>
                <h4><?= h(t('home_quality_title')) ?></h4>
                <p><?= h(t('home_quality_desc')) ?></p>
            </article>
            <article class="food-feature-item">
                <i class="fa-solid fa-truck-fast"></i>
                <h4><?= h(t('home_logistics_title')) ?></h4>
                <p><?= h(t('home_logistics_desc')) ?></p>
            </article>
            <article class="food-feature-item">
                <i class="fa-solid fa-tags"></i>
                <h4><?= h(t('home_support_title')) ?></h4>
                <p><?= h(t('home_support_desc')) ?></p>
            </article>
        </div>
    </div>
</section>

<?php if (!empty($carouselProducts)): ?>
<section class="food-section">
    <div class="food-container">
        <div class="food-center" style="margin-bottom:1rem;">
            <h2 class="food-title"><?= h(t('section_featured_products')) ?></h2>
            <p class="food-subtitle"><?= h(t('product_list_subtitle')) ?></p>
        </div>
        <div class="food-grid-4">
            <?php foreach ($carouselProducts as $p): ?>

   
                <article class="food-card">
                    <a href="<?= h($p['url']) ?>">
                        <img src="<?= asset_url($p['cover'] ?: '/assets/no-image.png') ?>" alt="<?= h($p['title']) ?>" loading="lazy">
                    </a>
                    <div class="food-card-body">
                        <h3><a href="<?= h($p['url']) ?>"><?= h($p['title']) ?></a></h3>
                        <p><?= h(mb_substr(strip_tags((string)$p['summary']), 0, 72)) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($categories)): ?>
<section class="food-section-sm">
    <div class="food-container">
        <div class="food-center" style="margin-bottom:1rem;">
            <h2 class="food-title"><?= h(t('home_feature_categories')) ?></h2>
        </div>
        <div class="food-grid-4">
            <?php foreach (array_slice($categories, 0, 8) as $cat): ?>
                <a class="food-card" href="<?= url('/products') ?>?category=<?= (int)$cat['id'] ?>">
                    <div class="food-card-body">
                        <h3><?= h($cat['name']) ?></h3>
                        <?php if (!empty($cat['description'])): ?>
                            <p><?= h(mb_substr(strip_tags((string)$cat['description']), 0, 60)) ?></p>
                        <?php else: ?>
                            <p><?= h(t('product_view_details')) ?></p>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="food-section">
    <div class="food-container">
        <div class="food-grid-2">
            <article class="food-card">
                <div class="food-card-body">
                    <h2 class="food-title" style="font-size:1.6rem"><?= h(t('home_why_us')) ?></h2>
                    <p class="food-subtitle"><?= h($site['company_bio'] ?? t('home_highlights')) ?></p>
                    <ul style="padding-left:1rem;margin:1rem 0 0;">
                        <li><?= h(t('home_iso')) ?></li>
                        <li><?= h(t('home_oem')) ?></li>
                        <li><?= h(t('home_rd')) ?></li>
                    </ul>
                </div>
            </article>
            <article class="food-card">
                <img class="food-card-img" src="<?= asset_url($site['og_image'] ?? $heroCover) ?>" alt="food factory" loading="lazy">
                <div class="food-card-body">
                    <h3><?= h(t('home_global')) ?></h3>
                    <p><?= h(t('home_ready_desc')) ?></p>
                </div>
            </article>
        </div>
    </div>
</section>

<?php if (!empty($cases)): ?>
<section class="food-section-sm">
    <div class="food-container">
        <div class="food-center" style="margin-bottom:1rem;">
            <h2 class="food-title"><?= h(t('section_success_cases')) ?></h2>
            <p class="food-subtitle"><?= h(t('case_interest')) ?></p>
        </div>
        <div class="food-grid-3">
            <?php foreach (array_slice($cases, 0, 6) as $case): ?>
                <article class="food-card">
                    <a href="<?= h($case['url']) ?>">
                        <img class="food-card-img" src="<?= asset_url(h($case['cover'] ?: '/assets/no-image.png')) ?>" alt="<?= h($case['title']) ?>" loading="lazy">
                    </a>
                    <div class="food-card-body">
                        <h3><a href="<?= h($case['url']) ?>"><?= h($case['title']) ?></a></h3>
                        <p><?= h(mb_substr(strip_tags((string)($case['summary'] ?? '')), 0, 68)) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($latestPosts)): ?>
<section class="food-section-sm">
    <div class="food-container">
        <div class="food-center" style="margin-bottom:1rem;">
            <h2 class="food-title"><?= h(t('home_latest_news')) ?></h2>
        </div>
        <div class="food-grid-3">
            <?php foreach ($latestPosts as $post): ?>
                <article class="food-card">
                    <div class="food-card-body">
                        <div class="food-meta"><span><?= format_date($post['created_at'], 'Y-m-d') ?></span></div>
                        <h3 style="margin-top:.45rem;"><a href="<?= h($post['url'] ?? url('/blog')) ?>"><?= h($post['title'] ?? '') ?></a></h3>
                        <p><?= h(mb_substr(strip_tags((string)($post['summary'] ?? '')), 0, 88)) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="food-section-sm">
    <div class="food-container">
        <div class="food-card" style="background:linear-gradient(140deg, #edf8f0, #ffffff); padding:100px 20px; ">
            <div class="food-card-body food-center">
                <h2 class="food-title" style="font-size:1.8rem;"><?= h(t('home_ready_title')) ?></h2>
                <p class="food-subtitle"><?= h(t('home_ready_desc')) ?></p>
                <div class="food-hero-actions" style="justify-content:center;">
                    <a class="food-btn food-btn-primary" href="<?= url('/contact') ?>"><?= h(t('cta_quote')) ?></a>
                    <a class="food-btn food-btn-outline" href="<?= url('/products') ?>"><?= h(t('btn_view_all')) ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
