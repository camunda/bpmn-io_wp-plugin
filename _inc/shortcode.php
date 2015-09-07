<?php

/*
// Include bpmn-io ONLY when post contains a .bpmn media attachment
add_filter('the_content', 'bpmn_mediaType_handler' );
function bpmn_mediaType_handler($content) {
	$content .= '<h2>blah</h2';

	return $content;
}
*/

// The bpmn-io HTML - load shortcode XML
function bpmnio_xml_html( $bpmn_data ) {
	wp_enqueue_script( 'bpmn-io_navigated', plugins_url('../bower_components/bpmn-js/dist/bpmn-navigated-viewer.min.js', __FILE__), array('jquery'), '1.0', true );
	
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


	$html .= '</script>'."\n";
	return $html;
}




// media to shortcode
function bpmn_media_to_shortcode( $html, $id, $attachment ) {
	$mime = get_post_mime_type( $id ); 
	if ($mime == 'application/bpmn+xml') {
		$html = '[bpmn url="'. $attachment['url'] .'"]';
	}
	return $html;
}
add_filter( 'media_send_to_editor', 'bpmn_media_to_shortcode', 7, 3 );



// Render BPMN shortcode HTML
function bpmn_shortcode_to_editor($atts, $content = null) {
	$atts = shortcode_atts(
		array(
			'url' => NULL
		), $atts, 'bpmn' );

	$html = bpmnio_xml_html( $atts['url'] );
	return $html;
}
function bind_bpmn_shortcode(){
	add_shortcode('bpmn', 'bpmn_shortcode_to_editor');
}

function bartag_func( $atts ) {
	$atts = shortcode_atts(
		array(
			'foo' => 'no foo',
			'bar' => 'default bar',
		), $atts, 'bartag' );

	return 'bartag: ' . $atts['foo'] . ' ' . $atts['bar'];
}
add_shortcode( 'bartag', 'bartag_func' );

// Bind BPMN shortcode formatting to editor
add_action( 'init', 'bind_bpmn_shortcode');


// Bind BPMN shortcode to widgets
//add_filter('widget_text', 'bind_bpmn_shortcode');
// Bind BPMN shortcode to comments
//add_filter( 'comment_text', 'bind_bpmn_shortcode' );
// Bind BPMN shortcode to excerpts
//add_filter( 'the_excerpt', 'bind_bpmn_shortcode');




