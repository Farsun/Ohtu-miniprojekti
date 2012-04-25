<?php
/**
 *  File operoi.php
 *  tietokantaoperaatiot
 *
 *  PHP version 5.3.10
 *
 *  @category Logic
 *  @package  Src
 *  @author   LateBloomers <sampo.laurila@helsinki.fi>
 *  @license  http://sam.zoy.org/wtfpl/ DWYFW
 *  @link     https://github.com/Farsun/Ohtu-miniprojekti
*/

require_once "viite.php";

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
} else if ($_POST["tyyppi"]=="nayta") {
    $viite = getOne($_POST["id"]);
    echo printtex("foo", $viite->getTiedot, $viite->getLisatiedot);
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

/**
 * Tulostaa  bibtex-muotoisen tiedoston tietokannassa olevista viitteistä
 *
 * @param String $name      tulostetidoston nimi
 * @param array  $data      dataa
 * @param array  $extradata lisädataa
 *
 * @return file $temp palautustiedosto
*/
function printtex($name, $data, $extradata) 
{
    if (!$file = fopen($name, 'a')) {
        return null;
    }

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

    foreach ($extradata as $a => $v) {
        if ($v=="") {
        } else {
            //fputs($file,"$a = $c$v$b,\n");
            $temp="$temp".""."$a = $c$v$b,\n";
        }
    }

    //fputs($file,"$b\n\n");
    $temp="$temp".""."$b\n\n";
    fputs($file, "$temp");
    fclose($file);
    return $temp;
}

/**
 * Lisää viitteen tietokantaan
 *
 * @param Viite $viite lisättävä
 * 
 * @return int   $id    lisätyn viitteen tietokantaid
*/
function insert(Viite $viite)
{

    $dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";
    $data = $viite->getTiedot();
    $extradata = $viite->getLisaTiedot();

    $conn = pg_connect($dbdata) or die ('AYAYAYAYAYYAAAAYAYAYAAA!!');
    $arraynames = array_keys($extradata);

    $query = pg_query_params($conn, "INSERT INTO viite (type,key,name,author,year) VALUES ($1,$2,$3,$4,$5)", array($data["type"],$data["key"],$data["name"],$data["author"],$data["year"])) or die ('AYAYAYAYAYAYYAA!');
    $id=pg_fetch_row(pg_query($conn, "SELECT MAX(id) FROM viite"));
    if (count($extradata)>=0) {
        foreach ($extradata as $key => $value) {
            $query2 = pg_query_params($conn, "INSERT INTO lisatieto (type, data, owner) VALUES ($1,$2,$3)", array($key,$value,$id[0]));
        }
    }
    
    return $id[0];
}

/**
*  Etsii sopivan/sopivat viitteet annettujen parametrien perusteella
*
*
*
*
/*

public function search($where, $what)
{
  $i = array();

  $dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";

  $conn = pg_connect($dbdata);
  $query = pg_query_params($conn, "SELECT DISTINCT id FROM viite WHERE $1 like $2", array($where, $what);
  $k=array();
  $i=0;
  if ($where =="type" || $where="author" || $where=="name" || where=="year" || $where=="key")
  {
   while($row=pg_fetch_row($query))
    {
      $k[$i]=$row[0];
      $i++;
    }
  }
  else
  {
    $query=pg_query_params($conn, "SELECT DISTINCT owner FROM lisatieto WHERE type = $1 AND data=$2", array($where, $what));
    while ($row=pg_fetch_row($query))
    {
      $k[$i]=$row[0];
      $i++;
    }
  }
  return $k;

}



/**
* Hakee tiedot yksittäisestä osasta.
*
* @param int $id haettava id
*
* @return Viite $viite haettava viite
*
*
*/
function getOne($id)
{
    $dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";
    $conn = pg_connect($dbdata);
    $kysely = pg_query_params($conn, "SELECT * FROM viite WHERE id = $1", array($id));
    $tiedot=pg_fetch_array($kysely, null, PGSQL_ASSOC);
    if (!$tiedot) {
        return null;
    }
    $query = pg_query_params($conn, "SELECT * FROM lisatieto WHERE owner =$1 AND type <> 'tag'", array($id));
    $extradata=array();
    while ($lisatiedot = pg_fetch_row($query)) {
        $extradata[$lisatiedot[1]]=$lisatiedot[2];
    }
    $query = pg_query($conn, "SELECT * FROM lisatieto WHERE type = 'tag'");
    $tags=array();
    $i=0;
    while ($tagit = pg_fetch_row($query)) {
        $tags[$i]=$tagit;
        $i++;
    }
    $v = new Viite();
    $v->lueDatat($tiedot, $extradata, $tags);

    return $v;
}



/**
* Poistaa idtä vastaavaan viitteen taulukosta
*
* @param int $id poistettava id
*
* @return int $id poistettu id
*/
function remove($id)
{
    $dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";
    $tempViite = getOne($id);
    if ($tempViite==null) {
        return false;
    }
    $conn = pg_connect($dbdata);
    $query = pg_query_params($conn, "DELETE FROM lisatieto WHERE owner = $1", array($id));
    $query = pg_query_params($conn, "DELETE FROM viite WHERE id = $1", array($id));
    $tempViite = getOne($id);
    if ($tempViite==null) {
        return true;
    } else {
        return false;
    }
}
?>
