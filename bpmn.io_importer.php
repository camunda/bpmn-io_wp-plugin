<?php
/*
 Plugin Name: bpmn.io
 Plugin URI: http://bpmn.io/
 Description: A BPMN 2.0 rendering toolkit and web modeler. bpmn.io simplifies creating, embedding and extending BPMN diagrams.
 Author: Camunda Services GmbH
 Version: 1.0
 Author URI: http://www.camunda.org
 */



// Register BPMN mime type
function mime_type_bpmn($existing_mimes) {
	$existing_mimes['bpmn'] = 'application/bpmn+xml';
	return $existing_mimes;
}
add_filter('mime_types', 'mime_type_bpmn');



// Register BPMN as Media Type
function post_mime_type_bpmn($post_mime_types) {
	$post_mime_types['application/bpmn+xml'] = array(
		__('BPMN'), 
		__('Manage BPMN Diagrams'), 
		_n_noop('BPMN <span class="count">(%s)</span>', 'BPMN <span class="count">(%s)</span>')
	);
	return $post_mime_types;
}
add_filter('post_mime_types', 'post_mime_type_bpmn');



// Include bpmn-io ONLY when post contains a .bpmn media attachment
function bpmn_mediaType_handler($content) {
	if (strstr($content, '.bpmn')) {
		wp_enqueue_script( 'bpmn-io_navigated', plugins_url('/bower_components/bpmn-js/dist/bpmn-navigated-viewer.min.js', __FILE__), array('jquery'), '1.0', true );
	}
	return $content;
}
add_filter('the_content', 'bpmn_mediaType_handler');



// The bpmn-io HTML - load .bpmn file
function bpmnio_file_html( $bpmn_data ) {
	$id = uniqid();
	$html =  '<div id="bpmnio-'. $id .'" class="bpmn-io"></div>'."\n";
	$html .= '<script>'."\n";
	$html .= 'jQuery(document).ready(function($) {'; 
	$html .= "'use strict';";
	$html .= "var BpmnViewer = window.BpmnJS;";
	$html .= "var viewer = new BpmnViewer({ container: '#bpmnio-". $id ."' });";
	$html .= "var xhr = new XMLHttpRequest();";
	$html .= "xhr.onreadystatechange = function() {";
	$html .= "if (xhr.readyState === 4) {";
	$html .= "viewer.importXML(xhr.response, function(err) {";
	$html .= "if (!err) {";
	$html .= "console.log('success!');";
	$html .= "viewer.get('canvas').zoom('fit-viewport');";
	$html .= "} else {";
	$html .= "console.log('something went wrong:', err);";
	$html .= "}";
	$html .= "});";
	$html .= "}";
	$html .= "};";
	$html .= "xhr.open('GET', '". $bpmn_data ."', true);";
	$html .= "xhr.send(null);";
	$html .= "});"."\n";
	$html .= '</script>'."\n";
	return $html;
}



// Bind BPMN media formatting to editor
function bpmn_media_to_editor( $html, $id, $attachment ) {
	$mime = get_post_mime_type( $id ); 
	if ($mime == 'application/bpmn+xml') {
		$html = bpmnio_file_html( $attachment['url'] );
	}
	return $html;
}
add_filter( 'media_send_to_editor', 'bpmn_media_to_editor', 7, 3 );



?>