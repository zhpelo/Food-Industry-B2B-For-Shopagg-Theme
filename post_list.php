<?php
$categories = $categories ?? [];
$currentCategory = $current_category ?? null;
$currentCategoryId = $currentCategory ? (int)$currentCategory['id'] : null;
?>
<section class="food-section-sm">
    <div class="food-container">
        <nav class="food-breadcrumb"><a href="<?= url('/') ?>">Home</a> / <span>Blog</span></nav>
        <h1 class="food-title"><?= h($title) ?></h1>
        <p class="food-subtitle"><?= $currentCategory && !empty($currentCategory['description']) ? h($currentCategory['description']) : 'Get the latest industry insights and company news' ?></p>
    </div>
</section>

<section class="food-section-sm" style="padding-top:1rem;">
    <div class="food-container food-layout" style="grid-template-columns:300px 1fr;">
        <aside class="food-sidebar">
            <div class="food-side-head">Categories</div>
            <a href="<?= url('/blog') ?>" class="food-side-link <?= !$currentCategory ? 'is-active' : '' ?>">All Articles</a>
            <?php if (!empty($categories)): ?>
                <?php food_render_post_categories($categories, $currentCategoryId); ?>
            <?php endif; ?>
        </aside>

        <div class="food-post-list">
            <?php if (empty($items)): ?>
                <article class="food-card"><div class="food-card-body"><p>No articles found</p></div></article>
            <?php else: ?>
                <?php foreach ($items as $item): ?>
                    <article class="food-post-item">
                        <?php if (!empty($item['cover'])): ?>
                            <a href="<?= h($item['url']) ?>"><img src="<?= asset_url(h($item['cover'])) ?>" alt="<?= h($item['title']) ?>" loading="lazy"></a>
                        <?php endif; ?>
                        <div class="food-card-body">
                            <div class="food-meta">
                                <span><i class="far fa-calendar"></i> <?= format_date($item['created_at'], 'Y-m-d') ?></span>
                                <?php if (!empty($item['category_name'])): ?><span class="food-badge"><?= h($item['category_name']) ?></span><?php endif; ?>
                            </div>
                            <h3 style="margin-top:.55rem;"><a href="<?= h($item['url']) ?>"><?= h($item['title']) ?></a></h3>
                            <p><?= mb_substr(strip_tags((string)$item['summary']), 0, 150) ?></p>
                            <div style="margin-top:.75rem;"><a class="food-btn food-btn-soft" href="<?= h($item['url']) ?>">Read Full Article</a></div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
