<?php
/**
 * Changelog
 */
$theme_obj = wp_get_theme( $this->theme_slug );
?>
<div class="ti-about-page-tab-pane" id="changelog">

    <div class="ti-about-page-tab-pane-center">

        <h1><?php echo $this->theme_name; ?> <?php if( !empty($theme_obj['Version']) ): ?> <sup id="ti-about-page-theme-version"><?php echo esc_attr( $theme_obj['Version'] ); ?> </sup><?php endif; ?></h1>

    </div>

    <?php
    WP_Filesystem();
    global $wp_filesystem;
    $ti_about_page_changelog = $wp_filesystem->get_contents( get_template_directory().'/CHANGELOG.md' );
    $ti_about_page_changelog_lines = explode(PHP_EOL, $ti_about_page_changelog);
    foreach($ti_about_page_changelog_lines as $ti_about_page_changelog_line){
        if(substr( $ti_about_page_changelog_line, 0, 3 ) === "###"){
            echo '<hr /><h1>'.substr($ti_about_page_changelog_line,3).'</h1>';
        } else {
            echo $ti_about_page_changelog_line.'<br/>';
        }
    }
    ?>

</div>