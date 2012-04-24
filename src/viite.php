<?php
/**
* Sisältää viitteen tiedot, sekä funktiot niiden käsittelyyn.
*/
class Viite
{
    private $_tiedot = array();
    private $_lisatiedot = array();
    private $_tagit = array();

    /**
    * Lukee 3 taulukkoa viitteen tiedoiksi.
    */
    public function lueDatat($tieto, $lisatieto, $tag)
    {
        //all parameters should be arrays!
        $this->_tiedot = $tieto;
        $this->_lisatiedot = $lisatieto;
        $this->_tagit = $tag;
    }

    /**
    * Palauttaa viitteen perustiedot.
    */
    public function getTiedot()
    {
        return $this->_tiedot;
    }

    /**
    * Palauttaa viitteen lisätiedot.
    */
    public function getLisatiedot()
    {
        return $this->_lisatiedot;
    }

    /**
    * Palauttaa viitteen tagit.
    */
    public function getTagit()
    {
        return $this->_tagit;
    }

}
?>
