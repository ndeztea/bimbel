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
                            <h1><strong>Lupa Password ?</strong></h1>
                            <div class="description">
                              <p>
                                Password anda berhasil di-<i>reset</i>, silakan <a href="<?php echo base_url() ?>">Login</a> dengan password baru anda untuk masuk ke laman BMBimbel.
                              </p>
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