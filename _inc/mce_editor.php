<?php


// Register TinyMCE button
function register_bpmn_button( $buttons ) {
	array_push( $buttons, "|", "bpmn" );
	return $buttons;
}
function add_bpmn_TinyMCE_js( $plugin_array ) {
	$plugin_array['bpmn'] = plugin_dir_url( __FILE__ ) . '../tinymce/bpmn.js';
	return $plugin_array;
}
function bpmn_TinyMCE_button() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
		return;
	}
	if ( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'add_bpmn_TinyMCE_js' );
		add_filter( 'mce_buttons', 'register_bpmn_button' );
	}
}
add_action('init', 'bpmn_TinyMCE_button');

