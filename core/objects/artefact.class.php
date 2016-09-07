<?php
/**
 *
 *
 */
class artefact extends generic_object
{
    public function artefact(){
        $this->generic_object();
        $this->logger = Logger::getLogger("artefact-app");
        $this->logger->info("Object constructor");
    }

}