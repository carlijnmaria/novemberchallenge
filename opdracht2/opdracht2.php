<?php
/**
 * Created by PhpStorm.
 * User: safou
 * Date: 2019-11-04
 * Time: 12:15
 */
$db['database'] = "apen";
$db['host'] = "localhost";
$db['user'] = 'root';
$db['password'] = 'root';
try {
    $dsn = 'mysql:dbname='.$db['database'].';host='.$db['host'];
    $dbh = new PDO($dsn, $db['user'], $db['password']);
} catch(\Exception $e) {
    echo "Connection failed ".$e->getMessage();
}
if(isset($_GET['knop'])) {
    echo "idleefgebied is: ". $_GET['idleefgebied']."<br>";
    echo "omschrijving is: ". $_GET['omschrijving']."<br>";
    $sql = "insert into leefgebied (idleefgebied, omschrijving) values (:idleefgebied, :omschrijving)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([":idleefgebied" => $_GET['idleefgebied'], ":omschrijving" => $_GET['omschrijving']]);
    //echo $sql;
}
$sql = "select omschrijving, soort from leefgebied 
join aap_has_leefgebied on aap_has_leefgebied.idleefgebied = leefgebied.idleefgebied
join aap on aap.idaap = aap_has_leefgebied.idaap";
$resultaat = $dbh->query($sql);
?>

<form action="" method="get">
    Leefgebied: <input type="text" name="idleefgebied">
    omschrijving: <input type="text" name="omschrijving">
    <input type="submit" name="knop" value="verzenden">
</form>
<ul>
    <?php
    foreach ($resultaat as $row) {
        print "<li>".$row['omschrijving'] . " - ".$row['soort'];
    }
    ?>
</ul>