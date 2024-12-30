<nav class="navbar navbar-expand-sm bg-info navbar-dark col-md-12 mb-1 sticky-top">
    <a href="index.php" class="navbar-brand"><img src="img/logo.jpg" width="40" height="40" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav  mt-2 mt-lg-0">
            <li class="nav-item"><a href="index.php" class="nav-link"><i class="fa fa-home"></i> Home</a></li>
            
            <?php 
                if($adminType == '1'){
                    ?>
                    <li class="nav-item"><a href="student.php" class="nav-link"><i class="fa fa-user"></i> Student</a></li>
                    <li class="nav-item"><a href="question.php" class="nav-link"><i class="fa fa-file-text"></i> Question</a></li>
                    <li class="nav-item"><a href="department.php" class="nav-link"><i class="fa fa-book"></i> Department</a></li>
                    <?php
                }
            ?>
            <li class="nav-item dropdown">
                <a href="" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cog"></i> Settings</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> <?php echo ucwords($adminName) ;?></a>
                    
                    <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>