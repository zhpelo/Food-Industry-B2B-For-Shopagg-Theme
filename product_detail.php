<?php
$category = $category ?? null;
$images = $images ?? [];
$price_tiers = $price_tiers ?? [];
$whatsapp = $whatsapp ?? '';
$inquiry_form = !empty($inquiry_form);
$waDigits = preg_replace('/\D+/', '', $whatsapp);

$galleryImages = $images;
if (empty($galleryImages) && !empty($item['banner_image'])) {
    $galleryImages[] = $item['banner_image'];
}
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<section class="food-section-sm">
    <div class="food-container">
        <nav class="food-breadcrumb">
            <a href="<?= url('/') ?>">Home</a> /
            <a href="<?= url('/products') ?>">Products</a>
            <?php if ($category): ?> / <a href="<?= url('/products') ?>?category=<?= (int)$category['id'] ?>"><?= h($category['name']) ?></a><?php endif; ?>
            / <span><?= h($item['title']) ?></span>
        </nav>
        <h1 class="food-title" style="font-size:2rem;"><?= h($item['title']) ?></h1>
    </div>
</section>

<section class="food-section-sm" style="padding-top:1rem;">
    <div class="food-container food-detail-grid">
        <div class="food-card food-gallery-card">
            <?php if (!empty($galleryImages)): ?>
                <div class="swiper food-gallery-main" id="food-main-swiper" >
                    <div class="swiper-wrapper">
                        <?php foreach ($galleryImages as $img): ?>
                            <div class="swiper-slide"><img src="<?= asset_url(h($img)) ?>" alt="<?= h($item['title']) ?>"  ></div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-prev food-swiper-prev"></div>
                    <div class="swiper-button-next food-swiper-next"></div>
                </div>
                <div class="swiper food-gallery-thumbs" id="food-thumbs-swiper" >
                    <div class="swiper-wrapper">
                        <?php foreach ($galleryImages as $img): ?>
                            <div class="swiper-slide"><img src="<?= asset_url(h($img)) ?>" alt="<?= h($item['title']) ?>" ></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="food-card-body"><p>No products found</p></div>
            <?php endif; ?>
        </div>

        <aside class="food-card food-card-body food-detail-info">
            <div class="food-meta">
                <span><i class="far fa-calendar"></i> <?= format_date($item['created_at'], 'Y-m-d') ?></span>
                <?php if ($category): ?><a class="food-badge" href="<?= url('/products') ?>?category=<?= (int)$category['id'] ?>"><?= h($category['name']) ?></a><?php endif; ?>
            </div>

            <?php if (!empty($item['summary'])): ?>
                <p class="food-subtitle" style="margin-top:.8rem;"><?= h($item['summary']) ?></p>
            <?php endif; ?>

            <?php if (!empty($price_tiers)): ?>
                <div class="food-price">
                    <strong>Tiered Pricing</strong>
                    <div class="food-price-grid">
                        <?php foreach ($price_tiers as $tier): ?>
                            <div>
                                <strong><?= h($tier['currency']) ?> $<?= h((string)$tier['price']) ?></strong>
                                <span class="food-subtitle" style="font-size:.85rem;"><?= number_format((float)$tier['min_qty']) ?><?= !empty($tier['max_qty']) ? '-' . number_format((float)$tier['max_qty']) : '+' ?> Pieces</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="food-actions">
                <?php if ($inquiry_form): ?>
                    <a class="food-btn food-btn-primary" id="food-open-inquiry" type="button">Send Inquiry</a>
                <?php endif; ?>
                <?php if (!empty($waDigits)): ?>
                    <a class="food-btn food-btn-soft" href="https://wa.me/<?= h($waDigits) ?>" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i>Chat Now</a>
                <?php endif; ?>
            </div>
        </aside>
    </div>
</section>

<section class="food-section-sm" style="padding-top:0;">
    <div class="food-container">
        <article class="food-card food-card-body food-content">
            <h2 class="food-title" style="font-size:1.35rem;">Product Description</h2>
            <div class="food-rich"><?= process_rich_text($item['content']) ?></div>
        </article>
    </div>
</section>

<?php if ($inquiry_form): ?>
<div class="food-modal" id="food-inquiry-modal">
    <div class="food-modal-content">
        <div class="food-modal-head">
            <h3 style="margin:0;">Request Quote</h3>
            <button type="button" class="food-modal-close" id="food-close-inquiry">&times;</button>
        </div>
        <div class="food-modal-body">
            <form method="post" action="<?= url('/inquiry') ?>">
                <input type="hidden" name="csrf" value="<?= h(csrf_token()) ?>">
                <input type="hidden" name="product_id" value="<?= h((string)$item['id']) ?>">
                <div class="food-form-row">
                    <div class="food-form-group">
                        <label>Your Name *</label>
                        <input name="name" required placeholder="Full Name">
                    </div>
                    <div class="food-form-group">
                        <label>Email Address *</label>
                        <input name="email" type="email" required placeholder="example@email.com">
                    </div>
                </div>
                <div class="food-form-row">
                    <div class="food-form-group">
                        <label>Company</label>
                        <input name="company" placeholder="Company Ltd.">
                    </div>
                    <div class="food-form-group">
                        <label>Quantity Needed</label>
                        <input name="quantity" placeholder="e.g. 500 units">
                    </div>
                </div>
                <div class="food-form-group">
                    <label>Requirements</label>
                    <textarea name="message" placeholder="Project requirements, customization, etc."></textarea>
                </div>
                <button class="food-btn food-btn-primary food-btn-block" type="submit">Send My Inquiry</button>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (!empty($galleryImages)): ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
(function () {
    function initGallery() {
        var thumbsEl = document.getElementById('food-thumbs-swiper');
        var mainEl = document.getElementById('food-main-swiper');
        if (!thumbsEl || !mainEl || typeof Swiper === 'undefined') return;

        var thumbs = new Swiper(thumbsEl, {
            spaceBetween: 10,
            slidesPerView: 4,
            watchSlidesProgress: true,
            breakpoints: { 0: { slidesPerView: 3 }, 768: { slidesPerView: 4 }, 1100: { slidesPerView: 5 } }
        });

        new Swiper(mainEl, {
            spaceBetween: 10,
            navigation: { nextEl: '.food-swiper-next', prevEl: '.food-swiper-prev' },
            thumbs: { swiper: thumbs }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGallery);
    } else {
        initGallery();
    }
})();
</script>
<?php endif; ?>

<?php if ($inquiry_form): ?>
<script>
(function () {
    var modal = document.getElementById('food-inquiry-modal');
    var openBtn = document.getElementById('food-open-inquiry');
    var closeBtn = document.getElementById('food-close-inquiry');
    if (!modal || !openBtn || !closeBtn) return;

    function openModal() { modal.style.display = 'flex'; document.body.style.overflow = 'hidden'; }
    function closeModal() { modal.style.display = 'none'; document.body.style.overflow = ''; }

    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
})();
</script>
<?php endif; ?>
