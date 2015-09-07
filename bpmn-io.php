<?php
/*
 Plugin Name: bpmn.io
 Plugin URI: http://bpmn.io/
 Description: A BPMN 2.0 rendering toolkit and web modeler. bpmn.io simplifies creating, embedding and extending BPMN diagrams.
 Author: Camunda Services GmbH
 Version: 1.0
 Author URI: http://www.camunda.org
 */


define( 'BPMNIO__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once( BPMNIO__PLUGIN_DIR . '_inc/activation.php' );

require_once( BPMNIO__PLUGIN_DIR . '_inc/mime.php' );
require_once( BPMNIO__PLUGIN_DIR . '_inc/render.php' );
require_once( BPMNIO__PLUGIN_DIR . '_inc/shortcode.php' );
require_once( BPMNIO__PLUGIN_DIR . '_inc/mce_editor.php' );

require_once( BPMNIO__PLUGIN_DIR . '_inc/debug.php' );
