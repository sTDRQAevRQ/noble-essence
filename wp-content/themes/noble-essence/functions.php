<?php
function ne_enqueue_assets() {
    wp_enqueue_style('ne-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Inter:wght@300;400&display=swap', [], null);
    wp_enqueue_style('kadence-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('ne-style', get_stylesheet_uri(), ['kadence-style'], filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_script('ne-script', get_stylesheet_directory_uri() . '/assets/js/main.js', [], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'ne_enqueue_assets');

function ne_schema_org() {
    if (!is_front_page()) return;
    $schema = ['@context'=>'https://schema.org','@type'=>'Organization','name'=>'Noble Essence','url'=>'https://noble-essence.fr','email'=>'nobleessenceparfum@gmail.com','description'=>'Parfumerie de niche française — Extraits de parfum de caractère'];
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) . '</script>';
}
add_action('wp_head', 'ne_schema_org');

function ne_open_graph() {
    if (!is_front_page()) return;
    echo '<meta property="og:title" content="Noble Essence — Parfumerie de Niche">';
    echo '<meta property="og:description" content="Extraits de parfum de caractère. Tabac, cuir, épices, agrumes, encens.">';
    echo '<meta property="og:type" content="website">';
    echo '<meta property="og:url" content="https://noble-essence.fr">';
    echo '<meta name="twitter:card" content="summary_large_image">';
}
add_action('wp_head', 'ne_open_graph');

function ne_home_title($title) {
    if (is_front_page()) $title['title'] = 'Parfum niche épicé tabac cuir | Noble Essence';
    return $title;
}
add_filter('document_title_parts', 'ne_home_title');

function ne_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('html5', ['search-form','comment-form','gallery','caption']);
}
add_action('after_setup_theme', 'ne_theme_setup');

function ne_register_menus() {
    register_nav_menus(['primary'=>'Navigation principale','footer'=>'Navigation footer']);
}
add_action('init', 'ne_register_menus');

function ne_exclude_duplicate_products_from_queries($q) {
    if (is_admin() || !$q->is_main_query()) return;
    if (is_front_page()) {
        $tax_query = (array) $q->get('tax_query');
        $tax_query[] = [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => ['non-classe'],
            'operator' => 'NOT IN',
        ];
        $q->set('tax_query', $tax_query);
    }
}
add_action('pre_get_posts', 'ne_exclude_duplicate_products_from_queries');

function ne_related_products_args($args, $product_id) {
    $args['tax_query'][] = [
        'taxonomy' => 'product_cat',
        'field'    => 'slug',
        'terms'    => ['non-classe'],
        'operator' => 'NOT IN',
    ];
    return $args;
}
add_filter('woocommerce_related_products_args', 'ne_related_products_args', 10, 2);

function ne_remove_kadence_footer_credit() {
    remove_action('kadence_footer', 'kadence_single_footer', 10);
    if (is_product()) {
        remove_action('kadence_footer', 'Kadence\\footer_markup', 10);
    }
}
add_action('wp', 'ne_remove_kadence_footer_credit', 20);

