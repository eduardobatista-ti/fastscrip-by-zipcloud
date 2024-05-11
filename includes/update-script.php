<?php
// Função para atualizar o script no GitHub
function fastscrip_by_zipcloud_update_script() {
    if (isset($_POST['fastscrip_by_zipcloud_update_script'])) {
        $settings = get_option('fastscrip_by_zipcloud_settings');
        $script = isset($settings['script']) ? $settings['script'] : '';
        $github_repo = isset($settings['github_repo']) ? $settings['github_repo'] : '';
        $github_version = isset($settings['github_version']) ? $settings['github_version'] : '';

        if ($script && $github_repo && $github_version) {
            $file = 'script.js'; // Nome do arquivo que contém o script
            $url = $github_repo . '/raw/' . $github_version . '/' . $file;
            $response = wp_remote_get($url);
            $body = wp_remote_retrieve_body($response);

            if (!is_wp_error($response) && $response['response']['code'] === 200) {
                $settings['script'] = $body;
                update_option('fastscrip_by_zipcloud_settings', $settings);
            }
        }
    }
}

// Hook para atualizar o script no GitHub
add_action('admin_init', 'fastscrip_by_zipcloud_update_script');
