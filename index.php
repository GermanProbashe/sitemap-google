<?php
/*
Plugin Name: Sitemap Support
Plugin URI: http://www.germanprobashe.com
Description: URL-List for Google to crawl. Usage: http://www.example.com/?sitemap=sitemap
Version: 4.1
*/

function g24ekdl2389_sitemap_callback() {
	if( isset($_REQUEST['sitemap']) == false)
	{
		return;
	}
	$cats = get_categories('exclude=');
	echo '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	foreach ($cats as $cat) 
	{
		//echo $cat->cat_name;
		$archive_query = new WP_Query('posts_per_page=-1&order=asc&orderby=title&cat='.$cat->cat_ID);
		while ($archive_query->have_posts()) 
		{
			$archive_query->the_post();
			
			$modifiedDate = get_the_modified_date('c');
			$permalink = get_permalink();
			
			echo "<url><loc>$permalink</loc><lastmod>$modifiedDate</lastmod></url>";
			echo "<url><loc>$permalink/amp</loc><lastmod>$modifiedDate</lastmod></url>";
		}
	}
	echo '</urlset>';
	die;
}

add_action( 'init', 'g24ekdl2389_sitemap_callback' );
