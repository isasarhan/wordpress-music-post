<?php
/*
Plugin Name: Music Plugin
Description: WP plugin assesment
Version: 1.0
Author: Issa Sarhan
*/

if (!defined('ABSPATH')) {
    exit;
}

include_once(plugin_dir_path(__FILE__) . 'class-music-plugin.php');
include_once(plugin_dir_path(__FILE__) . 'class-theme-setting.php');


function run_plugin()
{

    $music_plugin = new Music_Plugin();
    return $music_plugin;
}

run_plugin();