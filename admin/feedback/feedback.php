<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

function smpg_is_plugins_page() {

    if ( function_exists( 'get_current_screen' ) ) {

        $screen = get_current_screen();

            if ( is_object( $screen ) ) {

                if ( $screen->id == 'plugins' || $screen->id == 'plugins-network' ) {
                    return true;
                }

            }
    }

    return false;
}

add_filter( 'admin_footer', 'smpg_deactivation_feedback_modal' );

function smpg_deactivation_feedback_modal() {

    if ( is_admin() && smpg_is_plugins_page() ) {

        $email = '';

        if ( function_exists( 'wp_get_current_user' ) ) {

            $current_user = wp_get_current_user();

            if ( $current_user instanceof WP_User ) {
                $email = trim( $current_user->user_email );	
            }

        }
        
        ?>

<div id="smpg-feedback-overlay" style="display: none;">
	
    <div id="smpg-feedback-content">
		<div class="smpg-dp-header">
            <h3><?php esc_html_e('Deactivating Schema Package', 'schema-package') ?></h3>
            <button class="close dashicons dashicons-no smpg-fd-stop-deactivation">
                <span class="screen-reader-text"></span>
            </button>
        </div>
    	<form action="" method="post">
		<div class="smpg-dp-body">
	    <p><strong><?php esc_html_e('Help us improve — why are you deactivating the plugin?', 'schema-package'); ?></strong></p>
        <ul class="smpg-dp-reasons">
            <li>
                <input type="radio" id="smpg-reason1" name="smpg_disable_reason" value="temporary" />
                <label for="smpg-reason1"><?php esc_html_e('The deactivation is temporary', 'schema-package') ?></label>
            </li>
            <li>
                <input type="radio" id="smpg-reason2" name="smpg_disable_reason" value="stopped_using" />
                <label for="smpg-reason2"><?php esc_html_e('No longer using schema markup', 'schema-package') ?></label>
            </li>
            <li>
                <input type="radio" id="smpg-reason3" name="smpg_disable_reason" value="missing_feature" />
                <label for="smpg-reason3"><?php esc_html_e('Needed feature not available', 'schema-package') ?></label>
            </li>
            <li>
                <input type="radio" id="smpg-reason4" name="smpg_disable_reason" value="technical_difficulties" />
                <label for="smpg-reason4"><?php esc_html_e('Facing Technical Difficulties', 'schema-package') ?></label>
            </li>
            <li>
                <input type="radio" id="smpg-reason5" name="smpg_disable_reason" value="switched_plugin" />
                <label for="smpg-reason5"><?php esc_html_e('Switched to a different plugin', 'schema-package') ?></label>
            </li>
            <li>
                <input type="radio" id="smpg-reason6" name="smpg_disable_reason" value="other_reason" />
                <label for="smpg-reason6"><?php esc_html_e('Other reason', 'schema-package') ?></label>
            </li>
        </ul>
	    <div class="smpg-reason-details">
				<textarea data-id="smpg-reason3" class="smpg-d-none" rows="3" name="smpg_missing_feature_text" placeholder="<?php esc_attr_e( 'Kindly describe the feature you found missing.', 'schema-package' ); ?>"></textarea>
                <textarea data-id="smpg-reason4" class="smpg-d-none" rows="3" name="smpg_technical_difficulties_text" placeholder="<?php esc_attr_e( 'Kindly provide details about the difficulties you\'re facing.', 'schema-package' ); ?>"></textarea>
                <textarea data-id="smpg-reason5" class="smpg-d-none" rows="3" name="smpg_switched_plugin_text" placeholder="<?php esc_attr_e( 'If you don\'t mind, name the plugin you switched to.', 'schema-package' ); ?>"></textarea>
                <textarea data-id="smpg-reason6" class="smpg-d-none" rows="3" name="smpg_other_reason_text" placeholder="<?php esc_attr_e( 'Kindly provide a brief explanation.', 'schema-package' ); ?>"></textarea>
		</div>
		</div>
		<hr/>
		<div class="smpg-dp-footer">
			<?php if( null !== $email && !empty( $email ) ) : ?>
    	    	<input type="hidden" name="smpg_deactivated_from" value="<?php echo esc_attr($email); ?>" />
	    	<?php endif; ?>

			<input id="smpg-feedback-submit" class="button button-primary" type="submit" name="smpg_disable_submit" value="<?php esc_html_e('Submit & Deactivate', 'schema-package'); ?>"/>
	    	<a class="button smpg-only-deactivate"><?php esc_html_e('Skip & Deactivate', 'schema-package'); ?></a>
	    	<a class="button smpg-dt-de smpg-fd-stop-deactivation"><?php esc_html_e('Don\'t Deactivate', 'schema-package'); ?></a>
		</div>	    
	</form>
    </div>
</div>
<?php
        

    }
    
}


