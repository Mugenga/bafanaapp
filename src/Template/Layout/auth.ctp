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
        echo $this->Html->css('insp/animate');
        echo $this->Html->css('insp/style');
        ?>

    </head>
    <body class="gray-bg">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <div>
                    <h1 class="logo-name">NJ+</h1>
                </div>
                <?php echo $this->Flash->render(); ?>
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
        <!-- Mainly scripts -->
        <?php
        // <!-- PLUGIN JS -->
        echo $this->Html->script('insp/jquery-2.1.1');
        echo $this->Html->script('insp/bootstrap.min');
        ?>
    </body>
</html>
