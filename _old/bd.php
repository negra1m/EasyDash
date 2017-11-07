<?php header('Access-Control-Allow-Origin: *');
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
$servername = "10.155.131.16";
$username = "easy";
$password = "easy";
$dbname = "EASY_HISTORIC";

//mysqlnd_plugin_id = mysqlnd_plugin_register();
// Create connection
$conn = mysqli_connect($servername, $username, $password, $bd);
if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
mysqli_query($conn, "SET SESSION sql_mode = ''");
?>