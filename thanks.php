<section class="food-section">
    <div class="food-container">
        <article class="food-card food-card-body food-center" style="max-width:720px;margin:0 auto;">
            <span class="food-badge"><i class="fa-solid fa-circle-check"></i> Success</span>
            <h1 class="food-title" style="margin-top:.8rem;"><?= h(t('thanks_title')) ?></h1>
            <p class="food-subtitle"><?= h(t('thanks_desc')) ?></p>
            <p class="food-subtitle" style="margin-top:.5rem;"><?= h(t('thanks_expected')) ?></p>
            <div class="food-hero-actions" style="justify-content:center; margin-top:1.2rem;">
                <a class="food-btn food-btn-primary" href="<?= url('/') ?>"><?= h(t('btn_back_home')) ?></a>
                <a class="food-btn food-btn-outline" href="<?= url('/products') ?>"><?= h(t('btn_view_more')) ?></a>
            </div>
        </article>
    </div>
</section>
