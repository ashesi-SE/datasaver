<?PHP
 session_start();
    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        header ("Location: delete.php");
    }

    DEFINE('DBUSER', 'csashesi_ma15');
    DEFINE('DBPW', 'db!bed26a');
    DEFINE('DBHOST', 'localhost');
    DEFINE('DBNAME', 'csashesi_mohammed-abdulai');
   
 $db = @mysql_select_db(DBNAME, $conn) or die(mysql_error());


   // if($_SERVER["REQUEST_METHOD"] == "POST"){
       /* if(isset($_POST['fileId'])){
            $id = $_POST['fileId'];
        }*/

        $id =$_SESSION['deleteId'] ;

    	
    	$errorMessage = "";
        echo "<script>alert($id)</script>";
        echo $id;
        $conn = mysql_connect(DBHOST, DBUSER, DBPW);

        if (!$conn) {
            die('Could not connect: '. mysql_error());
        }

        $db = mysql_select_db(DBNAME, $conn) or die(mysql_error());

        if($db){
            if (isset($_GET['fileID'])) {
                $del = $_GET['fileID'];
            
                $query = "DELETE FROM data_saver_files WHERE file_id = $del";
                $result = mysql_query($query);
            }
        }
        else{
            $errorMessage = "Error";
     //   }
    }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<script> alert(<?PHP echo $id  ?>)</script>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Data Saver:User Page</title>
    <meta name= "description" content="">
    <meta name= "viewport" content ="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bower_components/html5-boilerplate/css/normalize.css">
        <link rel="stylesheet" href="bower_components/html5-boilerplate/css/main.css">
        <link rel="stylesheet" href="app.css"/>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/fonts/FontAwesome/font-awesome-4.0.3.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="bower_components/html5-boilerplate/js/vendor/modernizr-2.6.2.min.js"></script>
        




    <!--icon-->
    <link href="assets/img/data_saver.png" rel="icon" />
    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="assets/css/datasaver.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    
</head>


<body>
    <!-- Navigation Bar, fixed to top -->

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                        <FORM METHOD="LINK" ACTION="add.php">
                            <INPUT class="btn btn-success navbar-btn" TYPE="submit" VALUE="Add A New File">
                        </FORM>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Logged in as: 
                    <?php 
                         echo $_SESSION['firstname']." ";
                         echo $_SESSION['lastname'];
                     ?>
                    </a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle " data-toggle="dropdown">Options<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">My Files</a></li>
                            <li><a href="#">My Account</a></li>
                            <li class="divider"></li>
                            <li><a href="index.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="text-center jumbotron">
        <img src="assets/img/data_saver.png" class="text-center">
    </div>

    <div  class="col-sm-8 col-sm-offset-2">
		<div role="alert" class="alert alert-danger">
            <a href="User_Page.php"><h4><?php 
                if(!$result )
                    {
                     die('Could not delete data: ' . mysql_error());
                    }
                echo "Deleted Successfully. GO Back to your page";?></h4>
            </a>
    	</div>
    </div>
</div>


    <script src="assets/js/jquery-2.1.1.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
             

</body>

</html>
