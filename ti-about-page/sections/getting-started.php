<?php
/**
 * Getting started template
 */

$customizer_url = admin_url() . 'customize.php' ;

$theme_obj = wp_get_theme( $this->theme_slug );
?>

<div id="getting_started" class="ti-about-page-tab-pane active">

    <div class="ti-about-page-tab-pane-center">

        <h1 class="ti-about-page-welcome-title">Welcome to <?php echo $this->theme_name; ?> <?php if( !empty($theme_obj['Version']) ): ?> <sup id="ti-about-page-theme-version"><?php echo esc_attr( $theme_obj['Version'] ); ?> </sup><?php endif; ?></h1>

        <?php
        if( !empty($this->theme_short_description) ) {
            echo '<p>'.$this->theme_short_description.'</p>';
        }
        ?>
        <p><?php esc_html_e( 'We want to make sure you have the best experience using Zerif Lite and that is why we gathered here all the necessary informations for you. We hope you will enjoy using Zerif Lite, as much as we enjoy creating great products.', $this->text_domain ); ?>

    </div>

    <hr />

    <div class="ti-about-page-tab-pane-center">

        <h1><?php esc_html_e( 'Getting started', $this->text_domain ); ?></h1>

        <h4><?php esc_html_e( 'Customize everything in a single place.' ,$this->text_domain ); ?></h4>
        <p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', $this->text_domain ); ?></p>
        <p><a href="<?php echo esc_url( $customizer_url ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', $this->text_domain ); ?></a></p>

    </div>

    <hr />

    <?php
        if( !empty( $this->docs ) && is_array( $this->docs ) ) {

            ?>
            <div class="ti-about-page-tab-pane-center">

                <h1><?php esc_html_e( 'FAQ', $this->text_domain ); ?></h1>

            </div>
            <div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">
                <?php

                foreach ($this->docs as $doc) {

                    ?>
                    <h4><?php esc_html_e( $doc['title'], $this->text_domain ); ?></h4>
                    <p><?php esc_html_e( $doc['description'], $this->text_domain ); ?></p>
                    <p><a href="<?php echo esc_url( 'http://docs.themeisle.com/article/14-how-to-create-a-child-theme/' ); ?>" class="button"><?php esc_html_e( 'View how to do this', $this->text_domain ); ?></a></p>
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


    <div class="ti-about-page-clear"></div>

    <hr />

    <div class="ti-about-page-tab-pane-center">

        <h1><?php esc_html_e( 'View full documentation', $this->text_domain ); ?></h1>
        <p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed information on how to use Zerif Lite.', $this->text_domain ); ?></p>
        <p><a href="<?php echo esc_url( 'http://themeisle.com/documentation-ti-about-page/' ); ?>" class="button button-primary"><?php esc_html_e( 'Read full documentation', $this->text_domain ); ?></a></p>

    </div>

    <hr />

    <?php
    if( !empty( $this->plugins ) && is_array( $this->plugins ) ) {

    ?>
    <div class="ti-about-page-tab-pane-center">

        <h1><?php esc_html_e('Recommended plugins', $this->text_domain); ?></h1>

    </div>
    <div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">
        <?php

        foreach ($this->plugins as $plugin) {
            ?>
            <h4><?php esc_html_e( 'Page Builder by SiteOrigin', $this->text_domain ); ?></h4>
            <p><?php esc_html_e( 'Build responsive page layouts using the widgets you know and love using this simple drag and drop page builder.', $this->text_domain ); ?></p>

            <?php if ( is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) ) { ?>

                <p><span class="ti-about-page-w-activated button"><?php esc_html_e( 'Already activated', $this->text_domain ); ?></span></p>

                <?php
            }
            else { ?>

                <p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=siteorigin-panels' ), 'install-plugin_siteorigin-panels' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Page Builder by SiteOrigin', $this->text_domain ); ?></a></p>

                <?php
            }

            ?>

            <hr />
            <?php
        }
        ?>
    </div>
    <div class="ti-about-page-tab-pane-half ti-about-page-tab-pane-first-half">

    </div>
    <?php
    }
    ?>

    <div class="ti-about-page-clear"></div>

</div>