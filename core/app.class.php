<?php
/**
 *
 *
 */
class app
{
    // connection to the database
    private $db = null;
    private $data;

    private $logger;

    public function app(){
        global $data;
        $this->logger = Logger::getLogger("app");
        $this->db = new db();
        $this->data = &$data;
    }

    /**
     * Konstruktor aplikace.
     */
    public function run()
    {
        $this->logger->debug("Start executing app");

        $this->data["content"] = "title";

        $this->prepareEvents();

        $this->createFooter();

        $this->test_objects();

        $this->logger->debug("End executing app");
        return $this->data;
    }

    public function prepareEvents(){
        $this->data["events"][1]["date"] = "12. 5. - 16. 5."  ;
        $this->data["events"][1]["name"] = "Velkolepá výprava";

        $this->data["events"][2]["date"] = "12. 5. - 16. 5."  ;
        $this->data["events"][2]["name"] = "Velkolepá výprava";

        $this->data["events"][3]["date"] = "12. 5. - 16. 5."  ;
        $this->data["events"][3]["name"] = "Velkolepá výprava";

        $this->data["events"][4]["date"] = "12. 5. - 16. 5."  ;
        $this->data["events"][4]["name"] = "Velkolepá výprava";

        $this->data["events"][5]["date"] = "12. 5. - 16. 5."  ;
        $this->data["events"][5]["name"] = "Velkolepá výprava";
    }

    /**
     * Přidá zprávu do pole, které je šablonou interpretováno jako chyby.
     * @param string $message
     */
    public function addError($message) {
        $this->data["error"][] = $message;
    }

    /**
     * Přidá zprávu do pole, které je šablonou interpretováno jako úspěchy.
     * @param string $message
     */
    public function addSuccess($message) {
        $this->data["success"][] = $message;
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
        $this->data["footer_left_a"] = "http://www.skauti-doubravka.cz";
        $this->data["footer_left"] = SKAUTI_DOUBRAVKA;

        $this->data["footer_right_a"] = "http://www.skaut.cz/";
        $this->data["footer_right"] = JUNAK;
    }

    //todo delete
    private function test_objects(){
        $this->logger->info("Start testing");
        $object = new artefact();
        $object = new category();
        $object = new right();
        $object = new user();
        $this->logger->info("End testing");
    }

}
