<?php
class Viite
{
	private $tiedot = array();
	private $lisatiedot = array();
	private $tagit = array();

	public function lueData(){
	
	}

	//for testing purposes
	public function lueDatat($tieto, $lisatieto, $tag){
	//all parameters should be arrays!
	$this->tiedot = $tieto;
	$this->this->lisatiedot = $lisatieto;
	$this->tagit = $tag;
	}

	public function getTiedot(){
	return $this->tiedot;
	}

	public function getLisatiedot(){
	return $this->lisatiedot;
	}

	public function getTagit(){
	return $this->tagit;
	}

	public function printAll(){
		$tiedot=$this->tiedot;
		echo "Title: $tiedot[3] Year: $tiedot[2] \n Author: $tiedot[1] \n Type: $tiedot[4]";
	}

	public function printBibtex(){
	
	}
}
?>
