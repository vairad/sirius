<?php

abstract class generic_object implements IDatabase
{
    //instance loggeru
    protected $logger;

    //instance db connection
    protected $db;

    //pole představující nastavení jednotlivých parametrů
    public $set_up = array();

    public function __construct($db){
        $this->logger = Logger::getLogger("generic_object");
        $this->db = $db;
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

    /**
     * Update all DB properties of object. Whenever object loads any properties depending on DB parameters
     * This method invoke reload all other fields.
     * @return boolean
     */
    abstract public function updateFromDB();

    /**
     * @return boolean
     */
    public abstract function saveToDB();

    /**
     * @return boolean
     */
    public abstract function updateToDB();
}