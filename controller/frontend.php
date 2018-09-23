<?php

// Chargement des classes

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new \Haorou\Blog\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function post($postId)
{
    $postManager = new \Haorou\Blog\Model\PostManager();
    $commentManager = new \Haorou\Blog\Model\CommentManager();

    $post = $postManager->getPost($postId);
    $comments = $commentManager->getComments($postId);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new \Haorou\Blog\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) 
    {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else 
    {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function displayCommentToChange($commentId, $postId)
{
    $commentManager = new \Haorou\Blog\Model\CommentManager();
    $postManager = new \Haorou\Blog\Model\PostManager();

    $comment = $commentManager->getComment($commentId);
    $post = $postManager->getPost($postId);

    require('view/frontend/commentToChangeView.php');
}

function changeComment($postId)
{
    $commentManager = new \Haorou\Blog\Model\CommentManager();

    $isCommentChange = $commentManager->modifyComment($postId);

    if($isCommentChange === false)
    {
        throw new Exception('Impossible de changer le commentaire !');
    }
    else
    {
        header('Location: index.php?action=post&id=' . $postId);
    }
}