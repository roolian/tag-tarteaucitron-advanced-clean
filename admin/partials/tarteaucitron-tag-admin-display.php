<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       daeris.fr
 * @since      1.0.0
 *
 * @package    Tarteaucitron_Tag
 * @subpackage Tarteaucitron_Tag/admin/partials
 */
?>

<form action="options.php" method="post">
    <?php
        settings_fields('tarteaucitron_tag_settings_group');
        do_settings_sections('tarteaucitron-tag-page'); 
        submit_button();
        ?>
</form>