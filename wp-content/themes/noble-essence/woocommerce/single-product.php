<?php
/**
 * Single product template — Noble Essence
 */

defined('ABSPATH') || exit;
get_header();

while (have_posts()) : the_post();
    global $product;

    $product_id = get_the_ID();
    $slug = get_post_field('post_name', $product_id);
    $title = get_the_title();
    $price_html = $product ? $product->get_price_html() : '';
    $short_description = apply_filters('woocommerce_short_description', $post->post_excerpt ?? '');
    $description = apply_filters('the_content', get_the_content());
    $categories = wc_get_product_category_list($product_id, ', ');
    $image_id = $product ? $product->get_image_id() : 0;
    $image_alt = $title . ' — extrait de parfum niche — Noble Essence';
    $fallback_images = [
        'samarcande-extrait-de-parfum-50-ml-parfum-epice-tabac-cuir' => home_url('/wp-content/uploads/2026/04/file_00000000c35c7243a9ec62b2477902ce.png'),
        'yuzu-nara' => home_url('/wp-content/uploads/2026/04/yuzu-nara-extrait-de-parfum-agrumes.png'),
        'yuzu-nara-extrait-de-parfum-50-ml' => home_url('/wp-content/uploads/2026/04/yuzu-nara-extrait-de-parfum-agrumes.png'),
        'rio-grande' => home_url('/wp-content/uploads/2026/04/file_00000000698072468990153c612023f3.png'),
        'rio-grande-extrait-de-parfum-50-ml' => home_url('/wp-content/uploads/2026/04/file_00000000698072468990153c612023f3.png'),
    ];
    if ($image_id) {
        $image_html = wp_get_attachment_image($image_id, 'large', false, ['alt' => $image_alt, 'loading' => 'eager', 'fetchpriority' => 'high', 'class' => 'ne-product-hero-image']);
    } elseif (!empty($fallback_images[$slug])) {
        $image_html = '<img src="' . esc_url($fallback_images[$slug]) . '" alt="' . esc_attr($image_alt) . '" class="ne-product-hero-image" loading="eager" fetchpriority="high">';
    } else {
        $image_html = '<div class="ne-product-image-placeholder"><!-- Image produit manquante pour ' . esc_html($slug) . ' --></div>';
    }

    $defaults = [
        'samarcande-extrait-de-parfum-50-ml-parfum-epice-tabac-cuir' => [
            'family' => 'Tabac · Épices · Cuir',
            'impact' => 'Une densité sombre, chaude, résineuse.',
            'story_1' => 'Samarcande avance comme une route ancienne. Le tabac, le safran et le cuir construisent une matière dense, tenue par une chaleur sèche.',
            'story_2' => 'Le parfum garde du relief, du poids, et une vraie ligne. Rien de décoratif. Tout repose sur la trace.',
            'for' => 'Pour les profils attirés par les matières sombres, les épices et les sillages à forte présence.',
            'when' => 'Le soir, en automne, en hiver, ou dès qu’une présence plus dense devient juste.',
            'intensity' => 'Dense',
            'trail' => 'Marqué',
            'moment' => 'Soir · Temps froid',
            'material_link' => '/tabac-en-parfumerie/',
            'material_label' => 'Le tabac en parfumerie',
            'category_link' => '/categorie/parfums-orientaux-epices/',
            'category_label' => 'Parfums orientaux et épicés',
        ],
        'yuzu-nara' => [
            'family' => 'Citrus · Floral · Japonais',
            'impact' => 'Une lumière nette, minérale, tenue par le yuzu.',
            'story_1' => 'Yuzu Nara construit une fraîcheur calme. Le cédrat, le yuzu et les fleurs blanches ouvrent un espace plus sec, plus minéral, plus tenu.',
            'story_2' => 'Le parfum reste lisible, précis, traversé d’air et de bois clair. Une fraîcheur qui garde du caractère.',
            'for' => 'Pour les profils attirés par les agrumes nets, les floraux légers et les matières japonaises.',
            'when' => 'En journée, au printemps, en été, ou quand il faut de la clarté sans fadeur.',
            'intensity' => 'Modérée',
            'trail' => 'Net',
            'moment' => 'Jour · Temps clair',
            'material_link' => '/yuzu-en-parfumerie/',
            'material_label' => 'Le yuzu en parfumerie',
            'category_link' => '/categorie/parfums-citruses-floraux/',
            'category_label' => 'Parfums citruses et floraux',
        ],
        'rio-grande' => [
            'family' => 'Agrumes · Encens · Vanille',
            'impact' => 'Un désert minéral traversé d’agrumes et de myrrhe.',
            'story_1' => 'Rio Grande pose une chaleur sèche, salée, résineuse. Le pamplemousse et le kumquat ouvrent la marche avant que le cèdre, la sauge et la myrrhe prennent le relais.',
            'story_2' => 'Le fond garde de l’air et du poids. Une tension solaire, jamais molle, tenue par les résines et la vanille.',
            'for' => 'Pour les profils attirés par les agrumes secs, les résines et les sillages plus solaires que sucrés.',
            'when' => 'En fin de journée, sur peau chaude, ou quand un parfum sec et ample devient plus juste.',
            'intensity' => 'Chaleureuse',
            'trail' => 'Présent',
            'moment' => 'Fin de jour · Temps sec',
            'material_link' => '/encens-en-parfumerie/',
            'material_label' => 'L\'encens en parfumerie',
            'category_link' => '/categorie/parfums-chauds-resineux/',
            'category_label' => 'Parfums chauds et résineux',
        ],
    ];

    $data = $defaults[$slug] ?? [
        'family' => 'Extrait de parfum',
        'impact' => 'Un parfum de caractère construit autour des matières.',
        'story_1' => 'Chaque parfum Noble Essence suit une ligne claire. Une matière, un territoire, une trace.',
        'story_2' => 'La formule cherche la tenue, la lisibilité et le sillage sans surcharge.',
        'for' => 'Pour les profils qui cherchent un parfum lisible, construit et durable.',
        'when' => 'Quand une présence plus tenue devient juste.',
        'intensity' => 'Présence',
        'trail' => 'Tenue',
        'moment' => 'Jour et soir',
        'material_link' => '/la-maison/',
        'material_label' => 'La maison Noble Essence',
        'category_link' => '/parfums/',
        'category_label' => 'La collection Noble Essence',
    ];

    $related_args = [
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 2,
        'post__not_in' => [$product_id],
        'orderby' => 'menu_order title',
        'order' => 'ASC',
    ];
    $related = new WP_Query($related_args);
    ?>

    <main class="ne-product-page">
        <section class="ne-product-hero ne-section">
            <div class="ne-product-hero-grid ne-fade-in">
                <div class="ne-product-hero-media"><?php echo $image_html; ?></div>
                <div class="ne-product-hero-content">
                    <span class="label-or">Extrait de parfum · Noble Essence</span>
                    <h1><?php echo esc_html($title); ?></h1>
                    <p class="ne-product-family"><?php echo esc_html($data['family']); ?></p>
                    <p class="ne-product-impact"><?php echo esc_html($data['impact']); ?></p>
                    <?php if ($price_html) : ?>
                        <div class="ne-product-price-wrap"><?php echo wp_kses_post($price_html); ?></div>
                    <?php endif; ?>
                    <?php if ($short_description) : ?>
                        <div class="ne-product-short-description"><?php echo wp_kses_post($short_description); ?></div>
                    <?php endif; ?>
                    <div class="ne-product-buyline">Extrait de parfum 50 ml · Présence tenue · Maison de caractère</div>
                    <div class="ne-product-cart-wrap">
                        <?php woocommerce_template_single_add_to_cart(); ?>
                    </div>
                    <div class="ne-product-micro-reassurance">
                        <span>Livraison soignée</span>
                        <span>Paiement sécurisé</span>
                        <span>Extrait de parfum</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="ne-section ne-section--alt">
            <div class="ne-product-story ne-fade-in">
                <div class="ne-section-header ne-section-header--left">
                    <span class="label-or">Territoire</span>
                    <h2><?php echo esc_html($title); ?> — sillage, matière et caractère</h2>
                </div>
                <div class="ne-product-story-grid">
                    <div>
                        <p><?php echo esc_html($data['story_1']); ?></p>
                        <p><?php echo esc_html($data['story_2']); ?></p>
                    </div>
                    <div class="ne-product-meta-card">
                        <h3>Repères</h3>
                        <ul>
                            <li><strong>Pour qui :</strong> <?php echo esc_html($data['for']); ?></li>
                            <li><strong>Quand :</strong> <?php echo esc_html($data['when']); ?></li>
                            <li><strong>Intensité :</strong> <?php echo esc_html($data['intensity']); ?></li>
                            <li><strong>Sillage :</strong> <?php echo esc_html($data['trail']); ?></li>
                            <li><strong>Moment :</strong> <?php echo esc_html($data['moment']); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="ne-section">
            <div class="ne-product-description ne-fade-in">
                <div class="ne-section-header ne-section-header--left">
                    <span class="label-or">Pyramide olfactive</span>
                    <h2>Notes de tête, cœur et fond</h2>
                </div>
                <div class="ne-product-long-description"><?php echo wp_kses_post($description); ?></div>
            </div>
        </section>

        <section class="ne-section ne-section--alt2">
            <div class="ne-product-links ne-fade-in">
                <div class="ne-section-header ne-section-header--left">
                    <span class="label-or">Maillage</span>
                    <h2>Approfondir l’univers <?php echo esc_html($title); ?></h2>
                </div>
                <div class="ne-product-links-grid">
                    <a class="ne-product-link-card" href="<?php echo esc_url(home_url($data['material_link'])); ?>">
                        <h3><?php echo esc_html($data['material_label']); ?></h3>
                        <p>Comprendre la matière qui structure le parfum.</p>
                    </a>
                    <a class="ne-product-link-card" href="<?php echo esc_url(home_url($data['category_link'])); ?>">
                        <h3><?php echo esc_html($data['category_label']); ?></h3>
                        <p>Explorer la famille olfactive liée à cette création.</p>
                    </a>
                    <a class="ne-product-link-card" href="<?php echo esc_url(home_url('/parfums/')); ?>">
                        <h3>La collection Noble Essence</h3>
                        <p>Voir les autres extraits de parfum de la maison.</p>
                    </a>
                </div>
            </div>
        </section>

        <?php if ($related->have_posts()) : ?>
            <section class="ne-section">
                <div class="ne-fade-in">
                    <div class="ne-section-header ne-section-header--left">
                        <span class="label-or">Autres créations</span>
                        <h2>Deux autres sillages de la maison</h2>
                    </div>
                    <div class="ne-products-grid ne-products-grid--related">
                        <?php while ($related->have_posts()) : $related->the_post(); global $product; ?>
                            <article class="ne-product-card">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium_large', ['class' => 'ne-product-card-img', 'loading' => 'lazy']); ?>
                                    <?php else : ?>
                                        <div class="ne-product-card-img ne-product-card-img--placeholder"></div>
                                    <?php endif; ?>
                                </a>
                                <div class="ne-product-card-body">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <p><?php echo esc_html(get_the_excerpt()); ?></p>
                                    <a class="ne-btn-text" href="<?php the_permalink(); ?>">Voir le parfum →</a>
                                </div>
                            </article>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <?php
endwhile;

get_footer();
