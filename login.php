<?php
    include_once('db.php');
    session_start();
    $msg = 1;

    if(isset($_SESSION['admin_id'])){
        header('Location: index.php');
    }

    if(isset($_POST['login'])){
        if((!empty($_POST['uname'])) or (!empty($_POST['upass']))){
            $uname = trim($_POST['uname']);
            $utype = $_POST['type'];
            echo $utype;
            $uname = mysqli_real_escape_string($link, $uname);
            $upass = trim($_POST['upass']);
            $upass = mysqli_real_escape_string($link, $upass);
            $upass = md5($upass);
            $query = "select * from bs_admin where admin_name = '$uname' and admin_pass = '$upass' and admin_type = '$utype' ";
            $query = mysqli_query($link, $query); 
            if(mysqli_num_rows($query) == 1){
                while($result = mysqli_fetch_assoc($query)){
                    $adminId = $result['admin_id'];
                }
                $_SESSION['admin_id'] = $adminId;
                header('Location: index.php');
            }
            elseif(mysqli_num_rows($query) == 0){
                $msg = "Incorrect User Name or Password";
            }
        }
        else{
            $msg = "Please enter Username And Password";
        }

    }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include('link.php') ;?>
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <form action="" method="post" class="form-group mx-auto  mt-5 border">
            <h3 class="p22 display-4 bg-info col-md-12 text-white p-2 ">LMS</h3>
                <div class="p-5">
                    <div class="ml-5"><img src="img/logo.jpg" class="logo w-50 mb-5 ml-5" alt=""></div>
                <?php 
                    if($msg!=1){
                        ?>
                        <p class="alert alert-danger col-md-12"><?php echo $msg; ?></p>
                    <?php

                    }
                ?>
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control" placeholder="User Name" name="uname">
                </div>
                <div class="form-group">
                    <label for="username">Type</label>
                    <select name="type" class="form-control" id="">
                        <option value="1">Admin</option>
                        <option value="2">Student</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="upass" id="" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-info" name="login">Login</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>