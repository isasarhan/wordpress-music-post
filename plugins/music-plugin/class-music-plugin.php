<?php

class Music_Plugin
{
    public function __construct()
    {
        add_action('init', array($this, 'register_post_types'));
        add_action('init', array($this, 'register_taxonomies'));
        
        add_action('add_meta_boxes', array($this, 'addDateField'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('save_post', array($this, 'saveMusicDate'));
        add_action('before_delete_post', array($this, 'metadata_deletion'));
        
        add_filter('template_include', array($this, 'custom_templates'));
        
        add_theme_support('post-thumbnails');

        $this->define_admin_hooks();
    }

    public function register_post_types()
    {
        register_post_type(
            'music',
            array(
                'labels' => array(
                    'name' => 'Music',
                    'singular_name' => 'Music',
                    'add_new_item'=> 'Add New Music',
                    'edit_item' =>'Edit Music',
                    'all_items'=> 'All Music',
                ),
                //shows new wordpress editor
                'show_in_rest'=>true,
                'rewrite'=>array('slug'=>'musics'),
                'menu_icon' => 'dashicons-format-audio',
                'public' => true,
                'exclude_from_search' => false,
                'supports' => array('title', 'editor', 'thumbnail','excerpt'),
                'has_archive' => true,
                'taxonomies' => array('albums', 'artists')

            )
        );
    }
    public function enqueue_scripts()
    {
        // Bootstrap CSS
        wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
        // Bootstrap JS
        wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array('jquery'), null, true);
        // my css files
        wp_enqueue_style('music-styles', plugin_dir_url(__FILE__) . 'css/style.css');

    }
    public function register_taxonomies()
    {

        register_taxonomy(
            'artists',
            'music',
            array(
                'label' => 'Artists',
                'hierarchical' => true,
            )
        );

        register_taxonomy(
            'albums',
            'music',
            array(
                'label' => 'Albums',
                'hierarchical' => true,
            )
        );
    }
    public function metadata_deletion($post_id) {
        if (get_post_type($post_id) === 'music') {
            delete_post_meta($post_id, 'date-music');
        }
    }
    public function register_menus()
    {
        register_nav_menus(
            array(
                'header-menu' => 'Header Menu',
            )
        );
    }
   
    public function custom_templates($template)
    {

        if (is_tax('artists') || is_tax('albums')) {
            return plugin_dir_path(__FILE__) . 'templates/taxonomies.php';
        } 
        else if (is_post_type_archive('music')) {
            return plugin_dir_path(__FILE__) . 'templates/archive-music.php';
        } else if (is_singular('music')) {
            return plugin_dir_path(__FILE__) . 'templates/single-music.php';
        }

        return $template;
    }
    
    public function define_admin_hooks()
    {
        $plugin_admin = new CustomThemeSettings();
        return $plugin_admin;
    }

    public function addDateField() {
        add_meta_box(
            'date-music',
            __('Music Date', 'text_domain'),
            array($this, 'renderFieldDate'),
            'music',
            'normal',
            'default'
        );
    }

    public function renderFieldDate($post) {
        $musicDate = get_post_meta($post->ID, '_music_date', true);

        // Output the field
        echo '<label for="music_date">';    
        _e('Music Date:', 'text_domain');
        echo '</label> ';
        echo '<input type="date" id="music_date" name="music_date" value="'. esc_attr($musicDate) .'" size="25" />';
    }
    public function saveMusicDate($post_id) {
       
        // Save custom field data
        if (isset($_POST['music_date'])) {
            update_post_meta($post_id, '_music_date', sanitize_text_field($_POST['music_date']));
        }
    }
    
}
