<?php
/**
 *
 *
 */
class artefact extends generic_object
{
    public function __construct(){
        parent::__construct();
        $this->logger = Logger::getLogger("artefact-app");
        $this->logger->info("Object constructor");
    }

}