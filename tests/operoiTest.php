<?php
include_once "./src/operoi.php";
//include ("../src/viite.php");
class OperoiTest extends PHPUnit_Framework_TestCase
{
	//some test data
	public $b = array("pages"=>"1-3","volume"=>"4");
	public $a = array("id"=>"1337","author"=>"ville", "year"=>"2000", "name"=>"testi","key"=>"VI20", "type"=>"@inproceedings");
	public $c = array("ville", "testi");
	public $tempa = array("author"=>"ville", "year"=>"2000", "name"=>"testi","key"=>"VI20", "type"=>"@inproceedings");
	public $d =0;

	public $temp = "@inproceedings{ VI20,\nauthor = {ville},\ntitle = {testi},\nyear = {2000},\npages = {1-3},\nvolume = {4},\n}\n\n";

	public $viite;

	public function testLueData(){
                $this->viite = new Viite();
		$this->viite->lueDatat($this->a,$this->b,$this->c);
		$this->assertNotNull($this->viite);
                return $this->viite;
	}

        /** @depends testLueData  */
	public function testPrinttex(Viite $viite){
		$this->assertEquals($this->temp, printtex("buu",$this->a,$this->b));
	}

      /** @depends testLueData  */
	public function testInsert(Viite $viite){
		$id=insert($viite);
		$this->assertNotNull($id);
		$this->assertGreaterThan(0,$id);
                return $id;
	}

	/** @depends testInsert */
	public function testGetOne($id){
		$temp = getOne($id);
		$temp3 = array();
		$this.tempa["id"] = $id;
		$this->assertEquals($this->tempa, $temp->getTiedot());
		$this->assertEquals($this->b, $temp->getLisatiedot());
		$this->assertEquals($temp3, $temp->getTagit());
                $temp = getOne(0);
                $this->assertEquals(NULL, $temp);
	}

      /** @depends testInsert  */
	public function testRemove($id){
		$this->assertFalse(remove(0));
		$this->assertTrue(remove($id));
	}


}
?>
