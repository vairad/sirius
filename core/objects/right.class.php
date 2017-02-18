<?php
/**
 * Container for database object user rights.
 *
 */
class right extends generic_object
{
    private $id;
    private $name;
    private $value;
    private $title;


    public function __construct(){
        parent::__construct();
        $this->logger = Logger::getLogger("right-app");
        $this->logger->info("Object constructor");

        $this->set_up["id"] = false;
        $this->set_up["name"] = false;
        $this->set_up["value"] = false;
        $this->set_up["title"] = false;

    }

//==================================================================


    public function getId()
    {
        $this->logger->trace("Get id");
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->logger->debug("Set up id with:".$id);
        $this->set_up["id"] = true;
        $this->id = $id;
    }
//=================

    public function getName()
    {
        $this->logger->trace("Get name");
        return $this->name;
    }

    public function setName($name)
    {
        $this->logger->debug("Set up name with:" . $name);
        $this->set_up["name"] = true;
        $this->name = $name;
    }
//=================

    public function getValue()
    {
        $this->logger->trace("Get value");
        return $this->value;
    }

    public function setValue($value)
    {
        $this->logger->debug("Set up value with:".$value);
        $this->set_up["value"] = true;
        $this->value = $value;
    }
//=================

    public function getTitle()
    {
        $this->logger->trace("Get title");
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->logger->debug("Set up title with:".$title);
        $this->set_up["title"] = true;
        $this->title = $title;
    }
//=================

    public function toString(){
        if($this->isSetUp() == true){
            return "ID: ".$this->id." NAME: ".$this->name." TITLE: ".$this->title." VALUE: ".$this->value;
        }else{
            return "Object is not set up";
        }
    }
}