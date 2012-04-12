<?php

echo "<html>
<head>
<title>Listaus</title> 
<body>";
$query = "SELECT * FROM viite";
$conn = pg_connect ("host=localhost dbname=vkukkola user=vkukkola password=94e578236c9fe980");
if (!$conn)
{
	echo "something failed!";
}

$result = pg_query($conn, $query);

while  ($row = pg_fetch_row($result))
{
    for ($i = 1; $i< 4;$i++)

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


echo "<a href=\"lisaa.php\">Lis&auml;&auml; uusi!</a>";

echo "</body>";

echo "</html>";

?>
