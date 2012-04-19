<?php
class ViiteTest extends PHPUnit_Framework_TestCase
{
	//some test data
	public $a = array(1,"ville", "2000", "testi", "inproceeding", "VI20");
	public $b = array(array("sivut","1-3"), array("volume","4"));
	public $c = array("ville", "testi");

	public $viite = new Viite();

	public function testLueData(){
		$viite->lueDatat($a,$b,$c);
	}

	public function testGetTiedot(){
		$tiedot = $this->$a;
		$this->assertEquals($this->a, $this->viite->getTiedot());
	}

	public function testGetLisatiedot(){
		$lisatiedot = $this->$b;
		$this->assertEquals($this->b, $this->viite->getLisatiedot());
	}

	public function testGetTagit(){
		$tagit = $this->$c;
		$this->assertEquals($this->c, $this->viite->getTagit());
	}
}
?>
