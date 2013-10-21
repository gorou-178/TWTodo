<h2>ホーム<?php if (!empty($me)){echo "[" . h($me->tw_screen_name) . "]";} else {echo "";}; ?></h2>
<?php
    if (!empty($me)) {
?>
    <p><?php echo $this->Html->link("[ログアウト]", array("action"=>"logout")); ?></p>
<?php
        var_dump($tweets);
    }
    else {
?>
    <p><?php echo $this->Html->link("[ログイン]", array("action"=>"login")); ?></p>
<?php
    }
?>