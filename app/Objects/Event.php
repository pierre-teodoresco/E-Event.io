<?php

class Event extends ObjectBase{
    private $id;
    private $title;
    private $owner;
    private $description;
    private $content;
    private $votes;
    private $illustration;
    private $addcontent;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        $this->updateOrCreate();
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->updateAttribute('title', $title);

    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;
        $this->updateAttribute('owner', $owner);

    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        $this->updateAttribute('description', $description);


    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
        $this->updateAttribute('content', $content);

    }

    public function getVotes()
    {
        return $this->votes;
    }

    public function setVotes($votes)
    {
        $this->votes = $votes;
        $this->updateAttribute('votes', $votes);

    }

    public function getIllustration()
    {
        return $this->illustration;
    }

    public function setIllustration($illustration)
    {
        $this->illustration = $illustration;
        $this->updateAttribute('illustration', $illustration);

    }

    public function getAddcontent()
    {
        return $this->addcontent;
    }

    public function setAddcontent($addcontent)
    {
        $this->addcontent = $addcontent;
        $this->updateAttribute('addcontent', $addcontent);
    }

}