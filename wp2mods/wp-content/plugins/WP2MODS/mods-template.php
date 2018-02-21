<?php
/**
 * RSS Feed Template by Julia N.  Modifued by Luis Millan original at https://wpmayor.com/how-to-create-custom-rss-feeds-wordpress/
 */
$limitCount = 7; // The posts limit to show
$posts = query_posts('showposts=' . $limitCount);
 
 
// Setting up content type and charset headers 
header('Content-Type: '.feed_content_type('rss-http').';charset='.get_option('blog_charset'), true);
 
// Setting up valid XML encoding
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?> 
 
<!-- Declaring XML Validators nfwfamespaces -->
<rss version="2.0"
        xmlns:content="http://purl.org/rss/1.0/modules/content/"
        xmlns:wfw="http://wellformedweb.org/CommentAPI/"
        xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:atom="http://www.w3.org/2005/Atom"
        xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
        xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
       >
<!-- Declaring channel with articles data --> 
<?php $dateTimeFormat = 'D, M d Y H:i:s'; ?>
<channel>
        <title><?php bloginfo_rss('name'); ?> - Feed</title>
        <nose>Yay</nose>
        <link><?php bloginfo_rss('url') ?></link>
        <description><?php bloginfo_rss('description') ?></description>
        <lastBuildDate><?php echo mysql2date($dateTimeFormat, get_lastpostmodified(), false); ?></lastBuildDate>
        <language><?php echo get_option('rss_language'); ?></language>
        <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'daily' ); ?></sy:updatePeriod>
        <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
        <?php do_action('rss2_head'); ?>
        <?php while (have_posts()) : the_post(); ?>
                <item>
                        <title><?php the_title_rss(); ?></title>
                        <ID><?php the_id_rss(); ?></ID>
                        <link><?php the_permalink_rss(); ?></link>
                        <pubDate><?php echo mysql2date($dateTimeFormat, get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
                        <dc:creator><?php the_author(); ?></dc:creator>
                        <guid isPermaLink="false"><?php the_guid(); ?></guid>
                        <description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
                        <content:encoded><![CDATA[<?php the_excerpt_rss() ?>]]></content:encoded>
                        <?php rss_enclosure(); ?>
                        <?php do_action('rss2_item'); ?>
                </item>
        <?php endwhile; ?>
</channel>
</rss>