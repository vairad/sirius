<?php
/**
 *
 *
 */
class app
{
    // connection to the database
    private $db = null;

    /**
     * Konstruktor aplikace.
     */
    public function app()
    {
        $this->db = new db();
    }

    /**
     * Pripojit k databazi.
     */
    public function connectDB()
    {
        $this->db->Connect();
    }
}