<?PHP
    session_start();
    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        header ("Location: index.php");
    }

    DEFINE('DBUSER', 'csashesi_ma15');
    DEFINE('DBPW', 'db!bed26a');
    DEFINE('DBHOST', 'localhost');
    DEFINE('DBNAME', 'csashesi_mohammed-abdulai');

    $search = "";
    $errorMessage = "";


    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $search = $_POST[search];
        echo $search . "is the search query";

        $conn = mysql_connect(DBHOST, DBUSER, DBPW);

        if (!$conn) {
            die('Could not connect: '. mysql_error());
            echo "Died because I could not connect";
        }

        $db = mysql_select_db(DBNAME, $conn) or die(mysql_error());
        echo "Did not die, because I could not connect";

        if($db){
            echo "Connected to the database";
            $query = "SELECT name, description, full_name, email, contact FROM data_saver_files WHERE name LIKE '%" . $search . "%'";
            $result = mysql_query($query);
            $num_rows = mysql_num_rows($result);
            
            echo "Got here ". $num_rows;

            while ($info = mysql_fetch_array($result)) {
                echo "Got info";
                $file_name = $info['name'];
                $description = $info['description'];
                $full_name = $info['full_name'];
                $email = $info['email'];
                $contact = $info['contact'];

                echo "<ul>\n";
                echo "<li>" . $file_name . " " . $description . " " . $full_name . " " . $email . "</li>\n";
                echo "</ul>";
            }
        }
    }
    else{
            $errorMessage = "Error";
            echo $errorMessage;
        }
    

?>