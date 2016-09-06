<?php
/**
 *
 *
 */
class category
{
    private $logger;

    public function category(){
        $this->logger = Logger::getLogger("category-app");
        $this->logger->info("Object constructor");
    }

}