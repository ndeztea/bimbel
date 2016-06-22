<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= TITLE ?></title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?= base_url() ?>assets/login/form-1/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/login/form-1/assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/login/form-1/assets/css/form-elements.css">
        <link rel="stylesheet" href="<?= base_url() ?>assets/login/form-1/assets/css/style.css">

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

		<!-- Top menu -->
		<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">Bootstrap Registration Form Template</a>
				</div>
				<!-- <div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<span class="li-text">
								Put some text or
							</span> 
							<a href="#"><strong>links</strong></a> 
							<span class="li-text">
								here, or some icons: 
							</span> 
							<span class="li-social">
								<a href="#"><i class="fa fa-facebook"></i></a> 
								<a href="#"><i class="fa fa-twitter"></i></a> 
								<a href="#"><i class="fa fa-envelope"></i></a> 
								<a href="#"><i class="fa fa-skype"></i></a>
							</span>
						</li>
					</ul>
				</div> -->
                <form method="post" action="<?= base_url() ?>login" class="navbar-form navbar-right" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="NISN / Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-default">Masuk !</button>
                </form>
			</div>
		</nav>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-5 text">
                            <h1><strong>Bootstrap</strong> Registration Form</h1>
                            <div class="description">
                            	<p>
	                            	This is a free responsive registration form made with Bootstrap. 
	                            	Download it on <a href="http://azmind.com"><strong>AZMIND</strong></a>, customize and use it as you like!
                            	</p>
                            </div>
                            <div class="top-big-link">
                            	<a class="btn btn-link-1" href="#">Button 1</a>
                            	<a class="btn btn-link-2" href="#">Button 2</a>
                            </div>
                        </div>
                        <div class="col-sm-7 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                                    <?php if($this->session->flashdata('msg') != NULL): ?>
                                        <div class="alert alert-info">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <?= $this->session->flashdata('msg'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($this->session->flashdata('msg_error') != NULL): ?>
                                        <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <?= $this->session->flashdata('msg_error'); ?>
                                        </div>
                                    <?php endif; ?>
                        			<h3>Daftar Sekarang</h3>
                                    <?= validation_errors() ?>
                            		<!-- <p>Fill in the form below to get instant access:</p> -->
                        		</div>
                        		<!-- <div class="form-top-right">
                        			<i class="fa fa-pencil"></i>
                        		</div> -->
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="<?= base_url() ?>register" method="post" class="registration-form">
                                    <div class="col-md-12">
    			                    	<div class="form-group">
    			                    		<label class="sr-only" for="form-first-name">Nama Lengkap</label>
    			                        	<input type="text" name="nama_lengkap" placeholder="Nama Lengkap" class="form-control" value="<?= set_value('nama_lengkap') ?>">
    			                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
    			                        <div class="form-group">
    			                        	<label class="sr-only" for="form-jkel">Jenis Kelamin</label>
    			                        	<div class="form-inline">
                                                <div class="radio">
                                                    <label>
                                                    <input type="radio" name="jkel" value="l" <?= set_radio('jkel', 'l', TRUE); ?>>
                                                    Laki - laki
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                    <input type="radio" name="jkel" value="p" <?= set_radio('jkel', 'p') ?> >
                                                    Perempuan
                                                    </label>
                                                </div>
                                            </div>
    			                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
    			                        <div class="form-group">
    			                        	<label class="sr-only" for="form-nisn">NISN</label>
    			                        	<input type="text" name="NISN" placeholder="NISN" class="form-control" value="<?= set_value('NISN') ?>">
    			                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-password">Password</label>
                                            <input type="password" name="password" placeholder="Password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-confirm-password">Password</label>
                                            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-pendidikan">Tingkatan Sekolah</label>
                                            <select name="pendidikan" class="form-control" id="pendidikan" onchange="changePendidikan(this)">
                                                <option value="">-- Pilih Pendidikan--</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="SMA">SMK</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-kelas">Kelas</label>
                                            <select name="kelas" class="form-control" id="kelas">
                                                <option value="" <?= set_select('kelas', '', true) ?>>-- Pilih Kelas--</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-no-hp">No HP</label>
                                            <input type="text" name="no_hp" class="form-control" placeholder="Nomor HP" value="<?= set_value('no_hp') ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-email">Email</label>
                                            <input type="text" name="email" class="form-control" placeholder="E-Mail" value="<?= set_value('email') ?>">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-rekening">No Rekening</label>
                                            <input type="text" name="no_rek" class="form-control" placeholder="Nomor Rekening" value="<?= set_value('no_rek') ?>">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
			                             <button type="submit" class="btn">Daftar !!</button>
                                    </div>
                                    <div class="clearfix"></div>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="<?= base_url() ?>assets/login/form-1/assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?= base_url() ?>assets/login/form-1/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>assets/login/form-1/assets/js/jquery.backstretch.min.js"></script>
        <script src="<?= base_url() ?>assets/login/form-1/assets/js/retina-1.1.0.min.js"></script>
        <script src="<?= base_url() ?>assets/jquery-validation/dist/jquery.validate.min.js"></script>
        <!-- <script src="<?= base_url() ?>/assets/login/form-1/assets/js/scripts.js"></script> -->
        <script>

            jQuery(document).ready(function() {

                /*
                    Fullscreen background
                */
                $.backstretch("<?= base_url()?>assets/login/form-1/assets/img/backgrounds/1.jpg");
                
                /*
                    Form validation
                */
                $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function() {
                    $(this).removeClass('input-error');
                });
                
                $('.login-form').on('submit', function(e) {
                    
                    $(this).find('input[type="text"], input[type="password"], textarea').each(function(){
                        if( $(this).val() == "" ) {
                            e.preventDefault();
                            $(this).addClass('input-error');
                        }
                        else {
                            $(this).removeClass('input-error');
                        }
                    });
                    
                });
                
                
            });
        </script>
        <script type="text/javascript">
        //<![CDATA[ 
         var pendidikan = new Array(4) 
         pendidikan[""] = ["-- Pilih Kelas --"]; 
         pendidikan["SD"] = ["1", "2", "3", "4", "5", "6"]; 
         pendidikan["SMP"] = ["7", "8", "9"]; 
         pendidikan["SMA"] = ["10", "11", "12"]; 
         pendidikan["SMK"] = ["10", "11", "12"]; 
         
         function changePendidikan(selectObj) { 
             var idx = selectObj.selectedIndex; 
             var which = selectObj.options[idx].value; 
             pList = pendidikan[which];

             var pSelect = document.getElementById("kelas"); 
             var len = pSelect.options.length; 

             while (pSelect.options.length > 0) 
             { 
                pSelect.remove(0); 
             } 



            var newOption; 
            for (var i=0; i<pList.length; i++) { 
                newOption = document.createElement("option"); 
                newOption.value = pList[i];
                newOption.text  = pList[i]; 
                     try { 
                        pSelect.add(newOption); 
                     } 
                     catch (e) { 
                        pSelect.appendChild(newOption); 
                     } 
                 } 
             } 
            //]]>
            </script>

            <script type="text/javascript">
                (function($,W,D)
                    {
                        var JQUERY4U = {};
                        JQUERY4U.UTIL =
                        {
                            setupFormValidation: function()
                            {
                                //form validation rules
                                $(".registration-form").validate({
                                    rules: {
                                        nama_lengkap: "required",
                                        NISN: {
                                            required:true,
                                            number:true
                                        },
                                        jkel: "required",
                                        password: {
                                            required: true,
                                            minlength: 5
                                        },
                                        confirm_password: {
                                            required: true,
                                            minlength: 5
                                        },
                                        pendidikan: "required",
                                        kelas: "required",
                                        no_hp:{
                                            required:true,
                                            number:true,
                                            minlength: 10
                                        },
                                        email: {
                                            required: true,
                                            email: true
                                        },
                                        no_rek: {
                                            required: false,
                                            number: true
                                        },
                                    },
                                    messages: {
                                        nama_lengkap: "Masukkan Nama Lengkap Anda",
                                        jkel: "Masukkan Jenis Kelamin Anda",
                                        NISN: {
                                            required:"Masukkan NISN Anda",
                                            number:"NISN hanya boleh diisi dengan angka"
                                        },
                                        password: {
                                            required: "Masukkan password",
                                            minlength: "Password minimal 5 karakter"
                                        },
                                        confirm_password: {
                                            required: "Masukkan Konfirmasi Password",
                                            minlength: "Konfirmasi Password minimal 5 karakter"
                                        },
                                        pendidikan:{
                                            required:"Pilih tingkatan pendidikan sesuai dengan tingkatan pendidikan anda"
                                        },
                                        kelas:{
                                            required:"Pilih kelas sesuai dengan tingkatan pendidikan anda"
                                        },
                                        no_hp: {
                                            required:"Masukkan Nomor HP Anda",
                                            number:"Nomor HP hanya boleh diisi dengan angka"},
                                            minlength: "Nomor HP minimal 12 karakter diawali dengan 0"


                                        email: "Masukkan email yang valid",
                                    },
                                    submitHandler: function(form) {
                                        form.submit();
                                    },
                                    errorContainer : "#errors",
                                });
                            }
                        }
                        var errMsgTmpl = '<small style="color:red; font-size:smaller; font-weight:"><label   for="{{LABEL-FOR}}">{{ERROR-MSG}}</label></small>';

                        $.validator.setDefaults({            
                            errorElement: "section", 
                            showErrors: function (errorMap, errorList) {
                                var i, elements;
                                for (i = 0; errorList[i]; i++) {
                                    errorList[i].message = errMsgTmpl
                                    .replace(/{{ERROR-MSG}}/, errorList[i].message)
                                    .replace(/{{LABEL-FOR}}/, $(errorList[i].element).attr('id'));
                                }
                                this.defaultShowErrors();
                            }
                        });
                        //when the dom has loaded setup form validation rules
                        $(D).ready(function($) {
                            JQUERY4U.UTIL.setupFormValidation();
                        });
                    })(jQuery, window, document);
            </script>
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>