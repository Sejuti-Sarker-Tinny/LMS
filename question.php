<?php
    include('session.php');
    include('function.php');
?>
<?php
    if($adminType == '1'){
        $msg = 1;
        if(isset($_POST['qs-sub'])){
            $qsTitle = trim($_POST['qs-title']);
            $qsDep = $_POST['qs-dep'];
            $qsYear = $_POST['qs-year'];
            $qsSemester = $_POST['qs-semester'];

            $allowTypes = array('pdf', 'doc');
            $qsFile = basename($_FILES['qs-file']['name']);
            $targetFilePath = "upload/".$qsFile;
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            //check file as image

            if(!in_array($fileType, $allowTypes)){
                $msg = "Please select a valid file";
            }
            
            elseif(!empty($qsTitle)){
                if(move_uploaded_file($_FILES['qs-file']['tmp_name'], $targetFilePath)){
                    $qsQuery = mysqli_query($link, "insert into bs_qs (qs_title, qs_year, qs_sem, qs_dep, qs_file) values ('$qsTitle', '$qsYear', '$qsSemester', '$qsDep', '$qsFile')");
                    if($qsQuery){
                        $msg = "Question added";
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
                            <strong>Add Qusetion </strong>
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
                                    <label for="username">Subject</label>
                                    <input type="text" class="form-control" placeholder="Question Title" name="qs-title">
                                </div>
                                
                                <div class="form-group">
                                    <label for="username">Department</label>
                                    <select name="qs-dep" class="form-control" id="">
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
                                    <label for="username">Year</label>
                                    <select name="qs-year" class="form-control" id="">
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="username">Semester</label>
                                    <select name="qs-semester" class="form-control" id="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="username">Question</label>
                                    <input type="file" class="form-control" name="qs-file">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-info" name="qs-sub">Create</button>
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
                                        <th scope="col">Subject</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">File</th>

                                        </tr>
                                    </thead>
                                <tbody>
                                <?php
                                    $qsCount = 1;
                                    $qsList = selectAll("bs_qs", $link);
                                    if(mysqli_num_rows($qsList)>0){
                                        while($qsRes = mysqli_fetch_assoc($qsList)){
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $qsCount; ?></th>
                                                <td><?php echo ucwords($qsRes['qs_title']) ?></td>
                                                <td><?php
                                                    $depId = $qsRes['qs_dep'];
                                                    $findDep = nameFinder("bs_dep", "dep_id", $depId, $link);
                                                    echo $findDep['dep_name'];

                                                ?></td>
                                                                                                                                             <td><?php echo ucwords($qsRes['qs_year']) ?></td>                                                                                                                                        <td><?php echo ucwords($qsRes['qs_sem']) ?></td>                                                                                                                                         <td><a target="_blank" href="upload/<?php echo $qsRes['qs_file']; ?>"><?php echo $qsRes['qs_file']; ?></a></td>



                                            </tr>
                                            <?php
                                            $qsCount++;
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