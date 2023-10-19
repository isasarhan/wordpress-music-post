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
            'Setting',
            'Setting',
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
            <form method="post" action="options.php">
                <input type="hidden" name="justsubmitted" value="true">
                <?php
                settings_fields('plugin_setting');
                do_settings_sections('setting_page');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public function register_fields()
    {
        add_settings_section(
            'setting_section',
            'Music Plugin Setting',
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
        register_setting('plugin_setting', 'featured_album');

    }

    public function section_callback()
    {
        echo '<p>Choose the featured album</p>';
    }

    public function featured_album_field()
    {
        $albums = get_categories('taxonomy=albums&type=music');
        ?>
        <select name="featured_album" id="featured_album">
            <option value="">Select an option</option>
            <?php
            foreach ($albums as $album) {
                echo '<option value="' . esc_attr($album->name) . '" ' . '' . '>' . esc_html($album->name) . '</option>';
            }
            ?>
        </select>
        <?php

    }
}
