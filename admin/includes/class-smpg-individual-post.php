<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

class SMPG_Individual_Post {

    private static $instance;
    public $_screen    = [];
    public $_taxonomy  = [];

    public static function get_instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    
    private function __construct(){
        
        add_action( 'admin_init', [ $this, 'initialize_metabox' ] );           
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_script' ],10);
        
    }

    public function initialize_metabox() {

        $smpg_settings = smpg_load_smpg_settings();        

        if ( isset( $smpg_settings['spg_post_types'] ) ) {

            $this->_screen   = apply_filters( 'smpg_filter_spg_post_types', $smpg_settings['spg_post_types'] );

            if( !empty($this->_screen) ){

                foreach ($this->_screen as  $value) {
                    add_action( "add_meta_boxes_{$value}", [ $this, 'add_meta_boxes' ], 10, 1 );	                
                }
    
            }
        }
        
        if ( isset( $smpg_settings['spg_taxonomies'] ) ) {

            $this->_taxonomy = apply_filters( 'smpg_filte_spg_taxonomy', $smpg_settings['spg_taxonomies'] );
            
            if( ! empty( $this->_taxonomy ) ){

                foreach ( $this->_taxonomy as $value ) {
                    add_action( "{$value}_edit_form_fields", [ $this, 'render_taxonomy_metabox' ], 10, 2 );
                }
    
            }
        }
                                    
    }

    public function add_meta_boxes( $post ) {

        $context = 'advanced';

        if ( smpg_is_gutenberg_editor() ) {
            $context = 'side';
        }
        
        foreach ( $this->_screen as  $value ) {
            
            add_meta_box(
                'smpg_individual_post_metabox',
                esc_html__( 'Schema Package Generator', 'schema-package' ),
                [ $this, 'render_metabox' ],
                $value,
                $context,
                'high'
            );

        }        
    }

    /**
     * Renders the meta box.
     */
    public function render_metabox( $post ){
          // Add nonce for security and authentication.
        wp_nonce_field( 'smpg_individual_nonce_action', 'smpg_individual_nonce' );

        echo '<div id="smpg_individual_post_container"></div>';        
        
    }
    public function render_taxonomy_metabox($term, $taxonomy){

        // Add nonce for security and authentication.
        wp_nonce_field( 'smpg_individual_nonce_action', 'smpg_individual_nonce' );

        echo '<tr class="smpg_individual_taxonomy">';  
        echo '<th>Schema Package</th>';  
        echo '<td><div id="smpg_individual_post_container"></div></td>'; 
        echo '</tr>';
    }
    
    public function to_be_enqueue( $hook ) {

            $local_data = [
                'smpg_plugin_url'      => SMPG_PLUGIN_URL,
                'rest_url'             => esc_url_raw( rest_url() ),
                'nonce'                => wp_create_nonce( 'wp_rest' ),
                'post_id'              => get_the_ID(),
                // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reason: Not processing form data
                'tag_id'               => ! empty( $_GET['tag_ID'] ) ? intval( wp_unslash( $_GET['tag_ID'] ) ) : ''
            ];

            wp_enqueue_media();    
            wp_enqueue_style( 'wp-components' );
            wp_register_script( 'smpg-individual-script', SMPG_PLUGIN_URL . 'admin/assets/react/dist/individual_post.js', [ 'wp-i18n', 'wp-components', 'wp-element', 'wp-api', 'wp-editor', 'wp-blocks' ], SMPG_VERSION, true );    
            wp_localize_script( 'smpg-individual-script', 'smpg_local', $local_data );
            wp_enqueue_script( 'smpg-individual-script');

    }
    
    public function enqueue_script( $hook ){

        global $taxonomy, $typenow;        
        
        if( in_array($typenow, $this->_screen) || in_array($taxonomy, $this->_taxonomy) ){    
            $this->to_be_enqueue($hook);
        }                
    }
        
}
SMPG_Individual_Post::get_instance();