<?php
class CommentModel extends Model{
    private $_id;
    private $_author;
    private $_description;
    private $_event;

    public function __construct (array $data){
        $this->hydrate($data);
    }

    public function hydrate (array $data){
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }


    public function setId($id)
    {
        if (is_int($id))
            $this->_id = $id;
    }

    public function setAuthor($author)
    {
        if (is_string($author))
            $this->_author = $author;
    }

    public function setDescription($description)
    {
        if (is_string($description))
            $this->_description = $description;
    }

    public function setEvent($event)
    {
        $this->_event = $event;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getAuthor()
    {
        return $this->_author;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getEvent()
    {
        return $this->_event;
    }
}