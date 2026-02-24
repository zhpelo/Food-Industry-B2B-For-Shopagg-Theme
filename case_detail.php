<section class="food-section-sm">
    <div class="food-container">
        <nav class="food-breadcrumb">
            <a href="<?= url('/') ?>"><?= h(t('nav_home')) ?></a> /
            <a href="<?= url('/cases') ?>"><?= h(t('cases')) ?></a> /
            <span><?= h($item['title']) ?></span>
        </nav>
        <span class="food-badge"><?= h(t('case_success')) ?></span>
        <h1 class="food-title" style="margin-top:.6rem;"><?= h($item['title']) ?></h1>
        <?php if (!empty($item['summary'])): ?><p class="food-subtitle"><?= h($item['summary']) ?></p><?php endif; ?>
    </div>
</section>

<section class="food-section-sm" style="padding-top:1rem;">
    <div class="food-container food-detail-grid" style="grid-template-columns:1fr 340px;">
        <article class="food-card food-card-body">
            <?php if (!empty($item['cover'])): ?>
                <img src="<?= asset_url(h($item['cover'])) ?>" alt="<?= h($item['title']) ?>" loading="lazy" style="border-radius:12px;margin-bottom:1rem;aspect-ratio:16/9;object-fit:cover;">
            <?php endif; ?>
            <h2 class="food-title" style="font-size:1.35rem;"><?= h(t('case_details')) ?></h2>
            <div class="food-rich"><?= process_rich_text($item['content']) ?></div>
        </article>

        <aside class="food-card food-card-body food-detail-info">
            <h3 style="margin-top:0;"><?= h(t('case_about')) ?></h3>
            <p><strong><?= h(t('case_publish_time')) ?>:</strong> <?= format_date($item['created_at'], 'Y-m-d') ?></p>
            <p class="food-subtitle"><?= h(t('case_interest')) ?></p>
            <div class="food-actions">
                <a class="food-btn food-btn-primary" href="<?= url('/contact') ?>"><?= h(t('cta_quote')) ?></a>
                <a class="food-btn food-btn-outline" href="<?= url('/cases') ?>"><?= h(t('case_back_list')) ?></a>
            </div>
        </aside>
    </div>
</section>
