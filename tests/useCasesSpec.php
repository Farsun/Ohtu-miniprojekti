<?php
require_once 'PHPUnit/Extensions/Story/TestCase.php';
require_once './src/operoi.php';
require_once './src/viite.php';
 
class UseCasesSpec extends PHPUnit_Extensions_Story_TestCase
{
    /**
     * @scenario
     */
    public function viitteenLisaaminen()
    {
        $this->given('Luo viite')
	     ->when('Lisää viite', 0) 
             ->then('Viite löytyy', 0);
    }
 
    /**
     * @scenario
     */
    public function viitteenNayttaminen()
    {
        $this->given('Luo viite')
             ->when('Lisää viite', 0)
             ->then('Näytä viite', 0);
    }
 
    /**
     * @scenario
     */
    public function viitteenPoisto()
    {
        $this->given('Luo viite')
             ->when('Lisää viite', 0)
	     ->and('Poista viite', 0)
             ->then('Viite ei löydy', 0);
    }
 
    /**
     * @scenario
     */
    public function bibtexTulostus()
    {
        $this->given('Luo viite')
             ->then('Bibtex tulostus', 0);
    }
 
     
    public function runGiven(&$world, $action, $arguments)
    {
        switch($action) {
            case 'Luo viite': {
		$tdata = array("author"=>"ville", "year"=>"2000", "name"=>"testi","key"=>"VI20", "type"=>"@inproceedings");
                $tdata2 = array("pages"=>"1-3","volume"=>"4");
		$world['viite']  = new Viite();
                $world['viite']->lueDatat($tdata, $tdata2, array());
            }
            break;
 
            default: {
                return $this->notImplemented($action);
            }
        }
    }
 
    public function runWhen(&$world, $action, $arguments)
    {
        switch($action) {
            case 'Lisää viite': {
		$world['id'] = insert($world['viite']);
            }
	    case 'Poista viite': {
		$world['poistettu'] = remove($world['id']);
	    }
            break;
 
            default: {
                return $this->notImplemented($action);
            }
        }
    }
 
    public function runThen(&$world, $action, $arguments)
    {
	$tdata = array("author"=>"ville", "year"=>"2000", "name"=>"testi","key"=>"VI20", "type"=>"@inproceedings");
        $tdata2 = array("pages"=>"1-3","volume"=>"4");
	$texdata = "@inproceedings{ VI20,\nauthor = {ville},\ntitle = {testi},\nyear = {2000},\npages = {1-3},\nvolume = {4},\n}\n\n";
        switch($action) {
            case 'Viite löytyy': {
                $this->assertEquals($world['viite'], getOne($world['id']));
		remove($world['viite']);
            }

	    case 'Viite ei löydy': {
		$this->assertEquals(null, getOne($world['id']));
	    }

	    case 'Näytä viite': {
		$print = printtex("fuu", $tdata, $tdata2);
		$this->assertEquals($texdata, $print);
	    }

	    case 'Bibtex tulostus': {
		$this->assertTrue(file_exists("fuu"));
	    }
            break;
 
            default: {
                return $this->notImplemented($action);
            }
        }
    }
}
?>