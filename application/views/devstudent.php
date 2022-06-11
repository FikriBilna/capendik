<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#424242" />
        <title></title>
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
          <h1><?php echo $judul; ?></h1>
          <div class="">
            <ul>
            <?php
              foreach ($listmurid as $murid) {
            ?>
              <li><?php echo $murid['firstname']; ?></li>
            <?php
              }
            ?>
          </ul>

          </div>
        </div>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mCustomScrollbar.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.mousewheel.min.js"></script>
    </body>
</html>
