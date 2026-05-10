<?php get_header('minimal'); ?>

<header class="ne-header">
  <a href="<?php echo home_url(); ?>" class="ne-logo">Noble Essence</a>
  <nav><ul class="ne-nav">
    <li><a href="<?php echo home_url('/boutique/'); ?>">Parfums</a></li>
    <li><a href="<?php echo home_url('/blog/'); ?>">Blog</a></li>
    <li><a href="<?php echo home_url('/la-maison/'); ?>">La Maison</a></li>
    <li><a href="<?php echo home_url('/contact/'); ?>">Contact</a></li>
  </ul></nav>
  <div class="ne-header-right">
    <a href="<?php echo wc_get_cart_url(); ?>" class="ne-cart-link">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c9a84c" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
      <?php if(function_exists('WC')): $count = WC()->cart->get_cart_contents_count(); if($count > 0): ?><span class="ne-cart-count"><?php echo $count; ?></span><?php endif; endif; ?>
    </a>
    <button class="ne-burger" aria-label="Menu">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#c9a84c" stroke-width="1.5"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
  </div>
</header>

<div class="ne-mobile-menu">
  <button class="ne-mobile-close">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#c9a84c" stroke-width="1.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
  </button>
  <nav class="ne-mobile-nav">
    <span class="label-or">La Collection</span>
    <a href="<?php echo home_url('/boutique/'); ?>">Tous les parfums</a>
    <span class="label-or">L'Univers</span>
    <a href="<?php echo home_url('/blog/'); ?>">Le Blog</a>
    <a href="<?php echo home_url('/la-maison/'); ?>">La Maison</a>
    <a href="<?php echo home_url('/contact/'); ?>">Contact</a>
  </nav>
</div>

<!-- HERO -->
<section class="ne-hero">
  <div class="ne-hero-bg" style="background-image:url('<?php echo home_url('/wp-content/uploads/2026/05/collection-noble-essence-48.png'); ?>')"></div>
  <div class="ne-hero-overlay"></div>
  <div class="ne-hero-content">
    <span class="label-or">✦ Parfumerie de niche française ✦</span>
    <h1>Trois extraits.<br>Un caractère sans compromis.</h1>
    <span class="ne-hero-tagline">Des matières premières choisies. Concentration 20 %. Un sillage qui dure.</span>
    <div class="ne-hero-ctas">
      <a href="#ne-collection" class="ne-btn">Découvrir la collection</a>
      <a href="<?php echo home_url('/la-maison/'); ?>" class="ne-btn-text">La Maison →</a>
    </div>
  </div>
  <div class="ne-scroll-arrow">
    <svg width="24" height="40" viewBox="0 0 24 40"><path d="M12 2v28M4 22l8 8 8-8" fill="none" stroke="#c9a84c" stroke-width="1.5"/></svg>
  </div>
</section>

<!-- EDITORIAL -->
<section class="ne-editorial">
  <div class="ne-separator"></div>
  <blockquote>Une matière. Un territoire. Une trace.</blockquote>
  <div class="ne-separator"></div>
</section>

<section class="ne-section" id="parfums">
  <div class="ne-section-header ne-fade-in">
    <span class="label-or">La Collection</span>
    <h2>La collection Noble Essence</h2>
  </div>
  <div class="ne-products-grid">
    <?php
    $products = new WP_Query(["post_type"=>"product","posts_per_page"=>3,"orderby"=>"menu_order","order"=>"ASC","post_status"=>"publish","post__in"=>[123,150,151]]);
    $accents = ["samarcande-extrait-de-parfum-50-ml-parfum-epice-tabac-cuir"=>["color"=>"#b8863a","famille"=>"Épicé · Tabac · Cuir","desc"=>"Safran, cannelle, labdanum. Une caravane au crépuscule."],"yuzu-nara-extrait-de-parfum-50-ml"=>["color"=>"#d4c47a","famille"=>"Citrus · Floral · Japonais","desc"=>"Cédrat, yuzu, lotus. L air d un jardin de pierre."],"rio-grande-extrait-de-parfum-50-ml"=>["color"=>"#c4923a","famille"=>"Agrumes · Encens · Vanille","desc"=>"Pamplemousse, sel, myrrhe. Le désert après la pluie."]];
    if($products->have_posts()):while($products->have_posts()):$products->the_post();
    $slug=get_post_field("post_name",get_the_ID());
    $accent=$accents[$slug]??["color"=>"#c9a84c","famille"=>"","desc"=>""];
    $price=get_post_meta(get_the_ID(),"_regular_price",true);
    ?>
    <article class="ne-product-card ne-fade-in">
      <a href="<?php the_permalink();?>"><?php if(has_post_thumbnail()):the_post_thumbnail("large",["class"=>"ne-product-card-img","loading"=>"lazy"]);else:?><div class="ne-product-card-img" style="background:#1a1a1a;min-height:400px;"></div><?php endif;?></a>
      <div class="ne-product-card-body">
        <span class="ne-product-famille" style="color:<?php echo $accent["color"];?>"><?php echo $accent["famille"];?></span>
        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
        <p><?php echo $accent["desc"];?></p>
        <?php if($price):?><div class="ne-product-price"><?php echo $price;?> €</div><?php endif;?>
        <a href="<?php the_permalink();?>" class="ne-btn-text">Découvrir →</a>
      </div>
    </article>
    <?php endwhile;wp_reset_postdata();endif;?>
  </div>
