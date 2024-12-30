<?php
    include('session.php');
    include('function.php');
?>
<?php
    if($adminType == '1'){
        $msg = 1;
        if(isset($_POST['dep-sub'])){
            $depName = trim($_POST['dep-name']);
            if(!empty($depName)){

                $depQuery = mysqli_query($link, "insert into bs_dep (dep_name) values('$depName')");
                if($depQuery){
                    $msg = "Department Created";
                }

                else{
                    $msg = "something went wrong";
                } 
            }
            else{
                $msg = "Please input name";
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
                            <strong>Create Department </strong>
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
                                    <input type="text" class="form-control" placeholder="Department Name" name="dep-name">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-info" name="dep-sub">Create</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!--table-->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                            <strong>All Department </strong>
                            </div>

                            <div class="card-body card-block">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Total Student</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                <?php
                                    $depCount = 1;
                                    $depList = selectAll("bs_dep", $link);
                                    if(mysqli_num_rows($depList)>0){
                                        while($depRes = mysqli_fetch_assoc($depList)){
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $depCount ?></th>
                                                <td><?php echo ucwords($depRes['dep_name']) ?></td>
                                                <td><?php
                                                    $countSt = selectOne("bs_admin", "admin_dep", $depRes['dep_id'], $link);
                                                    echo mysqli_num_rows($countSt);
                                                
                                                ?></td>
                                            </tr>
                                            <?php
                                            $depCount++;
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