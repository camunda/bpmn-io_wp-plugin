<?php

// Register BPMN mime type
add_filter('mime_types', 'mime_type_bpmn');
function mime_type_bpmn($existing_mimes) {
	$existing_mimes['bpmn'] = 'application/bpmn+xml';
	return $existing_mimes;
}



// Register BPMN as Media Type
add_filter('post_mime_types', 'post_mime_type_bpmn');
function post_mime_type_bpmn($post_mime_types) {
	$post_mime_types['application/bpmn+xml'] = array(
		__('BPMN'), 
		__('Manage BPMN Diagrams'), 
		_n_noop('BPMN <span class="count">(%s)</span>', 'BPMN <span class="count">(%s)</span>')
	);
	return $post_mime_types;
}
