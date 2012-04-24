<?php
/**
 * File viite.php
 * Sisältää viitteen tiedot, sekä funktiot niiden käsittelyyn.
 *
 * @category Logic
 * @package  Src
 * @author   Farsun
 * @license  http://sam.zoy.org/wtfpl/ DWTFYWT license
 * @link     https://github.com/Farsun/Ohtu-miniprojekti
*/
class Viite
{
    private $_tiedot = array();
    private $_lisatiedot = array();
    private $_tagit = array();

    /**
    * Lukee 3 taulukkoa viitteen tiedoiksi.
    *
    * @param array $tieto viitteen perustiedot
    * @param array $lisatieto viitteen lisätiedot
    * @param array $tag viitteen tagit
    *
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
    * @return array $_tieto palauttaa tieto-taulukon; viitteen perustiedot
    */
    public function getTiedot()
    {
        return $this->_tiedot;
    }

    /**
    * Palauttaa viitteen lisätiedot.
    * @return array $_lisatieto palauttaa lisätiedot taulukosta; viitteen lisätiedot
    */
    public function getLisatiedot()
    {
        return $this->_lisatiedot;
    }

    /**
    * Palauttaa viitteen tagit.
    * @return array $_tagit palauttaa tagit taulukosta; viitteen tagit
    */
    public function getTagit()
    {
        return $this->_tagit;
    }

}
?>
