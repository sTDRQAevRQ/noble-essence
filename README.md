# noble-essence
Site noble-essence.fr
# Noble Essence — noble-essence.fr

Parfumerie de niche française — Extraits de parfum de caractère.

---

## Stack technique

| Composant | Détail |
|-----------|--------|
| CMS | WordPress 6.9.4 |
| Thème | Kadence |
| E-commerce | WooCommerce + Stripe + PayPal |
| SEO | SEOPress (free) |
| Email marketing | MailPoet |
| Analytics | Google Site Kit (GA4 + Search Console) |
| Hébergement | IONOS |

---

## Produits

| Nom | SKU | Prix | Famille | Statut |
|-----|-----|------|---------|--------|
| Samarcande – Extrait 50ml | samarcande-extrait-parfum-niche-oriental | 120 € | Oriental épicé | ✅ |
| Yuzu Nara – Extrait 50ml | yuzu-nara-extrait-parfum-niche-citrus | 120 € | Citrus floral | ✅ |
| Rio Grande – Extrait 50ml | rio-grande-extrait-parfum-niche-agrumes | 120 € | Agrumes encensé | ✅ |

---

## Pages

| Page | URL | Index | Statut |
|------|-----|-------|--------|
| Accueil | / | ✅ | ✅ Publié |
| La Maison | /la-maison/ | ✅ | ✅ Publié |
| Parfums | /parfums/ | ✅ | ✅ Publié |
| Boutique | /boutique/ | ✅ | ✅ Publié |
| Blog | /blog/ | ✅ | ✅ Publié |
| Contact | /contact/ | ✅ | ✅ Publié |
| Mentions légales | /mentions-legales/ | ❌ noindex | ✅ Publié |
| CGV | /conditions-generales-de-vente/ | ❌ noindex | ✅ Publié |
| Politique de confidentialité | /politique-de-confidentialite/ | ❌ noindex | ✅ Publié |
| Politique de retour | /politique-en-matiere-de-remboursements/ | ❌ noindex | ✅ Publié |
| Avis clients | /avis-clients/ | ❌ noindex | ✅ Publié |

---

## Articles de blog

| Article | Keyword cible | Statut |
|---------|---------------|--------|
| Extrait vs EdP vs EdT | différence extrait eau de parfum EDT | ✅ |
| Parfum de niche : définition | parfum de niche definition | ✅ |
| Faire tenir son parfum | faire tenir un parfum longtemps | ✅ |
| Le tabac en parfumerie | note tabac parfumerie | ✅ |
| Le cuir en parfumerie | note cuir parfumerie | ✅ |
| Le yuzu en parfumerie | yuzu parfumerie japonais | ✅ |
| L'encens en parfumerie | encens oliban parfumerie | ✅ |

---

## SEO — état complet ✅

### SEOPress (meta par post)
- [x] _seopress_titles_title — tous les contenus indexés
- [x] _seopress_titles_desc — tous les contenus indexés (≤155 car)
- [x] _seopress_analysis_target_kw — tous les contenus
- [x] _seopress_social_og_title + _seopress_social_og_desc — 3 produits + homepage
- [x] _seopress_robots_index: noindex — 5 pages légales/utilitaires
- [x] _seopress_scripts_header — JSON-LD injecté sur 3 produits + homepage + 3 articles

### Schema.org JSON-LD
- [x] Product (name, description, brand, sku, image, offers, additionalProperty) — 3 produits
- [x] Organization + WebSite + ItemList — homepage
- [x] Article (headline, author, publisher, datePublished) — 3 articles blog

### Images
- [x] Alt textes SEO sur ~25 images (flacons, ingrédients, collection)
- [x] Titres et légendes sur toutes les images produits
- [x] Galeries produits : 3 images par produit
- [x] Featured images sur tous les articles et pages

---

## Design & UX ✅

### CSS luxe (custom CSS Kadence)
Variables : --ne-gold: #b8962e | --ne-dark: #1a1a18 | --ne-serif: Georgia

- Typographie serif sur titres produits
- Boutons noirs → or au hover, border-radius 0, uppercase
- Pyramide olfactive 3 colonnes avec marqueur ✦
- Séparateurs dorés, caractéristiques produit en grille

### Homepage
- [x] Hero cover plein écran avec image collection, titre centré, CTA double
- [x] Section collection 3 colonnes (image + famille + titre + tagline + prix + CTA)
- [x] Bandeau sombre "Engagement Noble Essence" (3 piliers)
- [x] Section blog 3 articles avec liens
- [x] Liens corrects vers toutes les URLs existantes
- [x] Références à des parfums inexistants supprimées

### Navigation
- [x] Menu principal complet : Accueil / La Maison / Parfums / Boutique / Blog / Contact

### Pages produits
- [x] Tagline italique dorée
- [x] Pyramide 3 colonnes (Tête / Cœur / Fond)
- [x] Fiche caractéristiques (concentration, contenance, famille, tenue, saison, occasion)
- [x] Paragraphe narratif "L'histoire du parfum"

---

## Pages légales ✅ (conformes droit français)

| Page | Contenu clé |
|------|-------------|
| Mentions légales | Éditeur, hébergeur IONOS, PI, RGPD, cookies, responsabilité |
| CGV | Rétractation 14j (L221-18), exception produit ouvert (L221-28), garanties légales |
| Politique de confidentialité | RGPD complet, droits ARCO, CNIL, durées conservation |
| Politique de retour | 14j, procédure email, remboursement 14j, frais retour client |

---

## Tunnel de conversion — état

- 0 commande complétée (2 paniers abandonnés en draft)
- Pages panier / checkout / confirmation en place (WooCommerce natif)
- Stripe + PayPal configurés
- ⚠️ Emails WooCommerce non personnalisés (template natif WooCommerce)
- ⚠️ MailPoet installé, non configuré

---

## À faire — priorités

### Urgent
- [ ] Tester tunnel complet : passer commande test, vérifier email confirmation
- [ ] Personnaliser emails WooCommerce (header, couleurs, signature Noble Essence)
- [ ] Connecter Google Search Console via Site Kit + soumettre sitemap

### Court terme
- [ ] MailPoet : email de bienvenue + séquence post-achat (J+1 remerciement, J+7 avis)
- [ ] Vérifier CSS mobile sur pages produits
- [ ] Créer menu footer Kadence avec liens légaux
- [ ] Valider JSON-LD via Google Rich Results Test (search.google.com/test/rich-results)

### Moyen terme
- [ ] Remplacer avis clients démo par vrais retours
- [ ] 3 articles de blog supplémentaires (objectif 10 avant netlinking)
- [ ] Campagne netlinking : annuaires parfumerie, guest posts, forums niche
- [ ] Envisager 4e parfum si extension de gamme

---

## Git

Le dépôt est administré depuis le VPS avec une connexion SSH GitHub fonctionnelle.

Commandes usuelles :

```bash
git status
git add .
git commit -m "message"
git push origin main

