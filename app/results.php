<?PHP
    session_start();
    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        header ("Location: index.php");
    }

    DEFINE('DBUSER', 'csashesi_ma15');
    DEFINE('DBPW', 'db!bed26a');
    DEFINE('DBHOST', 'localhost');
    DEFINE('DBNAME', 'csashesi_mohammed-abdulai');
	
	// DEFINE('DBUSER', 'root');
 //    DEFINE('DBPW', 'Dream1234');
 //    DEFINE('DBHOST', 'localhost');
 //    DEFINE('DBNAME', 'datasaver');

    $search = "";
    $errorMessage = "";


    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $search = $_POST[search];
    //   echo $search;

        $conn = mysql_connect(DBHOST, DBUSER, DBPW);

        if (!$conn) {
            die('Could not connect: '. mysql_error());
        }

        $db = mysql_select_db(DBNAME, $conn) or die(mysql_error());

        if($db){
            $query = "SELECT name, description, full_name, email, contact FROM data_saver_files WHERE name LIKE '%" . $search . "%'";
            $result = mysql_query($query);
            $num_rows = mysql_num_rows($result);
        }
        else{
            $errorMessage = "Error";
        }
    }

?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Data Saver : Results</title>
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
	    <nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left">
            <li><a href="home.php">Home</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Logged in as:
            <?php 
             echo $_SESSION['firstname']." ";
             echo $_SESSION['lastname'];
            ?>
            </a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Options<b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="User_Page.php">My Files</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </nav><!-- /.navbar-collapse -->
    
 

<div id = "container">


   <div  class="col-sm-8 col-sm-offset-2 text-center">
                <div class='text-center'>
                    <img src='assets/img/data_saver.png' class='text-center'>
                </div>
				<h3>Results:</h3>
	</div>
				
					
                <?php 
				$info = mysql_fetch_array($result);


				
				if(!$info){
					echo "<table class='table'><tr><td class='text-center'>No results found</td></tr>";
					echo "<tr ><td class='text-center'><a href='home.php'>Go Back Home </a></td></tr>";
					echo "</table>";
				}else{
				
				echo"<table class='table table-bordered table-hover'>
					<th>File Name </th>
					<th>File Description </th>
					<th> User Name </th>
					<th> Email </th>
					<th> Phone </th>";
					
				while ($info ) {
					
                    $email = $info['email'];
                  //  $contact = $info['contact']; 
					
					echo "<tr><td id='filename'>".$info['name']."</td>";
					echo "<td id='description'>".$info['description']."</td>";
					echo "<td id='fullname'>".$info['full_name']."</td>";
					echo "<td id='email'><a href='mailto:$email'>".$info['email']."</a></td>";
					echo "<td id='contact'>".$info['contact']."</td></tr>";
									
					$info = mysql_fetch_array($result);
					}
				}	
                    //$_SESSION['deleteId'] = $id;
               ?>
</div>
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-2.1.1.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

    
        <script src="js/bootstrap.js"></script>

        <script src="bower_components/angular/angular.js"></script>
        <script src="bower_components/angular-route/angular-route.js"></script>
        <script src="app.js"></script>
        <script src="view1/view1.js"></script>
        <script src="view2/view2.js"></script>
        <script src="assets/js/controller.js"></script>
          
        <script src="components/version/version.js"></script>
        <script src="components/version/version-directive.js"></script>
        <script src="components/version/interpolate-filter.js"></script>
</body>

</html>
