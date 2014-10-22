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
	
    $conn = mysql_connect(DBHOST, DBUSER, DBPW);

    if (!$conn) {
        die('Could not connect: '. mysql_error());
    }

    $db = @mysql_select_db(DBNAME, $conn) or die(mysql_error());


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST[file_name];
        $file_type = "pdf";
        $description = $_POST[description];
		$username = $_SESSION['username'];
        $fullnameS = $_SESSION['firstname']." ".$_SESSION['lastname'];
        $emailS = $_SESSION['email'];
        $contactS = $_SESSION['phone'];
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
    <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
	
	<script>
		
		function syncAjax(u){
			var obj= $.ajax(
				{url:u,
				 async:false
				}
			);
			return $.parseJSON(obj.responseText);
		}
		
		function saveAdd(){
			var fullname = document.getElementById("uFullname").value;
			var contact = document.getElementById("uContact").value;
			var email = document.getElementById("uEmail").value;
			var filename = document.getElementById("fileName").value;
			var filetype = document.getElementById("fileType").value;
			var description = document.getElementById("descrip").value;
			var date = Date();
			alert(date);
			
			var u = "dataAction.php?cmd=4&fName="+filename+"&description="+description+"&fileType="+filetype+"&fullname="+fullname+"&email="+email+"&contact="+contact;
				
			var r = syncAjax(u);
					
			if(r.result == 0){
				// not successful
			}else if(r.result ==1){
				//successful
				location.reload();
			}
		}
				
	</script>

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
                    <a data-toggle='modal' data-target='#addModal' href='#'><button class="btn btn-success navbar-btn" >Add New Post</button></a>
                        
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
                            <li class="divider"></li>
                            <li><a href="index.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
        <!-- add Modal -->
     <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">Add FileName</h4>
					  </div>
					  <div class="modal-body">
						<table class="table table-bordered table-hover">
							
							<input type="hidden" value="<?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?>" id="uFullname">
							<input type="hidden" value="<?php echo $_SESSION['phone']; ?>" id="uContact">
							<input type="hidden" value="<?php echo $_SESSION['email']; ?>" id="uEmail">
							
							<tr>
								<th>File name</th>
								<td><input type="text" value="" id="fileName" class="field "></td>
							</tr>
							
							<tr>
								<th>File Type</th>
								<td><input type="text" value="" id="fileType" class="field "></td>
							</tr>
							<tr>
								<th >Description </th>
								<td><textarea type="text" value="" id="descrip" class="field"></textarea></td>
							</tr>
							
						</table>
					  </div>
					  <div class="modal-footer">
						<button type="button" onclick="saveAdd()" class="btn btn-primary">Add Post</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					  </div>
					</div>
				  </div>
			</div> 
    <div id="wrapper">
        <div class="col-xs-10 col-xs-offset-1  col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
            <div >
                
                <form action= "results.php" method = "post" id="searchform">
                    <div class="text-center jumbotron">
                        <img src="assets/img/data_saver.png" class="text-center">
                    </div>
                    <div class="input-group col-xs-12 padding-10">
                        <input id="btn-input" name = "search" type="text" class="form-control input-md margin-10" placeholder="Search...">
                    </div>
                    <input class="margin-10 padding-10 col-xs-12 btn btn-primary" type="submit" value="Search" name="submit" id="submit">
                </form>
               
            </div>
        </div>
    </div>
    
        <div class="container">
				<div  class="col-sm-8 col-sm-offset-2 text-center">
					<h3>Recently Added</h3>
				</div>
				<table class="table table-bordered table-hover">
					<th>File Name </th>
					<th>File Description </th>
					<th> User Name </th>
					<th> Email </th>
					<th> Phone </th>
					
                <?php 
				$info = mysql_fetch_array($recent);
				while ($info ) {
					
					$id = $info['file_id'];
                    /*$file_name = $info['name'];
                    $description = $info['description'];
                    $full_name = $info['full_name'];*/
                    $email = $info['email'];
                  //  $contact = $info['contact']; 
					
					echo "<tr><td id='filename'>".$info['name']."</td>";
					echo "<td id='description'>".$info['description']."</td>";
					echo "<td id='fullname'>".$info['full_name']."</td>";
					echo "<td id='email'><a href='mailto:$email'>".$info['email']."</a></td>";
					echo "<td id='contact'>".$info['contact']."</td></tr>";
									
					$info = mysql_fetch_array($recent);
					}
                    //$_SESSION['deleteId'] = $id;
               ?>
           </table>

        </div>
    </div>
    
    

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
