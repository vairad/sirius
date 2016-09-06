<?php
/**
 *
 *
 */
class artefact
{
    private $logger;

    public function artefact(){
        $this->logger = Logger::getLogger("artefact-app");
        $this->logger->info("Object constructor");
    }

}