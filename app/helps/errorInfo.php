<?php
if ($errorMessage > 0){?>
    <ul>
        <?php foreach ($errorMessage as $error){?>
            <li><?=$error;?></li>
        <?php }?>
    </ul>
<?php }