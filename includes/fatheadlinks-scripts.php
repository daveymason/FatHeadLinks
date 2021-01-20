<?php

//Add Scripts
function sl_add_scripts(){
    wp_enqueue_style('sl-main-style', plugins_url().'/fatheadlinks/css/style.css');
    wp_enqueue_script('sl-main-script', plugins_url().'/fatheadlinks/js/main.js');
}

add_action('wp_enqueue_scripts', 'sl_add_scripts');