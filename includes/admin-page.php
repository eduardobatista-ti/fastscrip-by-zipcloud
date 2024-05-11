<?php
// Página de configurações do plugin
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
