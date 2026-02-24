<section class="food-section-sm">
    <div class="food-container">
        <nav class="food-breadcrumb">
            <a href="<?= url('/') ?>"><?= h(t('nav_home')) ?></a> / <span><?= h(t('contact_title')) ?></span>
        </nav>
        <h1 class="food-title"><?= h(t('contact_title')) ?></h1>
        <p class="food-subtitle"><?= h($site['tagline'] ?? '') ?></p>
    </div>
</section>

<section class="food-section-sm" style="padding-top:1rem;">
    <div class="food-container food-contact-grid">
        <article class="food-card food-contact-info">
            <h2 style="margin-top:0;"><?= h(t('footer_contact')) ?></h2>
            <p><strong><?= h(t('about_address')) ?>:</strong> <?= h($site['company_address'] ?? '') ?></p>
            <p><strong><?= h(t('form_email')) ?>:</strong> <?= h($site['company_email'] ?? '') ?></p>
            <p><strong><?= h(t('form_phone')) ?>:</strong> <?= h($site['company_phone'] ?? '') ?></p>
            <p><strong><?= h(t('about_resp_time')) ?>:</strong> <?= h($site['company_response_time'] ?? '≤24h') ?></p>
            <?php $waDigits = preg_replace('/\D+/', '', $site['whatsapp'] ?? ''); ?>
            <?php if (!empty($waDigits)): ?>
                <a class="food-btn food-btn-soft" href="https://wa.me/<?= h($waDigits) ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i><?= h(t('chat_now')) ?></a>
            <?php endif; ?>
        </article>

        <article class="food-card food-form-card">
            <h2 style="margin-top:0;"><?= h(t('contact_message')) ?></h2>
            <form method="post" action="<?= url('/contact') ?>">
                <input type="hidden" name="csrf" value="<?= h(csrf_token()) ?>">
                <div class="food-form-row">
                    <div class="food-form-group">
                        <label><?= h(t('form_name')) ?> *</label>
                        <input name="name" required placeholder="<?= h(t('form_name_placeholder')) ?>">
                    </div>
                    <div class="food-form-group">
                        <label><?= h(t('form_email')) ?> *</label>
                        <input name="email" type="email" required placeholder="<?= h(t('form_email_placeholder')) ?>">
                    </div>
                </div>
                <div class="food-form-row">
                    <div class="food-form-group">
                        <label><?= h(t('form_company')) ?></label>
                        <input name="company" placeholder="<?= h(t('form_company_placeholder')) ?>">
                    </div>
                    <div class="food-form-group">
                        <label><?= h(t('form_phone')) ?></label>
                        <input name="phone">
                    </div>
                </div>
                <div class="food-form-group">
                    <label><?= h(t('form_message_label')) ?></label>
                    <textarea name="message" required placeholder="<?= h(t('form_req_placeholder')) ?>"></textarea>
                </div>
                <button class="food-btn food-btn-primary" type="submit"><?= h(t('contact_message')) ?></button>
            </form>
        </article>
    </div>
</section>
