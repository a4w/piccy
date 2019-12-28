<?php
namespace View;

use Mapper\CommentMapper;
use Mapper\UserMapper;
use Model\Picture;
use Mapper\ReactionMapper;
use Model\Reaction;
use Model\REACTION_TYPE;
use Util\Util;

class PictureView extends View{
    const TEMPLATE = 'basic_bs_picture.phtml';
    private $picture;
    private $author;
    private $comments = array();
    private $downvoteCount = 0, $upvoteCount = 0;
    function __construct(Picture $picture, $template = null){
        $this->picture = $picture;
        $this->author = UserMapper::get($picture->getUserID());
        $comments = CommentMapper::getAllComments($picture);
        $this->downvoteCount = ReactionMapper::getNumberOfReactsTypeByPicture($picture, REACTION_TYPE::DOWNVOTE);
        $this->upvoteCount = ReactionMapper::getNumberOfReactsTypeByPicture($picture, REACTION_TYPE::UPVOTE);
        foreach($comments as $comment){
            $tmp = array(
                'comment' => $comment,
                'user' => UserMapper::get($comment->getUserID())
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
            'comments' => $this->comments,
            'downvoteCount' => $this->downvoteCount,
            'upvoteCount' => $this->upvoteCount
        );
        return parent::render($data, $returnOnly);
    }
}
