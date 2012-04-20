<?php

$dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";

echo "<html><head><title>Operoi</title></head><body>";

if ($_POST["tyyppi"]=="lisaa")
{
echo "lisays";
insert($_POST);
echo "lisays tehty";
}

else if ($_POST["tyyppi"]=="poista")
{
echo "poisto";
remove($_POST["id"]);
}

else if ($_POST["tyyppi"]=="tulosta")
{
echo "tulosta";

$dbdata="host=localhost dbname=ohtu user=ohtu password=ohtuproju";
$conn = pg_connect($dbdata);
$result = pg_query($conn, "SELECT * FROM viite");

$filename = $_POST["filename"];

echo "$filename";


while ($row = pg_fetch_row($result))
{
	echo "moi</br>";
	printtex($_POST["filename"], $row);
}


echo "<a href=\"$filename\">lataa tiedosto!</a>";
}


echo "<a href=\"listaa.php\">Palaa takaisin!</a>
</body>
</html>";









/*function getdata()
{
$file = fopen("install",'r');
$dbdata = fgets($file);
fclose($file);
}*/


function printtex($name, $data)
{

//print data to file
$file = fopen($name,'a') or die ("Failed");
echo "$data";
$arraynames = array_keys($data);
fputs($arraynames[viitetype]);
fputs($arraynames[key]);
for ($i=3;$i<count($data);$i++)
{
  fputs($arraynames[i]$data[i]);
}
fputs('}');
fclose($file);

}

function insert($data)
{
 $dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";



echo "Hello?";
echo "asd $dbdata asr";
$conn = pg_connect($dbdata);
$arraynames = array_keys($_POST);
$query = pg_query_params($conn, "INSERT INTO viite (type,key,name,author,year) VALUES ($1,$2,$3,$4,$5)", array($_POST["type"],$_POST["key"],$_POST["name"],$_POST["author"],$_POST["year"]));
for ($i=5;$i<count($data);$i++)
{
$query = pg_query_params($conn, "INSERT INTO lisatieto (type, data) VALUES ($1,$2)", array($arraynames[i],$_POST[i]));
}

}


function remove($id)
{
 $dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";

$conn = pg_connect($dbdata);
$query = pg_query_params($conn, "DELETE FROM viite WHERE id =$1", array($_POST["id"]));
$query = pg_query_params($conn, "DELETE FROM lisatiedot WHERE id = (SELECT a FROM b WHERE c = $1)", array($_POST["id"]));
$query = pg_query_params($conn, "DELETE FROM a WHERE b = $1", array($_POST["id"]));
}
?>
