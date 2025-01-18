<?php
    include_once "app/include/header.php";
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 4;
    $offset = $limit * ($page - 1);
    $totalPage = round(countRow('posts') / $limit);

    $posts = selectAllPostAndUser('posts', 'users', $limit, $offset);
    $postTop = selectTopPost('posts');
?>

<div class="container">
    <div class="row">
        <h2 class="slider-title">Топ публікацій!</h2>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-inner">
            <?php foreach($postTop as $key => $pTop) {
            if ($key == 0) {?>
                <div class="carousel-item active">
            <?php }else{?>
                <div class="carousel-item">
            <?php } ?>
                    <img src="<?=BASE_URL . '/assets/img/posts/' . $pTop['img'];?>" alt="<?=$pTop['title'];?>" class="d-block w-100">
                    <div class="carousel-caption carousel-caption-hack d-none d-md-block">
                        <h5>
                            <a href="<?=BASE_URL . 'single.php?post=' . $pTop['id']?>">
                                <?=strlen($pTop['title']) > 60 ? mb_substr($pTop['title'], 0, 60, 'UTF-8') . '...' : $pTop['title']; ?>
                            </a>
                        </h5>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="container">
    <div class="content row">
        <div class="main-content col-md-9 col-12">
            <h2>Останні публікації</h2>
            <?php foreach ($posts as $key => $post){ ?>
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
            <?php include_once "app/include/pagination.php"; ?>
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