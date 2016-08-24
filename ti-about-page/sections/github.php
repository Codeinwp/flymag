<?php
/**
 * Github
 */
?>

<div id="github" class="ti-about-page-tab-pane">

    <h1><?php esc_html_e( 'How can I contribute?', $this->text_domain ); ?></h1>

    <hr/>

    <div class="ti-about-page-tab-pane-half zerif-tab-pane-first-half">
        <p><strong><?php esc_html_e( 'Found a bug? Want to contribute with a fix or create a new feature?',$this->text_domain); ?></strong></p>

        <p><?php esc_html_e( 'GitHub is the place to go!','zerif-lite' ); ?></p>

        <p>
            <a href="<?php echo $this->github; ?>" class="github-button button button-primary"><?php esc_html_e( 'Zerif Lite on GitHub', 'zerif-lite' ); ?></a>
        </p>
        <hr>
    </div>

    <div class="ti-about-page-tab-pane-half">
        <p><strong><?php esc_html_e( 'Are you a polyglot? Want to translate Zerif Lite into your own language?', $this->text_domain ); ?></strong></p>

        <p><?php esc_html_e( 'Get involved at WordPress.org.', 'zerif-lite' ); ?></p>

        <p>
            <a href="<?php echo $this->translations_wporg; ?>" class="translate-button button button-primary"><?php _e( 'Translate Zerif Lite', 'zerif-lite' ); ?></a>
        </p>
        <hr>
    </div>

    <div>
        <h4><?php esc_html_e( 'Are you enjoying Zerif Lite?', 'zerif-lite' ); ?></h4>

        <p class="review-link"><?php echo sprintf( esc_html__( 'Rate our theme on %sWordPress.org%s. We\'d really appreciate it!', $this->text_domain ), '<a href="https://wordpress.org/themes/zerif-lite/">', '</a>' ); ?></p>

        <p><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></p>
    </div>

</div>