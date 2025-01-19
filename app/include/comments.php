<?php include_once __DIR__ . '/../controllers/comment.php'; ?>

<div class="comments col-md-12 col-12">
    <h3>Comments</h3>
    <form method="post" action="<?=BASE_URL . 'single.php?post=' . $page;?>">
        <div class="mb-3 col-12 error">
            <?php include_once  __DIR__ . "/../helps/errorInfo.php";?>
        </div>
        <input type="hidden" name="page" value="<?= $page;?>">
        <div class="mb-3">
            <label for="comment_email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="comment_email" id="comment_email" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="mb-3">
            <label for="comment_text" class="form-label">Text</label>
            <textarea class="form-control" name="comment_text" id="comment_text" rows="4"></textarea>
        </div>
        <div class="col-12 mt-3 mb-3">
            <button type="submit" name="goComment" class="btn btn-primary">Submit comments</button>
        </div>
    </form>

    <?php if (count($comments) > 0){?>
        <div class="all-comments row">
            <h3 class="mb-3 col-12">Коментарі до поста</h3>
            <?php foreach($comments as $comment){?>
                <div class="one-comment col-12">
                    <span><i class="far fa-envelope"></i> <?=$comment['email']?></span>
                    <span><i class="far fa-calendar-check"></i> <?=$comment['created_date']?></span>
                    <div class="col-12 text">
                        <?=$comment['comment']?>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</div>