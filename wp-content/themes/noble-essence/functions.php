<?php
function ne_enqueue_assets() {
    wp_enqueue_style('ne-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Inter:wght@300;400&display=swap', [], null);
    wp_enqueue_style('kadence-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('ne-style', get_stylesheet_uri(), ['kadence-style'], '1.0.0');
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
    if (is_front_page() || is_shop() || is_product_category() || is_product()) {
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
}
add_action('wp', 'ne_remove_kadence_footer_credit', 20);
