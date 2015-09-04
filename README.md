# bpmn.io - WordPress Plugin

Adds support for .bpmn files within the WordPress Media Library.

== Description ==

[bpmn.io](http://bpmn.io/) is a BPMN 2.0 rendering toolkit and web modeler. It is powered by bpmn-js, a client-side only library that embeds BPMN 2.0 into the browser. It runs in modern browsers and requires no server backend.

## Requirements
* WordPress
  * [Download latest WordPress](https://wordpress.org/download/).
  * [Famous_5-Minute_Install Istructions](https://codex.wordpress.org/Installing_WordPress#Famous_5-Minute_Install).

## Installation
1. Clone or Unzip `bpmn.io` to the `/wp-content/plugins/` directory
2. Activate the `bpmn.io` through the 'Plugins' menu in WordPress

1. Clone this repository in the `/wp-content/plugins/` of your WordPress install.
2. Activate `bpmn-io-WP-Plugin` under `Admin -> Plugins -> bpmn.io -> Activate`.

## Usage
  * ### Option A: Use as Media Type
    `Manage` and `Add` .bpmn files within the WordPress Media Library in same manner as images and videos.

  * ### Option B: Shortcode (TODO)
    BPMN XML data may be inserted directly via shortcode 
    e.g. `[bpmn]your XML here[/bpmn]`


## License
Use under the terms of the [bpmn-js license](http://bpmn.io/license).


## Changelog ##
### 1.0 ###
* Initial release.
* Register the "application/bpmn-xml" mime-type.
* Extend Media Library to allow .bpmn files.
* Display .bpmn files via [bpmn.io](http://bpmn.io/).


## Upgrade Notice ##
### 1.0 ###
Initial release.
