<?php

class generic_object
{
    //instance loggeru
    public $logger;
    //pole představující nastavení jednotlivých parametrů
    public $set_up = array();

    public function generic_object(){
        $this->logger = Logger::getLogger("generic_object");
    }

    public function isSetUp(){
        $this->logger->info("Check set up of object");
        $bool = true;
        foreach($this->set_up as $index ) {
            $bool &= $index;
            //      $debug[]=$bool;
            //      $debug["index"][]=$index;
        }
        return $bool;
    }

    public function toString(){
        return "Object is not correctly extended! ERROR";
    }

}