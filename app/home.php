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

    $db = mysql_select_db(DBNAME, $conn) or die(mysql_error());

        if($db){
            $query = "SELECT * FROM data_saver_files ORDER BY date_added DESC LIMIT 5" ;
            $recent = mysql_query($query);
            $num_rows = mysql_num_rows($recent);
        }
        else{
            $errorMessage = "Error";
        }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Saver : Home</title>
    
    <link href="assets/img/data_saver.png" rel="icon" />
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/datasaver.css" rel="stylesheet" />
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
                            <li><a href="User_Page.php">My Files</a></li>
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
                
                    <a class="btn btn-success navbar-btn margin-10 padding-10 col-xs-12" href="#recent_files" TYPE="submit" VALUE="View Recent Uploads">View Recent Uploads</a>
                    
                    
                
            </div>
        </div>
    </div>
    
 

    <section  id="recent_files">
            <div  class="col-sm-8 col-sm-offset-2 text-center">
                <h3>Recently Added</h3>
            </div>
    <div class="container">
        <div class="col-xs-10 col-xs-offset-1  col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">

            
                <?php while ($info = mysql_fetch_array($recent)) { ?>
                <div  class="col-sm-8 col-sm-offset-2 searchlist">
                    <div class="searcheditem">
                        
                            <?php 
                                        $id = $info['file_id'];
                                        $file_name = $info['name'];
                                        $description = $info['description'];
                                        $full_name = $info['full_name'];
                                        $email = $info['email'];
                                        $contact = $info['contact']; 
                                        $_SESSION['deleteId'] = $id;
                            ?>
                                        <!-- <h3><?php echo $file_name; ?></h3>
                                        <p><?php echo $description ?></p> -->

                            <div class="row text-center">
                                <!-- <div class="col-sm-6 col-md-4"> -->
                                    <div class="thumbnail">
                                        <div class="caption">
                                            <h3><?php echo $file_name?></h3>
                                            <p><?php echo $description ?></p>
                                            <p><?php echo $full_name ?></p>
                                            <ul class='list-unstyled list-inline dateComments'>
                                                <li><span class='glyphicon glyphicon-earphone'></span>&#32; Contact Number: <?php echo $contact ?></li>
                                                <li><a href="mailto:<?php echo $email ?>"><span class="glyphicon glyphicon-envelope"></span>&#32;<?php echo $email ?></a></li>
                                            </ul> 
                                        </div>
                                    </div>
                                <!-- </div> -->
                            </div>
                        
                    </div>
                </div>
                <?php } ?>
           

        </div>
    </div>
    </section>
    

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-2.1.1.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>

    // function sendRequest() {
    //             new Ajax.Updater('show_results', 'results.php', { method: 'post', parameters: $('searchform').serialize() });
    //         }
    // </script>
   
         

</body>

</html>
