<?php

// No DB required for logout. Just destroy the session.
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
session_unset();
session_destroy();

header('Location: login.php');
exit;

?>