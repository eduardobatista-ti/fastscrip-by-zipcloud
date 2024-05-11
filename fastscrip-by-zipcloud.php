<?php
/*
Plugin Name: FastScrip - By ZipCloud
Description: Plugin para inserir scripts em páginas específicas do WordPress.
Version: 1.0
Author: Seu Nome
*/

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

// Cria a página de configurações do plugin
function fastscrip_by_zipcloud_page() {
    ?>
    <div class="wrap">
        <h2>FastScrip - By ZipCloud</h2>
        <form method="post" action="options.php">
            <?php settings_fields('fastscrip_by_zipcloud_settings_group'); ?>
            <?php do_settings_sections('fastscrip-by-zipcloud'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Registra as configurações do plugin
add_action('admin_init', 'fastscrip_by_zipcloud_settings');

function fastscrip_by_zipcloud_settings() {
    register_setting(
        'fastscrip_by_zipcloud_settings_group',
        'fastscrip_by_zipcloud_settings',
        'fastscrip_by_zipcloud_settings_validate'
    );

    add_settings_section(
        'fastscrip_by_zipcloud_section',
        'Configurações do Script',
        'fastscrip_by_zipcloud_section_callback',
        'fastscrip-by-zipcloud'
    );

    add_settings_field(
        'fastscrip_by_zipcloud_script',
        'Insira o Script',
        'fastscrip_by_zipcloud_script_callback',
        'fastscrip-by-zipcloud',
        'fastscrip_by_zipcloud_section'
    );

    add_settings_field(
        'fastscrip_by_zipcloud_pages',
        'Selecione as Páginas',
        'fastscrip_by_zipcloud_pages_callback',
        'fastscrip-by-zipcloud',
        'fastscrip_by_zipcloud_section'
    );

    add_settings_field(
        'fastscrip_by_zipcloud_location',
        'Localização do Script',
        'fastscrip_by_zipcloud_location_callback',
        'fastscrip-by-zipcloud',
        'fastscrip_by_zipcloud_section'
    );
}

// Função de callback para a seção de configurações
function fastscrip_by_zipcloud_section_callback() {
    echo '<p>Configure o script e as páginas onde ele deve ser inserido.</p>';
}

// Função de callback para o campo de script
function fastscrip_by_zipcloud_script_callback() {
    $settings = get_option('fastscrip_by_zipcloud_settings');
    echo "<textarea id='fastscrip_by_zipcloud_script' name='fastscrip_by_zipcloud_settings[script]' rows='5' cols='50'>" . esc_attr($settings['script']) . "</textarea>";
}

// Função de callback para o campo de páginas
function fastscrip_by_zipcloud_pages_callback() {
    $settings = get_option('fastscrip_by_zipcloud_settings');
    $pages = get_pages();
    echo "<select id='fastscrip_by_zipcloud_pages' name='fastscrip_by_zipcloud_settings[pages][]' multiple='multiple'>";
    foreach ($pages as $page) {
        $selected = (in_array($page->ID, $settings['pages'])) ? 'selected' : '';
        echo "<option value='{$page->ID}' $selected>{$page->post_title}</option>";
    }
    echo "</select>";
}

// Função de callback para o campo de localização do script
function fastscrip_by_zipcloud_location_callback() {
    $settings = get_option('fastscrip_by_zipcloud_settings');
    $location = isset($settings['location']) ? $settings['location'] : 'header';
    ?>
    <input type="radio" id="fastscrip_by_zipcloud_header" name="fastscrip_by_zipcloud_settings[location]" value="header" <?php checked('header', $location); ?>>
    <label for="fastscrip_by_zipcloud_header">Header</label><br>
    <input type="radio" id="fastscrip_by_zipcloud_footer" name="fastscrip_by_zipcloud_settings[location]" value="footer" <?php checked('footer', $location); ?>>
    <label for="fastscrip_by_zipcloud_footer">Footer</label>
    <?php
}

// Validação das configurações
function fastscrip_by_zipcloud_settings_validate($input) {
    $new_input['script'] = sanitize_text_field($input['script']);
    $new_input['pages'] = array_map('intval', $input['pages']);
    $new_input['location'] = sanitize_text_field($input['location']);

    return $new_input;
}

// Adiciona o script nas páginas selecionadas
add_action('wp_head', 'fastscrip_by_zipcloud_insert_script_header');
add_action('wp_footer', 'fastscrip_by_zipcloud_insert_script_footer');

function fastscrip_by_zipcloud_insert_script_header() {
    fastscrip_by_zipcloud_insert_script('header');
}

function fastscrip_by_zipcloud_insert_script_footer() {
    fastscrip_by_zipcloud_insert_script('footer');
}

function fastscrip_by_zipcloud_insert_script($location) {
    $settings = get_option('fastscrip_by_zipcloud_settings');
    $script = isset($settings['script']) ? $settings['script'] : '';
    $pages = isset($settings['pages']) ? $settings['pages'] : array();
    $current_page_id = get_the_ID();

    if ($script && in_array($current_page_id, $pages) && $location === $settings['location']) {
        echo $script;
    }
}