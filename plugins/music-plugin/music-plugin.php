<?php
/*
Plugin Name: Music Plugin
Description: WP plugin assesment
Version: 2.0
Author: Issa Sarhan
*/

if (!defined('ABSPATH')) {
    exit;
}

include_once(plugin_dir_path(__FILE__) . 'class-music-plugin.php');
include_once(plugin_dir_path(__FILE__) . 'class-theme-setting.php');
include_once(plugin_dir_path(__FILE__) . 'includes/plugin-setup.php');


function run_plugin()
{

    $music_plugin = new Music_Plugin();
    return $music_plugin;
}

register_activation_hook(__FILE__, array('WCM_Setup_Demo_Class', 'on_activation'));
register_deactivation_hook(__FILE__, array('WCM_Setup_Demo_Class', 'on_deactivation'));
register_uninstall_hook(__FILE__, array('WCM_Setup_Demo_Class', 'on_uninstall'));

add_action('plugins_loaded', array('WCM_Setup_Demo_Class', 'init'));

run_plugin();