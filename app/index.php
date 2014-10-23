<?php 

    // session_start();
    // session_destroy();

    DEFINE('DBUSER', 'csashesi_ma15');
    DEFINE('DBPW', 'db!bed26a');
    DEFINE('DBHOST', 'localhost');
    DEFINE('DBNAME', 'csashesi_mohammed-abdulai');
	
	// DEFINE('DBUSER', 'root');
 //    DEFINE('DBPW', 'Dream1234');
 //    DEFINE('DBHOST', 'localhost');
 //    DEFINE('DBNAME', 'datasaver');

    $username = "";
    $password = "";
    $errorMessage = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // $username = test_input($_POST[username]);
        // $pword = test_input($_POST[password]);


        $username = $_POST[username];
        $pword = md5($_POST[password]);

        $conn = mysql_connect(DBHOST, DBUSER, DBPW);

        if (!$conn) {
            die('Could not connect: '. myql_error());
        }

        $db_conn = mysql_select_db(DBNAME, $conn);

        if ($db_conn) {
             $query = "SELECT username, firstname, lastname, email, phone FROM data_saver_users WHERE username='$username' AND password='$pword'";
             $result = mysql_query($query);
             $num_rows = mysql_num_rows($result);
             $info = mysql_fetch_assoc($result);

             //check to see if the $result variable is true
            if ($result) {
                if ($num_rows > 0) {
                    session_start();
                    $_SESSION['login'] = "1";
                    $_SESSION['username'] = $info["username"];
                    $_SESSION['firstname'] = $info["firstname"];
                    $_SESSION['lastname'] = $info["lastname"];
                    $_SESSION['email'] = $info["email"];
                    $_SESSION['phone'] = $info["phone"];
                    
                    header("Location: home.php");
                }
                else {
                    session_start();
                    $_SESSION['login'] = "";
                    header ("Location: sign_up.php");
                }
            }
            else{
                $errorMessage = "Error Logging On";
            }

            mysql_close($conn);
            
        }
        else{
            $errorMessage = "Error Loggin On";
        }

    }

    function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


 ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Saver : Login</title>
    <!--icon-->
    <link href="assets/img/data_saver.png" rel="icon" />
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/datasaver.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
   <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
</head>

<body>
    <!-- Navigation Bar, fixed to top -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">

    </nav>

    <div id="wrapper">
        <div class="col-xs-10 col-xs-offset-1  col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="signup">
                <!--SIGN UP Modal-->
                <form method = "post" action ="index.php">
                    <div class="text-center">
                        <img src="assets/img/data_saver.png" class="text-center">
                    </div>
                    <div class="input-group col-xs-12 padding-10">
                        <input id="btn-input" name = 'username' type="text" class="form-control input-md margin-10" placeholder="Username">
                        <input id="btn-input" name = 'password' type="password" class="form-control input-md margin-10" placeholder="Password">
                    </div>
                    
                    <div class="btn-group, text-center">
                        <!-- <a href="home.html" class="btn btn-lg btn-primary">Login</a> -->
                        <input class="btn btn-lg btn-primary" type="submit" name="login_btn" id="login_btn" value="Login">
                    </div>
                    <div class="text-center">
                        <a href="sign_up.php" class="forget">Don't have an account? Sign Up Here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>


    </div>
    </div>






    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-2.1.1.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS 
    <script src="assets/js/custom.js"></script>-->


</body>

</html>

<?php 

    function login($username, $password){

        $pword =md5($password);

       

        if(!mysql_query($query, $conn)){
            return false;
        }
        else{
            return true;
        }
/*
        $result = mysql_query($query, $conn);

        return $this->mysql_fetch_assoc($result);
    }*/
}

    function loadUserProfile($username){
        $_SESSION['username'] = $username; 
		//$_SESSION['fullname'] = $fullname;
    }
 ?>
