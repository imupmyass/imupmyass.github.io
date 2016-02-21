<?
//Booleans
$bolShowLogin = 1;
$bolShowUseSessions = $bolShowLogin;
$bolDebugSite = 0;
$bolLoggedIn = 0;
$bolErr = 0;

//Member Login variables.
$MAX_UPDATE_SESSION_TIME = 1800;
$MAX_UPDATE_SESSION_LENGTH = 35;
$MAX_USERNAME_LENGTH = 15;//these two could be taken from database field sizes
$MAX_PASSWORD_LENGTH = 15;
$MIN_USERNAME_LENGTH = 2;
$MIN_PASSWORD_LENGTH = 6;

//Misc
$qs = "?";
$sid = "";
$this_time = time();
$default_user = "visitor";
$form_pw = "pw";
$site_table_width = "625";

//Messages
$msg_conn_err = "Database connection error";
$msg_logout = "Hi, and welcome to my site....";

?>