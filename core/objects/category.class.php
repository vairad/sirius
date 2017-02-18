<?php
/**
 *
 *
 */
class category extends generic_object
{
    public function __construct(){
        parent::__construct();
        $this->logger = Logger::getLogger("category-app");
        $this->logger->info("Object constructor");
    }

}