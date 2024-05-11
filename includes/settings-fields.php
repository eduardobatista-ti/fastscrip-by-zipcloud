<?php
// Campos de configuração do plugin
function fastscrip_by_zipcloud_settings() {
    register_setting(
        'fastscrip_by_zipcloud_settings_group', // Corrigido: Nome do grupo de configurações
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

    add_settings_field(
        'fastscrip_by_zipcloud_version',
        'Versionamento do Script (GitHub)',
        'fastscrip_by_zipcloud_version_callback',
        'fastscrip-by-zipcloud',
        'fastscrip_by_zipcloud_section'
    );

    add_settings_field(
        'fastscrip_by_zipcloud_update_button',
        'Atualizar Script (GitHub)',
        'fastscrip_by_zipcloud_update_button_callback',
        'fastscrip-by-zipcloud',
        'fastscrip_by_zipcloud_section'
    );
}
