 <?php
/**
 *  File lisaa.php
 *  Tulostaa kentät viitteen tiedoille, joihin käyttäjä täyttää tiedot.
 *  Antaa tiedot eteenpäin operoi.php:lle, joka hoitaa logiikan
 *
 *  PHP version 5.3.10
 *
 *  @category Logic
 *  @package  Src
 *  @author   LateBloomers <sampo.laurila@helsinki.fi>
 *  @license  http://sam.zoy.org/wtfpl/ DWTFYW
 *  @link     https://github.com/Farsun/Ohtu-miniprojekti
*/


 
 echo "<html><head></head><body>";
 $viitetype = $_POST["viitetype"];
 echo "<form action=\"operoi.php\" method = \"post\">
 <input type=\"hidden\" name=\"tyyppi\" value=\"lisaa\">
 <input type=\"hidden\" name=\"type\" value=\"$viitetype\">
 Avain <input type=\"text\" name=\"key\" value=\"avain\"></br>
 Viitten nimi <input type =\"text\" name = \"name\" value = \"viitteen nimi\"/></br>
 Tekij&auml; <input type =\"text\" name = \"author\" value = \"tekija\"/></br>
 Vuosi <input type = \"text\" name = \"year\" value = \"vuosi\"/></br>";
echo "<br/>";

echo "<input type =\"text\" name =\"publisher\" value=\"publisher\"><br/>";
echo "<input type =\"text\" name =\"pages\" value=\"pages\"><br/>";
echo "<input type =\"text\" name =\"volume\" value=\"volume\"><br/>";
echo "<input type =\"text\" name =\"isbn\" value=\"isbn\"><br/>";
echo "<input type =\"text\" name =\"booktitle\" value=\"book title\"><br/>";
echo "<input type =\"text\" name =\"number\" value=\"number\"><br/>";
echo "<input type=\"text\" name=\"address\" value=\"address\"><br/>";
echo "<input type=\"text\" name=\"journal\" value=\"journal\"><br/>";

echo "<input type = \"submit\" value = \"lis&auml;&auml; mut!\"/>
 
 
</form>
</body></html> ";





 ?>
