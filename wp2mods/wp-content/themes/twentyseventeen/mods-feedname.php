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
        xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/ http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">
<!-- Declaring channel with articles data --> 
<?php $dateTimeFormat = 'D, M d Y H:i:s'; ?>

        <responseDate>2017-12-17T03:56:13Z</responseDate>
        <request verb="ListRecords" metadataPrefix="mods"><?php echo get_site_url(); ?></request>
<ListRecords>
        
        <?php do_action('rss2_head'); ?>
        <?php while (have_posts()) : the_post(); ?>
               
                <record>
                    <metadata>
                       <mods xmlns="http://www.loc.gov/mods/v3" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:cell="http://cellproject.net/schemas/cell-mods-extension" xsi:schemaLocation="http://www.loc.gov/mods/v3 http://www.loc.gov/standards/mods/v3/mods-3-5.xsd">
                        <?php /*Source DB*/

                        //  if(get_post_meta(get_the_ID(),"creator",true))
                        // { echo '<recordInfo> <recordContentSource authorityURI="http://cellproject.net/authorities/source-database" valueURI="">'.get_post_meta(get_the_ID(),"creator",true).'</recordContentSource></recordInfo>'; }
                      
                       /*Title*/ if(get_post_meta(get_the_ID(),"title",true))
                        { echo '<titleInfo> <title>'.get_post_meta(get_the_ID(),"title",true).'</title></titleInfo>'; }
                       
                       /*Creator*/ if(get_post_meta(get_the_ID(),"creator",true)){
                        // { echo '<name authority="local"> <namePart>'.get_post_meta(get_the_ID(),"creator",true).'</namePart></name>'; }
                        	$creatorName = explode(",",get_post_meta(get_the_ID(),"creator",true));
                        	// echo $array;
                    		for ($i = 0;$i < count($creatorName);$i++){	
	                        	echo '<name authority="local">';
	                        	$creatorNamePart = explode(" ",$creatorName[$i]);
	                        	for ($j = 0;$j < count($creatorNamePart);$j++){
	                        	echo '<namePart>'.$creatorNamePart[$j].'</namePart>';} 
	                        	// echo '<originInfo> <publisher>'.get_post_meta(get_the_ID(),"publisher",true).'</publisher></originInfo>'; 
	                        	echo '</name>';
	                        }
                        }


                       
                       /*CreatorsRole*/ if(get_post_meta(get_the_ID(),"creators_role",true)){
                        // { echo '<name><role><roleTerm type="code" authority="marcrelator">'.get_post_meta(get_the_ID(),"creator",true).'</roleTerm></role></name>'; }
                      		echo '<name>';
							$creatorRole = explode(",",get_post_meta(get_the_ID(),"creators_role",true));
                        	// echo $array;
                    		for ($i = 0;$i < count($creatorRole);$i++){	
	                        	echo '<role>';
	                        	$creatorRoleTerm = explode(" ",$creatorRole[$i]);
	                        	for ($j = 0;$j < count($creatorRoleTerm);$j++){
	                        	echo '<roleTerm type="code" authority="marcrelator">'.$creatorRoleTerm[$j].'</roleTerm>';} 
	                        	// echo '<originInfo> <publisher>'.get_post_meta(get_the_ID(),"publisher",true).'</publisher></originInfo>'; 
	                        	echo '</role>';
	                        }
	                               		echo '</name>';
                        }

                        /*Creator URI*/ if(get_post_meta(get_the_ID(),"creator_uri",true) ){
                        // { echo '<name xlink:href="http://localhost">'.get_post_meta(get_the_ID(),"creator",true).'</name>'; }
                        	$creatorUri = explode(",",get_post_meta(get_the_ID(),"creator_uri",true));
                        	for ($i = 0;$i < count($creatorUri);$i++){	
	                        	echo '<name xlink:href="'.$creatorUri[$i].'">';
	                        	echo $creatorUri[$i];
	                        	// echo '<originInfo> <publisher>'.get_post_meta(get_the_ID(),"publisher",true).'</publisher></originInfo>'; 
	                        	echo '</name>';
	                        }
						}
                       
                       /* Year of OP*/ if(get_post_meta(get_the_ID(),"year_of_original_publication",true))
                        { echo '<originInfo><dateIssued encoding="w3cdtf">'.get_post_meta(get_the_ID(),"year_of_original_publication",true).'</dateIssued></originInfo>'; }
                       
                       /*Work Lang*/ if(get_post_meta(get_the_ID(),"work_language",true)){
                        // { echo '<language><languageTerm authority="rfc3066">'.get_post_meta(get_the_ID(),"work_language",true).'</languageTerm></language>'; }

                        $array = explode(",",get_post_meta(get_the_ID(),"work_language",true));
                        	echo '<language>';
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<languageTerm authority="rfc3066">'.$array[$i].'</languageTerm>';} 
                        	echo '</language>';
                      	}

                        
                        //Trying with publisher

                       /*Publisher*/ if(get_post_meta(get_the_ID(),"publisher",true))
                        { 	// echo '<originInfo> <publisher>'.get_post_meta(get_the_ID(),"publisher",true).'</publisher></originInfo>'; 
                        	// echo $array;
                        	$array = explode(",",get_post_meta(get_the_ID(),"publisher",true));
                        	echo '<originInfo>';
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<publisher>'.$array[$i].'</publisher>';} 
                        	echo '</originInfo>';
                        }
                       
                       /*Publisher URI*/ if(get_post_meta(get_the_ID(),"publisher_uri",true))
                        { echo '<extension> <cell:originInfo> <cell:publisher xlink:href="http://localhost">'.get_post_meta(get_the_ID(),"publisher_uri",true).'</cell:publisher></cell:originInfo></extension>'; }
                       
                       /*Work URL*/ if(get_post_meta(get_the_ID(),"work_url",true)){
                        // { echo '<location> <url>'.get_post_meta(get_the_ID(),"work_url",true).'</url></location>'; }
                        $array = explode(",",get_post_meta(get_the_ID(),"work_url",true));
                        	echo '<location>';
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<url>'.$array[$i].'</url>';} 
                        	echo '</location>';
						}
                       
                       /*Source Entry URL*/ if(get_post_meta(get_the_ID(),"source_entry_url",true)){
                        // { echo '<identifier type="uri">'.get_post_meta(get_the_ID(),"source_entry_url",true).'</identifier>'; }
                        $array = explode(",",get_post_meta(get_the_ID(),"source_entry_url",true));
                        
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<identifier type="uri">'.$array[$i].'</identifier>';} 
                      	}

                       
                       /*Author Of Entry Source*/ if(get_post_meta(get_the_ID(),"entry_source_author",true)){
                        // { echo '<extension><cell:recordInfo><name><namePart>'.get_post_meta(get_the_ID(),"entry_source_author",true).'</namePart></name></cell:recordInfo></extension>'; }
							echo '<extension>';
							$authorEntrySourceName = explode(",",get_post_meta(get_the_ID(),"entry_source_author",true));
                        	// echo $array;
                    		for ($i = 0;$i < count($authorEntrySourceName);$i++){	
	                        	echo '<name>';
	                        	$authorNamePart = explode(" ",$authorEntrySourceName[$i]);
	                        	for ($j = 0;$j < count($authorNamePart);$j++){
	                        	echo '<namePart>'.$authorNamePart[$j].'</namePart>';} 
	                        	// echo '<originInfo> <publisher>'.get_post_meta(get_the_ID(),"publisher",true).'</publisher></originInfo>'; 
	                        	echo '</name>';}
	                        

	                        	echo '</extension>';}

                       
                       /*Techonlogyused*/ if(get_post_meta(get_the_ID(),"technology_used",true)){
                        // { echo '<physicalDescription> <form type="technology" authorityURI="http://cellproject.net/authorities/technology" valueURI="">'.get_post_meta(get_the_ID(),"technology_used",true).'</form></physicalDescription>'; }
                       	   $array = explode(",",get_post_meta(get_the_ID(),"technology_used",true));
                        	echo '<physicalDescription>';
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<form type="technology" authorityURI="http://cellproject.net/authorities/technology" valueURI="">'.$array[$i].'</form>';} 
                        	echo '</physicalDescription>';
                      	}



                       
                       /*Publication Types*/ if(get_post_meta(get_the_ID(),"publication_type",true)){
                        // { echo '<physicalDescription> <form type="publication-type" authorityURI="http://cellproject.net/authorities/publication-type" valueURI="">'.get_post_meta(get_the_ID(),"creator",true).'</form></physicalDescription>'; }

                            $array = explode(",",get_post_meta(get_the_ID(),"publication_type",true));
                        	echo '<physicalDescription>';
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<form type="publication-type" authorityURI="http://cellproject.net/authorities/publication-type" valueURI="">'.$array[$i].'</form>';} 
                        	echo '</physicalDescription>';
                      	}

                       
                       /*Complementary Publication Types*/ if(get_post_meta(get_the_ID(),"complementary_publication_type",true)){
                        // { echo '<physicalDescription> <form type="publication-type">'.get_post_meta(get_the_ID(),"complementary_publication_type",true).'</form></physicalDescription>'; }

                           $array = explode(",",get_post_meta(get_the_ID(),"publication_type",true));
                        	echo '<physicalDescription>';
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<form type="publication-type">'.$array[$i].'</form>';} 
                        	echo '</physicalDescription>';
                      	}
                       
                       /*Preocedurl mod*/ if(get_post_meta(get_the_ID(),"procedural_modalities",true)){
                        // { echo '<genre type="procedural-modality" authorityURI="http://cellproject.net/authorities/procedural-modality" valueURI="">'.get_post_meta(get_the_ID(),"procedural_modalities",true).'</genre>'; }

                            $array = explode(",",get_post_meta(get_the_ID(),"procedural_modalities",true));
                        	
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<genre type="procedural-modality" authorityURI="http://cellproject.net/authorities/procedural-modality" valueURI="">'.$array[$i].'</genre>';} 
             
                      	}
                       
                       /*Complementary Preocedurl mod*/ if(get_post_meta(get_the_ID(),"complementary_procedural_modalities",true)){
                        // { echo '<genre type="procedural-modality">'.get_post_meta(get_the_ID(),"complementary_procedural_modalities",true).'</genre>'; }


                            $array = explode(",",get_post_meta(get_the_ID(),"complementary_procedural_modalities",true));
                        	
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<genre type="procedural-modality">'.$array[$i].'</genre>';} 
             
                      	}
                       
                       
                       /*Mechanism*/ if(get_post_meta(get_the_ID(),"mechanism",true)){
                        // { echo '<physicalDescription><form type="mechanism" authorityURI="http://cellproject.net/authorities/mechanism" valueURI="">'.get_post_meta(get_the_ID(),"mechanism",true).'</form></physicalDescription>'; }
                          $array = explode(",",get_post_meta(get_the_ID(),"mechanism",true));
                        	echo '<physicalDescription>';
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<form type="mechanism" authorityURI="http://cellproject.net/authorities/mechanism" valueURI="">'.$array[$i].'</form>';} 
                        	echo '</physicalDescription>';
                      	}


                       
                       /*Complementary mechanism*/ if(get_post_meta(get_the_ID(),"complementary_mechanism",true)){
                        // { echo '<physicalDescription><form type="mechanism">'.get_post_meta(get_the_ID(),"complementary_mechanism",true).'</form></physicalDescription>'; }

                          $array = explode(",",get_post_meta(get_the_ID(),"mechanism",true));
                        	echo '<physicalDescription>';
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<form type="mechanism">'.$array[$i].'</form>';} 
                        	echo '</physicalDescription>';
                      	}

                       
                       /*Format*/ if(get_post_meta(get_the_ID(),"format",true)){
                        // { echo '<physicalDescription> <form type="format" authorityURI="http://cellproject.net/authorities/format" valueURI="">'.get_post_meta(get_the_ID(),"format",true).'</form></physicalDescription>'; }
  							$array = explode(",",get_post_meta(get_the_ID(),"format",true));
                        	echo '<physicalDescription>';
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<form type="format" authorityURI="http://cellproject.net/authorities/format" valueURI="">'.$array[$i].'</form>';} 
                        	echo '</physicalDescription>';
                      	}

                       
                       /*Complementary Format*/ if(get_post_meta(get_the_ID(),"complementary_format",true)){
                        // { echo '<physicalDescription> <form type="format">'.get_post_meta(get_the_ID(),"complementary_format",true).'</form></physicalDescription>'; }

							$array = explode(",",get_post_meta(get_the_ID(),"complementary_format",true));
                        	echo '<physicalDescription>';
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<form type="format">'.$array[$i].'</form>';} 
                        	echo '</physicalDescription>';
                      	}

                       
                       /*Description*/ if(get_post_meta(get_the_ID(),"description",true))
                        { echo '<abstract>'.get_post_meta(get_the_ID(),"description",true).'</abstract>'; }
                       

                       /*Literary Qualities*/ if(get_post_meta(get_the_ID(),"literary_qualities",true)){
                        // { echo '<genre type="literary-quality">'.get_post_meta(get_the_ID(),"creator",true).'</genre>'; }
							$array = explode(",",get_post_meta(get_the_ID(),"literary_qualities",true));
                            for ($i = 0;$i < count($array);$i++){
                        	echo '<genre type="literary-quality">'.$array[$i].'</genre>';} 
                        }
                       
                       /*Identifier*/ if(get_post_meta(get_the_ID(),"identifier",true)){
                        // { echo '<identifier type="uri">'.get_post_meta(get_the_ID(),"identifier",true).'</identifier>'; }
                       		$array = explode(",",get_post_meta(get_the_ID(),"identifier",true));
                            for ($i = 0;$i < count($array);$i++){
                        	echo '<identifier type="uri">'.$array[$i].'</identifier>';} 
                        }



                       /*Source Entry Creation Date*/ if(get_post_meta(get_the_ID(),"source_entry_creation_date",true))
                        { echo '<recordInfo><recordCreationDate encoding="iso8601">'.get_post_meta(get_the_ID(),"source_entry_creation_date",true).'</recordCreationDate></recordInfo>'; }
                       
                       /*Source Entry Change Date*/ if(get_post_meta(get_the_ID(),"source_entry_change_date",true)){
                        // { echo '<recordInfo> <recordChangeDate encoding="iso8601">'.get_post_meta(get_the_ID(),"creator",true).'</recordChangeDate></recordInfo>'; }

							$array = explode(",",get_post_meta(get_the_ID(),"complementary_format",true));
                        	echo '<recordInfo>';
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<recordChangeDate encoding="iso8601">'.$array[$i].'</recordChangeDate>';} 
                        	echo '</recordInfo>';
                      	}


                       
                       /*Source Entry Language*/ if(get_post_meta(get_the_ID(),"source_entry_language",true)){
                        // { echo '<recordInfo> <languageOfCataloging> <languageTerm authority="rfc3066">'.get_post_meta(get_the_ID(),"creator",true).'</languageTerm></languageOfCataloging></recordInfo>'; }
							echo '<recordInfo>';
							$sourceEntryLanguage = explode(",",get_post_meta(get_the_ID(),"source_entry_language",true));
                        	// echo $array;
                    		for ($i = 0;$i < count($sourceEntryLanguage);$i++){	
	                        	echo '<languageOfCataloging>';
	                        	$languagePart = explode(" ",$sourceEntryLanguage[$i]);
	                        	for ($j = 0;$j < count($languagePart);$j++){
	                        	echo '<languageTerm authority="rfc3066">'.$languagePart[$j].'</languageTerm>';} 
	                        	// echo '<originInfo> <publisher>'.get_post_meta(get_the_ID(),"publisher",true).'</publisher></originInfo>'; 
	                        	echo '</languageOfCataloging>';}
	                        

	                        	echo '</recordInfo>';}


                       
                       /*Original Identifier*/ if(get_post_meta(get_the_ID(),"original_identifier",true)){
                        // { echo '<relatedItem type="host"><identifier>'.get_post_meta(get_the_ID(),"original_identifier",true).'</identifier></relatedItem>'; }

                        $array = explode(",",get_post_meta(get_the_ID(),"original_identifier",true));
                        	echo '<relatedItem type="host">';
                        	for ($i = 0;$i < count($array);$i++){
                        	echo '<identifier>'.$array[$i].'</identifier>';} 
                        	echo '</relatedItem>';
                      	}


                       
                       /*Original source entry url*/ if(get_post_meta(get_the_ID(),"original_source_url",true)){
                        // { echo '<relatedItem type="host"><location><url>'.get_post_meta(get_the_ID(),"creator",true).'</url></location></relatedItem>'; }

                        echo '<relatedItem type="host">';
							$sourceEntryUrl = explode(",",get_post_meta(get_the_ID(),"original_source_url",true));
                        	// echo $array;
                    		for ($i = 0;$i < count($sourceEntryUrl);$i++){	
	                        	echo '<location>';
	                        	$urlPart = explode(" ",$sourceEntryUrl[$i]);
	                        	for ($j = 0;$j < count($urlPart);$j++){
	                        	echo '<url>'.$urlPart[$j].'</url>';} 
	                        	// echo '<originInfo> <publisher>'.get_post_meta(get_the_ID(),"publisher",true).'</publisher></originInfo>'; 
	                        	echo '</location>';}
	                        

	                        	echo '</relatedItem>';}



                       
                       /*Original source entry creation date*/ if(get_post_meta(get_the_ID(),"original_soruce_creation_date",true))
                        { echo '<relatedItem type="host"><recordInfo><recordCreationDate encoding="iso8601">'.get_post_meta(get_the_ID(),"original_soruce_creation_date",true).'</recordCreationDate></recordInfo></relatedItem>'; }

                            
                       
                        /*Original source entry change date*/ if(get_post_meta(get_the_ID(),"original_source_change_date",true)){
                        // { echo '<relatedItem type="host"><recordInfo><recordChangeDate encoding="iso8601">'.get_post_meta(get_the_ID(),"creator",true).'</recordChangeDate></recordInfo></relatedItem>'; }

                        echo '<relatedItem type="host">';
							$source_entry_change_date = explode(",",get_post_meta(get_the_ID(),"original_source_change_date",true));
                        	// echo $array;
                    		for ($i = 0;$i < count($source_entry_change_date);$i++){	
	                        	echo '<recordInfo>';
	                        	$recordChangeDate = explode(" ",$source_entry_change_date[$i]);
	                        	for ($j = 0;$j < count($recordChangeDate);$j++){
	                        	echo '<recordChangeDate encoding="iso8601">'.$recordChangeDate[$j].'</recordChangeDate>';} 
	                        	// echo '<originInfo> <publisher>'.get_post_meta(get_the_ID(),"publisher",true).'</publisher></originInfo>'; 
	                        	echo '</recordInfo>';}
	                        

	                        	echo '</relatedItem>';}
                         
                        /*Original source entry Database*/ if(get_post_meta(get_the_ID(),"original_source_entry_database",true)){
                        // { echo '<relatedItem type="host"><recordInfo><recordContentSource authorityURI="http://cellproject.net/authorities/source-database" valueURI="">'.get_post_meta(get_the_ID(),"creator",true).'</recordContentSource></recordInfo></relatedItem>'; }

							echo '<relatedItem type="host">';
							$source_entry_database = explode(",",get_post_meta(get_the_ID(),"original_source_entry_database",true));
                        	// echo $array;
                    		for ($i = 0;$i < count($source_entry_database);$i++){	
	                        	echo '<recordInfo>';
	                        	$recordDatabase = explode(" ",$source_entry_database[$i]);
	                        	for ($j = 0;$j < count($recordDatabase);$j++){
	                        	echo '<recordContentSource authorityURI="http://cellproject.net/authorities/source-database" valueURI="">'.$recordDatabase[$j].'</recordContentSource>';} 
	                        	// echo '<originInfo> <publisher>'.get_post_meta(get_the_ID(),"publisher",true).'</publisher></originInfo>'; 
	                        	echo '</recordInfo>';}
	                        

	                        	echo '</relatedItem>';}

                    
                    ?>
   
       

                        <?php rss_enclosure(); ?>
                        <?php do_action('rss2_item'); ?>
                        </mods>
                    </metadata>
                </record>
        <?php endwhile; ?>
</ListRecords>
</OAI-PMH>