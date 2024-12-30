<?php
    include('session.php');
    unset($_SESSION['admin_id']);
    header('Location: login.php');


?>