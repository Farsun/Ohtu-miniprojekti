<?php

echo "<html>
<head>
<title>Listaus</title> 
<body>";


$query = "SELECT * FROM viite";

$dbdata="host=localhost dbname=ohtu user=ohtu password=ohtuproju";

$conn = pg_connect ($dbdata);
if (!$conn)
{
	echo "something failed!";
}

$result = pg_query($conn, $query);

while  ($row = pg_fetch_row($result))
{
    for ($i = 1; $i< count($row);$i++)

	{
		echo "$row[$i], ";
	}

	echo "<form action=\"operoi.php\" method=\"post\">
		<input type =\"hidden\" name =\"tyyppi\" value =\"poista\">
		<input type =\"hidden\" name =\"id\" value =\"$row[0]\"/>
		<input type =\"submit\" value=\"poista t&auml;m&auml;\"/>
		</form>";

	echo "</br>";

}


echo "<form action=\"lisaa.php\" method=\"post\">
	<input type=\"radio\" name=\"viitetype\" value = \"@inproceeding\" checked />Inproceeding
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