<section class="food-section-sm">
    <div class="food-container">
        <h1 class="food-title"><?= h($title) ?></h1>
    </div>
</section>

<section class="food-section-sm" style="padding-top:1rem;">
    <div class="food-container">
        <?php if (empty($items)): ?>
            <article class="food-card"><div class="food-card-body"><p>No articles found</p></div></article>
        <?php else: ?>
            <div class="food-grid-3">
                <?php foreach ($items as $item): ?>
                    <article class="food-card">
                        <?php if (!empty($show_image) && !empty($item['cover'])): ?>
                            <a href="<?= h($item['url']) ?>"><img src="<?= asset_url(h($item['cover'])) ?>" alt="<?= h($item['title']) ?>" loading="lazy"></a>
                        <?php endif; ?>
                        <div class="food-card-body">
                            <h3><a href="<?= h($item['url']) ?>"><?= h($item['title']) ?></a></h3>
                            <?php if (!empty($show_category)): ?>
                                <p class="food-subtitle" style="margin-bottom:.5rem;"><?= h($item['category_name'] ?? 'Uncategorized') ?></p>
                            <?php endif; ?>
                            <p><?= mb_substr(strip_tags((string)$item['summary']), 0, 88) ?></p>
                            <div style="margin-top:.75rem;"><a class="food-btn food-btn-soft" href="<?= h($item['url']) ?>">Read More</a></div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
