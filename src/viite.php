<?php
class Viite
{
    private $_tiedot = array();
    private $_lisatiedot = array();
    private $_tagit = array();

    public function lueDatat($tieto, $lisatieto, $tag)
    {
        //all parameters should be arrays!
        $this->_tiedot = $tieto;
        $this->_lisatiedot = $lisatieto;
        $this->_tagit = $tag;
    }

    public function getTiedot()
    {
        return $this->_tiedot;
    }

    public function getLisatiedot()
    {
        return $this->_lisatiedot;
    }

    public function getTagit()
    {
        return $this->_tagit;
    }

}
?>
