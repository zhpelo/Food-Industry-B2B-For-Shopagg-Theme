<?php
$categories = $categories ?? [];
$currentCategory = $current_category ?? null;
$currentCategoryId = $currentCategory ? (int)$currentCategory['id'] : null;
?>
<section class="food-section-sm">
    <div class="food-container">
        <nav class="food-breadcrumb">
            <a href="<?= url('/') ?>">Home</a> /
            <span><?= h($title) ?></span>
        </nav>
        <h1 class="food-title" style="font-size:2rem;"><?= h($title) ?></h1>
        <p class="food-subtitle">
            <?= $currentCategory && !empty($currentCategory['description']) ? h($currentCategory['description']) : 'Browse our full range of products.' ?>
        </p>
    </div>
</section>

<section class="food-section-sm" style="padding-top:1rem;">
    <div class="food-container food-layout">
        <aside class="food-sidebar">
            <div class="food-side-head">Categories</div>
            <a href="<?= url('/products') ?>" class="food-side-link <?= !$currentCategory ? 'is-active' : '' ?>">All Products</a>
            <?php if (!empty($categories)): ?>
                <?php food_render_product_categories($categories, $currentCategoryId); ?>
            <?php endif; ?>
        </aside>

        <div class="food-product-list">
            <?php if (empty($items)): ?>
                <article class="food-card">
                    <div class="food-card-body food-center" style="padding: 100px 20px;">
                        <p style="margin-bottom: 50px;">No products found</p>
                        <a class="food-btn food-btn-soft" href="<?= url('/products') ?>">View All Products</a>
                    </div>
                </article>
            <?php else: ?>
                <div class="food-grid-3">
                    <?php foreach ($items as $item): ?>
                        <article class="food-card">
                            <a href="<?= h($item['url']) ?>">
                                <img src="<?= asset_url(h($item['cover'] ?: '/assets/no-image.png')) ?>" alt="<?= h($item['title']) ?>" loading="lazy">
                            </a>
                            <div class="food-card-body">
                                <h3><a href="<?= h($item['url']) ?>"><?= h($item['title']) ?></a></h3>
                                <p><?= mb_substr(strip_tags((string)$item['summary']), 0, 74) ?></p>
                                <div style="margin-top:.8rem;">
                                    <a href="<?= h($item['url']) ?>" class="food-btn food-btn-soft">View Details</a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
