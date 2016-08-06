<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo TITLE ?></title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/login/form-1/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/login/form-1/assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/login/form-1/assets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/login/form-1/assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>


        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-5 text">
                            <?php echo validation_errors() ?>
                            <h1><strong>Reset Password</strong></h1>
                            <div class="description">
                            </div>
                            <div class="top-big-link">
                                <img style="width: 50px; height: 50px; display: none; margin: 20px auto;" id="loading" src="<?= base_url() ?>assets/loading.gif" class="img-responsive">
                                <form method="post" action="<?php echo base_url() ?>reset_password/<?php echo $this->uri->rsegment(3)" id="form-forgot">
                                <div class="form-group">
                                    <label>Password Baru </label>
                                    <input type="password" name="password" class="form-control">
                                    <br />
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password Baru </label>
                                    <input type="password" name="conf_password" class="form-control">
                                    <br />
                                </div>
                                <button class="btn btn-link-2" type="submit" href="#">Submit</a>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="<?php echo base_url() ?>assets/login/form-1/assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url() ?>assets/login/form-1/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/login/form-1/assets/js/jquery.backstretch.min.js"></script>
        <script src="<?php echo base_url() ?>assets/login/form-1/assets/js/retina-1.1.0.min.js"></script>
        <script src="<?php echo base_url() ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
        <!-- <script src="<?php echo base_url() ?>/assets/login/form-1/assets/js/scripts.js"></script> -->
        <script type="text/javascript">
          $('#form_forgot').submit(function(){
          $('#loading').css('display', 'block');
          $('#form_forgot').css('display', 'none'); //<----here
          return true;
        });
    </script>
        <script>

            jQuery(document).ready(function() {

                /*
                    Fullscreen background
                */
                $.backstretch("<?php echo base_url()?>assets/login/form-1/assets/img/backgrounds/1.jpg");
                
                /*
                    Form validation
                */
                
            });
        </script>
        

            
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>