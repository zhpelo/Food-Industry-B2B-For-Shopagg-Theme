<?php
declare(strict_types=1);

if (!function_exists('food_get_carousel_products')) {
    function food_get_carousel_products(int $limit = 4): array
    {
        static $cache = null;
        if ($cache !== null) {
            return array_slice($cache, 0, $limit);
        }

        $productModel = new \App\Models\Product();
        $featured = $productModel->getFeatured($limit);

        if (count($featured) < $limit) {
            $excludeIds = array_column($featured, 'id');
            $latest = $productModel->getLatest($limit + 8);
            foreach ($latest as $item) {
                if (count($featured) >= $limit) {
                    break;
                }
                if (!in_array($item['id'], $excludeIds, true)) {
                    $featured[] = $item;
                }
            }
        }

        // var_dump($featured);
        // die();

        $cache = array_map(function (array $item): array {
            return [
                'title' => $item['title'] ?? '',
                'summary' => $item['summary'] ?? '',
                'cover' => $item['banner_image'] ?? ($item['cover'] ?? ''),
                'url' => $item['url'] ?? url('/product/' . ($item['slug'] ?? '')),
            ];
        }, array_slice($featured, 0, $limit));

        return $cache;
    }
}

if (!function_exists('food_get_latest_posts')) {
    function food_get_latest_posts(int $limit = 3): array
    {
        $postModel = new \App\Models\PostModel();
        $items = [];
        if (method_exists($postModel, 'getLatest')) {
            $method = 'getLatest';
            $items = $postModel->{$method}($limit);
        } else {
            $items = $postModel->getList(0, true);
            $items = array_slice($items, 0, $limit);
        }
        foreach ($items as &$item) {
            if (empty($item['url']) && !empty($item['slug'])) {
                $item['url'] = url('/blog/' . $item['slug']);
            }
        }
        return $items;
    }
}

if (!function_exists('food_render_product_categories')) {
    function food_render_product_categories(array $categories, ?int $activeCategoryId = null, int $level = 0): void
    {
        foreach ($categories as $category) {
            $isActive = $activeCategoryId === (int)($category['id'] ?? 0);
            $hasChildren = !empty($category['children']) && is_array($category['children']);
            ?>
            <a href="<?= url('/products') ?>?category=<?= (int)$category['id'] ?>" class="food-side-link <?= $isActive ? 'is-active' : '' ?>" style="--level:<?= $level ?>">
                <?php if ($level > 0): ?><span class="food-tree">└</span><?php endif; ?>
                <span><?= h($category['name'] ?? '') ?></span>
            </a>
            <?php
            if ($hasChildren) {
                food_render_product_categories($category['children'], $activeCategoryId, $level + 1);
            }
        }
    }
}

if (!function_exists('food_render_post_categories')) {
    function food_render_post_categories(array $categories, ?int $activeCategoryId = null, int $level = 0): void
    {
        foreach ($categories as $category) {
            $isActive = $activeCategoryId === (int)($category['id'] ?? 0);
            $hasChildren = !empty($category['children']) && is_array($category['children']);
            ?>
            <a href="<?= url('/blog') ?>?category=<?= (int)$category['id'] ?>" class="food-side-link <?= $isActive ? 'is-active' : '' ?>" style="--level:<?= $level ?>">
                <?php if ($level > 0): ?><span class="food-tree">└</span><?php endif; ?>
                <span><?= h($category['name'] ?? '') ?></span>
            </a>
            <?php
            if ($hasChildren) {
                food_render_post_categories($category['children'], $activeCategoryId, $level + 1);
            }
        }
    }
}
