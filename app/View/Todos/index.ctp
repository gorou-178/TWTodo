<h2>todos</h2>
    <h3>ようこそ <?php echo $twUser; ?></h3>
    <p><?php echo $this->Html->link("ログアウト", "/login/logout"); ?></p>
    <p><?php echo $this->Html->link("設定", "/setting"); ?></p>
    <?php var_dump($tweets); ?>