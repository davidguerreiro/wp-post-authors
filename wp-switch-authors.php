<?php
/**
 * Plugin Name: WP Switch Authors
 * Plugin URI: https://93digital.co.uk
 * Description: This plugin allows admins to change post types authors massively choosing which author will be replaced.
 * Version: 1.0.0
 * Author: David Guerreiro ( 93Digital )
 * Author URI: https://github.com/davidguerreiro
 * License: GPL2
 *
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/

// Make sure this plugin is exposing data when called directly.
if ( ! function_exists( 'add_action' ) ) {
    echo "You know what, I am a WP Plugin so install me properly and do not cheat :)";
    exit();
}

define( 'AUTHORS_VERSION', '1.0' );
define( 'AUTHORS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// include main plugin class.
require_once( AUTHORS_PLUGIN_DIR . '/inc/posts_authors.php' );

// init plugin.
add_action( 'init', array( 'posts_authors', 'init' ) );