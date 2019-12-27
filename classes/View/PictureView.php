<?php
namespace View;

use Mapper\CommentMapper;
use Mapper\UserMapper;
use Model\Picture;

class PictureView extends View{
    const TEMPLATE = 'basic_bs_picture.phtml';
    private $picture;
    private $author;
    private $comments = array();
    function __construct(Picture $picture, $template = null){
        $this->picture = $picture;
        $this->author = UserMapper::getByUsername('ahmed');
        $comments = CommentMapper::getAllComments($picture);
        foreach($comments as $comment){
            $tmp = array(
                'comment' => $comment,
                'user' => UserMapper::getByUsername('ahmed')
            );
            $this->comments[] = $tmp;
        }
        if($template === null)
            parent::__construct(self::TEMPLATE);
        else
            parent::__construct($template);
    }

    function render($data = array(), $returnOnly = false){
        // Just alias what's important to reduce code in view template
        $data = array(
            'author' => $this->author,
            'picture' => $this->picture,
            'comments' => $this->comments
        );
        return parent::render($data, $returnOnly);
    }
}
