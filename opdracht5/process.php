<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {//Check it is comming from a form

    //mysql credentials
    $mysql_host = "localhost";
    $mysql_username = "root";
    $mysql_password = "root";
    $mysql_database = "apen";
    $query = "SELECT MAX(idaap) FROM aap";


    $u_species = filter_var($_POST["soort"], FILTER_SANITIZE_STRING);

}
if (empty($u_species)){
    die("Please enter a species");
}

//Open a new connection to the MySQL server
$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

$statement = $mysqli->prepare("INSERT INTO aap (soort) VALUES(?)"); //prepare sql insert query
//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
$statement->bind_param('s', $u_species); //bind values and execute insert query

if($statement->execute()){
    print "Your message has been saved!";
}else{
    print $mysqli->error; //show mysql error if any
}
?>