function ne_global_site_footer() {
    if (is_front_page() || is_shop()) {
        return;
    }

    echo '<section class="ne-newsletter">';
    echo '<span class="label-or">Restez dans l\'univers</span>';
    echo '<h2>Nouvelles créations. Matières. Destinations.</h2>';
    echo '<p>Une newsletter rare. Comme nos parfums.</p>';
    echo '<form class="ne-newsletter-form" action="#" method="post">';
    echo '<input type="email" name="email" placeholder="Votre adresse email" required>';
    echo '<button type="submit">S\'inscrire</button>';
    echo '</form>';
    echo '</section>';

    echo '<div class="ne-reassurance">';
    echo '<span>Extrait de parfum · concentration 30 %</span>';
    echo '<span class="ne-reassurance-sep">·</span>';
    echo '<span>Livraison soignée · emballage protégé</span>';
    echo '<span class="ne-reassurance-sep">·</span>';
    echo '<span>Paiement sécurisé · CB · PayPal</span>';
    echo '</div>';

    echo '<footer class="ne-footer">';
    echo '<div class="ne-footer-grid">';
    echo '<div>';
    echo '<div class="ne-footer-logo">Noble Essence</div>';
    echo '<div class="ne-footer-tagline">Le sillage comme territoire.</div>';
    echo '<a href="mailto:nobleessenceparfum@gmail.com" style="font-size:13px;color:var(--color-text-secondary);">nobleessenceparfum@gmail.com</a>';
    echo '</div>';
    echo '<div>';
    echo '<h4>Nos parfums</h4>';
    echo '<ul>';
    echo '<li><a href="' . home_url('/produit/samarcande-extrait-de-parfum-50-ml-parfum-epice-tabac-cuir/') . '">Samarcande</a></li>';
    echo '<li><a href="' . home_url('/produit/yuzu-nara-extrait-de-parfum-50-ml/') . '">Yuzu Nara</a></li>';
    echo '<li><a href="' . home_url('/produit/rio-grande-extrait-de-parfum-50-ml/') . '">Rio Grande</a></li>';
    echo '<li><a href="' . home_url('/boutique/') . '">Toute la collection</a></li>';
    echo '<li><a href="' . home_url('/blog/') . '">Le blog</a></li>';
    echo '</ul>';
    echo '</div>';
    echo '<div>';
    echo '<h4>La maison</h4>';
    echo '<ul>';
    echo '<li><a href="' . home_url('/la-maison/') . '">Notre philosophie</a></li>';
    echo '<li><a href="' . home_url('/contact/') . '">Contact</a></li>';
    echo '<li><a href="' . home_url('/mentions-legales/') . '">Mentions légales</a></li>';
    echo '<li><a href="' . home_url('/conditions-generales-de-vente/') . '">CGV</a></li>';
    echo '<li><a href="' . home_url('/politique-de-confidentialite/') . '">Confidentialité</a></li>';
    echo '<li><a href="' . home_url('/remboursements_retours/') . '">Retours</a></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</footer>';
}
add_action('kadence_after_footer', 'ne_global_site_footer', 5);


function ne_shop_archive_hero() {
    if (!is_shop()) return;
    echo '<div class="ne-shop-hero">';
    echo '<div class="ne-shop-hero-inner">';
    echo '<span class="label-or">Parfumerie de niche française</span>';
    echo '<h1>Trois extraits. Un caractère sans compromis.</h1>';
    echo '<p class="ne-shop-hero-lead">Samarcande, Yuzu Nara, Rio Grande — trois signatures formulées à 30 % pour laisser une trace.</p>';
    echo '<p class="ne-shop-hero-tagline">Le sillage comme territoire.</p>';
    echo '</div>';
    echo '</div>';
}
add_action('woocommerce_before_main_content', 'ne_shop_archive_hero', 29);

