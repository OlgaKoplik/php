<?php
# Connect on ‘localhost’ for user ‘mike’
# with password ‘easysteps’ to database ‘site_db’.
$dbc = mysqli_connect
( 'localhost' , 'root' , '' , 'site_db' )
OR die
( mysqli_connect_error() ) ;
# Set encoding to match PHP script encoding.
mysqli_set_charset( $dbc , 'utf8' ) ;
?>