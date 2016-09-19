<?php
/**
 *
 *
 */
class user extends generic_object
{
    private $id;
    private $login;
    private $name;
    private $password;
    private $create_time;
    private $last_log_time;
    private $mail;
    private $nick;
    private $bio;
    private $function;
    private $photo;
    private $rights;
    private $verified;
    private $cookie;


    public function user(){
        $this->generic_object();
        $this->logger = Logger::getLogger("user-app");
        $this->logger->info("Object constructor");

        $this->set_up["id"] = false;
        $this->set_up["login"] = false;
        $this->set_up["name"] = false;
        $this->set_up["password"] = false;
        $this->set_up["create_time"] = false;
        $this->set_up["last_log_time"] = false;
        $this->set_up["mail"] = false;
//        $this->set_up["nick"] = false;              // not necessary to save to db
//        $this->set_up["bio"] = false;               // not necessary to save to db
        $this->set_up["function"] = false;
        $this->set_up["photo"] = false;
//        $this->set_up["rights"] = false;            // not necessary to save to db
        $this->set_up["verified"] = false;
//        $this->set_up["cookie"] = false;            // not necessary to save to db
    }


    //===================================================================

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

    public function getLogin()
    {
        $this->logger->trace("Get login");
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->logger->debug("Set up login with:".$login);
        $this->set_up["login"] = true;
        $this->login = $login;
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

    public function getPassword()
    {
        $this->logger->trace("Get password");
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->logger->debug("Set up password with:".$password);
        $this->set_up["password"] = true;
        $this->password = $password;
    }

//===================================

    public function getCreateTime()
    {
        $this->logger->trace("Get create_time");
        return $this->create_time;
    }

    public function setCreateTime($create_time)
    {
        $this->logger->debug("Set up create_time with:".$create_time);
        $this->set_up["create_time"] = true;
        $this->create_time = $create_time;
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
        $this->set_up["mail"] = true;
        $this->mail = $mail;
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
        $this->nick = $nick;
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


//===================================

    public function getCookie()
    {
        $this->logger->trace("Get cookie");
        return $this->cookie;
    }

    public function setCookie($cookie)
    {
        $this->logger->debug("Set up cookie with:".$cookie);
        $this->set_up["cookie"] = true;
        $this->cookie = $cookie;
    }

//============================================================================
    function toString()
    {
        if($this->isSetUp() == true){
            return "ID: ".$this->id." NAME: ".$this->name." LOGIN: ".$this->login."";
        }else{
            return "Object is not set up";
        }
    }


}