 <?php
 
 echo "<html><head></head><body>";
 $viitetype = $_POST["viitetype"];
 echo "<form action=\"operoi.php\" method = \"post\">
 <input type=\"hidden\" name=\"tyyppi\" value=\"lisaa\">
 <input type=\"hidden\" name=\"type\" value=\"$viitetype\">
 Avain <input type=\"text\" name=\"key\" value=\"avain\"></br>
 Viitten nimi <input type =\"text\" name = \"name\" value = \"viitteen nimi\"/></br>
 Tekij&auml; <input type =\"text\" name = \"author\" value = \"tekija\"/></br>
 Vuosi <input type = \"text\" name = \"year\" value = \"vuosi\"/></br>
<input type = \"submit\" value = \"lis&auml;&auml; mut!\"/>
 
 
</form>
</body></html> ";





 ?>
