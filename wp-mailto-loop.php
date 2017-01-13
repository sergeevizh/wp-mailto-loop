<?php
/*
Plugin Name: WP Mail To Local Loop
Version: 0.1
Plugin URI: ${TM_PLUGIN_BASE}
Description: Replace mail-to address for all mail from site
Author: ${TM_NAME}
Author URI: ${TM_HOMEPAGE}
*/


require_once 'inc/class-menu-settings.php';

class wp_mail_loop {

  var $to = '';

  function __construct(){
    add_filter( 'wp_mail', array($this, 'wp_mail_callback') );
  }

  function wp_mail_callback($arg){

    if(is_email( get_option( 'wp_mail_loop_address') )){
      $this->to = get_option( 'wp_mail_loop_address');
      $arg['to'] = $this->to;
    }

    return $arg;
  }

}
new wp_mail_loop;
