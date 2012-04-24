<?php
class Viite
{
	private $tiedot = array();
	private $lisatiedot = array();
	private $tagit = array();

	public function lueDatat($tieto, $lisatieto, $tag){
	//all parameters should be arrays!
	$this->tiedot = $tieto;
	$this->lisatiedot = $lisatieto;
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

}
?>
