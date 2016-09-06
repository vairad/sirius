<?php
/**
 *
 *
 */
class user
{
    private $logger;

    public function user(){
        $this->logger = Logger::getLogger("user-app");
        $this->logger->info("Object constructor");
    }

}