<?php


class wp_mail_loop_settings {

  function __construct(){

    add_action('admin_menu', function(){
        add_options_page(
          $page_title = 'Mail To Loop',
          $menu_title = "Mail To Loop",
          $capability = 'manage_options',
          $menu_slug = 'wp-mail-loop',
          $function = array($this, 'wp_mail_loop_settings_callback')

        );
    });

    add_action( 'admin_init', array($this, 'settings_init'), $priority = 10, $accepted_args = 1 );
  }

  function settings_init(){

    add_settings_section(
    	'wp_mail_loop_settings_main',
    	'Почтовый адрес',
    	null,
    	'wp-mail-loop'
    );

    add_settings_field(
      $id = 'wp_mail_loop_address',
      $title = 'Email (admin@...)',
      $callback = [$this, 'wp_mail_loop_address_display'],
      $page = 'wp-mail-loop',
      $section = 'wp_mail_loop_settings_main'
    );

    register_setting('wp_mail_loop_settings_main', 'wp_mail_loop_address');

  }


  function wp_mail_loop_address_display(){
    printf('<input type="text" name="wp_mail_loop_address" value="%s"/>', get_option('wp_mail_loop_address'));
  }

  function wp_mail_loop_settings_callback(){
    ?>
    <form method="POST" action="options.php">
      <h1>Настройки почтовой петли</h1>
      <?php
        settings_fields( 'wp_mail_loop_settings_main' );
        do_settings_sections( 'wp-mail-loop' );
        submit_button();
      ?>
    </form>
    <?php
  }



}
new wp_mail_loop_settings;