function ne_shop_bottom_branding() {
    if (!is_shop()) return;
    echo '<section class="ne-shop-branding ne-section ne-section--alt">';
    echo '<div class="ne-shop-branding-inner">';
    echo '<div class="ne-shop-branding-heading">';
    echo '<span class="label-or">Parfum de niche · Noble Essence</span>';
    echo '<h2>Une collection de parfums de niche pensée pour le caractère</h2>';
    echo '</div>';
    echo '<p>Noble Essence propose des extraits de parfum de niche français formulés à 30 %, construits autour de matières premières expressives, d\'accords lisibles et d\'un vrai parti pris olfactif. Samarcande explore un territoire oriental épicé, Yuzu Nara un souffle citrus floral japonais, Rio Grande une signature agrumes résineuse plus dense et plus texturée.</p>';
    echo '<p>Chaque parfum Noble Essence est pensé pour offrir une tenue marquée, un sillage net et une identité reconnaissable. Notre vision de la parfumerie de niche repose sur trois piliers : la concentration, la lisibilité et l\'émotion. Pas de parfum générique, pas d\'effet de mode vide, mais des créations qui laissent une trace et racontent un territoire.</p>';
    echo '<p>Si vous recherchez un parfum de niche boisé, un parfum citrus élégant, un parfum oriental plus affirmé ou simplement un extrait de parfum de caractère à porter au quotidien, la collection Noble Essence a été conçue pour concilier exigence olfactive, signature forte et accessibilité.</p>';
    echo '</div>';
    echo '</section>';

    echo '<section class="ne-newsletter">';
    echo '<span class="label-or">Restez dans l\'univers</span>';
    echo '<h2>Nouvelles créations. Matières. Destinations.</h2>';
    echo '<p>Une newsletter rare. Comme nos parfums.</p>';
    echo '<form class="ne-newsletter-form" action="#" method="post">';
    echo '<input type="email" name="email" placeholder="Votre adresse email" required>';
    echo '<button type="submit">S\'inscrire</button>';
    echo '</form>';
    echo '</section>';

    echo '<div class="ne-reassurance">';
    echo '<span>Extrait de parfum · concentration 30 %</span>';
    echo '<span class="ne-reassurance-sep">·</span>';
    echo '<span>Livraison soignée · emballage protégé</span>';
    echo '<span class="ne-reassurance-sep">·</span>';
    echo '<span>Paiement sécurisé · CB · PayPal</span>';
    echo '</div>';

    echo '<footer class="ne-footer">';
    echo '<div class="ne-footer-grid">';
    echo '<div>';
    echo '<div class="ne-footer-logo">Noble Essence</div>';
    echo '<div class="ne-footer-tagline">Le sillage comme territoire.</div>';
    echo '<a href="mailto:nobleessenceparfum@gmail.com" style="font-size:13px;color:var(--color-text-secondary);">nobleessenceparfum@gmail.com</a>';
    echo '</div>';
    echo '<div>';
    echo '<h4>Nos parfums</h4>';
    echo '<ul>';
    echo '<li><a href="' . home_url('/produit/samarcande-extrait-de-parfum-50-ml-parfum-epice-tabac-cuir/') . '">Samarcande</a></li>';
    echo '<li><a href="' . home_url('/produit/yuzu-nara-extrait-de-parfum-50-ml/') . '">Yuzu Nara</a></li>';
    echo '<li><a href="' . home_url('/produit/rio-grande-extrait-de-parfum-50-ml/') . '">Rio Grande</a></li>';
    echo '<li><a href="' . home_url('/boutique/') . '">Toute la collection</a></li>';
    echo '<li><a href="' . home_url('/blog/') . '">Le blog</a></li>';
    echo '</ul>';
    echo '</div>';
    echo '<div>';
    echo '<h4>La maison</h4>';
    echo '<ul>';
    echo '<li><a href="' . home_url('/la-maison/') . '">Notre philosophie</a></li>';
    echo '<li><a href="' . home_url('/contact/') . '">Contact</a></li>';
    echo '<li><a href="' . home_url('/mentions-legales/') . '">Mentions légales</a></li>';
    echo '<li><a href="' . home_url('/conditions-generales-de-vente/') . '">CGV</a></li>';
    echo '<li><a href="' . home_url('/politique-de-confidentialite/') . '">Confidentialité</a></li>';
    echo '<li><a href="' . home_url('/remboursements_retours/') . '">Retours</a></li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</footer>';
}
add_action('woocommerce_after_main_content', 'ne_shop_bottom_branding', 25);

