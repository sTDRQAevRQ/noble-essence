<?php
// Noble Essence — functions.php

// Chargement des styles et scripts
function ne_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style('ne-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&family=Inter:wght@300;400&display=swap', [], null);
    // Style parent Kadence
    wp_enqueue_style('kadence-style', get_template_directory_uri() . '/style.css');
    // Style enfant Noble Essence
    wp_enqueue_style('ne-style', get_stylesheet_uri(), ['kadence-style'], '1.0.0');
    // Script animations
    wp_enqueue_script('ne-script', get_stylesheet_directory_uri() . '/assets/js/main.js', [], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'ne_enqueue_assets');

// Schema.org Organization
function ne_schema_org() {
    if (!is_front_page()) return;
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'Noble Essence',
        'url' => 'https://noble-essence.fr',
        'logo' => 'https://noble-essence.fr/wp-content/themes/noble-essence/assets/img/logo.png',
        'email' => 'nobleessenceparfum@gmail.com',
        'description' => 'Parfumerie de niche française — Extraits de parfum de caractère',
        'sameAs' => []
    ];
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
}
add_action('wp_head', 'ne_schema_org');

// Open Graph
function ne_open_graph() {
    if (!is_front_page()) return;
    echo '<meta property="og:title" content="Noble Essence — Parfumerie de Niche">';
    echo '<meta property="og:description" content="Extraits de parfum de caractère. Tabac, cuir, épices, agrumes, encens.">';
    echo '<meta property="og:type" content="website">';
    echo '<meta property="og:url" content="https://noble-essence.fr">';
    echo '<meta name="twitter:card" content="summary_large_image">';
}
add_action('wp_head', 'ne_open_graph');

// Titre SEO homepage
function ne_home_title($title) {
    if (is_front_page()) {
        $title['title'] = 'Parfum niche épicé tabac cuir | Noble Essence';
    }
    return $title;
}
add_filter('document_title_parts', 'ne_home_title');

// Support thème
function ne_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('html5', ['search-form', 'comment-form', 'gallery', 'caption']);
}
add_action('after_setup_theme', 'ne_theme_setup');

// Menus
function ne_register_menus() {
    register_nav_menus([
        'primary' => 'Navigation principale',
        'footer'  => 'Navigation footer',
    ]);
}
add_action('init', 'ne_register_menus');

// Désactiver jQuery pour les animations (on utilise IntersectionObserver natif)
function ne_deregister_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'ne_deregister_jquery');
