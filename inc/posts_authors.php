<?php
/**
 * Plugin main class
 * 
 * @package wp-posts-authors/inc
 */

class Posts_Authors {

    private static $initiated   = false;
    private static $shortname   = 'Posts_Authors';

    /**
     * Main init function
     * 
     * @return void
     */
    public static function init() {
        if ( ! self::$initiated ) {
            self::init_hooks();
        }
    }

    /**
     * Initialize WordPress hooks
     * 
     * @return void
     */
     public static function init_hooks() {
        self::$initiated = true;

        add_action( 'admin_menu', array( self::$shortname, 'add_menu_page_option' ) );

        add_action( 'admin_enqueue_scripts', array( self::$shortname, 'enqueue_scripts' ) );

        // change author image dinamically when selected.
        add_action( 'wp_ajax_get_user_gravatar', array( self::$shortname, 'get_gravatar_by_ajax' ) );

        // move posts from original author to new author.
        add_action( 'wp_ajax_set_new_author', array( self::$shortname, 'switch_author_posts' ) );
     }

     /**
      * Add menu page option
      * 
      * @static
      * @return void
      */
      public static function add_menu_page_option() {
        add_menu_page(
            'Transfer Authors',
            'Transfer Authors',
            'administrator',
            'wp-posts-authors',
            array( self::$shortname, 'display_main_page' ),
            'dashicons-edit'
        );
      }

      /**
       * Displays plugin main page
       * 
       * @static
       * @return void
       */
      public static function display_main_page() {
          require_once( plugin_dir_path( dirname( __FILE__ ) ) . 'views/settings.php' );
      }

      /**
       * Enqueue plugin css / js files
       * 
       * @static
       * @return void
       */
      public static function enqueue_scripts() {

        // main css file.
        $css_url    = plugins_url( '/css/style.css', dirname( __FILE__ ) );
        $js_url     = plugins_url( '/js/scripts.js', dirname( __FILE__ ) );
        wp_enqueue_style( 'pa-main-css', $css_url, array(), '1.0', 'all' );
        wp_enqueue_script( 'pa-main-js', $js_url, array( 'jquery' ), '1.1', true );
      }

      /**
       * Get author image. This function can be called
       * statically and by ajax.
       * 
       * @static
       * @param int ( required ) $user_id User id
       * @param boolean          $is_ajax True by default   
       * @return String || Object
       */
      public static function get_author_image( $user_id, $is_ajax = true ) {
        $args = array(
            'size' => 200,
        );
        $img_url = get_avatar_url( $user_id, $args );

        if ( $is_ajax ) {
            $data = array(
                'img_url' => $img_url,
            );
            self::return_response( $data );
        }
        return $img_url;
      }

      /**
       * Wrapper to get author image by ajax
       * 
       * @return void.
       */
      public static function get_gravatar_by_ajax() {
          $data = array();
          if ( isset( $_POST['user_id'] ) && ! empty( $_POST['user_id'] ) ) {
            $data = self::get_author_image( intval( $_POST['user_id']), true );
          }
          self::return_response( $data );
      } 

      /**
       * Return ajax response
       * 
       * @param Array ( required ) $data Data to be encoded.
       * @return void
       */
      private static function return_response( $data ) {
          echo json_encode( $data );
          exit;
      } 

      /**
       * Switch author's posts
       *
       * @return void
       */
      public static function switch_author_posts() {
          global $post;
          $data = array(
              'status' => false,
          );

          // data sent by ajax comes from  HTTP POST - variable name : $data.$_COOKIE
          if ( ! isset( $_POST['data'] ) ) {
              $data['notification'] = "There is an error in the server, please try again";
              self::return_response( $data );
          }

          // get all params.
          $params       = array();
          $post_types   = array();
          foreach ( $_POST['data'] as $array_data ) {
            // post types have to be saved in a separate array.
            if ( $array_data['name'] == 'post-type[]' ) {
                $post_types[] = $array_data['value'];
            } else {
                $params[ $array_data['name'] ] = $array_data['value'];
            }
          }
            
          if ( ! isset( $params['author-new'] ) || ! isset( $params['author-old'] ) || ! isset( $params['nonce'] ) ) {
              $data['notification'] = 'No data has been provided';
              self::return_response( $data ); 
          }

          if ( empty( $params['nonce'] ) || ! wp_verify_nonce( $params['nonce'], 'wpa' ) ) {
              $data['notification'] = 'Invalid nonce';
              self::return_response( $data );
          }

          if ( empty( $post_types ) ) {
              $data['notification'] = 'Minimun one post type is required';
              self::return_response( $data );
          }

          $current_aut_id = (int) $params['author-old'];
          $new_aut_id     = (int) $params['author-new'];

          if ( $current_aut_id === $new_aut_id ) {
            $data['notification'] = 'You cannot transfer posts to the same author';
            self::return_response( $data );
          }

          $args = array(
              'posts_per_page'  => -1,
              'author'          => $current_aut_id,
              'post_type'       => $post_types,
          );
          $posts = get_posts( $args );
          
          foreach ( $posts as $the_post ) {
              $args = array(
                'ID'            => $the_post->ID,
                'post_author'   => $new_aut_id,
              );
              wp_update_post( $args );
          }

          $data['status'] = true;
          $data['notification'] = 'Posts have been successfully transfered. Have fun !!';
          self::return_response( $data );
      }
}