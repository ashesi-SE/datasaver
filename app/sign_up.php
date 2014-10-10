<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php 
    DEFINE('DBUSER', 'csashesi_ma15');
    DEFINE('DBPW', 'db!bed26a');
    DEFINE('DBHOST', 'localhost');
    DEFINE('DBNAME', 'csashesi_mohammed-abdulai');

    $conn = mysql_connect(DBHOST, DBUSER, DBPW);

    if (!$conn) {
        die('Could not connect: '. mysql_error());
    }

    $db = @mysql_select_db(DBNAME, $conn) or die(mysql_error());

    // $username = $fname = $lname = $email = $phone = $pword = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = test_input($_POST[username]);
        $fname = test_input($_POST[firstname]);
        $lname = test_input($_POST[lastname]);
        $email = test_input($_POST[email]);
        $phone = test_input($_POST[phone]);
        $pword = test_input(md5($_POST[password]));
    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


 ?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Saver: Sign Up</title>
    <!--icon-->
    <link href="assets/img/data_saver.png" rel="icon" />
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/datasaver.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <div id="wrapper">
        <div class="col-xs-10 col-xs-offset-1  col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="signup-main">
                <form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="text-center">
                        <img src="assets/img/data_saver.png" class="text-center">
                    </div>
                    <div class="text-center">
                        <h3>Please Enter Your Details Below</h3>                        
                    </div>

                    <div class="input-group col-xs-12 padding-10">
                        <input id="btn-input" type="text" class="form-control input-md margin-10" placeholder="username" name="username">
                        <input id="btn-input" type="text" class="form-control input-md margin-10" placeholder="Firstname" name="firstname">
                        <input id="btn-input" type="text" class="form-control input-md margin-10" placeholder="Lastname" name="lastname">
                        <input id="btn-input" type="email" class="form-control input-md margin-10" placeholder="E-mail" name="email">
                        <input id="btn-input" type="tel" class="form-control input-md margin-10" placeholder="Phone Number" name="phone">
                        <input id="btn-input" type="password" class="form-control input-md margin-10" placeholder="Password" name="password">
                        <input id="btn-input" type="password" class="form-control input-md margin-10" placeholder="Confirm Password" name="confirm_password">
                    </div>
                    <input class="margin-10 padding-10 col-xs-12 btn btn-success" type="submit" name="submit_btn" id="submit_btn">
                </form>
            </div>

            <?php 
                $query = "INSERT INTO data_saver_users(username, firstname, lastname, email, phone, password) VALUES('$username', '$fname', '$lname', '$email', '$phone', '$pword')";


                if(!mysql_query($query, $conn)){
            ?>
                    <script>
                        alert(<?php echo "'Error: '" . mysql_error(); ?>)
                    </script>
            <?php
                    die();
                }

            ?>
                <script>
                    alert("Sign Up Successful");
                    window.open("index.php", "_self")
                </script>
            <?php
                mysql_close($conn);
             ?>

        </div>
    </div>
    </div>
    <!--/End Sign Up Modal-->

    </div>
    </div>

    <!--FAQ Section-->
    <!--/End FAQ Section-->





    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-2.1.1.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>

</html>
