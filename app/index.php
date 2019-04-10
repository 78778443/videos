<?php
session_start();

include "head.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['password'] == (date('mY') + 1)) {
        $_SESSION['on'] = true;
    }
}

if (empty($_SESSION['on'])) {

    ?>
    <form class="form-inline" action="index.php" method="post">
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control" name="password" placeholder="密码">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">提交</button>
    </form>

    <?php

    ?><?php
} else {

    $list = scandir('/data/videos/');

    unset($list[0]);
    unset($list[1]);

    $arr = ['mp4', 'rmvb', 'wmv', 'MOV'];
    foreach ($list as $key => $val) {
        if (!in_array(pathinfo($val, PATHINFO_EXTENSION), $arr)) {
            continue;
        }

        ?>

        <a class="btn btn-default btn-video btn-lg" href="./encode.php?name=<?= $val ?>" role="button">
            <h2><?= $val ?></h2></a>

    <?php }
} ?>
</body>
</html>
