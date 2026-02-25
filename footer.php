</main>
<footer class="food-footer">
    <div class="food-container">
        <div class="food-footer-grid">
            <section>
                <h3><?= h($site['name'] ?? 'Food Supplier') ?></h3>
                <p><?= h($site['tagline'] ?? '') ?></p>
            </section>
            <section>
                <h4>Company</h4>
                <a href="<?= url('/about') ?>">About Us</a>
                <a href="<?= url('/products') ?>">Products</a>
                <a href="<?= url('/cases') ?>">Cases</a>
                <a href="<?= url('/blog') ?>">Blog</a>
            </section>
            <section>
                <h4>Contact</h4>
                <?php if (!empty($site['company_email'])): ?>
                    <a href="mailto:<?= h($site['company_email']) ?>"><?= h($site['company_email']) ?></a>
                <?php endif; ?>
                <?php if (!empty($site['company_phone'])): ?>
                    <a href="tel:<?= h(preg_replace('/\s+/', '', $site['company_phone'])) ?>"><?= h($site['company_phone']) ?></a>
                <?php endif; ?>
                <?php if (!empty($site['company_address'])): ?>
                    <p><?= h($site['company_address']) ?></p>
                <?php endif; ?>
            </section>
        </div>
        <div class="food-footer-bottom">
            <p>© <?= date('Y') ?> <?= h($site['name'] ?? '') ?>. All rights reserved.</p>
        </div>
    </div>
</footer>
<?= get_footer_code() ?>
<script>
(function () {
    var menuBtn = document.getElementById('food-menu-btn');
    var nav = document.getElementById('food-nav-menu');
    if (menuBtn && nav) {
        menuBtn.addEventListener('click', function () {
            var open = nav.classList.toggle('is-open');
            menuBtn.classList.toggle('is-open', open);
            menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
    }
})();
</script>
</body>
</html>
