<?php
/*
Plugin Name: FastScrip - By ZipCloud
Description: Plugin para inserir scripts em páginas específicas do WordPress.
Version: 1.2
Author: <a href=https://zipcloud.com.br>ZipCloud</a>
*/

// Inclui os arquivos do plugin
include_once(plugin_dir_path(__FILE__) . '/includes/admin-page.php');
include_once(plugin_dir_path(__FILE__) . '/includes/settings-fields.php');
include_once(plugin_dir_path(__FILE__) . '/includes/update-script.php');

// Adiciona a página de configurações do plugin ao menu do painel do WordPress
add_action('admin_menu', 'fastscrip_by_zipcloud_menu');

function fastscrip_by_zipcloud_menu() {
    add_menu_page(
        'FastScrip - By ZipCloud',
        'FastScrip - By ZipCloud',
        'manage_options',
        'fastscrip-by-zipcloud',
        'fastscrip_by_zipcloud_page',
        'dashicons-admin-generic'
    );
}

// Adiciona o script nas páginas
