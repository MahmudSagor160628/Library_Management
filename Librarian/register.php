<?php include('../connect.php');?>

<?php
    $conn = connectDB();
    session_start();
    if(isset($_SESSION['librarian_login'])){
         header('location: index.php');
    }

    if (isset($_POST['register'])) {

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $username = $_POST['username'];
        $roll = $_POST['roll'];
        $reg = $_POST['reg'];
        $phone = $_POST['phone'];

        $password = password_hash($pass, PASSWORD_DEFAULT);

        $input_errors = array();

        if (empty($fname)) {
            $input_errors['fname'] = "First name is required";
        }

        if (empty($lname)) {
            $input_errors['lname'] = "Last name is required";
        }
        
        if (empty($email)) {
            $input_errors['email'] = "Email is required";
        }

        if (empty($username)) {
            $input_errors['username'] = "User name is required";
        }

        if (empty($pass)) {
            $input_errors['pass'] = "Password is required";
        }

        if (empty($phone)) {
            $input_errors['phone'] = "Phone number is required";
        }

        if (empty($roll)) {
            $input_errors['roll'] = "Roll is required";
        }

        if (empty($reg)) {
            $input_errors['reg'] = "Registration number is required";
        }
        //print_r($input_errors);

        $email_sql = "SELECT * FROM `students` WHERE email = '$email'";
        $exists = mysqli_query($conn, $email_sql);
        $email_exists = mysqli_num_rows($exists);

        if($email_exists == 0){
            $username_sql = "SELECT * FROM `students` WHERE `username` = '$username'";
            $check = mysqli_query($conn, $username_sql);
            $username_exists = mysqli_num_rows($check);

            if ($username_exists == 0) {

                if (strlen($username)<6) {
                   $username_error = "Username should be more than 5 character!";
                }
                else{
                    if (strlen($pass)<6) {
                        $password_error = "Password should be more than 5 character!";
                    }
                    else{

                        if (count($input_errors) == 0) {
                             $sql = "INSERT INTO `students`(`fname`, `lname`, `roll`, `reg`, `email`, `username`, `password`, `phone`, `status`) VALUES ('$fname', '$lname', '$roll', '$reg', '$email', '$username', '$password', '$phone','0')";
                            $rslt = mysqli_query($conn, $sql);

                            if ($rslt) {
                                $success = "Regestration Sucessful!";
                            }
                            else{
                                $error = "Something Wrong!";
                            }
                        }

                    }
                }
            }
            else{
                $username_error = "Username already exists!";
            }
        }
        else{
            $email_error = "This email already exists";
        }

    }
    

?>

<!doctype html>
<html lang="en" class="fixed accounts sign-in">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Student Regestration</title>
    
    <!--BASIC css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/vendor/animate.css/animate.css">
    <!--SECTION css-->
    <!-- ========================================================= -->
    <!--TEMPLATE css-->
    <!-- ========================================================= -->
    <link rel="stylesheet" href="../assets/stylesheets/css/style.css">
</head>

<body>
<div class="wrap">
    <!-- page BODY -->
    <!-- ========================================================= -->
    <div class="page-body animated slideInDown">
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
        <!--LOGO-->
        <div class="logo">
            <h2 class="text-center">Student Registration</h2>
        </div>


        <div class="box">
            <!--SIGN IN FORM-->
            <div class="panel mb-none">
                <div class="panel-content bg-scale-0">

                <?php if (isset($success)) { ?>

                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $success; ?>
                    </div>

                <?php } ?>

                <?php if (isset($error)) { ?>

                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $error; ?>
                    </div>

                <?php } ?>

                <?php if (isset($email_error)) { ?>

                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $email_error; ?>
                    </div>

                <?php } ?>

                <?php if (isset($username_error)) { ?>

                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $username_error; ?>
                    </div>

                <?php } ?>

                <?php if (isset($password_error)) { ?>

                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $password_error; ?>
                    </div>

                <?php } ?>


                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="First Name" name="fname" value="<?= isset($fname)? $fname:''?>">
                                <i class="fa fa-user"></i>
                            </span>
                                <?php if (isset($input_errors['fname'])) {
                                    echo '<span class="input-error">'.$input_errors['fname'].'</span>';
                                    }
                                ?>
                        </div>

                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="Last Name" name="lname"
                                value="<?= isset($lname)? $lname:''?>">
                                <i class="fa fa-user"></i>
                            </span>

                            <?php if (isset($input_errors['lname'])) {
                                    echo '<span class="input-error">'.$input_errors['lname'].'</span>';
                                }
                                ?>

                        </div>

                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="email" class="form-control" placeholder="Email" name="email"
                                value="<?= isset($email)? $email:''?>">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <?php if (isset($input_errors['email'])) {
                                    echo '<span class="input-error">'.$input_errors['email'].'</span>';
                                }
                                ?>
                        </div>

                        <div class="form-group">
                            <span class="input-with-icon">
                                <input type="password" class="form-control" 
                                placeholder="Password" name="password" value="<?= isset($pass)? $pass:''?>">
                                <i class="fa fa-key"></i>
                            </span>
                            <?php if (isset($input_errors['pass'])) {
                                    echo '<span class="input-error">'.$input_errors['pass'].'</span>';
                                }
                                ?>
                        </div>

                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="User Name" name="username"
                                value="<?= isset($username)? $username:''?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php if (isset($input_errors['username'])) {
                                    echo '<span class="input-error">'.$input_errors['username'].'</span>';
                                }
                                ?>
                        </div>

                        <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="Roll Number" 
                                    name="roll" pattern="[0-9]{6}" value="<?= isset($roll)? $roll:''?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php if (isset($input_errors['roll'])) {
                                    echo '<span class="input-error">'.$input_errors['roll'].'</span>';
                                }
                                ?>
                        </div>

                         <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="Reg. Number" 
                                    name="reg" pattern="[0-9]{6}" value="<?= isset($reg)? $reg:''?>">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php if (isset($input_errors['reg'])) {
                                    echo '<span class="input-error">'.$input_errors['reg'].'</span>';
                                }
                                ?>
                        </div>

                         <div class="form-group mt-md">
                            <span class="input-with-icon">
                                <input type="text" class="form-control"  placeholder="Phone" name="phone" pattern="01[3-9][0-9]{8}" value="<?= isset($phone)? $phone:''?>">
                                <i class="fa fa-phone"></i>
                            </span>
                            <?php if (isset($input_errors['phone'])) {
                                    echo '<span class="input-error">'.$input_errors['phone'].'</span>';
                                }
                                ?>
                        </div>
                        
                        <div class="form-group">
                            <input class="btn btn-primary btn-block" type="submit" name="register" value="Register Now">
                        </div>
                        <div class="form-group text-center">
                            Have an account?, <a href="sign-in.php">Sign In</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
    </div>
</div>
<!--BASIC scripts-->
<!-- ========================================================= -->
<script src="../assets/vendor/jquery/jquery-1.12.3.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/vendor/nano-scroller/nano-scroller.js"></script>
<!--TEMPLATE scripts-->
<!-- ========================================================= -->
<script src="../assets/javascripts/template-script.min.js"></script>
<script src="../assets/javascripts/template-init.min.js"></script>
<!-- SECTION script and examples-->
<!-- ========================================================= -->
</body>


</html>
