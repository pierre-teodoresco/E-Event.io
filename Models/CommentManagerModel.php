<?php
class CommentManagerModel extends Model{
    private $_event = 'comments';

    public function __construct(){
        $this->getConnection();
        $this->table = $this->_event;
    }

    public function createCommentModel(){
        //TODO
    }

    public function getCommentModel(){
        //TODO
    }

    public function updateCommentModel(){
        //TODO
    }

    public function deleteCommentModel(){
        //TODO
    }
}
