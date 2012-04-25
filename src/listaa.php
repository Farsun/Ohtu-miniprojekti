<?php
/**
 *  File listaa.php
 *  Pääsivu, listaa yksinkertaistetut tiedot kaikista viitteistä
 *  linkit uusien viitteiden lisäämiseen ja bibtex tulostukseen.
 *
 *  PHP version 5.3.10
 *
 *  @category Logic
 *  @package  Src
 *  @author   LateBloomers <sampo.laurila@helsinki.fi>
 *  @license  http://sam.zoy.org/wtfpl/ DWTFYW
 *  @link     https://github.com/Farsun/Ohtu-miniprojekti
*/

echo "<html>
<head>
<title>Listaus</title> 
<body>";


$query = "SELECT * FROM viite";

$dbdata="host=localhost dbname=ohtu user=ohtu password=ohtuproju";

$conn = pg_connect($dbdata);
if (!$conn) {
    echo "something failed!";
}

$result = pg_query($conn, $query);

while ($row = pg_fetch_row($result)) {
    for ($i = 1; $i< count($row);$i++) {
        echo "$row[$i], ";
    }

    echo "<form action=\"operoi.php\" method=\"post\">
        <input type =\"hidden\" name =\"tyyppi\" value =\"poista\">
        <input type =\"hidden\" name =\"id\" value =\"$row[0]\"/>
        <input type =\"submit\" value=\"poista t&auml;m&auml;\"/>
        </form>
	<form action=\"operoi.php\" method=\"post\">
	<input type =\"hidden\" name =\"tyyppi\" value =\"nayta\">
	<input type =\"hidden\" name =\"id\" value =\"$row[0]\"/>
	<input type =\"submit\" value=\"Näytä Viite\"/>";

        echo "</br>";

}


echo "<form action=\"lisaa.php\" method=\"post\">
    <input type=\"radio\" name=\"viitetype\" value =\"@inproceedings\"checked />Inproceedings
    <input type=\"radio\" name =\"viitetype\" value=\"@book\"/>Book
    <input type=\"radio\" name=\"viitetype\" value=\"@article\"/>Article
    <input type=\"submit\" value=\"lis&auml;&auml; uusi\"/>
    </form>";


echo "Tulostaakseesi bibtex-muodossa sy&ouml;t&auml; tiedoston nimi </br>";
echo "<form action=\"operoi.php\" method=\"post\">
    <input type=\"hidden\" name=\"tyyppi\" value=\"tulosta\">
    tiedoston nimi: <input type =\"text\" name=\"filename\" value=\"Tiedoston nimi\"></br>
    <input type=\"submit\" value=\"tulosta bibtex\">
    </form>";

echo "</body>";

echo "</html>";

?>
