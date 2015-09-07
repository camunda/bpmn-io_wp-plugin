<?php



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

