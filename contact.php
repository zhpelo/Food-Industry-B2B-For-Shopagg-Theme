<section class="food-section-sm">
    <div class="food-container">
        <nav class="food-breadcrumb">
            <a href="<?= url('/') ?>">Home</a> / <span>Contact Us</span>
        </nav>
        <h1 class="food-title">Contact Us</h1>
        <p class="food-subtitle"><?= h($site['tagline'] ?? '') ?></p>
    </div>
</section>

<section class="food-section-sm" style="padding-top:1rem;">
    <div class="food-container food-contact-grid">
        <article class="food-card food-contact-info">
            <h2 style="margin-top:0;">Contact</h2>
            <p><strong>Address:</strong> <?= h($site['company_address'] ?? '') ?></p>
            <p><strong>Email:</strong> <?= h($site['company_email'] ?? '') ?></p>
            <p><strong>Phone:</strong> <?= h($site['company_phone'] ?? '') ?></p>
            <p><strong>Avg. Response Time:</strong> <?= h($site['company_response_time'] ?? '≤24h') ?></p>
            <?php $waDigits = preg_replace('/\D+/', '', $site['whatsapp'] ?? ''); ?>
            <?php if (!empty($waDigits)): ?>
                <a class="food-btn food-btn-soft" href="https://wa.me/<?= h($waDigits) ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i>Chat Now</a>
            <?php endif; ?>
        </article>

        <article class="food-card food-form-card">
            <h2 style="margin-top:0;">Send Message</h2>
            <form method="post" action="<?= url('/contact') ?>">
                <input type="hidden" name="csrf" value="<?= h(csrf_token()) ?>">
                <div class="food-form-row">
                    <div class="food-form-group">
                        <label>Name *</label>
                        <input name="name" required placeholder="Full Name">
                    </div>
                    <div class="food-form-group">
                        <label>Email *</label>
                        <input name="email" type="email" required placeholder="example@email.com">
                    </div>
                </div>
                <div class="food-form-row">
                    <div class="food-form-group">
                        <label>Company</label>
                        <input name="company" placeholder="Company Ltd.">
                    </div>
                    <div class="food-form-group">
                        <label>Phone</label>
                        <input name="phone">
                    </div>
                </div>
                <div class="food-form-group">
                    <label>Message</label>
                    <textarea name="message" required placeholder="Project requirements, customization, etc."></textarea>
                </div>
                <button class="food-btn food-btn-primary" type="submit">Send Message</button>
            </form>
        </article>
    </div>
</section>
