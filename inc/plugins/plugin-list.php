<?php

/**
 * Initiate plugin installing class (TGMPA)
 *
 * @package WordPress
 * @subpackage Event
 * @since Event 1.0.4
 */

if( !function_exists( 'wplook_initiate_tgmpa' ) ) {

	function wplook_initiate_tgmpa() {

		$plugins = array(
			array(
				'name'      => 'Contact Form 7',
				'slug'      => 'contact-form-7',
				'required'  => false,
			),
			array(
				'name'      => 'Widget Importer & Exporter',
				'slug'      => 'widget-importer-exporter',
				'required'  => false,
			),
			array(
				'name'      => 'WordPress Importer',
				'slug'      => 'wordpress-importer',
				'required'  => false,
			),
		);

		// Global TGMPA options - add individual plugins above
		$config = array(
			'id'           => 'event-wpl',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );

	}

	add_action( 'tgmpa_register', 'wplook_initiate_tgmpa' );

}

?>
