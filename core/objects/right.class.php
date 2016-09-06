<?php
/**
 *
 *
 */
class right
{
    private $logger;

    public function right(){
        $this->logger = Logger::getLogger("right-app");
        $this->logger->info("Object constructor");
    }

}