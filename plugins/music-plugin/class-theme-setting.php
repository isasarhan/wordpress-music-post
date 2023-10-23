<?php

class CustomThemeSettings
{
    public function __construct()
    {
        // register the submenu page
        add_action('admin_menu', array($this, 'submenu_page'));

        // register settings and fields
        add_action('admin_init', array($this, 'register_fields'));
    }

    public function submenu_page()
    {
        add_submenu_page(
            'edit.php?post_type=music',
            'Settings',
            'Settings',
            'manage_options',
            'setting',
            array($this, 'setting_page_ui')
        );
    }

    public function setting_page_ui()
    {
        ?>
        <div class="wrap">
            <h2>Setting</h2>
            <?php if (isset($_POST['justsubmitted']) and $_POST['justsubmitted'] == "true")
                $this->handleForm() ?>
                <!-- <form method="post" action="options.php"> -->
                <form method="post">
                    <input type="hidden" name="justsubmitted" value="true">
                <?php wp_nonce_field('saveIcons', 'ourNonce') ?>

                <?php
                settings_fields('plugin_setting');
                do_settings_sections('setting_page');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
    function handleForm()
    {
        $error = false;
        // protect from external attacks or access from other than admin
        if (!wp_verify_nonce($_POST['ourNonce'], 'saveIcons') or !current_user_can('manage_options'))
            return;
        // if name is written the use chose to add the icon
        // making link and icon required if name is written 
        if (
            !empty($_POST['music_plugin_deletion'])
        ) {
            update_option('music_plugin_deletion', sanitize_text_field($_POST['music_plugin_deletion']));
            
        }
        if(empty($_POST['featured_album'])){
            echo ' <div class="error">
                <p>ERROR! Choose a Featured Album.</p>
              </div>';
            $error = true;
        }
        update_option('featured_album', sanitize_text_field($_POST['featured_album']));
        if (!$error) {
            echo '<div class="updated">
            <p>Settings updated successfully!!!.</p>
          </div>';
        }

    }

    public function register_fields()
    {
        add_settings_section(
            'setting_section',
            'Music Plugin Settings',
            array($this, 'section_callback'),
            'setting_page'
        );

        add_settings_field(
            'featured_album',
            'Featured Album',
            array($this, 'featured_album_field'),
            'setting_page',
            'setting_section'
        );
        add_settings_field(
            'music_plugin_deletion',
            'Erase Data after deletion',
            array($this, 'plugin_deletion_view'),
            'setting_page',
            'setting_section'
        );
        register_setting('plugin_setting', 'featured_album');
        register_setting('plugin_setting', 'music_plugin_deletion');

    }

    public function section_callback()
    {
        echo '<p>Choose the featured album on home page</p>';
    }

    public function featured_album_field()
    {
        $albums = get_categories('taxonomy=albums&type=music');
        ?>
        <select name="featured_album" id="featured_album">
            <option value="">Select an option</option>
            <?php
            foreach ($albums as $album) {
                echo '<option  value="' . esc_attr($album->term_id) . '" ' . '' . '>' . esc_html($album->name) . '</option>';
            }
            ?>
        </select>
        <?php

    }
    public function plugin_deletion_view()
    { ?>
        <input type="checkbox" value="1" <?php echo (get_option('music_plugin_deletion', 0) == 1) ? 'checked="checked"' : ''; ?>
            name="music_plugin_deletion" id="music_plugin_deletion" />
        <?php

    }

}
