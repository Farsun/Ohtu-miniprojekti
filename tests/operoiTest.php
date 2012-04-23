<?php
include "../src/operoi.php";
//include ("../src/viite.php");
class OperoiTest extends PHPUnit_Framework_TestCase
{
	//some test data
	public $a = array("id"=>"1337","author"=>"ville", "year"=>"2000", "name"=>"testi","key"=>"VI20", "type"=>"@inproceedings");
	public $b = array("pages"=>"1-3","volume"=>"4");
	public $c = array("ville", "testi");
	public $d =0;

	public $temp = "@inproceedings{ VI20,\nauthor = {ville},\ntitle = {testi},\nyear = {2000},\npages = {1-3},\nvolume = {4},\n}\n\n";

	public $viite;

	public function testLueData(){
                $this->viite = new Viite();
		$this->viite->lueDatat($this->a,$this->b,$this->c);
                return $this->viite;
	}

        /** @depends testLueData  */
	public function testPrinttex(Viite $viite){
		$this->assertEquals($this->temp, printtex("buu",$this->a,$this->b));
	}

        /** @depends testLueData  */
	public function testInsert(Viite $viite){
		$d=insert($viite);
		$this->assertNotNull($d);
		$this->assertGreaterThan(0,$d);
	}

        /** @depends testInsert  */
	public function testRemove($id){
		
		$this->assertEquals($this->d, remove($id));
	}
}
?>
