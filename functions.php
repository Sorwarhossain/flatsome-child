<?php
// Add custom Theme Functions here

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

add_action( 'custom_payment_methods_replacement', 'woocommerce_checkout_payment', 10 );


//fix database collation error
  $con = mysql_connect('localhost', 'root', '');
  if (!$con) {
      echo "Cannot connect to the database ";
      die();
  }
  mysql_select_db('japanpremium');
  $result = mysql_query('show tables');
  while ($tables = mysql_fetch_array($result)) {
      foreach ($tables as $key => $value) {
          mysql_query("ALTER TABLE $value CONVERT TO CHARACTER SET utf8 COLLATE utf8_bin");
      }
  }
  echo "The collation of your database has been successfully changed!";