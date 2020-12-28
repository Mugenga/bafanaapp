<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Gwiza 2.0 | Savings Groups Platform</title>
        <?php
        //<!-- PLUGIN CSS -->
        echo $this->Html->css('insp/bootstrap.min');
        echo $this->Html->css('insp/font-awesome/css/font-awesome');
        // Morris -->
        echo $this->Html->css('insp//plugins/morris/morris-0.4.3.min');
        echo $this->Html->css('insp/animate');
        echo $this->Html->css('insp/style');
        ?>
    </head>
    <body class="top-navigation">
        <div id="container">
            <div id="header">
                <h1><?= __('Error') ?></h1>
            </div>
            <div id="content">
                <?= $this->Flash->render() ?>

                <?= $this->fetch('content') ?>
            </div>
            <div id="footer">
                <?= $this->Html->link(__('Back'), 'javascript:history.back()') ?>
            </div>
        </div>
    </body>
</html>
