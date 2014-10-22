<?php
/**
 * 
 * User: Winnie
 * Date: 22/10/14
 * Time: 11:03
 */

	DEFINE('DBUSER', 'root');
    DEFINE('DBPW', 'Dream1234');
    DEFINE('DBHOST', 'localhost');
    DEFINE('DBNAME', 'datasaver');
   
	
	$conn = mysql_connect(DBHOST, DBUSER, DBPW);
    
    if (!$conn) {
        die('Could not connect: '. mysql_error());
    }

    $db = mysql_select_db(DBNAME, $conn) or die(mysql_error());

	
    include("gen.php");
    $cmd=get_datan("cmd");
    switch($cmd){
        case 1:
            //get one file based n id
           get_user();
            break;
        case 2:
            //update file record and return
			updateItem();
            break;
		case 3:
            //delete file records and return as array
			deleteItem();
            break;	
        default:
            echo "{";
            echo jsonn("result",0).",";
            echo jsons ("message", "unknown command");
            echo "}";
    }


    function get_user(){
       
		$id=get_datan("fileId");
		$conn = mysql_connect(DBHOST, DBUSER, DBPW);
    
		if (!$conn) {
			die('Could not connect: '. mysql_error());
		}

		$db = mysql_select_db(DBNAME, $conn) or die(mysql_error());
        if($db){
			$query = "SELECT  file_id, name, description, full_name, email, contact FROM data_saver_files WHERE file_id = $id";
            $result = mysql_query($query);
			$info = mysql_fetch_array($result);
		}
		
		 if(!$info){
            echo "{";
            echo jsonn ("result",0).",";
            echo jsons ("message","file not found");
            echo "}";
            return;
        }

        echo "{";
            echo jsonn ("result",1).",";
            echo '"file":{';
                echo jsonn ("id",$id).",";
                echo jsons ("description",$info['description']).",";
                echo jsons ("filename",$info['name']);
               
            echo "}";
        echo "}";
    }

    
    function updateItem(){
       
		$id=get_datan("fileId");
        $filename=get_data("fName");
        $description = get_data("description");
		
		$conn = mysql_connect(DBHOST, DBUSER, DBPW);
    
		if (!$conn) {
			die('Could not connect: '. mysql_error());
		}

		$db = mysql_select_db(DBNAME, $conn) or die(mysql_error());
		if($db){
			$query = "UPDATE data_saver_files SET name='$filename', description='$description' WHERE file_id = $id";
			$result = mysql_query($query);
			//$info = mysql_fetch_assoc($result); 
		}
		
		 if(!$result){
            echo "{";
				echo jsonn ("result",0).",";
				echo jsons ("message","update was not successful");
            echo "}";
            return;
        }

        echo "{";
            echo jsonn ("result",1).",";
			echo jsons ("message","update was successful");
        echo "}";
        
	}

    function deleteItem(){
		
		$conn = mysql_connect(DBHOST, DBUSER, DBPW);
    
		if (!$conn) {
			die('Could not connect: '. mysql_error());
		}

		$db = mysql_select_db(DBNAME, $conn) or die(mysql_error());
        $id=get_datan("fileId");
		if($db){
			$query = "DELETE FROM data_saver_files WHERE file_id = $id";
			$result = mysql_query($query);
			//$info = mysql_fetch_array($result); 
		}
		
		 if(!$result){
            echo "{";
				echo jsonn ("result",0).",";
				echo jsons ("message","delete was not successful");
            echo "}";
            return;
        }

        echo "{";
            echo jsonn ("result",1).",";
			echo jsons ("message","delete was successful");
        echo "}";
    }
	?>