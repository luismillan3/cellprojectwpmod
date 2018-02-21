<?php
/**
 * RSS Feed Template by Julia N.  Modified by Luis Millan original at https://wpmayor.com/how-to-create-custom-rss-feeds-wordpress/
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
        xmlns:xlink="http://www.w3.org/1999/xlink"
         xmlns:dc="http://purl.org/dc/elements/1.1/" 
        xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/ http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">
<!-- Declaring channel with articles data --> 
<?php $dateTimeFormat = 'D, M d Y H:i:s'; ?>

        <responseDate>2017-12-17T03:56:13Z</responseDate>
        <request verb="ListRecords" metadataPrefix="oai_dc"><?php echo get_site_url(); ?></request>
      
<ListRecords>
        
        <?php do_action('rss2_head'); ?>
        <?php while (have_posts()) : the_post(); ?>
               
                <record>
                    <metadata>
                       <oai_dc:dc xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/"
                        xmlns:dc="http://purl.org/dc/elements/1.1/"
                        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                        xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/oai_dc/
            http://www.openarchives.org/OAI/2.0/oai_dc.xsd">
                        <?php /*Source DB*/

                        //  if(get_post_meta(get_the_ID(),"creator",true))
                        // { echo '<recordInfo> <recordContentSource authorityURI="http://cellproject.net/authorities/source-database" valueURI=">'.get_post_meta(get_the_ID(),"creator",true).'</recordContentSource></recordInfo>'; }
                      
                       /*Title*/ if(get_post_meta(get_the_ID(),"title",true))
                        { echo '<dc:title>'.get_post_meta(get_the_ID(),"title",true).'</dc:title>'; }

                         /*Creator*/ if(get_post_meta(get_the_ID(),"creator",true)){
                        // { echo '<dc:creator>'.get_post_meta(get_the_ID(),"creator",true).'</dc:creator>'; }

                        $array = explode(",",get_post_meta(get_the_ID(),"creator",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:creator>'.$array[$i].'</dc:creator>';} 
                        }

                        /*Original Publication*/ if(get_post_meta(get_the_ID(),"year_of_original_publicatione",true)){
                        // { echo '<dc:date>'.get_post_meta(get_the_ID(),"year_of_original_publication",true).'</dc:date>'; }

                        $array = explode(",",get_post_meta(get_the_ID(),"year_of_original_publicatione",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:date>'.$array[$i].'</dc:date>';} 
                        }



                          /*Work Language*/ if(get_post_meta(get_the_ID(),"work_language",true)){
                        // { echo '<dc:language>'.get_post_meta(get_the_ID(),"work_language",true).'</dc:language>'; }

                          $array = explode(",",get_post_meta(get_the_ID(),"work_language",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:language>'.$array[$i].'</dc:language>';} 
                        }



                         /*Publisher*/ if(get_post_meta(get_the_ID(),"publisher",true)){
                        // { echo '<dc:publisher>'.get_post_meta(get_the_ID(),"publisher",true).'</dc:publisher>'; }
                          $array = explode(",",get_post_meta(get_the_ID(),"publisher",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:publisher>'.$array[$i].'</dc:publisher>';} 
                        }




                          /*Work URL*/ if(get_post_meta(get_the_ID(),"work_url",true)){
                        // { echo '<dc:relation>'.get_post_meta(get_the_ID(),"work_url",true).'</dc:relation>'; }
                          $array = explode(",",get_post_meta(get_the_ID(),"work_url",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:relation>'.$array[$i].'</dc:relation>';} 
                        }




                          /*Tech Used*/ if(get_post_meta(get_the_ID(),"technology_used",true)){
                        // { echo '<dc:format>'.get_post_meta(get_the_ID(),"technology_used",true).'</dc:format>'; }

                        $array = explode(",",get_post_meta(get_the_ID(),"technology_used",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:format>'.$array[$i].'</dc:format>';} 
                        }



                          /*publication type*/ if(get_post_meta(get_the_ID(),"publication_type",true)){
                        // { echo '<dc:format>'.get_post_meta(get_the_ID(),"publication_type",true).'</dc:format>'; }

                        $array = explode(",",get_post_meta(get_the_ID(),"publication_type",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:format>'.$array[$i].'</dc:format>';} 
                        }



                          /*Complementary Publication*/ if(get_post_meta(get_the_ID(),"complementary_publication_type",true)){
                        // { echo '<dc:format>'.get_post_meta(get_the_ID(),"complementary_publication_type",true).'</dc:format>'; }

                        $array = explode(",",get_post_meta(get_the_ID(),"complementary_publication_type",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:format>'.$array[$i].'</dc:format>';} 
                        }


                          /*Procedural Modalities*/ if(get_post_meta(get_the_ID(),"procedural_modalities",true)){
                        // { echo '<dc:type>'.get_post_meta(get_the_ID(),"procedural_modalities",true).'</dc:type>'; }

                         $array = explode(",",get_post_meta(get_the_ID(),"procedural_modalities",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:type>'.$array[$i].'</dc:type>';} 
                        }


                          /*Complementary Procedural Modalities*/ if(get_post_meta(get_the_ID(),"complementary_procedural_modalities",true)){
                        // { echo '<dc:type>'.get_post_meta(get_the_ID(),"complementary_procedural_modalities",true).'</dc:type>'; }
                          $array = explode(",",get_post_meta(get_the_ID(),"complementary_procedural_modalities",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:type>'.$array[$i].'</dc:type>';} 
                        }


                          /*Mechanism*/ if(get_post_meta(get_the_ID(),"mechanism",true)){
                        // { echo '<dc:format>'.get_post_meta(get_the_ID(),"mechanism",true).'</dc:format>'; }

                         $array = explode(",",get_post_meta(get_the_ID(),"mechanism",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:format>'.$array[$i].'</dc:format>';} 
                        }


                          /*Complementary Mechanism*/ if(get_post_meta(get_the_ID(),"complementary_mechanism",true)){
                        // { echo '<dc:format>'.get_post_meta(get_the_ID(),"complementary_mechanism",true).'</dc:format>'; }

                        $array = explode(",",get_post_meta(get_the_ID(),"complementary_mechanism",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:format>'.$array[$i].'</dc:format>';} 
                        }


                          /*Format*/ if(get_post_meta(get_the_ID(),"format",true)){
                        // { echo '<dc:format>'.get_post_meta(get_the_ID(),"format",true).'</dc:format>'; }

                        $array = explode(",",get_post_meta(get_the_ID(),"format",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:format>'.$array[$i].'</dc:format>';} 
                        }

                          /*Complementary Format*/ if(get_post_meta(get_the_ID(),"complementary_format",true)){
                        // { echo '<dc:format>'.get_post_meta(get_the_ID(),"complementary_format",true).'</dc:format>'; }

                        $array = explode(",",get_post_meta(get_the_ID(),"complementary_format",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:format>'.$array[$i].'</dc:format>';} 
                        }


                          /*Description*/ if(get_post_meta(get_the_ID(),"description",true)){
                        // { echo '<dc:description>'.get_post_meta(get_the_ID(),"description",true).'</dc:description>'; }

                        $array = explode(",",get_post_meta(get_the_ID(),"description",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:description>'.$array[$i].'</dc:description>';} 
                        }


                          /*Literary quality*/ if(get_post_meta(get_the_ID(),"literary_qualities",true)){
                        // { echo '<dc:type>'.get_post_meta(get_the_ID(),"literary_qualities",true).'</dc:type>'; }
                            $array = explode(",",get_post_meta(get_the_ID(),"literary_qualities",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:type>'.$array[$i].'</dc:type>';} 
                        }



                          /*Identifier*/ if(get_post_meta(get_the_ID(),"identifier",true)){
                        // { echo '<dc:identifier>'.get_post_meta(get_the_ID(),"identifier",true).'</dc:identifier>'; }
                         $array = explode(",",get_post_meta(get_the_ID(),"identifier",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:identifier>'.$array[$i].'</dc:identifier>';} 
                        }


                          /*Original Source Entry*/ if(get_post_meta(get_the_ID(),"original_source_url",true)){
                        // { echo '<dc:source>'.get_post_meta(get_the_ID(),"original_source_url",true).'</dc:source>'; }

                         $array = explode(",",get_post_meta(get_the_ID(),"original_source_url",true));
                        
                          for ($i = 0;$i < count($array);$i++){
                          echo '<dc:source>'.$array[$i].'</dc:source>';} 
                        }


                      ?>
   
       

                        <?php rss_enclosure(); ?>
                        <?php do_action('rss2_item'); ?>
                        </oai_dc:dc>
                    </metadata>
                </record>
        <?php endwhile; ?>
</ListRecords>
</OAI-PMH>