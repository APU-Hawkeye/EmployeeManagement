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
    <?php echo $this->Html->css("/lib/ionicons/css/ionicons.min"); ?>
    <?php echo $this->Html->css("loader.min"); ?>
    <?php echo $this->Html->css("dimmer.min"); ?>

    <title><?php echo $titleForLayout; ?></title>

    <style>
        .df-logo img{
            max-height: 40px;
            max-width: 125px;
        }
    </style>
</head>
<body class="bg-dark df-roboto">

<div class="container">
    <div class="row">
        <div class="offset-sm-4 col-sm-4">
            <div class="card mg-t-100">
                <div class="card-body bg-gray-100">
                    <div class="mb-3 tx-center">
                        <a href="" class="df-logo tx-spacing-2 mt-1"><?php echo $this->Html->image('cake-logo.png', ['alt'=>'cake logo']) ?></span></a>
                    </div>
                    <h4 class="tx-spacing-2"><?php echo __("Sign In"); ?></h4>
                    <p class="tx-color-03 tx-spacing-2"><?php echo __("Welcome back! Please login to continue."); ?></p>
                    <?php echo $this->Flash->render(); ?>
                    <?php echo $this->Form->create(null, [
                        "autocomplete" => "off",
                        "templates" => [
                            "inputContainer" => '{{content}}'
                        ],
                        "data-submit" => "disable",
                    ]); ?>
                    <fieldset>
                        <div class="ui inverted dimmer">
                            <div class="ui loader"></div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="tx-spacing-2"><?php echo __("Username"); ?></label>
                            <?php echo $this->Form->control("username", [
                                "class" => "form-control tx-spacing-2",
                                "label" => false,
                                "error" => false,
                                "type" => "string",
                                "required" => true,
                                "placeholder" => "username"
                            ]); ?>
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mg-b-5">
                                <label for="password" class="mg-b-0-f tx-spacing-2"><?php echo __("Password"); ?></label>
                            </div>
                            <div class="input-group">
                                <?php echo $this->Form->control("password", [
                                    "class" => "form-control tx-spacing-2",
                                    "label" => false,
                                    "error" => false,
                                    "type" => "password",
                                    "required" => true,
                                    "placeholder" => __("Enter your password")
                                ]); ?>
                                <div class="input-group-append">
                                    <button id="passwordToggleBtn" class="btn btn-light" type="button"><i class="icon ion-md-eye"></i></button>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary tx-spacing-2 text-uppercase btn-block"><?php echo __("Sign In"); ?></button>
                    </fieldset>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Html->script([
    "/lib/jquery/jquery.min",
    "/lib/bootstrap/js/bootstrap.bundle.min",
    "/lib/feather-icons/feather.min",
    "/lib/perfect-scrollbar/perfect-scrollbar.min",
    "dashforge",
    "form-utility"
]) ?>
<script>
    let $passwordInput = $("#password");
    $(function(){
        $("#passwordToggleBtn").on("click", function(){
            if ( $passwordInput.prop("type") === "text" ) {
                $passwordInput.prop("type", "password");
                $(this).children("i").removeClass("ion-md-eye-off").addClass("ion-md-eye");
            } else {
                $passwordInput.prop("type", "text");
                $(this).children("i").removeClass("ion-md-eye").addClass("ion-md-eye-off");
            }
        });
    });
</script>
</body>
</html>