</section>

<!-- UNIVERS -->
<section class="ne-univers">
  <img src="<?php echo home_url('/wp-content/uploads/2026/05/collection-noble-essence-10.png'); ?>" alt="Noble Essence — parfumerie de niche française" class="ne-univers-img" loading="lazy">
  <div class="ne-univers-content ne-fade-in">
    <span class="label-or">L'Esprit Noble Essence</span>
    <h2 style="color:#f5f0e8;">Noble Essence naît d'un refus.</h2>
    <p>Celui du parfum standardisé, du sillage oublié sitôt posé, du flacon sans histoire. Trois créations. Des matières premières choisies pour leur densité, leur caractère, leur persistance.</p>
    <p>Un <a href="<?php echo home_url('/quest-ce-quun-extrait-de-parfum-differences-avec-leau-de-parfum-et-ledt/'); ?>">extrait de parfum</a> concentre l'essentiel — trente pour cent de matières, un sillage qui traverse les heures.</p>
    <div class="ne-univers-cta">
      <a href="<?php echo home_url('/la-maison/'); ?>" class="ne-btn-text">La philosophie de la maison →</a>
    </div>
  </div>
</section>




<section class="ne-collection-split">
 <div class="ne-collection-split-content">
  <span class="label-or">Parfumerie de Niche Française</span>
  <h2>Samarcande. Yuzu Nara. Rio Grande.</h2>
  <p>Trois extraits de parfum de niche formulés à 30 %. Trois territoires olfactifs — oriental épicé, citrus floral japonais, agrumes résineux. Une seule exigence : le caractère.</p>
  <a href="<?php echo home_url('/boutique/'); ?>" class="ne-btn">Découvrir la collection →</a>
 </div>
 <div class="ne-collection-split-img">
  <img src="https://noble-essence.fr/wp-content/uploads/2026/05/collection-noble-essence-14.png" alt="Collection Noble Essence" loading="lazy">
 </div>
</section>

<!-- MATIERES -->
<section class="ne-section ne-section--alt2">
  <div class="ne-section-header ne-fade-in">
    <span class="label-or">Les Matières</span>
    <h2 style="color:#f5f0e8;">Les ingrédients qui construisent nos parfums</h2>
  </div>
  <div class="ne-matieres-grid">
    <?php
    $matieres = [
      ['label' => 'Le tabac', 'desc' => 'Sec. Profond. Animal.', 'url' => home_url('/tabac-en-parfumerie/'), 'img' => home_url('/wp-content/uploads/2026/04/feuille-de-tabac.jpg')],
      ['label' => 'Le cuir', 'desc' => 'Noble. Dense. Tenace.', 'url' => home_url('/cuir-en-parfumerie/'), 'img' => home_url('/wp-content/uploads/2026/04/cuir.jpg')],
      ['label' => 'Le yuzu', 'desc' => 'Vif. Zesté. Japonais.', 'url' => home_url('/yuzu-en-parfumerie/'), 'img' => home_url('/wp-content/uploads/2026/04/parfum-frais-citron-bergamote.jpg')],
      ['label' => "L'encens", 'desc' => 'Fumé. Résineux. Sacré.', 'url' => home_url('/encens-en-parfumerie/'), 'img' => home_url('/wp-content/uploads/2026/04/myrrhe.jpg')],
    ];
    foreach ($matieres as $m): ?>
    <a href="<?php echo $m['url']; ?>" class="ne-matiere-item ne-fade-in">
      <img src="<?php echo $m['img']; ?>" alt="<?php echo $m['label']; ?> en parfumerie — Noble Essence" class="ne-matiere-img" loading="lazy">
      <h3><?php echo $m['label']; ?></h3>
      <p><?php echo $m['desc']; ?></p>
    </a>
    <?php endforeach; ?>
  </div>
</section>

