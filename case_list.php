<section class="food-section-sm">
    <div class="food-container">
        <nav class="food-breadcrumb"><a href="<?= url('/') ?>"><?= h(t('nav_home')) ?></a> / <span><?= h(t('cases')) ?></span></nav>
        <h1 class="food-title"><?= h($title) ?></h1>
        <p class="food-subtitle"><?= h(t('case_interest')) ?></p>
    </div>
</section>

<section class="food-section-sm" style="padding-top:1rem;">
    <div class="food-container food-case-list">
        <?php if (empty($items)): ?>
            <article class="food-card"><div class="food-card-body"><p><?= h(t('post_no_articles')) ?></p></div></article>
        <?php else: ?>
            <?php foreach ($items as $item): ?>
                <article class="food-case-item">
                    <?php if (!empty($item['cover'])): ?>
                        <a href="<?= h($item['url']) ?>"><img src="<?= asset_url(h($item['cover'])) ?>" alt="<?= h($item['title']) ?>" loading="lazy"></a>
                    <?php endif; ?>
                    <div class="food-card-body">
                        <h3><a href="<?= h($item['url']) ?>"><?= h($item['title']) ?></a></h3>
                        <p><?= h(mb_substr(strip_tags((string)$item['summary']), 0, 128)) ?></p>
                        <div style="margin-top:.75rem;">
                            <a class="food-btn food-btn-soft" href="<?= h($item['url']) ?>"><?= h(t('list_read_more')) ?></a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
