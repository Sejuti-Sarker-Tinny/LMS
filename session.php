<?php
    session_start();
    include('db.php');
    if(isset($_SESSION['admin_id'])){
        $admin_id = $_SESSION['admin_id'];
        $chkQuery = "select * from bs_admin where admin_id = '$admin_id' ";
            $chkQuery = mysqli_query($link, $chkQuery); 
            if(mysqli_num_rows($chkQuery) == 1){
                while($chkResult = mysqli_fetch_assoc($chkQuery)){
                    $adminId = $chkResult['admin_id'];
                    $adminName = $chkResult['admin_name'];
                    $adminPass = $chkResult['admin_pass'];
                    $adminType = $chkResult['admin_type'];
                    $adminDep = $chkResult['admin_dep'];
                    
                }
                
            }
            else{
                header('Location: login.php');
            }
        
    }
    else{
        header('Location: login.php');
    }


?>