<?php
function create_users_db_table(){
  global $wpdb;

  $table_name = "demo_plugin_users";

  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    demo_id bigint(20) UNSIGNED NOT NULL,
    demo_name VARCHAR(100) NOT NULL,
    user_email VARCHAR(320) NOT NULL,
    user_show BIT NOT NULL,
    PRIMARY KEY user_email (user_email)
  ) $charset_collate;";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}
function adding_users_to_db($name, $email){
  create_users_db_table();
  global $wpdb;
  $user_id = wp_rand( 1, 9999);
  $wpdb->query("INSERT INTO demo_plugin_users ( demo_id, demo_name, user_email, user_show)
VALUES ('$user_id','$name','$email', '1');");
return $user_id;
}
function create_contacts_db_table(){
  global $wpdb;

  $table_name = "demo_contacts";

  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    contact_id bigint(20) UNSIGNED NOT NULL,
    contact_number bigint(20) NOT NULL,
    country_code VARCHAR(100) NOT NULL,
    full_number VARCHAR(100) NOT NULL,
    holder_id bigint(20) NOT NULL,
    user_show BIT NOT NULL,
    PRIMARY KEY full_number (full_number)
  ) $charset_collate;";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}

function adding_contacts_to_db($code, $number, $user_id){
  create_contacts_db_table();
  global $wpdb;
  $contact_id = wp_rand( 1, 9999);
  $full_number = $code.$number;
  $wpdb->query("INSERT INTO demo_contacts ( contact_id, contact_number, country_code, full_number, holder_id, user_show)
VALUES ('$contact_id','$number','$code','$full_number','$user_id', '1');");
return $contact_id;
}