<?php
/**
 * Main plugin page
 * 
 * @package wp-posts-authors/views
 */

 $trans_key = 'wpa';
 $nonce     = wp_create_nonce( $trans_key );

 // get all non-subscribers users.
 $args = array(
     'role__not_in' => array( 'subscriber' ),
 );
 $users = get_users( $args );

 // get all CPT.
 $args = array(
     'public' => true,
 );
 $post_types = get_post_types( $args );

 // get initial author image.
 $author_img_url = Posts_Authors::get_author_image( $users[0]->ID, false );


 ?>

 <header class="plugin-section">
    <h2 class="plugin-section__title">
        <?php _e( 'WP Posts Authors', $trans_key ); ?>
    </h2>
 </header>
<section class="plugin-section">
    <form action="" method="post" class="plugin-main-form" id="switch-form" data-ajax="<?php echo admin_url( 'admin-ajax.php' ); ?>">
        <input type="hidden" name="wpa-form" value="main-form">
        <input type="hidden" name="nonce" value="<?php echo $nonce; ?>">

        <div class="form__section">
            <h3>
                <?php _e( 'Authors', $trans_key ); ?>
            </h3>
            <!-- Old author section -->
            <div class="form__input-section">
                <label for="author-old" class="author__label">Author to be replaced :</label>
                <img src="<?php echo esc_url( $author_img_url ); ?>" alt="" id="current-author" class="author__image">
                <select name="author-old" class="author__selector" data-image="current-author" data-ajax="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                    <?php foreach ( $users as $user ) : ?>
                        <option value="<?php echo $user->ID; ?>">
                            <?php echo $user->data->user_nicename; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- New author section -->
            <div class="form__input-section">
                <label for="author-new" class="author__label">New author :</label>
                <img src="<?php echo esc_url( $author_img_url ); ?>" alt="" id="new-author" class="author__image">
                <select name="author-new" class="author__selector" data-image="new-author" data-ajax="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                    <?php foreach ( $users as $user ) : ?>
                        <option value="<?php echo $user->ID; ?>">
                            <?php echo $user->data->user_nicename; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Custom post types -->
        <div class="form__section">
            <h3>
                <?php _e( 'Post Types', $trans_key ); ?>
            </h3>
            <ul>
                <?php foreach ( $post_types as $post_type ) : ?>    
                    <li>
                    <input type="checkbox" 
                        name="post-type[]"
                        value="<?php echo $post_type; ?>"
                        <?php if ( $post_type == 'post' ) { echo 'checked'; } ?>
                        >
                        <label for="<?php echo $post_type; ?>">
                            <?php echo ucfirst( $post_type ); ?>
                        </label>
                    </li>
                <?php endforeach; ?> 
            </ul>
        </div>

        <div class"form__section">
            <input type="submit" value="Switch Author Posts" class="form__submit-buttom">
        </div>
        <div class="form_section">
            
            <svg width="120" height="30" viewBox="0 0 120 30" xmlns="http://www.w3.org/2000/svg" fill="#832AC9" id="loader">
                <circle cx="15" cy="15" r="15">
                    <animate attributeName="r" from="15" to="15"
                            begin="0s" dur="0.8s"
                            values="15;9;15" calcMode="linear"
                            repeatCount="indefinite" />
                    <animate attributeName="fill-opacity" from="1" to="1"
                            begin="0s" dur="0.8s"
                            values="1;.5;1" calcMode="linear"
                            repeatCount="indefinite" />
                </circle>
                <circle cx="60" cy="15" r="9" fill-opacity="0.3">
                    <animate attributeName="r" from="9" to="9"
                            begin="0s" dur="0.8s"
                            values="9;15;9" calcMode="linear"
                            repeatCount="indefinite" />
                    <animate attributeName="fill-opacity" from="0.5" to="0.5"
                            begin="0s" dur="0.8s"
                            values=".5;1;.5" calcMode="linear"
                            repeatCount="indefinite" />
                </circle>
                <circle cx="105" cy="15" r="15">
                    <animate attributeName="r" from="15" to="15"
                            begin="0s" dur="0.8s"
                            values="15;9;15" calcMode="linear"
                            repeatCount="indefinite" />
                    <animate attributeName="fill-opacity" from="1" to="1"
                            begin="0s" dur="0.8s"
                            values="1;.5;1" calcMode="linear"
                            repeatCount="indefinite" />
                </circle>
            </svg>
            <p class="form-section__notification">
            </p>
        </div>

    </form>
</section>
<footer class="plugin-section">
    <p class="plugin-footer__text">
        <?php _e( 'Proudly developed by :', $trans_key ); ?>
    </p>
    <a href="https://93digital.co.uk" class="plugin-footer__link" targer="_blank">
        <img src="<?php echo plugin_dir_url( dirname( __FILE__) ) . 'assets/img/ninethree.png'; ?>" alt="" class="plugin-footer__image">
    </a>
</footer>