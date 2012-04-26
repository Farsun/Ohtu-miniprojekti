<?php

include "operoi.php";
$dbdata = "hostname=localhost dbname=ohtu user=ohtu password=ohtuproju";

echo "<html><head></head><body>";

$id=search($_POST["where"],$_POST["what"]);

foreach ($id as $v)
{
  $conn = pg_connect($dbdata);
  $query = pg_query_params($conn,"SELECT * FROM viite WHERE id = $1",array($v));
 while ( $row = pg_fetch_row ($query))
{
  
  echo "<a href=\"showsingle.php?id=$row[0]\">";
  for ($i = 1; $i<count($row); $i++)
  {
    echo "$row[$i], ";
  }
echo "</a>";
echo "<form action=\"operoi.php\" method=\"post\">
<input type=\"hidden\" name=\"tyyppi\" value=\"poista\">
<input type=\"hidden\" name=\"id\" value=\"$row[0]\">
<input type=\"submit\" value=\"poista t&auml;&auml;\">
</form> <br/>";


}
}


echo "</body></html>";

?>
