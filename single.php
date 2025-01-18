<?php
    include_once "app/include/header.php";
    $postId = $_GET['post'];
    $post = selectSinglePost($postId, 'posts', 'users');
?>

<div class="container">
    <div class="content row">
        <div class="main-content col-md-9 col-12">
            <h2><?=$post['title'];?></h2>
            <div class="single_post row">
                <div class="img col-12">
                    <img src="<?=BASE_URL . '/assets/img/posts/' . $post['img'];?>" alt="<?=$post['title'];?>" class="img-thumbnail">
                </div>
                <div class="info">
                    <i class="fa-solid fa-user"></i><?=$post['user_name'];?>
                    <i class="fa-solid fa-calendar"></i> <?=$post['created_date'];?>
                </div>
                <div class="single_post_text col-12">
                    <p><?=$post['content'];?></p>
                </div>
            </div>
        </div>

        <div class="sidebar col-md-3 col-12">
            <div class="section search">
                <h3>Search Post</h3>
                <form action="search.php" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="Search...">
                </form>
            </div>
            <div class="section topics">
                <h3>Category</h3>
                <ul>
                    <?php $getAllCategory = selectAll('categories');
                    foreach ($getAllCategory as $key => $category) {?>
                        <li><a href="<?=BASE_URL . 'category.php?id=' . $category['id'];?>"><?=$category['name']?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php include_once "app/include/footer.php"; ?>