function smpg_send_feedback() {

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die();
    }

        //phpcs:ignore WordPress.Security.NonceVerification.Missing -- Reason : Since form is serialised nonce is verified after parsing the recieved data.
    if ( isset( $_POST['data'] ) ) {
        //phpcs:ignore WordPress.Security.NonceVerification.Missing -- Reason : Since form is serialised nonce is verified after parsing the recieved data.
        parse_str( $_POST['data'], $form );
    }
    
    if ( ! isset( $form['smpg_security_nonce'] ) || isset( $form['smpg_security_nonce'] ) && !wp_verify_nonce( sanitize_text_field( $form['smpg_security_nonce'] ), 'smpg_ajax_check_nonce' ) ) {

        echo esc_html__('Nonce Not Verified', 'schema-package');
        
        wp_die();
    }    
    
    $text = $subject = '';
        
    $headers = [];

    $from = isset( $form['smpg_deactivated_from'] ) ? $form['smpg_deactivated_from'] : '';

    if ( $from ) {
        $headers[] = "From: $from";
        $headers[] = "Reply-To: $from";
    }

    $reason = isset( $form['smpg_disable_reason'] ) ? $form['smpg_disable_reason'] : 'No Reason Given';

    switch ( $reason ) {

        case 'temporary':
            $subject = 'The deactivation is temporary';        
            $text    = 'The deactivation is temporary';
        break;
        case 'stopped_using':
            $subject = 'No longer using schema markup';
            $text    = 'No longer using schema markup';
        break;
        case 'missing_feature':
            $subject = 'Needed feature not available';
            if ( ! empty( $form['smpg_missing_feature_text'] ) ) {
                $text    = $form['smpg_missing_feature_text'];
            }
        
        break;
        case 'technical_difficulties':
            $subject = 'Facing Technical Difficulties';
            if ( ! empty( $form['smpg_technical_difficulties_text'] ) ) {
                $text    = $form['smpg_technical_difficulties_text'];
            }
        break;
        case 'switched_plugin':
            $subject = 'Switched to a different plugin';
            if ( ! empty( $form['smpg_switched_plugin_text'] ) ) {
                $text    = $form['smpg_switched_plugin_text'];
            }
        break;
        case 'other_reason':
            $subject = 'Other reason';
            if ( ! empty( $form['smpg_other_reason_text'] ) ) {
                $text    = $form['smpg_other_reason_text'];
            }
        break;        
        default:
            $subject = 'No Reason Given';
            $text    = 'No Reason Given';
        break;

    }
    
    wp_mail( 'support@schemapackage.com', $subject, $text, $headers );
    
    echo 'sent';
    wp_die();

}

add_action( 'wp_ajax_smpg_send_feedback', 'smpg_send_feedback' );

function smpg_enqueue_feedback_scripts() {

    if ( is_admin() && smpg_is_plugins_page() ) {

        $min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        wp_enqueue_style( 'smpg-feedback-css', SMPG_PLUGIN_URL . "admin/feedback/feedback{$min}.css", false,  SMPG_VERSION );
        wp_register_script( 'smpg-feedback-js', SMPG_PLUGIN_URL . "admin/feedback/feedback{$min}.js", [ 'jquery' ],  SMPG_VERSION, true );

         $localdata = [
                'ajax_url'      		       => admin_url( 'admin-ajax.php' ),
                'smpg_security_nonce'          => wp_create_nonce( 'smpg_ajax_check_nonce' )
         ];

        wp_localize_script( 'smpg-feedback-js', 'smpg_feedback_local', $localdata );
        wp_enqueue_script( 'smpg-feedback-js' );
                
    }
    
}

add_action( 'admin_enqueue_scripts', 'smpg_enqueue_feedback_scripts' );