function ne_shop_inline_fixes() {
    if (!is_shop()) return;
    echo '<style id="ne-shop-inline-fixes">';
    echo 'body.post-type-archive-product .woocommerce-products-header,body.post-type-archive-product .page-header,body.post-type-archive-product .archive-title,body.post-type-archive-product .title-container,body.post-type-archive-product .entry-hero,body.post-type-archive-product .hero-section,body.post-type-archive-product .content-bg .page-header,body.post-type-archive-product .woocommerce-breadcrumb,body.post-type-archive-product .page-title{display:none!important;}';
    echo '.ne-shop-hero{padding:140px 24px 80px!important;background:linear-gradient(180deg,#050505 0%,#0a0a0a 55%,#0d0d0d 100%)!important;border-bottom:1px solid rgba(201,168,76,0.15)!important;text-align:center!important;}';
    echo '.ne-shop-hero h1{font-family:"Cormorant Garamond",serif!important;font-size:clamp(42px,7vw,76px)!important;font-weight:300!important;letter-spacing:.06em!important;color:#f5f0e8!important;line-height:1.08!important;margin-bottom:18px!important;}';
    echo '.ne-shop-hero .label-or{font-family:"Inter",sans-serif!important;color:#c9a84c!important;letter-spacing:.25em!important;text-transform:uppercase!important;}';
    echo '.ne-shop-hero-lead{font-family:"Inter",sans-serif!important;font-size:16px!important;line-height:1.95!important;color:#c8bfb0!important;max-width:760px!important;margin:0 auto 18px!important;}';
    echo '.ne-shop-hero-tagline{font-family:"Cormorant Garamond",serif!important;font-style:italic!important;font-size:26px!important;line-height:1.5!important;color:#c9a84c!important;margin:0 auto!important;}';
    echo '.ne-shop-branding{padding:120px 24px!important;background:#0d0d0d!important;border-top:1px solid rgba(201,168,76,0.15)!important;margin-top:100px!important;}';
    echo '.ne-shop-branding h2{font-family:"Cormorant Garamond",serif!important;color:#c9a84c!important;font-size:clamp(30px,4vw,44px)!important;font-weight:300!important;letter-spacing:.08em!important;line-height:1.2!important;margin-bottom:28px!important;}';
    echo '.ne-shop-branding p{font-family:"Cormorant Garamond",serif!important;color:#c8b07a!important;font-size:20px!important;line-height:1.9!important;max-width:860px!important;margin:0 auto 18px!important;}';
    echo 'body.post-type-archive-product .woocommerce ul.products li.product.entry.content-bg.loop-entry.product{background:#0a0a0a!important;background-color:#0a0a0a!important;}';
    echo 'body.post-type-archive-product .woocommerce ul.products li.product .product-details.content-bg.entry-content-wrap{background:#0a0a0a!important;background-color:#0a0a0a!important;}';
    echo 'body.post-type-archive-product.content-style-unboxed .content-bg.loop-entry .content-bg:not(.loop-entry),body.content-style-unboxed.post-type-archive-product .content-bg.loop-entry .content-bg:not(.loop-entry),body.post-type-archive-product .content-bg.loop-entry .content-bg:not(.loop-entry){background:#0a0a0a!important;background-color:#0a0a0a!important;}';
    echo 'body.post-type-archive-product .woocommerce ul.products li.product .woocommerce-loop-product__title,body.post-type-archive-product .woocommerce ul.products li.product .woocommerce-loop-product__title a,body.post-type-archive-product .woocommerce ul.products li.product .price,body.post-type-archive-product .woocommerce ul.products li.product .price *{color:#f5f0e8!important;}';
    echo '.site-footer .site-bottom-footer-wrap,.site-footer .site-bottom-footer-inner-wrap,.site-footer .footer-copyright-wrap,.site-footer .site-info,.site-footer .site-info-container,.site-footer .footer-html,.site-footer .kadence-copyright{display:none!important;height:0!important;min-height:0!important;padding:0!important;margin:0!important;border:0!important;background:transparent!important;}';
    echo '</style>';
}
add_action('wp_head', 'ne_shop_inline_fixes', 999);

