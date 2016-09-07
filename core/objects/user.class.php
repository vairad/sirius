<?php
/**
 *
 *
 */
class user extends generic_object
{
    public function user(){
        $this->generic_object();
        $this->logger = Logger::getLogger("user-app");
        $this->logger->info("Object constructor");
    }

}