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
    * @param $tieto viitteen perustiedot
    * @param $lisatieto viitteen lisätiedot
    * @param $tag viitteen tagit
    * @return standardi palautusarvo
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
    * @return palauttaa $_tieto taulukon; viitteen perustiedot
    */
    public function getTiedot()
    {
        return $this->_tiedot;
    }

    /**
    * Palauttaa viitteen lisätiedot.
    * @return palauttaa $_lisatieto taulukon; viitteen lisätiedot
    */
    public function getLisatiedot()
    {
        return $this->_lisatiedot;
    }

    /**
    * Palauttaa viitteen tagit.
    * @return palauttaa $_tagit taulukon; viitteen tagit
    */
    public function getTagit()
    {
        return $this->_tagit;
    }

}
?>
