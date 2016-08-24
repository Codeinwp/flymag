<?php
/**
 * Child themes template
 */
?>
<div id="child_themes" class="ti-about-page-tab-pane">

    <?php
    $current_theme = wp_get_theme();

    if( !empty( $this->child_themes ) && is_array( $this->child_themes ) ) {

        ?>
        <div class="ti-about-page-tab-pane-center">

            <h1><?php esc_html_e( 'Get a whole new look for your site', $this->text_domain ); ?></h1>

            <p><?php esc_html_e( 'Below you will find a selection of Zerif Lite child themes that will totally transform the look of your site.', $this->text_domain ); ?></p>

        </div>


        <div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">
        <?php

        foreach ($this->child_themes as $child_theme) {
            ?>
            <div class="ti-about-page-child-theme-container">
                <div class="ti-about-page-child-theme-image-container">
                    <?php if( !empty($child_theme['image']) ) {
                        echo '<img src="'.$child_theme['image'].'" alt="" />';
                    } ?>

                    <div class="ti-about-page-child-theme-description">
                        <h2><?php if( !empty($child_theme['title']) ) { echo $child_theme['title']; } ?></h2>
                    </div>
                </div>
                <div class="ti-about-page-child-theme-details">
                    <?php if ( 'ZBlackBeard' != $current_theme['Name'] ) { ?>
                        <div class="theme-details">
                            <span class="theme-name">Zblackbeard</span>
                            <a href="http://themeisle.com/themes/zblackbeard/#pricing-single" class="button button-primary install right"><?php esc_html_e( 'Get now', 'zerif-lite' ); ?></a>
                            <a class="button button-secondary preview right" target="_blank" href="https://wp-themes.com/zblackbeard"><?php esc_html_e( 'Live Preview','zerif-lite'); ?></a>
                            <div class="zerif-lite-clear"></div>
                        </div>
                    <?php } else { ?>
                        <div class="theme-details active">
                            <span class="theme-name"><?php echo esc_html_e( 'Zblackbeard - Current theme', 'zerif-lite' ); ?></span>
                            <a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e('Customize','zerif-lite'); ?></a>
                            <div class="ti-about-page-clear"></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <hr />
            <?php
        }

        ?>
            </div>
            <div class="ti-about-page-tab-pane-half">
            </div>
        <?php

    }
    ?>





</div>