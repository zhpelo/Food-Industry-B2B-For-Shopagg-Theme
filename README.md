# SHOPAGG 主题：b2b-002

`Food-Industry-B2B-For-Shopagg-Theme` 是一个面向食品行业（可扩展至通用外贸行业）的响应式 B2B 官网主题，适配 SHOPAGG 开源程序。

---

## 1. 主题特性

- 响应式布局，支持桌面端 / 平板 / 手机端。
- 首页产品与资讯模块可直接复用系统内容数据。
- 支持中英文双语（`lang/zh.php`、`lang/en.php`）。
- 产品详情页支持主图轮播 + 缩略图导航。
- 统一样式变量（在 `style.css` 的 `:root` 中维护主色、边框、阴影等设计令牌）。

---

## 2. 适配程序版本

- SHOPAGG B2B Website（PHP + SQLite 版本）
- 建议 PHP 8.0+（与主程序一致）

---

## 3. 安装与启用

### 方式 A：已在项目中（推荐）

当前目录结构已包含：

`themes/Food-Industry-B2B-For-Shopagg-Theme/`

后台进入：`系统设置`，将主题名称切换为 `Food-Industry-B2B-For-Shopagg-Theme` 并保存。

### 方式 B：手动拷贝

1. 将整个 `Food-Industry-B2B-For-Shopagg-Theme` 文件夹上传到 `themes/` 目录。
2. 后台切换主题为 `Food-Industry-B2B-For-Shopagg-Theme`。
3. 清理浏览器缓存后刷新前台页面。

---

## 4. 目录说明

```
b2b-002/
├── home.php             # 首页
├── product_list.php     # 产品列表
├── product_detail.php   # 产品详情
├── post_list.php        # 博客列表
├── post_detail.php      # 博客详情
├── case_list.php        # 案例列表
├── case_detail.php      # 案例详情
├── about.php            # 关于我们
├── contact.php          # 联系我们
├── thanks.php           # 提交成功页
├── 404.php              # 404 页面
├── header.php           # 全局头部
├── footer.php           # 全局底部
├── list.php             # 通用列表模板（按程序路由使用）
├── functions.php        # 主题辅助函数
├── style.css            # 主题样式
└── lang/
		├── zh.php           # 中文文案
		└── en.php           # 英文文案
```

---

## 5. 可配置与二次开发

### 5.1 主题样式

- 主要设计变量在 `style.css` 顶部 `:root`：
	- `--food-primary`
	- `--food-primary-dark`
	- `--food-bg`
	- `--food-border`
	- `--food-shadow`
- 推荐优先调整变量，不建议全局硬改组件样式，便于后续维护。

### 5.2 多语言文案

- 中文：`lang/zh.php`
- 英文：`lang/en.php`
- 两个文件的 key 需要保持一致。

### 5.3 主题函数

`functions.php` 中包含常用数据拼装与渲染函数，例如：

- `food_get_carousel_products()`：获取首页轮播产品。
- `food_get_latest_posts()`：获取最新文章。
- `food_render_product_categories()`：渲染产品分类树。
- `food_render_post_categories()`：渲染文章分类树。

如需扩展主题功能，建议在该文件新增函数并保持命名前缀 `food_`，避免与系统函数冲突。

---

## 6. 页面映射建议

常见前台路由与模板对应关系：

- `/` → `home.php`
- `/products` → `product_list.php`
- `/product/:slug` → `product_detail.php`
- `/cases` → `case_list.php`
- `/case/:slug` → `case_detail.php`
- `/blog` → `post_list.php`
- `/blog/:slug` → `post_detail.php`
- `/about` → `about.php`
- `/contact` → `contact.php`

> 实际路由以主程序控制器和路由配置为准。

---

## 7. 开发注意事项

- 保持模板文件名不变，避免主程序调用失败。
- 多语言新增字段时，需同步更新 `zh.php` 与 `en.php`。
- 产品详情页轮播样式与结构耦合较高，修改时建议联动测试：
	- 主图显示
	- 缩略图激活态
	- 移动端横向溢出
- 若出现 `width: 100%` 导致页面横向滚动，优先检查父级 grid/flex 容器是否缺少 `min-width: 0`。

---

## 8. 发布前检查清单

- 已替换 Logo、公司名称、联系方式。
- 已补齐 About / Contact 页面企业信息。
- 已检查中英文文案完整性。
- 已在手机端测试首页、列表页、详情页、表单提交。
- 已验证询盘与留言提交流程。

---

## 9. License

本主题遵循项目根目录 `LICENSE` 约定。
