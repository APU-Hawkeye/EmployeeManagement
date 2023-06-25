<?php
/**
 * @var \App\View\AppView $this
 * @var string $titleForLayout
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#ffffff">
    <?php echo $this->Html->css("dashforge"); ?>
    <?php echo $this->Html->css("skin.cool"); ?>
    <?php echo $this->Html->css("/lib/ionicons/css/ionicons.min"); ?>
    <?php echo $this->Html->css("loader.min"); ?>
    <?php echo $this->Html->css("dimmer.min"); ?>
    <?php echo $this->fetch("css"); ?>

    <title><?php echo $titleForLayout; ?></title>
</head>
<body class="df-roboto">
<?php echo $this->element("sidebar"); ?>
<div class="content ht-100v pd-0">
    <?php echo $this->fetch("content"); ?>
</div>
<?php echo $this->Html->script([
    "/lib/jquery/jquery.min",
    "/lib/bootstrap/js/bootstrap.bundle.min",
    "/lib/feather-icons/feather.min",
    "/lib/perfect-scrollbar/perfect-scrollbar.min",
    "dashforge",
    "dashforge.aside",
    "form-utility"
]) ?>
<script>
    $(function(){
        'use strict'

        $('.off-canvas-menu').on('click', function(e){
            e.preventDefault();
            let target = typeof $(this).attr('href') != 'undefined' ? $(this).attr('href') : $(this).attr('data-target');
            $(target).addClass('show');
            $(document).trigger('offCanvasMenu.show', [this])
        });


        $('.off-canvas .close').on('click', function(e){
            e.preventDefault();
            $(this).closest('.off-canvas').removeClass('show');
            $(document).trigger('offCanvasMenu.hide');
        })

        $(document).on('click touchstart', function(e){
            e.stopPropagation();
            if(!$(e.target).closest('.off-canvas-menu').length) {
                let offCanvas = $(e.target).closest('.off-canvas').length;
                if(!offCanvas) {
                    $('.off-canvas.show').removeClass('show');
                    $(document).trigger('offCanvasMenu.hide');
                }
            }
        });
    });
</script>
<?php echo $this->fetch("scriptBottom"); ?>
</body>
</html>
