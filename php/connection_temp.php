<?php
//This is the template connection file
//replace the server, user, password, and dbname strings to match DB
//then change the name of this file to connection.php

function connectDB() {

  $servername = "mysql.hostname.com";
  $user = "dax_user";
  $passwd = "d4x-P4ssw0rd";
  $dbname = "dbname_dax";

  $dh_conn = new mysqli($servername, $user, $passwd, $dbname);
  return $dh_conn;
}
?>
