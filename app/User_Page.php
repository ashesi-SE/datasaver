<?php
    session_start();
    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        header ("Location: User_Page.php");
    }

    DEFINE('DBUSER', 'csashesi_ma15');
    DEFINE('DBPW', 'db!bed26a');
    DEFINE('DBHOST', 'localhost');
    DEFINE('DBNAME', 'csashesi_mohammed-abdulai');
	
	// DEFINE('DBUSER', 'root');
 //    DEFINE('DBPW', 'Dream1234');
 //    DEFINE('DBHOST', 'localhost');
 //    DEFINE('DBNAME', 'datasaver');
   
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
  //  }

?>


<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

		<title>Data Saver : Your Page</title>
		<meta name= "description" content=""/>
		<meta name= "viewport" content ="width=device-width, initial-scale=1"/>

		<link rel="stylesheet" href="bower_components/html5-boilerplate/css/normalize.css"/>
		<link rel="stylesheet" href="bower_components/html5-boilerplate/css/main.css"/>
		<link rel="stylesheet" href="app.css"/>
		<link href="assets/css/bootstrap.css" rel="stylesheet"/>
		<link href="assets/css/fonts/FontAwesome/font-awesome-4.0.3.min.css" rel="stylesheet"/>
		<link href="assets/css/style.css" rel="stylesheet"/>
		<script src="jquery-1.11.0.js"></script>
		
			
		<script>
			
				function syncAjax(u){
					var obj= $.ajax(
						{url:u,
						 async:false
						}
					);
					return $.parseJSON(obj.responseText);
				}
				
				function deletePop(fileId){
					var u = "dataAction.php?cmd=1&fileId="+fileId;
					var r = syncAjax(u);
					
					if(r.result == 0){
						return;
					}
					$("#deleteId").prop("value", r.file.id);
				}
					
				function deleteData(){
				
					var id = document.getElementById("deleteId").value;
					var u = "dataAction.php?cmd=3&fileId="+id;
					var r = syncAjax(u);
					
					if(r.result == 0){
						
					}else if(r.result ==1){
						//successful
						location.reload();
					}
				}
				
				function popupEditUser(fileId){
					var u = "dataAction.php?cmd=1&fileId="+fileId;
					var r = syncAjax(u);
					
					if(r.result == 0){
						return;
					}
					$("#fileId").prop("value", r.file.id);
					$("#fileName").prop("value", r.file.filename);
					$("#descrip").prop("value", r.file.description);
				   
				}
				
				function saveUpdate(){
					var fileId = document.getElementById("fileId").value;
					var filename = document.getElementById("fileName").value;
					var description = document.getElementById("descrip").value;
					
					var u = "dataAction.php?cmd=2&fileId="+fileId+"&fName="+filename+"&description="+description;
					
					var r = syncAjax(u);
					
					if(r.result == 0){
						// not successful
					}else if(r.result ==1){
						//successful
						location.reload();
					}
				}
	
		</script>



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
                    <li><a href="home.php">Home</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </nav><!-- /.navbar-collapse -->

		<div class="text-center jumbotron">
							<img src="assets/img/data_saver.png" class="text-center">
						</div>

		<div class="container">
			<div class="row">
				<div  class="col-sm-8 col-sm-offset-2 text-center">
					<h3>My Files </h3>
				</div>
				
					
					<div  class="col-sm-8 col-sm-offset-2">
					<table class="table  table-hover">
						<th>File Name </th>
						<th>File Description </th>
						<th>Edit</th>
						<th>Delete</th>
						<?php
							$info = mysql_fetch_array($result);
							if(!$info){
								echo "<table class='table'><tr><td class='text-center'>You have not added any posts. </td></tr>";
								echo "<tr ><td class='text-center'><a href='home.php'>Go Back Home </a></td></tr>";
								echo "</table>";

							}else{
								while($info){
									$fileID = $info['file_id'];
									
									echo "<tr><td id='filename'>".$info['name']."</td>";
										echo "<td id='description'>".$info['description']."</td>";
										echo "<td><a data-toggle='modal' data-target='#myModal' href='#'><button type='button' onclick='popupEditUser($fileID);' class='btn btn-info'>Edit</button></td>";
										echo "<td><a data-toggle='modal' data-target='#deleteModal' href='#'><button type='button' onclick='deletePop($fileID);' class='btn btn-danger'>Delete</button></a></td></tr>";
										$info = mysql_fetch_array($result);
								}
							}
						?>
					</table>
			   </div>
		</div>
		
				<!-- Edit modal-->
			  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">Update File</h4>
					  </div>
					  <div class="modal-body">
						<table class="table table-bordered table-hover">
							
							<input type="hidden" value="" id="fileId">
							<tr>
								<th>File name</th>
								<td><input type="text" value="" id="fileName" class="field textarea"></td>
							</tr>
							<tr>
								<th >Description </th>
								<td><textarea type="text" value="" id="descrip" class="field"></textarea></td>
							</tr>
							
						</table>
					  </div>
					  <div class="modal-footer">
						<button type="button" onclick="saveUpdate()" class="btn btn-primary">Save Changes</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					  </div>
					</div>
				  </div>
			</div> 
			
			<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">Delete File</h4>
				  </div>
				  <div class="modal-body">
				   <h3>Are you sure you want to delete this file?</h3>
				   
				   <input type="hidden" value="" id="deleteId">
				  </div>
				  <div class="modal-footer">
					<button type="button" onclick="deleteData()" class="btn btn-primary">Yes</button></a>
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
