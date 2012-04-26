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
    $tiedot = array("author"=>checkString($_POST["author"],1), "year"=>checkString($_POST["year"],1), "name"=>checkString($_POST["name"],1),"key"=>checkString($_POST["key"], 1), "type"=>checkString($_POST["type"], 1));
    $lisatiedot = array();
    foreach ($_POST as $k => $v) {
        if ($_POST[$k]=="") {
        } else {
            if ($k=="author" || $k== "year" || $k== "name" || $k== "key" || $k== "type" ) {
            } else {
                 $lisatiedot[$k] = checkString($v,1);
            }
        }
    }
    $viite->lueDatat($tiedot, $lisatiedot, 0);
    //toteutetaan t�hän lisääysysashajöasjöglsmgknlössgmibgoköø
    insert($viite);
} else if ($_POST["tyyppi"]=="poista") {
    echo "poisto<br/>";
    remove($_POST["id"]);
} else if ($_POST["tyyppi"]=="nayta") {
    $viite = getOne($_POST["id"]);
    echo printtex("foo", $viite->getTiedot(), $viite->getLisatiedot());
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
    $names = checkString($data["type"],1);
    $names2 = checkString($data["key"],1);
    $temp="$temp".""."$names$c $names2,\n";
    $names=checkString($data["author"],1);
    $temp="$temp".""."author = $c$names$b,\n";
    $names=checkString($data["name"],1);
    $temp="$temp".""."title = $c$names$b,\n";
    $names=checkString($data["year"],1);
    $temp="$temp".""."year = $c$names$b,\n";

    foreach ($extradata as $a => $v) {
        if (!$v=="")
        {
            $a=checkString($a,1);
            $v=checkString($v,1);
            
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

    if (!$conn = pg_connect($dbdata)) {
        return null;
    }
    $arraynames = array_keys($extradata);

    if (!$query = pg_query_params($conn, "INSERT INTO viite (type,key,name,author,year) VALUES ($1,$2,$3,$4,$5)", array($data["type"],$data["key"],$data["name"],$data["author"],$data["year"]))) {
        return null;
    }
    $id=pg_fetch_row(pg_query($conn, "SELECT MAX(id) FROM viite"));
    if (count($extradata)>=0) {
        foreach ($extradata as $key => $value) {
            $query2 = pg_query_params($conn, "INSERT INTO lisatieto (type, data, owner) VALUES ($1,$2,$3)", array($key,$value,$id[0]));
        }
    }
    
    return $id[0];
}

/**
 * Etsii sopivan/sopivat viitteet annettujen parametrien perusteella
 *  
 * @param string $where haettava kenttä
 * @param string $what  hakusana
 *
 * @return array $k löydetyt tiedot
*/

function search($where, $what)
{
 
    $dbdata = "host=localhost dbname=ohtu user=ohtu password=ohtuproju";

    $conn = pg_connect($dbdata);
    $query = pg_query_params($conn, "SELECT DISTINCT id FROM viite WHERE $1=$2", array($where, $what));
    $k=array();
    $i=0;
    if ($where =="type" || $where="author" || $where=="name" || where=="year" || $where=="key") {
        while ($row=pg_fetch_row($query)) {
            $k[$i]=$row[0];
            $i++;
        }
    } else {
        $query=pg_query_params($conn, "SELECT DISTINCT owner FROM lisatieto WHERE type = $1 AND data=$2", array($where, $what));
        while ($row=pg_fetch_row($query)) {
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
    $tiedot=pg_fetch_array($kysely, null, PGSQL_ASSOC
    $tieto = array();
    foreach ($tiedot as $key => $value) {
        $tieto[checkString($key, 0)] = checkString($value, 0);
    }
    if (!$tiedot) {
        return null;
    }
    $query = pg_query_params($conn, "SELECT * FROM lisatieto WHERE owner =$1 AND type <> 'tag'", array($id));
    $extradata=array();
    while ($lisatiedot = pg_fetch_row($query)) {
        $extradata[checkString($lisatiedot[1],0)]=checkString($lisatiedot[2],0);
    }
    $query = pg_query($conn, "SELECT * FROM lisatieto WHERE type = 'tag'");
    $tags=array();
    $i=0;
    while ($tagit = pg_fetch_row($query)) {
        $tags[$i]=checkString($tagit,0);
        $i++;
    }
    $v = new Viite();
    $v->lueDatat($tieto, $extradata, $tags);

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
    if (!$tempViite==null) {
        return false;
    }
    return true;
}

/**
* Tarkistaa annetun parametrin ja muuttaa sen käyttökelpoiseen muotoon.
*
* @param string @string tarkistettava merkkijono
* @param int @totex määrittää, muutetaanko ko. merkkijono tex-muotoon, vai näytetäänkö se näytöllä
*
* @return string @string muokattu merkkijono.
*
*/
function checkString($string, $totex)
{
    if ($totex==1)
    {
        $string = strtr($string, "ö", '\"{o}');
        $string = strtr($string, "ä", '\"{a}');
        $string = strtr($string, "å", '\aa');
    }
    else    
    {

        $string = strtr($string, '\"{o}', 'ö');
        $string = strtr($string, '\"{a}', 'ä');
        $string = strtr($string, '\aa', 'å');
    }
    return $string;
}

?>
