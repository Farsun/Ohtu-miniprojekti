<?php
<<<<<<< HEAD
include ('../src/viite.php');
=======
include_once "./src/viite.php";
>>>>>>> ab02ab1306f845f5dc3dfac7fef29b1f7e4ffce5
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
<<<<<<< HEAD
=======
		$this->assertNotNull($this->viite);
>>>>>>> ab02ab1306f845f5dc3dfac7fef29b1f7e4ffce5
                return $this->viite;
	}

        /** @depends testLueData  */
	public function testGetTiedot(Viite $viite){
		$this->assertEquals($this->a, $viite->getTiedot());
	}

        /** @depends testLueData  */
	public function testGetLisatiedot(Viite $viite){
		$this->assertEquals($this->b, $viite->getLisatiedot());
	}

        /** @depends testLueData  */
	public function testGetTagit(Viite $viite){
		$this->assertEquals($this->c, $viite->getTagit());
	}
}
?>
