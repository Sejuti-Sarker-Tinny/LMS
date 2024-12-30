<?php
    include('session.php');
    include('function.php');
?>

<?php
    if($adminType == '2' or $adminType == 1){
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
                    <?php include('header.php'); ?>

                    <!--form-->
                    <?php
                        if($adminType == 2){
                            $msg = 1;
                            if(isset($_POST['an-sub'])){
                                $anTitle = trim($_POST['an-title']);
                                

                                $allowTypes = array('pdf', 'doc');
                                $anFile = basename($_FILES['an-file']['name']);
                                $targetFilePath = "upload/".$anFile;
                                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                                //check file as image

                                if(!in_array($fileType, $allowTypes)){
                                    $msg = "Please select a valid file";
                                }
                                
                                elseif(!empty($anTitle)){
                                    if(move_uploaded_file($_FILES['an-file']['tmp_name'], $targetFilePath)){
                                        $anQuery = mysqli_query($link, "insert into bs_answer (an_qs, an_st, an_file) values ('$anTitle', '$adminId', '$anFile')");
                                        if($anQuery){
                                            $msg = "Answer added";
                                        }
                                        else{
                                            $msg = "something wrong";
                                        }
                                    }
                                    else{
                                        $msg = "wrong";
                                    }
                                }
                                else{
                                    $msg = "Please input all field";
                                }
                                
                            }
                    
                    ?>
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                            <strong>Submit Answer</strong>
                            </div>

                            <div class="card-body card-block">
                            <?php 
                                if($msg!=1){
                                    ?>
                                    <p class="alert alert-info col-md-12"><?php echo $msg; ?></p>
                                <?php

                                }
                            ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="username">Select Question</label>
                                    <select name="an-title" id="" >
                                    <?php
                                        $qsQuery = selectOne("bs_qs", "qs_dep", $adminDep, $link);
                                        if(mysqli_num_rows($qsQuery)>0){
                                            while($qsRes = mysqli_fetch_assoc($qsQuery)){
                                                ?>
                                                <option value="<?php echo $qsRes['qs_id']; ?>"><?php  echo $qsRes['qs_title'];  ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="username">Question</label>
                                    <input type="file" class="form-control" name="an-file">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-info" name="an-sub">Submit</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!--table-->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                            <strong>All Question </strong>
                            </div>

                            <div class="card-body card-block">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tilte</th>
                                        <th scope="col">Question</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                <?php
                                    $depCount = 1;
                                    $qsList = selectOne("bs_qs","qs_dep", "$adminDep", $link);
                                    if(mysqli_num_rows($qsList)>0){
                                        while($depRes = mysqli_fetch_assoc($qsList)){
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $depCount ?></th>
                                                <td><?php echo ucwords($depRes['qs_title']); ?></td>
                                                <td><a target="_blank" href="upload/<?php echo $depRes['qs_file']; ?>"><?php echo $depRes['qs_file']; ?></a></td>
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
                <?php
    }
    elseif($adminType == "1"){
        ?>
        <div class="col-md-8 mx-auto">
                        <div class="card shadow-sm">
                            <div class="card-header">
                            <strong>Answer List </strong>
                            </div>

                            <div class="card-body card-block">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Student Roll</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Question</th>
                                        <th scope="col">Answer</th>

                                        </tr>
                                    </thead>
                                <tbody>
                                <?php
                                    $depCount = 1;
                                    $anList = selectAll("bs_answer", $link);
                                    if(mysqli_num_rows($anList)>0){
                                        while($anRes = mysqli_fetch_assoc($anList)){
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $depCount ?></th>
                                                <?php
                                                    $findSt = nameFinder("bs_admin", "admin_id", $anRes['an_st'], $link);
                                                    ?>
                                                    <td><?php echo $findSt['admin_name']; ?></td>
                                                    <td><?php echo $findSt['admin_roll']; ?></td>
                                                    <?php
                                                ?>
                                                <?php
                                                    $findQs = nameFinder("bs_qs", "qs_id", $anRes['an_qs'], $link);
                                                    ?>
                                                    <td><?php echo $findQs['qs_title']; ?></td>
                                                    <td><a target="_blank" href="upload/<?php echo $findQs['qs_file']; ?>"><?php echo $findQs['qs_file']; ?></a></td>
                                                
                                                    <?php
                                                ?>
                                                <td><a target="_blank" href="upload/<?php echo $anRes['an_file']; ?>"><?php echo $anRes['an_file']; ?></a></td>
                                               
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
        <?php
        
    }
                ?>
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