<?php
/**
 * Plugin Name: JPJuliao Blocks
 * Plugin URI: 
 * Description: A Gutenberg plugin created via create-guten-block.
 * Author: Juan Pablo Juliao
 * Author URI: http://jpjuliao.com/
 * Version: 1.0.0
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package JPJuliao
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';
