<?php
if ($errorMessage > 0){?>
    <ul class="error_list">
        <?php foreach ($errorMessage as $error){?>
            <li><?=$error;?></li>
        <?php }?>
    </ul>
<?php }?>

<style>
    ul.error_list{
        padding-left: 0;
    }
    .error_list li{
        color: red;
        font-style: italic;
        font-size: 0.8rem;
        list-style: none;
    }
</style>
