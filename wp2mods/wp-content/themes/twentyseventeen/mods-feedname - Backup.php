<?php
/**
 * RSS Feed Template by Julia N.  Modifued by Luis Millan original at https://wpmayor.com/how-to-create-custom-rss-feeds-wordpress/
 */
$limitCount = 0; // The posts limit to show
$posts = query_posts('showposts=' . $limitCount);
 
 
// Setting up content type and charset headers 
header('Content-Type: '.feed_content_type('rss-http').';charset='.get_option('blog_charset'), true);
 
// Setting up valid XML encoding fcsfd
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?> 
 
<!-- Declaring XML Validator  -->
<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" 
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
        xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/ http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">
<!-- Declaring channel with articles data --> 
<?php $dateTimeFormat = 'D, M d Y H:i:s'; ?>
<ListRecords>
        <responseDate>Solong</responseDate>
        <request verb="ListRecords" metadataPrefix="mods"><?php echo get_site_url(); ?></request>
<!--   Website Information     -->
        <title><?php bloginfo_rss('name'); ?> - Feed</title>
        <nose>Yay</nose>
        <link><?php bloginfo_rss('url') ?></link>
        <description><?php bloginfo_rss('description') ?></description>
        <lastBuildDate><?php echo mysql2date($dateTimeFormat, get_lastpostmodified(), false); ?></lastBuildDate>
        <language><?php echo get_option('rss_language'); ?></language>
      
        <?php do_action('rss2_head'); ?>
        <?php while (have_posts()) : the_post(); ?>
                <record>
                        <title><?php the_title_rss(); ?></title>
                        <ID><?php echo get_post_meta(get_the_ID(),"title",true) ?></ID>
                        <link><?php the_permalink_rss(); ?></link>
                        <pubDate><?php echo mysql2date($dateTimeFormat, get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
                      
                        <guid isPermaLink="false"><?php the_guid(); ?></guid>
                        <description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
                       
                        <?php rss_enclosure(); ?>
                        <?php do_action('rss2_item'); ?>
                </record>
        <?php endwhile; ?>
</ListRecords>
</OAI-PMH>