<!-- BLOG -->
<?php
$blog_posts = new WP_Query(['post_type' => 'post', 'posts_per_page' => 8, 'post_status' => 'publish']);
if ($blog_posts->have_posts()): ?>
<section class="ne-section ne-section--alt">
  <div class="ne-section-header ne-fade-in">
    <span class="label-or">Le Journal</span>
    <h2 style="color:#f5f0e8;">Comprendre la parfumerie de niche</h2>
    <p>Guides olfactifs, matières premières et conseils. Pour choisir et porter son extrait de parfum.</p>
  </div>
  <div class="ne-blog-grid">
    <?php $blog_posts->the_post(); ?>
    <article class="ne-blog-article ne-fade-in">
      <?php if (has_post_thumbnail()): the_post_thumbnail('large', ['loading' => 'lazy']); endif; ?>
      <div class="ne-blog-article-body">
        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
        <a href="<?php the_permalink(); ?>" class="ne-btn-text" style="margin-top:16px;display:inline-block;">Lire l'article →</a>
      </div>
    </article>
    <div class="ne-blog-secondary">
      <?php while ($blog_posts->have_posts()): $blog_posts->the_post(); ?>
      <article class="ne-blog-article ne-blog-article-small ne-fade-in">
        <?php if (has_post_thumbnail()): the_post_thumbnail('thumbnail', ['loading' => 'lazy']); endif; ?>
        <div>
          <h3 style="font-size:16px;color:#f5f0e8;"><a href="<?php the_permalink(); ?>" style="color:#f5f0e8;"><?php the_title(); ?></a></h3>
        </div>
      </article>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
  <div class="ne-blog-cta ne-fade-in">
    <a href="<?php echo home_url('/blog/'); ?>" class="ne-btn-text">Voir tous les articles →</a>
  </div>
</section>
<?php endif; ?>

<!-- NEWSLETTER -->
<section class="ne-newsletter">
  <span class="label-or">Restez dans l'univers</span>
  <h2 style="color:#f5f0e8;">Nouvelles créations. Matières. Destinations.</h2>
  <p style="color:#f5f0e8;">Une newsletter rare. Comme nos parfums.</p>
  <?php echo str_replace(array("Email Address", "Subscribe"), array("Votre adresse email", "S'inscrire"), do_shortcode("[sibwp_form id=2]")); ?>
</section>

<!-- REASSURANCE -->
<div class="ne-reassurance">
  <span>Extrait de parfum · concentration 30 %</span>
  <span class="ne-reassurance-sep">·</span>
  <span>Livraison soignée · emballage protégé</span>
  <span class="ne-reassurance-sep">·</span>
  <span>Paiement sécurisé · CB · PayPal</span>
</div>

<!-- FOOTER -->
<footer class="ne-footer">
  <div class="ne-footer-grid">
    <div>
      <div class="ne-footer-logo">Noble Essence</div>
      <div class="ne-footer-tagline">Le sillage comme territoire.</div>
      <a href="mailto:nobleessenceparfum@gmail.com" style="font-size:13px;color:var(--color-text-secondary);">nobleessenceparfum@gmail.com</a>
    </div>
    <div>
      <h4>Nos parfums</h4>
      <ul>
        <li><a href="<?php echo home_url('/produit/samarcande-extrait-de-parfum-50-ml-parfum-epice-tabac-cuir/'); ?>">Samarcande</a></li>
        <li><a href="<?php echo home_url('/produit/yuzu-nara-extrait-de-parfum-50-ml/'); ?>">Yuzu Nara</a></li>
        <li><a href="<?php echo home_url('/produit/rio-grande-extrait-de-parfum-50-ml/'); ?>">Rio Grande</a></li>
        <li><a href="<?php echo home_url('/boutique/'); ?>">Toute la collection</a></li>
        <li><a href="<?php echo home_url('/blog/'); ?>">Le blog</a></li>
      </ul>
    </div>
    <div>
      <h4>La maison</h4>
      <ul>
        <li><a href="<?php echo home_url('/la-maison/'); ?>">Notre philosophie</a></li>
        <li><a href="<?php echo home_url('/contact/'); ?>">Contact</a></li>
        <li><a href="<?php echo home_url('/mentions-legales/'); ?>">Mentions légales</a></li>
        <li><a href="<?php echo home_url('/conditions-generales-de-vente/'); ?>">CGV</a></li>
        <li><a href="<?php echo home_url('/politique-de-confidentialite/'); ?>">Confidentialité</a></li>
        <li><a href="<?php echo home_url('/remboursements_retours/'); ?>">Retours</a></li>
      </ul>
    </div>
  </div>
  <div class="ne-footer-bottom">© <?php echo date('Y'); ?> Noble Essence · Tous droits réservés</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
