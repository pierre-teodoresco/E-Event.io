<?php
class Comment{
    private $id;
    private $author;
    private $description;
    private $event;

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
            'author' => $this->author,
            'description' => $this->description,
            'event' => $this->event
        ];
        $model = new CommentModel();
        $model->updateOrCreate($data);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
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

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent($event)
    {
        $this->event = $event;
        $this->updateOrCreate();
    }

}