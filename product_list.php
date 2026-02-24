<?php
$categories = $categories ?? [];
$currentCategory = $current_category ?? null;
$currentCategoryId = $currentCategory ? (int)$currentCategory['id'] : null;
?>
<section class="food-section-sm">
    <div class="food-container">
        <nav class="food-breadcrumb">
            <a href="<?= url('/') ?>"><?= h(t('nav_home')) ?></a> /
            <span><?= h($title) ?></span>
        </nav>
        <h1 class="food-title" style="font-size:2rem;"><?= h($title) ?></h1>
        <p class="food-subtitle">
            <?= $currentCategory && !empty($currentCategory['description']) ? h($currentCategory['description']) : h(t('product_list_subtitle')) ?>
        </p>
    </div>
</section>

<section class="food-section-sm" style="padding-top:1rem;">
    <div class="food-container food-layout">
        <aside class="food-sidebar">
            <div class="food-side-head"><?= h(t('product_categories')) ?></div>
            <a href="<?= url('/products') ?>" class="food-side-link <?= !$currentCategory ? 'is-active' : '' ?>"><?= h(t('product_all')) ?></a>
            <?php if (!empty($categories)): ?>
                <?php food_render_product_categories($categories, $currentCategoryId); ?>
            <?php endif; ?>
        </aside>

        <div class="food-product-list">
            <?php if (empty($items)): ?>
                <article class="food-card">
                    <div class="food-card-body food-center">
                        <p><?= h(t('product_no_items')) ?></p>
                        <a class="food-btn food-btn-soft" href="<?= url('/products') ?>"><?= h(t('product_view_all')) ?></a>
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
                                <p><?= h(mb_substr(strip_tags((string)$item['summary']), 0, 74)) ?></p>
                                <div style="margin-top:.8rem;">
                                    <a href="<?= h($item['url']) ?>" class="food-btn food-btn-soft"><?= h(t('product_view_details')) ?></a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
