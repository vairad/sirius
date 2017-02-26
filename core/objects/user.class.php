<?php
/**
 *
 *
 */
class user extends generic_object
{
    // DB fields
    private $id;
    private $person_id;
    private $name;
    private $nick;
    private $surname;
    private $bio;
    private $function;
    private $photo;
    private $verified;
    private $last_log_time;

    //loaded parameters
    private $rights;
    private $mail;



    public function __construct($db){
        parent::__construct($db);
        $this->logger = Logger::getLogger("User-dataHolder");
        $this->logger->info("Object constructor");

        $this->set_up["id"] = false;
        $this->set_up["person_id"] = false;
        $this->set_up["name"] = false;
        $this->set_up["nick"] = false;
        $this->set_up["surname"] = false;
        $this->set_up["last_log_time"] = false;

        $this->set_up["photo"] = false;
        $this->set_up["verified"] = false;

//        $this->set_up["nick"] = false;              // not necessary to save to db
//        $this->set_up["bio"] = false;               // not necessary to save to db
//        $this->set_up["function"] = false;          // not necessary to save to db
    }

//==================================================================================

    public function getId()
    {
        $this->logger->trace("Get id");
        return $this->id;
    }

    public function setId($id)
    {
        $this->logger->debug("Set up id with:".$id);
        $this->set_up["id"] = true;
        $this->id = $id;
    }

//===================================

    public function getPersonId()
    {
        $this->logger->trace("Get PersonID");
        return $this->person_id;
    }

    public function setPersonId($id)
    {
        $this->logger->debug("Set up person_id with:".$id);
        $this->set_up["person_id"] = true;
        $this->person_id = $id;
    }

//===================================


    public function getName()
    {
        $this->logger->trace("Get login");
        return $this->name;
    }

    public function setName($name)
    {
        $this->logger->debug("Set up name with:".$name);
        $this->set_up["name"] = true;
        $this->name = $name;
    }

//===================================

    public function getNick()
    {
        $this->logger->trace("Get nick");
        return $this->nick;
    }

    public function setNick($nick)
    {
        $this->logger->debug("Set up nick with:".$nick);
        $this->set_up["nick"] = true;
        $this->name = $nick;
    }

//===================================

    public function getSurname()
    {
        $this->logger->trace("Get surname");
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->logger->debug("Set up surname with:".$surname);
        $this->set_up["surname"] = true;
        $this->name = $surname;
    }


//===================================

    public function getLastLogTime()
    {
        $this->logger->trace("Get last_log_time");
        return $this->last_log_time;
    }

    public function setLastLogTime($last_log_time)
    {
        $this->logger->debug("Set up last_log_time with:".$last_log_time);
        $this->set_up["last_log_time"] = true;
        $this->last_log_time = $last_log_time;
    }

//===================================

    public function getMail()
    {
        $this->logger->trace("Get mail");
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->logger->debug("Set up mail with:".$mail);
        $this->mail = $mail;
    }


//===================================

    public function getBio()
    {
        $this->logger->trace("Get bio");
        return $this->bio;
    }

    public function setBio($bio)
    {
        $this->logger->debug("Set up bio with:".$bio);
        $this->set_up["bio"] = true;
        $this->bio = $bio;
    }

//===================================

    public function getFunction()
    {
        $this->logger->trace("Get function");
        return $this->function;
    }

    public function setFunction($function)
    {
        $this->logger->debug("Set up function with:".$function);
        $this->set_up["function"] = true;
        $this->function = $function;
    }

//===================================

    public function getPhoto()
    {
        $this->logger->trace("Get photo");
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->logger->debug("Set up photo with:".$photo);
        $this->set_up["photo"] = true;
        $this->photo = $photo;
    }

//===================================

    public function getRights()
    {
        $this->logger->trace("Get rights");
        return $this->rights;
    }


    public function setRights($rights)
    {
        $this->logger->debug("Set up rights with:".$rights);
        $this->set_up["rights"] = true;
        $this->rights = $rights;
    }


//===================================

    public function getVerified()
    {
        $this->logger->trace("Get verified");
        return $this->verified;
    }

    public function setVerified($verified)
    {
        $this->logger->debug("Set up verified with:".$verified);
        $this->set_up["verified"] = true;
        $this->verified = $verified;
    }



//=====================================================================================
    function toString()
    {
        if($this->isSetUp() == true){
            return "ID: ".$this->id." NAME: ".$this->name." NICK: ".$this->nick."";
        }else{
            return "Object is not set up";
        }
    }


    public function updateFromDB()
    {
        // TODO: Implement updateFromDB() method.
    }

    public function saveToDB()
    {
        // TODO: Implement saveToDB() method.
    }

    public function updateToDB()
    {
        // TODO: Implement updateToDB() method.
    }
}