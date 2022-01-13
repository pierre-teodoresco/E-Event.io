<?php

class Event{
    private $id;
    private $title;
    private $owner;
    private $description;
    private $content;
    private $votes;
    private $illustration;
    private $addcontent;

    public function __construct($data)
    {
        foreach($data as $key=>$var){
            $varName = $key;
            $this->$varName = $var;
        }
    }


    public function updateOrCreate(){
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'owner' => $this->owner,
            'description' => $this->description,
            'content' => $this->content,
            'votes' => $this->votes,
            'illustration' => $this->illustration,
            'addcontent' => $this->addcontent
        ];
        $model = new EventModel();
        $model->updateOrCreate($data);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->updateOrCreate();

    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;
        $this->updateOrCreate();

    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        $this->updateOrCreate();

    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
        $this->updateOrCreate();

    }

    public function getVotes()
    {
        return $this->votes;
    }

    public function setVotes($votes)
    {
        $this->votes = $votes;
        $this->updateOrCreate();

    }

    public function getIllustration()
    {
        return $this->illustration;
    }

    public function setIllustration($illustration)
    {
        $this->illustration = $illustration;
        $this->updateOrCreate();

    }

    public function getAddcontent()
    {
        return $this->addcontent;
    }

    public function setAddcontent($addcontent)
    {
        $this->addcontent = $addcontent;
        $this->updateOrCreate();
    }

}