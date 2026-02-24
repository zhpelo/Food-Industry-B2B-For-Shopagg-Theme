<?php $category = $category ?? null; ?>
<section class="food-section-sm">
    <div class="food-container">
        <nav class="food-breadcrumb">
            <a href="<?= url('/') ?>"><?= h(t('nav_home')) ?></a> /
            <a href="<?= url('/blog') ?>"><?= h(t('blog')) ?></a>
            <?php if ($category): ?> / <a href="<?= url('/blog') ?>?category=<?= (int)$category['id'] ?>"><?= h($category['name']) ?></a><?php endif; ?>
            / <span><?= h($item['title']) ?></span>
        </nav>
        <h1 class="food-title"><?= h($item['title']) ?></h1>
        <div class="food-meta">
            <span><i class="far fa-calendar"></i> <?= format_date($item['created_at'], 'Y-m-d') ?></span>
            <?php if ($category): ?><span class="food-badge"><?= h($category['name']) ?></span><?php endif; ?>
        </div>
    </div>
</section>

<section class="food-section-sm" style="padding-top:1rem;">
    <div class="food-container">
        <article class="food-card food-card-body">
            <?php if (!empty($item['cover'])): ?>
                <img src="<?= asset_url(h($item['cover'])) ?>" alt="<?= h($item['title']) ?>" loading="lazy" style="border-radius:12px;margin-bottom:1rem;aspect-ratio:16/8;object-fit:cover;">
            <?php endif; ?>
            <div class="food-rich"><?= process_rich_text($item['content']) ?></div>
            <div class="food-actions" style="margin-top:1.4rem;">
                <?php if ($category): ?>
                    <a class="food-btn food-btn-outline" href="<?= url('/blog') ?>?category=<?= (int)$category['id'] ?>"><?= h(t('post_more_in_category')) ?></a>
                <?php endif; ?>
                <a class="food-btn food-btn-soft" href="<?= url('/blog') ?>"><?= h(t('post_back_list')) ?></a>
            </div>
        </article>
    </div>
</section>
