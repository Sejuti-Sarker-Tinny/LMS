<?php
    include('session.php');
    include('function.php');
?>
<?php
    if($adminType == '1'){
        $msg = 1;
        if(isset($_POST['st-sub'])){
            $stName = trim($_POST['st-name']);
            $stDep = $_POST['st-dep'];
            $stPass = md5($_POST['st-pass']);
            $stId = $_POST['st-id'];
            if(!empty($stName) or !empty($stPass) or !empty($stId)){

                $stQuery = mysqli_query($link, "insert into bs_admin (admin_name, admin_dep, admin_pass, admin_type, admin_roll) values('$stName', '$stDep', '$stPass', '2', '$stId')");
                if($stQuery){
                    $msg = "Student Added";
                }

                else{
                    $msg = "something went wrong";
                } 
            }
            else{
                $msg = "Please input all field";
            }
            
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <?php include('link.php') ?>
            <title>Student</title>
            <style>
        body {
            background-color: #E9EBEE;
        }

</style>
        </head>
        <body>
           <div class="container-fluid">
                <div class="row">
                    <?php include('header.php') ?>

                    <!--form-->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                            <strong>Add Student </strong>
                            </div>

                            <div class="card-body card-block">
                            <?php 
                                if($msg!=1){
                                    ?>
                                    <p class="alert alert-info col-md-12"><?php echo $msg; ?></p>
                                <?php

                                }
                            ?>
                                <form action="" method="post">
                                <div class="form-group">
                                    <label for="username">Name</label>
                                    <input type="text" class="form-control" placeholder="Student Name" name="st-name">
                                </div>
                                <div class="form-group">
                                    <label for="username">Department</label>
                                    <select name="st-dep" class="form-control" id="">
                                    <?php
                                        $depList = selectAll("bs_dep", $link);
                                        if(mysqli_num_rows($depList)>0){
                                            while($depRes = mysqli_fetch_assoc($depList)){
                                                ?>
                                                <option value="<?php echo $depRes['dep_id'] ?>"><?php echo ucwords($depRes['dep_name']) ?></option>

                                                <?php
                                            }
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="username">Roll</label>
                                    <input type="st-id" class="form-control" name="st-id">
                                </div>

                                <div class="form-group">
                                    <label for="username">Password</label>
                                    <input type="password" class="form-control" name="st-pass">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-info" name="st-sub">Create</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!--table-->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                            <strong>All Student </strong>
                            </div>

                            <div class="card-body card-block">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Department</th>

                                        </tr>
                                    </thead>
                                <tbody>
                                <?php
                                    $stCount = 1;
                                    $stList = selectOne("bs_admin", 'admin_type', '2',  $link);
                                    if(mysqli_num_rows($stList)>0){
                                        while($stRes = mysqli_fetch_assoc($stList)){
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $stCount; ?></th>
                                                <td><?php echo ucwords($stRes['admin_name']) ?></td>
                                                <td><?php echo ucwords($stRes['admin_roll']) ?></td>
                                                <td><?php
                                                    $depId = $stRes['admin_dep'];
                                                    $findDep = nameFinder("bs_dep", "dep_id", $depId, $link);
                                                    echo $findDep['dep_name'];

                                                ?></td>
                                            </tr>
                                            <?php
                                            $stCount++;
                                        }
                                    }
                                
                                ?>
                                
                                
                                </tbody>
                                </table>
                
                            </div>
                        </div>
                    </div>

                </div>
           </div> 
           <script src="js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    }
    else{
        header('index.php');
    }

?>