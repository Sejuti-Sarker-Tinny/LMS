<?php
    include('session.php');
    include('function.php');
?>
<?php
    if($adminType == '1'){
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
                                <div class="form-group">
                                    <label for="username">User Name</label>
                                    <input type="text" class="form-control" placeholder="User Name" name="uname">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-info" name="login">Login</button>
                                </div>
                
                            </div>
                        </div>
                    </div>


                    <!--table-->
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                            <strong>Add Student </strong>
                            </div>

                            <div class="card-body card-block">
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                </tr>
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