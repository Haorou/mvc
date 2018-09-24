<?php
namespace Haorou\Blog\Model;

require_once("model/Manager.php");
class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?');
        $comment->execute(array($commentId));
        $comment = $comment->fetch();
        return $comment;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function modifyComment($postId, $commentContent)
    {
        $db = $this -> dbConnect();
        $newComment = $db->prepare('UPDATE comments SET comment=:commentContent, comment_date = :comment_date WHERE id= :postId');
        $newComment->execute(array(
            "commentContent" => $commentContent,
            "comment_date" => now(),
            "id" => $postId));
    }
}