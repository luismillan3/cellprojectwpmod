<?php
/*
*@package wp2mods
*/
/*
Plugin Name: WP2MODS
Version: 1.0.0
Description: Convert to MODS and DC metadata in order to be found by OAI-PMH Harvester
Author: Luis Millan 
License: GPLv2 or later
Text Domain: WP2MODS
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/




class WP2MODS
{
    function __construct(){
          //  add_action('init', array($this, 'custom_post_type'));
            add_action('init',  array($this, 'customRSS'));
    }
    
    function activate(){
      // Generate a custom post type 
        //Flush rewrite rules
        
        $this -> custom_post_type();
        flush_rewrite_rules();
    }
    
    function deactivate(){
        //flush rewrite rules
        flush_rewrite_rules();
    }
    
    function uninstall(){
        //delete CPT
    }
    
    function custom_post_type(){
        
        register_post_type('book', ['public' => true, 'label' => 'Books']);
    }
 
    function customRSS(){
            add_feed('MODS',  array($this, 'customRSSFunc'));
            add_feed('DC',  array($this, 'customDCFunc'));
       
    }
    
    function customRSSFunc(){
        get_template_part('mods', 'feedname');
        //load_template( 'wp-content/plugins/WP2MODS/dc-feedname.php' );
    }

    function customDCFunc(){

         get_template_part('dc', 'feedname');
    }



}

   

    

if ( class_exists('WP2MODS'))
{
$wp2admin = new WP2MODS();
}

//activation
register_activation_hook( __File__ , array($wp2admin,'activate'));

//deactivate 
register_deactivation_hook( __File__ , array($wp2admin,'deactivate'));

//uninstall
