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
        global $data;
        $data["content"] = "title";
        $data["nadpis"] = "Tohle je H1";
       /* $data["error"][]="TEstovací chyba";
        $data["success"][]="TEstovací úspěch";*/

        $this->db = new db();
        $this->createFooter();
    }

    /**
     * Method establish connection to database.
     */
    public function connectDB()
    {
        $this->db->Connect();
    }

    /**
     * Method fill in fields in footer.
     */
    public function createFooter(){
        global $data;
        $data["footer_left_a"] = "http://www.skauti-doubravka.cz";
        $data["footer_left"] = SKAUTI_DOUBRAVKA;

        $data["footer_right_a"] = "http://www.skaut.cz/";
        $data["footer_right"] = JUNAK;
    }
}