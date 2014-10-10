<?PHP
    session_start();
    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        header ("Location: index.php");
    }

    DEFINE('DBUSER', 'csashesi_ma15');
    DEFINE('DBPW', 'db!bed26a');
    DEFINE('DBHOST', 'localhost');
    DEFINE('DBNAME', 'csashesi_mohammed-abdulai');

    $conn = mysql_connect(DBHOST, DBUSER, DBPW);

    if (!$conn) {
        die('Could not connect: '. mysql_error());
    }

    $db = @mysql_select_db(DBNAME, $conn) or die(mysql_error());


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST[file_name];
        $file_type = "pdf";
        $description = $_POST[description];
        $fullname = $_SESSION['firstname']." ".$_SESSION['lastname'];
        $email = $_SESSION['email'];
        $contact = $_SESSION['phone'];
    }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Saver : Home</title>
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
        
    
    <div id="wrapper">
        <div class="col-xs-10 col-xs-offset-1  col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div class="signup">
                
                <form action= "results.php" method = "post" id="searchform">
                    <div class="text-center">
                        <img src="assets/img/data_saver.png" class="text-center">
                    </div>
                    <div class="input-group col-xs-12 padding-10">
                        <input id="btn-input" name = "search" type="text" class="form-control input-md margin-10" placeholder="Search...">
                    </div>
                    
                   <!--  <div class="btn-group btn-group-justified">

                         <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-lg">
                                <span class="glyphicon glyphicon-search"></span> Search
                            </button>
                         </div>
                    </div> -->
                    <input class="margin-10 padding-10 col-xs-12 btn btn-primary" type="submit" value="Search" name="submit" id="submit">
                </form>
                
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title, text-center">Add A New File</h4>
                </div>

                <div class="modal-body">
                    <form method = "post" action= "home.php">

                        <div class="input-group col-xs-12 padding-10">
                            <input id="btn-input" name = "file_name"type="text" class="form-control input-md margin-10" placeholder="File Name" value: "A Thousand Splendid Suns">
                            <input id="btn-input" name = "description" type="text" class="form-control input-md margin-10" placeholder="Short Description">

                            <form class="form">
                                <div class="form-group">
                                    <label class="radio-inline">File Type: </label>
                                    <label class="radio-inline">
                                        <input type="radio" id="1" name="pdf" value="pdf"> PDF
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" id="2" name="epub" value="pdf"> EPUB
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" id="3" name="video" value="pdf"> Video
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" id="4" name="audio" value="pdf"> Audio
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" id="5" name="image" value="pdf"> Image
                                    </label> 
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input class="btn btn-primary" data-dismiss="modal" type="submit" onClick="$('form').submit();">
                        </div>   
                    </form>
                </div>

                <?php 
                    $query = "INSERT INTO data_saver_files(name, type, description, full_name, email, contact) VALUES('$name', '$file_type', '$description','$fullname', '$email', '$contact')";
                    echo "alert($query)";
                    if(!mysql_query($query, $conn)){
                        die('Error: ' . mysql_error());
                    }

                    echo "File Post Succesful";
                    mysql_close($conn);

                 ?>

                

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-2.1.1.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


</body>

</html>
