<?php
/**
 * Plugin Name: FatHead Links
 * Description: Adds fathead icons as a widget
 * Version 1.0
 * Author: FatHeadSolutions
 *  
 */

 if(!defined('ABSPATH')){
     exit;
 }

 //Load Scripts
 require_once(plugin_dir_path(__FILE__) . '/includes/fatheadlinks-scripts.php');

 //Load Class
 require_once(plugin_dir_path(__FILE__) . '/includes/fatheadlinks-class.php');

  //Load New Widget
  function register_fathead_links(){
      register_widget('Fathead_Links_Widget');
  }

  add_action('widgets_init', 'register_fathead_links');
