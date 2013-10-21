<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<?php echo $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>
		<?php echo $title_for_layout; ?>
	</title>

    <?php
        //echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('cake.generic');
        //echo $this->Html->css('app');
    ?>

    <script type="text/javascript" src="/js/underscore.js"></script>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/backbone-min.js"></script>
    <script type="text/javascript" src="/js/backbone.localStorage.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>

	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
        <div id="header">
            <h1><?php echo $this->Html->link("ホーム", array("controller"=>"twido", "action"=>"index")); ?></h1>
        </div>
        <div id="content">

            <?php echo $this->Session->flash(); ?>

            <?php echo $this->fetch('content'); ?>
        </div>
        <div id="footer">
            <?php echo $this->Html->link(
                $this->Html->image('cake.power.gif', array('alt' => "twido", 'border' => '0')),
                'http://www.cakephp.org/',
                array('target' => '_blank', 'escape' => false)
            );
            ?>
        </div>
    </div>
</body>
</html>
