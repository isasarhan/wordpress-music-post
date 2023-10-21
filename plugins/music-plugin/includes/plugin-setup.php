<?php


class WCM_Setup_Demo_Class
{
    protected static $instance;

    public static function init()
    {
        is_null(self::$instance) and self::$instance = new self;
        return self::$instance;
    }

    public static function on_activation()
    {
        if (!current_user_can('activate_plugins'))
            return;
        $plugin = isset($_REQUEST['plugin']) ? $_REQUEST['plugin'] : '';
        check_admin_referer("activate-plugin_{$plugin}");
  
    }

    public static function on_deactivation()
    {
        if (!current_user_can('activate_plugins'))
            return;
        $plugin = isset($_REQUEST['plugin']) ? $_REQUEST['plugin'] : '';
        check_admin_referer("deactivate-plugin_{$plugin}");

    }

    public static function on_uninstall()
    {
        if (!current_user_can('activate_plugins'))
            return;

        $featured = get_option("music_plugin_deletion");

        if ($featured) {
            $args = array(
                'post_type' => 'music',
                'posts_per_page' => -1,
            );

            $custom_posts = get_posts($args);

            foreach ($custom_posts as $post) {
                wp_delete_post($post->ID, true); // Set the second parameter to true to force delete
            }
        }
    }

}
new WCM_Setup_Demo_Class();