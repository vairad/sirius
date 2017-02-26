<?php
/**
 *
 *
 */
class artefact_type extends generic_object
{
    public function __construct($db){
        parent::__construct($db);
        $this->logger = Logger::getLogger("category-app");
        $this->logger->info("Object constructor");
    }

    public function updateFromDB()
    {
        // TODO: Implement updateFromDB() method.
    }

    public function saveToDB()
    {
        // TODO: Implement saveToDB() method.
    }

    public function updateToDB()
    {
        // TODO: Implement updateToDB() method.
    }
}