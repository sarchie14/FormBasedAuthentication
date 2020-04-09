<?php
require_once('model/database.php');
require_once('model/admin_db.php');

if (!isset($_SESSION['is_valid_admin'])) {
    header('Location: ../zua-login.php');
}

?>