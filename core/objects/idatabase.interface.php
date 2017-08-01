<?php

interface IDatabase
{

    /**
     * Check mandatory fields to save to DB
     * @return boolean
     */
    public function isSetUp();

    /**
     * Update all DB properties of object. Whenever object loads any properties depending on DB parameters
     * This method invoke reload all other fields.
     * @return boolean
     */
    public function updateFromDB();

    /**
     * @return boolean
     */
    public function saveToDB();

    /**
     * @return boolean
     */
    public function updateToDB();
}