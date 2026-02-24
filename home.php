<?php
$products = $products ?? [];
$cases = $cases ?? [];
// 使用通用函数获取推荐产品，参数可根据需要调整（如 ['featured' => true, 'limit' => 4]）
$carouselProducts = get_products(['limit' => 4, 'featured' => true]);
// 如果推荐产品不足，可以补充最新产品，或者直接获取最新产品： get_products(['limit' => 4]);
if (count($carouselProducts) < 4) {
    $more = get_products(['limit' => 4 - count($carouselProducts)]);
    // 简单的合并，可能会有重复，实际项目中可在 get_products 内部处理排除逻辑或在此处去重
    $ids = array_column($carouselProducts, 'id');
    foreach ($more as $m) {
        if (!in_array($m['id'], $ids)) {
            $carouselProducts[] = $m;
        }
    }
}
$latestPosts = get_posts(['limit' => 3]);
$categories = [];
if (!empty(get_product_categories())) {
    $categories = get_product_categories();
}
$heroCover = !empty($site['og_image']) ? $site['og_image'] : 'https://devtool.tech/api/placeholder/800/800';
?>

<section class="food-hero">
    <div class="food-container food-hero-inner">
        <div>
            <span class="food-badge"><i class="fa-solid fa-seedling"></i> Food Industry B2B</span>
            <h1 class="food-title"><?= h($site['name'] ?? 'Food Manufacturer') ?></h1>
            <p class="food-subtitle"><?= h($site['tagline'] ?? 'Company Highlights') ?></p>
            <div class="food-hero-actions">
                <a class="food-btn food-btn-primary" href="<?= url('/products') ?>">Featured Products</a>
                <a class="food-btn food-btn-soft" href="<?= url('/contact') ?>">Request Quote</a>
            </div>
        </div>
        <div class="food-hero-media">
            <img src="<?= asset_url($heroCover) ?>" alt="<?= h($site['name'] ?? 'Food Manufacturer') ?>" loading="eager">
        </div>
    </div>
</section>

<section class="food-section-sm">
    <div class="food-container">
        <div class="food-feature-list">
            <article class="food-feature-item">
                <i class="fa-solid fa-shield-heart"></i>
                <h4>Quality Assurance</h4>
                <p>ISO-aligned production with strict QC before shipment.</p>
            </article>
            <article class="food-feature-item">
                <i class="fa-solid fa-truck-fast"></i>
                <h4>Global Logistics</h4>
                <p>On-time delivery with consolidated freight options.</p>
            </article>
            <article class="food-feature-item">
                <i class="fa-solid fa-tags"></i>
                <h4>Dedicated Support</h4>
                <p>One-to-one account service for long-term buyers.</p>
            </article>
        </div>
    </div>
</section>

<?php if (!empty($carouselProducts)): ?>
<section class="food-section">
    <div class="food-container">
        <div class="food-center" style="margin-bottom:1rem;">
            <h2 class="food-title">Featured Products</h2>
            <p class="food-subtitle">Browse our full range of products.</p>
        </div>
        <div class="food-grid-4">
            <?php foreach ($carouselProducts as $p): ?>
                <article class="food-card">
                    <a href="<?= $p['url'] ?>">
                        <img class="food-card-img" src="<?= asset_url($p['cover']) ?>" alt="<?= $p['title']; ?>" loading="lazy">
                    </a>
                    <div class="food-card-body">
                        <h3><a href="<?= $p['url'] ?>"><?= $p['title'] ?></a></h3>
                        <p><?= mb_substr(strip_tags((string)$p['summary']), 0, 72) ?></p>
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
            <h2 class="food-title">Featured Categories</h2>
        </div>
        <div class="food-grid-4">
            <?php foreach (array_slice($categories, 0, 8) as $cat): ?>
                <a class="food-card" href="<?= url('/products') ?>?category=<?= (int)$cat['id'] ?>">
                    <div class="food-card-body">
                        <h3><?= h($cat['name']) ?></h3>
                        <?php if (!empty($cat['description'])): ?>
                            <p><?= mb_substr(strip_tags((string)$cat['description']), 0, 60) ?></p>
                        <?php else: ?>
                            <p>View Details</p>
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
                    <h2 class="food-title" style="font-size:1.6rem">Why Choose Us</h2>
                    <p class="food-subtitle"><?= h($site['company_bio'] ?? 'Company Highlights') ?></p>
                    <ul style="padding-left:1rem;margin:1rem 0 0;">
                        <li>ISO Certified</li>
                        <li>OEM & ODM</li>
                        <li>R&D Team</li>
                    </ul>
                </div>
            </article>
            <article class="food-card">
                <img class="food-card-img" src="<?= asset_url(!empty($site['og_image']) ? $site['og_image'] : $heroCover) ?>" alt="food factory" loading="lazy">
                <div class="food-card-body">
                    <h3>Global Presence</h3>
                    <p>Contact us today for a professional quote and expert consultation.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<?php if (!empty($cases)): ?>
<section class="food-section-sm">
    <div class="food-container">
        <div class="food-center" style="margin-bottom:1rem;">
            <h2 class="food-title">Success Cases</h2>
            <p class="food-subtitle">If you are interested in this solution or have similar needs, please contact our expert team.</p>
        </div>
        <div class="food-grid-3">
            <?php foreach (array_slice($cases, 0, 6) as $case): ?>
                <article class="food-card">
                    <a href="<?= h($case['url']) ?>">
                        <img class="food-card-img" src="<?= asset_url(h($case['cover'] ?: '/assets/no-image.png')) ?>" alt="<?= h($case['title']) ?>" loading="lazy">
                    </a>
                    <div class="food-card-body">
                        <h3><a href="<?= h($case['url']) ?>"><?= h($case['title']) ?></a></h3>
                        <p><?= mb_substr(strip_tags((string)($case['summary'] ?? '')), 0, 68) ?></p>
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
            <h2 class="food-title">Latest News</h2>
        </div>
        <div class="food-grid-3">
            <?php foreach ($latestPosts as $post): ?>
                <article class="food-card">
                    <div class="food-card-body">
                        <div class="food-meta"><span><?= format_date($post['created_at'], 'Y-m-d') ?></span></div>
                        <h3 style="margin-top:.45rem;"><a href="<?= h($post['url'] ?? url('/blog')) ?>"><?= h($post['title'] ?? '') ?></a></h3>
                        <p><?= mb_substr(strip_tags((string)($post['summary'] ?? '')), 0, 88) ?></p>
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
                <h2 class="food-title" style="font-size:1.8rem;">Ready to start your project?</h2>
                <p class="food-subtitle">Contact us today for a professional quote and expert consultation.</p>
                <div class="food-hero-actions" style="justify-content:center;">
                    <a class="food-btn food-btn-primary" href="<?= url('/contact') ?>">Request Quote</a>
                    <a class="food-btn food-btn-outline" href="<?= url('/products') ?>">View All</a>
                </div>
            </div>
        </div>
    </div>
</section>
