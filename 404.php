<section class="food-section">
    <div class="food-container">
        <article class="food-card food-card-body food-center" style="max-width:640px;margin:0 auto;">
            <span class="food-badge">404</span>
            <h1 class="food-title" style="margin-top:.8rem;"><?= h(t('not_found_title')) ?></h1>
            <p class="food-subtitle"><?= h(t('not_found_desc')) ?></p>
            <div style="margin-top:1rem;"><a class="food-btn food-btn-primary" href="<?= url('/') ?>"><?= h(t('btn_go_home')) ?></a></div>
        </article>
    </div>
</section>
