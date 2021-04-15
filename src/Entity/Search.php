<?php
namespace App\Entity;

class Search{
    private $mcle;

    /**
     * Get the value of mcle
     */ 
    public function getMcle()
    {
        return $this->mcle;
    }

    /**
     * Set the value of mcle
     *
     * @return  self
     */ 
    public function setMcle($mcle)
    {
        $this->mcle = $mcle;

        return $this;
    }
}