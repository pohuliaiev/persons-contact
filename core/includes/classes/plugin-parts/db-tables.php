<?php
function create_users_db_table(){
  global $wpdb;

  $table_name = "demo_plugin_users";

  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    demo_id bigint(20) UNSIGNED NOT NULL,
    demo_name VARCHAR(100) NOT NULL,
    user_email VARCHAR(320) NOT NULL,
    PRIMARY KEY user_email (user_email)
  ) $charset_collate;";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}
function adding_users_to_db($name, $email){
  create_users_db_table();
  global $wpdb;
  $user_id = wp_rand( 1, 9999);
  $wpdb->query("INSERT INTO demo_plugin_users ( demo_id, demo_name, user_email)
VALUES ('$user_id','$name','$email');");
return $user_id;
}