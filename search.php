<?php include_once "app/include/header.php";
$posts = selectAllPostAndUser('posts', 'users');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search-term'])) {
    $term = $_POST['search-term'];
    if ($term !== ''){
        $search_post = searchAllPost($_POST['search-term'], 'posts', 'users');
    }else{
        @header('Location: index.php');
    }
}
?>

<div class="container">
    <div class="content row">
        <div class="main-content col-12">
            <h2>Результати пошуку</h2>
            <?php foreach ($search_post as $key => $post){ ?>
                <div class="post row">
                    <div class="img col-12 col-md-4">
                        <img src="<?=BASE_URL . '/assets/img/posts/' . $post['img'];?>" alt="<?=$post['title'];?>" class="img-thumbnail">
                    </div>
                    <div class="post_text col-12 col-md-8">
                        <h3>
                            <a href="<?=BASE_URL . 'single.php?post=' . $post['id']?>">
                                <?=strlen($post['title']) > 60 ? mb_substr($post['title'], 0, 60, 'UTF-8') . '...' : $post['title']; ?>
                            </a>
                        </h3>
                        <i class="fa-solid fa-user"></i> <?=$post['user_name'];?>
                        <i class="fa-solid fa-calendar"> </i><?=$post['created_date'];?>
                        <p class="preview-text">
                            <?=strlen($post['content']) > 100 ? mb_substr($post['content'], 0, 100, 'UTF-8') . '...' : $post['content']; ?>
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php include_once "app/include/footer.php"; ?>