<?php


// Include bpmn-io ONLY when post contains a .bpmn media attachment
add_filter('the_content', 'bpmn_debug' );
function bpmn_debug($content) {

	global $post;

	$attachments = query_posts(array(
		'post_type' => 'attachment',
		'post_parent' => get_the_ID(),
		'post_mime_type' => 'application/bpmn+xml',
	));

	$attachments = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment') );
	$photos = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
	$pdfs = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'application/pdf', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
	$bpmns = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'application/bpmn+xml', 'order' => 'ASC', 'orderby' => 'menu_order ID') );

	$content .= 'ALL<br>'.json_encode($attachments, JSON_PRETTY_PRINT).'<hr><hr>';
	$content .= 'IMG<br>'.json_encode($photos,JSON_PRETTY_PRINT).'<hr><hr>';
	$content .= 'PDF<br>'.json_encode($pdfs,JSON_PRETTY_PRINT).'<hr><hr>';
	$content .= 'BPMN<br>'.json_encode($bpmns,JSON_PRETTY_PRINT);

	return $content;
}

