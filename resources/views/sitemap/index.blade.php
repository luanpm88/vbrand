<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ url('sitemap-posts.xml') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ url('sitemap-category.xml') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ url('sitemap-tags.xml') }}</loc>
    </sitemap>
    <sitemap>
        <loc>{{ url('sitemap-products.xml') }}</loc>
    </sitemap>
</sitemapindex>