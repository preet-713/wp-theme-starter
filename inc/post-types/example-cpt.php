WARNING: The WordPress standard uses 1 deprecated sniff
-------------------------------------------------------------------------------
-  Generic.Functions.CallTimePassByReference
   This sniff has been deprecated since v3.12.1 and will be removed in v4.0.0.

Deprecated sniffs are still run, but will stop working at some point in the
future.

<?php
/**
 * Example Custom Post Type.
 * Duplicate and rename this file for each additional CPT.
 *
 * @package MyTheme\PostTypes
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'init',
	static function (): void {
		register_post_type(
			'cpt',
			array(
				'labels'            => array(
					'name'               => __( 'CPTs', 'juralaw' ),
					'singular_name'      => __( 'CPT', 'juralaw' ),
					'add_new'            => __( 'Add New', 'juralaw' ),
					'add_new_item'       => __( 'Add New CPT', 'juralaw' ),
					'edit_item'          => __( 'Edit CPT', 'juralaw' ),
					'new_item'           => __( 'New CPT', 'juralaw' ),
					'all_items'          => __( 'All CPTs', 'juralaw' ),
					'view_item'          => __( 'View CPT', 'juralaw' ),
					'search_items'       => __( 'Search CPTs', 'juralaw' ),
					'not_found'          => __( 'No CPTs Found', 'juralaw' ),
					'not_found_in_trash' => __( 'No CPTs Found in Trash', 'juralaw' ),
					'menu_name'          => __( 'CPTs', 'juralaw' ),
				),

				'public'            => true,
				'show_ui'           => true,
				'show_in_menu'      => true,
				'show_in_nav_menus' => true,
				'show_in_admin_bar' => true,
				'show_in_rest'      => true,

				'has_archive'       => true,
				'rewrite'           => array(
					'slug'       => 'CPTs',
					'with_front' => false,
				),

				'hierarchical'      => false,
				'supports'          => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),

				'menu_icon'         => 'dashicons-*',
				'menu_position'     => 25,

				'capability_type'   => 'post',
				'map_meta_cap'      => true,

				'can_export'        => true,
				'delete_with_user'  => false,
			)
		);
	}
);
