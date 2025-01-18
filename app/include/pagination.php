<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="?page=1">First</a>
        </li>
        <?php if($page > 1){ ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?=($page - 1);?>">Prev</a>
            </li>
        <?php } ?>
        <?php if($page < $totalPage){ ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?=($page + 1);?>">Next</a>
            </li>
        <?php } ?>
        <li class="page-item">
            <a class="page-link" href="?page=<?=$totalPage?>">Last</a>
        </li>
    </ul>
</nav>