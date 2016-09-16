<?php

/***************DB-DATEN**********************/

define( 'MYSQL_HOST', 'db1206' );
define( 'MYSQL_NAME', 'usr_p272377_1' );
define( 'MYSQL_USER', 'p272377' );
define( 'MYSQL_PASSWORD', 'Bc3x7-X27' );


/*************CONNECT TO DB*************************/

$conn = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_NAME) or die ("Verbindung nicht möglich");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

mysqli_select_db($conn, MYSQL_NAME) or die ("Datenbank existiert nicht");

/**************DOCUMENT ROOT**********************/

//$DOCUMENT_ROOT = 'p272377.mittwaldserver.info';

?>
