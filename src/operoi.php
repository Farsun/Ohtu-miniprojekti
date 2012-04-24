<?php

include_once "viite.php";

$dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";

echo "<html><head><title>Operoi</title></head><body>";

if ($_POST["tyyppi"]=="lisaa") {
    echo "lisays<br/>";
    $viite = new Viite();
    $tiedot = array("author"=>$_POST["author"], "year"=>$_POST["year"], "name"=>$_POST["name"],"key"=>$_POST["key"], "type"=>$_POST["type"]);
    $lisatiedot = array();
    foreach ($_POST as $k => $v) {
        if ($_POST[$k]=="") {
        } else {
            if ($k=="author" || $k== "year" || $k== "name" || $k== "key" || $k== "type" ) {
        } else {
            $lisatiedot[$k] = $v;
        }
    }
}
    $viite->lueDatat($tiedot, $lisatiedot, 0);
    //toteutetaan t�hän lisääysysashajöasjöglsmgknlössgmibgoköø
    insert($_POST);
} else if ($_POST["tyyppi"]=="poista") {
    echo "poisto<br/>";
    remove($_POST["id"]);
} else if ($_POST["tyyppi"]=="tulosta") {
    echo "tulosta<br/>";
    $temp = $_POST["filename"];
    $filename = "./files/"."".$temp;
    if (file_exists($filename)) {
        unlink($filename);
    }
    $file = fopen($filename, 'a');
    fclose($file);

    $dbdata="host=localhost dbname=ohtu user=ohtu password=ohtuproju";
    $conn = pg_connect($dbdata);
    $result = pg_query($conn, "SELECT * FROM viite");

    while ($row = pg_fetch_array($result)) {
        $result2 = pg_query($conn, "SELECT * from lisatieto WHERE owner = $row[0]");
        $extradata = array();

        while ($row2 = pg_fetch_row($result2)) {
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

$temp ="";

$c="{";
$b="}";
$temp1="type";
$temp2="key";
/*fputs($file,"$data[5]$c $data[4],\n");
fputs($file,"author = $c$data[1]$b,\n");
fputs($file,"title = $c$data[3]$b,\n");
fputs($file,"year = $c$data[2]$b,\n");
*/
$names = "type";
$names2 = "key";
$temp="$temp".""."$data[$names]$c $data[$names2],\n";
$names="author";
$temp="$temp".""."author = $c$data[$names]$b,\n";
$names="name";
$temp="$temp".""."title = $c$data[$names]$b,\n";
$names="year";
$temp="$temp".""."year = $c$data[$names]$b,\n";

foreach($extradata as $a => $v)
{
if ($v=="")
{}
else
{
//fputs($file,"$a = $c$v$b,\n");
$temp="$temp".""."$a = $c$v$b,\n";

}
}



//fputs($file,"$b\n\n");
$temp="$temp".""."$b\n\n";
fputs ($file,"$temp");
fclose($file);
return $temp;

}

function insert(Viite $viite)
{
 $dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";

$data = $viite->getTiedot();
$extradata = $viite->getLisaTiedot();



$conn = pg_connect($dbdata) or die ('AYAYAYAYAYYAAAAYAYAYAAA!!');
$arraynames = array_keys($extradata);

$query = pg_query_params($conn, "INSERT INTO viite (type,key,name,author,year) VALUES ($1,$2,$3,$4,$5)", array($data["type"],$data["key"],$data["name"],$data["author"],$data["year"])) or die ('AYAYAYAYAYAYYAA!');
$id=pg_fetch_row(pg_query($conn,"SELECT MAX (id) FROM viite"));
if (count($extradata)>=0)
{
  $as = pg_query($conn, "SELECT MAX(id) FROM viite"); 
  $id = pg_fetch_row($as);
  foreach($extradata as $key => $value)
  {
  
  $query2 = pg_query_params($conn, "INSERT INTO lisatieto (type, data, owner) VALUES ($1,$2,$3)", array($key,$value,$id[0]));
  
  }
}
return $id;
}


function remove($id)
{
 $dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";

$conn = pg_connect($dbdata);
$query = pg_query_params($conn, "DELETE FROM lisatieto WHERE owner=$1",array($id));
$query = pg_query_params($conn, "DELETE FROM viite WHERE id =$1", array($id));
return $id;
}
?>
