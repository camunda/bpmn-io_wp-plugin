<?php


register_activation_hook( __FILE__, 'your_plugin_activation_function' );

// Test current system for the features the plugin needs.

function t5_check_plugin_requirements() {

	$php_min_version = '5.4';
	// see http://www.php.net/manual/en/extensions.alphabetical.php
	$extensions = array (
		'iconv',
		'mbstring',
		'id3'
	);
	$errors = array ();

	$php_current_version = phpversion();

	if ( version_compare( $php_min_version, $php_current_version, '>' ) )
		$errors[] = "Your server is running PHP version $php_current_version but
			this plugin requires at least PHP $php_min_version. Please run an upgrade.";

//	foreach ( $extensions as $extension )
//		if ( ! extension_loaded( $extension ) )
//			$errors[] = "Please install the extension $extension to run this plugin.";

	return $errors;
}




// Call t5_check_plugin_requirements() and deactivate this plugin if there are error.

function poweredBy_OptIn() {

	$errors = t5_check_plugin_requirements();

	if ( empty ( $errors ) )
		return;

	// Suppress "Plugin activated" notice.
	unset( $_GET['activate'] );

	// this plugin's name
	$name = get_file_data( __FILE__, array ( 'Plugin Name' ), 'plugin' );

	printf(
		'<div class="error"><p>%1$s</p>
		<p><i>%2$s</i> has been deactivated.</p></div>',
		join( '</p><p>', $errors ),
		$name[0]
	);
	deactivate_plugins( plugin_basename( __FILE__ ) );


}



// Register OPT-IN confirmation when plugin is activated.
// Don't start on every page, the plugin page is enough.
if ( ! empty ( $GLOBALS['pagenow'] ) && 'plugins.php' === $GLOBALS['pagenow'] ) {
	add_action( 'admin_notices', 'poweredBy_OptIn', 0 );

}

function your_plugin_activation_function() {
	return('<script>confirm("!!WARNING!!\n------------------------\n\nThe javascript incuded in this plugin inserts a small \"powered by\" icon while rendering link. You must Opt-In to continue with installation of this plugin.");</script>');
}
