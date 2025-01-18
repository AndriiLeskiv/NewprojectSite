<?php
include_once "app/include/header.php";
$getPostFromCategory = selectAllCategoryPost('posts', 'users', ['category_id' => $_GET['id']]);
$getCategoryName = selectOne('categories', ['id' => $_GET['id']]);
?>

    <div class="container">
        <div class="content row">
            <div class="main-content col-md-9 col-12">
                <h2 id="<?=$getCategoryName['id'];?>">Пости з категорії: <strong><?=$getCategoryName['name'];?></strong></h2>
                <?php if($getCategoryName['description']){?>
                    <p><?=$getCategoryName['description'];?></p>
                <?php } ?>
                <?php foreach ($getPostFromCategory as $key => $post){ ?>
                    <div class="post row">
                        <div class="img col-12 col-md-4">
                            <img src="<?=BASE_URL . '/assets/img/posts/' . $post['img'];?>" alt="<?=$post['title'];?>" class="img-thumbnail">
                        </div>
                        <div class="post_text col-12 col-md-8">
                            <h3>
                                <a href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>">
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