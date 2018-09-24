<?php
require('controller/frontend.php');

try 
{
    if (isset($_GET['action'])) 
    {
        if ($_GET['action'] == 'listPosts') 
        {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') 
        {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                post($_GET['id']);
            }
            else 
            {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') 
        {
            if (isset($_GET['id']) && $_GET['id'] > 0) 
            {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) 
                {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else 
                {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else 
            {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif($_GET["action"] == "displayCommentToChange")
        {
            if(isset($_GET["comment_id"]) && $_GET["comment_id"] >0)
            {
                if(isset($_GET["post_id"]) && $_GET["post_id"] >0)
                {   
                    displayCommentToChange($_GET["comment_id"], $_GET["post_id"]);
                }                       
            }
            else 
            {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif($_GET["action"] == "changeComment")
        {
            if($_GET["comment_id"] && $_GET["comment_id"] > 0)
            {
                changeComment($_GET["comment_id"], $_POST["comment"], $_GET["post_id"]);
            }
        }
    }
    else 
    {
        listPosts();
    }
}
catch(Exception $e) 
{
    echo 'Erreur : ' . $e->getMessage();
}
