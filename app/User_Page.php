<?PHP
    session_start();
    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
      
        header ("Location: User_Page.php");
    }

    DEFINE('DBUSER', 'csashesi_ma15');
    DEFINE('DBPW', 'db!bed26a');
    DEFINE('DBHOST', 'localhost');
    DEFINE('DBNAME', 'csashesi_mohammed-abdulai');

   
    $errorMessage = "";

    //if($_SERVER["REQUEST_METHOD"] == "POST"){

        $fullname1 = $_SESSION['firstname']." ".$_SESSION['lastname'];;
        $username = $_SESSION['username'];

        $conn = mysql_connect(DBHOST, DBUSER, DBPW);
        

        if (!$conn) {
            die('Could not connect: '. mysql_error());
        }

        $db = mysql_select_db(DBNAME, $conn) or die(mysql_error());

        if($db){
            $query = "SELECT  file_id, name, description, full_name, email, contact FROM data_saver_files WHERE full_name = '$fullname1'";
            $result = mysql_query($query);
           $num_rows = mysql_num_rows($result);
        }
        else{
            $errorMessage = "Error";
        }
    //}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Data Saver : Your Page</title>
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
                    <li><a href="home.php">Search</a></li>
                    <li><a href="add.php">Add</a></li>
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

    <div class="container">
        <div class="row">
            <div  class="col-sm-8 col-sm-offset-2 text-center">
                <h3>My Files </h3>
            </div>
            
                <?php while ($info = mysql_fetch_array($result)) { ?>
                <div  class="col-sm-8 col-sm-offset-2 searchlist">
                    <div class="searcheditem">
                        <form  method = "post" action = "delete.php">
                            <?php 
                                        $id = $info['file_id'];
                                        $file_name = $info['name'];
                                        $description = $info['description'];
                                        $full_name = $info['full_name'];
                                        $email = $info['email'];
                                        $contact = $info['contact']; 
                                        $_SESSION['deleteId'] = $id;
                            ?>
                                        <h3><?php echo $file_name; ?></h3>
                                        <p><?php echo $description ?></p>
                                        <p name="fileID"><?php echo $id ?></p>
                                        <input type="hidden" name="fileID" value="<?php echo $id; ?>">
                                        <ul class='list-unstyled list-inline dateComments'>
                                            <li ><a data-toggle="modal" data-target="#myModal" href="#"><span class="glyphicon glyphicon-remove"></span>&#32; Delete</a></li>
                                            <li><a href="#"><span class="glyphicon glyphicon-plus"></span>&#32; Edit</a>
                                            </li>
                                        </ul> 
                        </form>
                    </div>
                     </div>
                 <?php } ?>
           

        </div>
    </div>
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete File</h4>
      </div>
      <div class="modal-body">
       <h3>Are You Sure you want to delete</h3>
      </div>
      <div class="modal-footer">
        <a href="delete.php?fileID=<?php echo $id ?>"><button type="button" class="btn btn-primary">Yes</button></a>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>

 
</body>
         <script src="assets/js/jquery-2.1.1.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
</html>
