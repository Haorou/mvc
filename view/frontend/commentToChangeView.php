<?php 
    $title="Mon blog";
    ob_start();
?>

    <h1>Mon super blog !</h1>
    <p><a href="index.php">Billet relatif</a></p>

    <div class="news">
        <h3>
            <?= htmlspecialchars($post['title']) ?>
            <em>le <?= $post['creation_date_fr'] ?></em>
        </h3>
        
        <p> <?= nl2br(htmlspecialchars($post['content'])) ?> </p>
    </div>

    <h2>Commentaire à modifer</h2>

    <form action="index.php?action=changeComment&amp;id=<?= $comment['id']?> &amp;" method="post">
        <div>
            <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> 
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"><?=$comment["comment"] ?></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>

<?php 
    $content = ob_get_clean();
    require("template.php");
?>