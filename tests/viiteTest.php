<?php
include ('../src/viite.php');
class ViiteTest extends PHPUnit_Framework_TestCase
{
	//some test data
	public $a = array(1,"ville", "2000", "testi", "inproceeding", "VI20");
	public $b = array(array("sivut","1-3"), array("volume","4"));
	public $c = array("ville", "testi");

	public $viite;

	public function testLueData(){
                $this->viite = new Viite();
		$this->viite->lueDatat($this->a,$this->b,$this->c);
	}

        /** @depends testLueData  */
	public function testGetTiedot(Viite $viite){
		$tiedot = $this->a;
		$this->assertEquals($this->a, $this->viite->getTiedot());
	}

        /** @depends testLueData  */
	public function testGetLisatiedot(Viite $viite){
		$lisatiedot = $this->b;
		$this->assertEquals($this->b, $this->viite->getLisatiedot());
	}

        /** @depends testLueData  */
	public function testGetTagit(Viite $viite){
		$tagit = $this->c;
		$this->assertEquals($this->c, $this->viite->getTagit());
	}
}
?>
