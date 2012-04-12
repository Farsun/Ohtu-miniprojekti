<?php

$dbdata = "host=localhost dbname=vkukkola user=vkukkola password=94e578236c9fe980";

echo "<html><head></head><body>";

if ($_POST["tyyppi"]=="lisaa")
{
    //lisataan

	$conn = pg_connect("$dbdata");
	$query = pg_query_params($conn, "INSERT INTO viite (name,author,year) VALUES ($1,$2,$3)", array($_POST["nimi"],$_POST["tekija"],$_POST["vuosi"]));

}

if ($_POST["tyyppi"]=="poista")
{
	$nimi = "id";

	echo "$_POST[$nimi]";

	$conn = pg_connect("$dbdata");

	$query = pg_query_params($conn, "DELETE FROM viite WHERE id=$1", array($_POST["id"]));

}

echo "<a href = \"listaa.php\" > palaa </a>";

echo "</body></html>";


?>
