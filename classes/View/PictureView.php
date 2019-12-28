<?php
namespace View;

use Mapper\CommentMapper;
use Mapper\UserMapper;
use Model\Picture;
use Mapper\ReactionMapper;
use Model\Reaction;
use Model\REACTION_TYPE;

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
        $reactions = ReactionMapper::getReactionsByPicture($picture);
        foreach($comments as $comment){
            $tmp = array(
                'comment' => $comment,
                'user' => UserMapper::getByUsername('ahmad')
            );
            $this->comments[] = $tmp;
        }
        foreach($reactions as $reaction){
            if ($reaction->getType() === REACTION_TYPE::DOWNVOTE)
                $this->downvoteCount++;
            else
                $this->upvoteCount++;
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
