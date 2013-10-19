<h2>ホーム<?php if ($login == true){echo "(ログイン中)";} else {echo "";}; ?></h2>
<?php
    if ($login == true) {
?>
    <p><?php echo $this->Html->link("[ログアウト]", array("action"=>"logout")); ?></p>
<?php
    }
    else {
?>
    <p><?php echo $this->Html->link("[ログイン]", array("action"=>"login")); ?></p>
<?php
    }
?>