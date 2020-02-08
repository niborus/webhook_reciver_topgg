<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Free to choose Variables:
$token = "T0k3n"; //Insert you're Token here. You need to generate this Token by yourself.
$save = "db"; //Either "db" for MySQL-Database or "file" for file.
$sql_username = "user";
$sql_passwd = "password";

//Variables set throught the git
$db_name = "topgg";
$table_name = "votes";

function kill($code, $body)
{
        http_response_code($code);
        die("{'error': " . $body . "'}");
}


//Checks, if Token is valid:
if (!(isset($_GET["token"]))){
        kill(401, "add ?token=T0k3N to URI");
}
if (!($_GET["token"] === $token)) {
        kill(403, "Invalid token");
}

// Takes raw data from the request
$json = file_get_contents('php://input');

//Converts JSON into a PHP object
$data = json_decode($json);

if ($save == "db") {

        $mysqli = new mysqli("localhost", $sql_username, $sql_passwd, $db_name);
        if ($mysqli->connect_errno) {
                kill(500, "Failed to connect to MySQL: Check Username and Password");
        }

        if (!($stmt = $mysqli->prepare("INSERT INTO ".$table_name."(bot, user, type, isWeekend, timestamp) VALUES (?, ?, ?, ?, ?)"))) {
                kill(500, "Preparation failed");
        }


}
//Read user ID
$user_id = $data->user;

//Create a File named ID.json
$filename = './topgg_json/'.$user_id.'.json';
$handle = fopen($filename, 'w') or die('Error');

//add timestamp
//$data['timestamp'] = date('U');

//Convert back to JSON
$json = json_encode($data);

//Write JSON Data into File
fwrite($handle, $json);

//Close file
fclose($handle);
?>
