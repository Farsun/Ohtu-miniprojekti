<?php

$dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";

echo "<html><head><title>Operoi</title></head><body>";

if ($_POST["tyyppi"]=="lisaa")
{
echo "lisays<br/>";
insert($_POST);
}

else if ($_POST["tyyppi"]=="poista")
{
echo "poisto<br/>";
remove($_POST["id"]);
}

else if ($_POST["tyyppi"]=="tulosta")
{
echo "tulosta<br/>";

$temp = $_POST["filename"];
$filename = "./files/"."".$temp;

if (file_exists($filename))
{
  unlink($filename);
}
$file = fopen($filename,'a');
fclose ($file);


$dbdata="host=localhost dbname=ohtu user=ohtu password=ohtuproju";
$conn = pg_connect($dbdata);
$result = pg_query($conn, "SELECT * FROM viite");




while ($row = pg_fetch_row($result))
{
	$result2 = pg_query($conn, "SELECT * from lisatieto WHERE owner = $row[0]");
	$extradata = array();

	while ($row2 = pg_fetch_row($result2))
	{
	   $extradata[$row2[1]] = $row2[2];
	}
	printtex($filename, $row, $extradata);
}


echo "<a href=\"$filename\">lataa tiedosto!</a><br/><br/>";
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


function printtex($name, $data, $extradata)
{

//print data to file

$file = fopen($name,'a') or die ("Failed");


$temp1="type";
$temp2="key";
fputs($file,"$data[5]{ $data[4],\n");
fputs($file,"author = {$data[1]},\n");
fputs($file,"title = {$data[3]},\n");
fputs($file,"year = {$data[2]},\n");

foreach($extradata as $a => $v)
{
if ($v=="")
{}
else
{
fputs($file,"$a = {$v},\n");
}
}



fputs($file,"}\n\n");
fclose($file);

}

function insert($data)
{
 $dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";



$conn = pg_connect($dbdata);
$arraynames = array_keys($_POST);

$query = pg_query_params($conn, "INSERT INTO viite (type,key,name,author,year) VALUES ($1,$2,$3,$4,$5)", array($_POST["type"],$_POST["key"],$_POST["name"],$_POST["author"],$_POST["year"]));

if (count($_POST)>5)
{
  for ($i=6;$i<count($data);$i++)
  {
  $as = pg_query($conn, "SELECT MAX(id) FROM viite"); 
  $id = pg_fetch_row($as);

  
  if ($_POST[$arraynames[$i]]==""){}
  else
  {
  $query2 = pg_query_params($conn, "INSERT INTO lisatieto (type, data, owner) VALUES ($1,$2,$3)", array($arraynames[$i],$_POST[$arraynames[$i]],$id[0]));
  }
  }
}
}


function remove($id)
{
 $dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";

$conn = pg_connect($dbdata);
$query = pg_query_params($conn, "DELETE FROM lisatieto WHERE owner=$1", array($_POST["id"]));
$query = pg_query_params($conn, "DELETE FROM viite WHERE id =$1", array($_POST["id"]));
}
?>
