<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#424242" />
        <title>CAPENDIK</title>
        <link href="<?php echo base_url(); ?>uploads/school_content/admin_small_logo/favicon.png" rel="shortcut icon" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/jquery.mCustomScrollbar.min.css">
        <style type="text/css">
            body{background:linear-gradient(to right,#676767 0,#dadada 100%);}
            /*.loginbg {background: #455a64;}*/
            .top-content{position: relative;}
            .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar {
                background: rgb(53, 170, 71);}
            .bgoffsetbgno{background: transparent; border-right:0 !important; box-shadow: 0px 0px 12px rgba(0, 0, 0, 0.29); border-radius: 4px;}

            .loginradius{border-radius: 4px;}
            .btn-user {background-color: #334FFF !important;}
            .btn-user:hover {background-color: #424242 !important;}
            .logowidth > span {font-size: 18px; font-weight: 500;}

        </style>
    </head>

    <body>
        <!-- Top content -->
        <div class="top-content">

            <div class="inner-bg">

                <div class="container">
                    <div class="row">
                        <?php
                        $empty_notice = 0;
                        $offset       = "";
                        $bgoffsetbg   = "bgoffsetbg";
                        $bgoffsetbgno = "";
                        if (empty($notice)) {
                            $empty_notice = 1;
                            $offset       = "col-md-offset-4";
                            $bgoffsetbg   = "";
                            $bgoffsetbgno = "bgoffsetbgno";
                        }
                        ?>
                        <div class="<?php echo $bgoffsetbg; ?>">

                            <div class="col-lg-4 col-md-4 col-sm-12 nopadding <?php echo $bgoffsetbgno; ?> <?php echo $offset; ?>">
                                <div class="loginbg loginradius login390">
                                    <div class="form-top">
                                        <div class="form-top-left logowidth">
                                            <span>CAPENDIK |</span> <img src="<?php echo base_url(); ?>uploads/school_content/admin_logo/logo-bilna.png" />
                                        </div>
                                    </div>
                                    <div class="form-bottom" style="text-align:center;">
                                        <h3 class="font-white" style="text-align:center;">Select Login Portal</h3>
                                        <div class="row" style="margin: 10px 0px;">
                                          <a href="/site/login" target="_blank">
                                            <button type="button" name="btn-admin" class="btn" style="width:100%;">Staff Login</button>
                                          </a>
                                        </div>
                                        <div class="row" style="margin: 10px 0px;">
                                          <a href="/site/userlogin" target="_blank">
                                            <button type="button" name="btn-user" class="btn btn-user" style="width:100%;">Parents / Students Login</button>
                                          </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mCustomScrollbar.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mousewheel.min.js"></script>
    </body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function () {
            $(this).removeClass('input-error');
        });
        $('.login-form').on('submit', function (e) {
            $(this).find('input[type="text"], input[type="password"], textarea').each(function () {
                if ($(this).val() == "") {
                    e.preventDefault();
                    $(this).addClass('input-error');
                } else {
                    $(this).removeClass('input-error');
                }
            });
        });
    });
</script>
<script type="text/javascript">
    function refreshCaptcha(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('site/refreshCaptcha'); ?>",
            data: {},
            success: function(captcha){
                $("#captcha_image").html(captcha);
            }
        });
    }
</script>
