
<?php
// check cookie set

if(!isset($_COOKIE[$cookiePermission])) {
    echo "You have not accepted cookie usage";
} else {
    echo "You have accepted the use of cookies on this website.";
}
?>
