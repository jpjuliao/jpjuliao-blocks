<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package JPJuliao
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function jpjuliao_blocks_assets() {
	// Styles.
	wp_enqueue_style(
		'jpjuliao-blocks-style', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		array( 'wp-editor' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);
}
add_action( 'enqueue_block_assets', 'jpjuliao_blocks_assets' );

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-plugins} to register sidebar plugins 
 * @uses {wp-edit-post} 
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function jpjuliao_blocks_editor_assets() {
	// Scripts.
	wp_enqueue_script(
		'jpjuliao-blocks-editor-script', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-plugins', 'wp-edit-post', 'wp-element', 'wp-editor' ) // Dependencies, defined above.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ) // Version: File modification time.
	);
	// Styles.
	wp_enqueue_style(
		'jpjuliao-blocks-editor-style', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);
}
add_action( 'enqueue_block_editor_assets', 'jpjuliao_blocks_editor_assets' );

/**
 * Get Sidebar up and Running
 *
 * @since 1.0.0
 */
// function jpjuliao_sidebar_register() {
//     wp_register_script(
//         'jpjuliao-blocks-sidebar',
//         plugins_url( 'sidebar.js', __FILE__ ),
//         array( 'wp-plugins', 'wp-edit-post', 'wp-element' )
//     );
// }
// add_action( 'init', 'jpjuliao_sidebar_register' );
// function jpjuliao_sidebar_script_enqueue() {
//     wp_enqueue_script( 'jpjuliao-blocks-sidebar' );
// }
// add_action( 'enqueue_block_editor_assets', 'jpjuliao_sidebar_script_enqueue' );