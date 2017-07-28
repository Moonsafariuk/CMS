<?php
//set cookie

if(!isset($_COOKIE[$cookiePermission])){
  $cookiePermission = "cookiePermission";
  $cookie_value = "true";
  setcookie($cookiePermission, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day / lasts 30 days
}


?>
