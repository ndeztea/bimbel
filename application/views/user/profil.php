<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->

<?php $this->load->view('template/header'); ?>

<section class="content">
	<div class="row">
		<div class="col-md-3">
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img id="imageProfile" class="profile-user-img img-responsive img-circle" alt="User profile picture" src="<?php
              							 if($this->session->userdata('avatar') == NULL):
                                            echo base_url()."assets/images/avatar/default.jpg";
                                         else:
                                            echo base_url()."assets/images/user/".$this->session->userdata('avatar');
                                         endif;?>"  
              style="width: 150px; height: 150px; margin: 10px auto;">
              <h3 class="profile-username text-center"><?= $this->session->userdata('nama'); ?></h3>
              <p class="text-muted text-center">Software Engineer</p>
              <hr />
              <form method="post" action="<?= base_url() ?>avatar" enctype="multipart/form-data">
              	<div class="form-group">
              		<label>Update foto profil</label>
              		<input id="imgProfile" type="file" name="avatar" class="form-control" accept="image/*">
              	</div>
              	<div class="clearfix"></div>
              	<button class="btn btn-primary btn-block">Upload !</button>
              </form>
            </div>
          </div>
        </div>
    </div>
</section>

	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->
<script type="text/javascript">
	 function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $('#imageProfile').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	  }

	  $("#imgProfile").change(function(){
	      readURL(this);
	  });
</script>
<?php $this->load->view('template/foot'); ?>