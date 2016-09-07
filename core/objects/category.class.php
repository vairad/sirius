<?php
/**
 *
 *
 */
class category extends generic_object
{
    public function category(){
        $this->generic_object();
        $this->logger = Logger::getLogger("category-app");
        $this->logger->info("Object constructor");
    }

}