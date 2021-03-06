<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->

<?php $this->load->view('template/header'); ?>

<section class="content">
	<div class="row">
    <div class="col-xs-12">
              <?php
              if($this->session->flashdata('msg_error') != NULL){
              echo '<div class="alert alert-danger" role="alert" style="padding: 6px 12px;height:34px;">';
              echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg_error')."</span></strong>";
              echo '</div>';
              }?>
              <?php
              if($this->session->flashdata('msg_success') != NULL){
              echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
              echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg_success')."</span></strong>";
              echo '</div>';
              }?>

              <?php echo validation_errors() ?>
    </div>

		<div class="col-md-8">
          <div class="box box-primary table-responsive">
            <div class="box-body box-profile">
              <div class="col-md-3">
                <img id="imageProfile" class="profile-user-img img-responsive img-circle" alt="User profile picture" src="<?php echo thumb_avatar($users['avatar'], $users['gender'])?>"
                style="width: 150px; height: 150px; margin: 10px auto;">
                <form method="post" action="<?php echo base_url() ?>avatar_update/<?php echo $users['nisn'] ?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Update foto profil</label>
                    <input id="imgProfile" type="file" name="avatar" class="form-control" accept="image/*">
                  </div>
                  <div class="clearfix"></div>
                  <button class="btn btn-primary btn-block">Upload !</button>
                </form>
              </div>
              <div class="col-md-9">
                <form method="post" action="<?php echo base_url() ?>edit_user/<?php echo $this->uri->rsegment(3) ?>">
                  <table class="table">
                    <tr>
                      <td style="border-top: 0px solid #f4f4f4;">Nama Lengkap</td>
                      <td style="border-top: 0px solid #f4f4f4;">:</td>
                      <td style="border-top: 0px solid #f4f4f4;">
                        <input type="text" name="nama" value="<?php echo $users['nama'] ?>" class="form-control">
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #f4f4f4;">NISN</td>
                      <td style="border-top: 0px solid #f4f4f4;">:</td>
                      <td style="border-top: 0px solid #f4f4f4;">
                        <input type="text" value="<?php echo $users['nisn'] ?>" class="form-control" disabled>
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #f4f4f4;">Jenis Kelamin</td>
                      <td style="border-top: 0px solid #f4f4f4;">:</td>
                      <td style="border-top: 0px solid #f4f4f4;"> 
                        <input type="radio" name="jkel" value="l" <?php echo set_radio('jkel', 'l', TRUE); ?>
                        <?php if($users['gender'] == 'l'):
                                echo "selected";
                              endif;
                        ?>>
                        Laki - laki
                        <input type="radio" name="jkel" value="p" <?php echo set_radio('jkel', 'p') ?> 
                        <?php if($users['gender'] == 'p'):
                              echo "selected";
                              endif;
                        ?>>
                        Perempuan
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #f4f4f4;">Tingkat Pendidikan </td>
                      <td style="border-top: 0px solid #f4f4f4;">:</td>
                      <td style="border-top: 0px solid #f4f4f4;">
                          <select name="pendidikan" class="form-control" id="pendidikan" onchange="changePendidikan(this)">
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="SD" 
                            <?php if($users['tingkat_sekolah'] == 'SD'):
                              echo "selected";
                              endif;
                            ?>>SD / Sederajat</option>
                            <option value="SMP" 
                            <?php if($users['tingkat_sekolah'] == 'SMP'):
                              echo "selected";
                              endif;
                            ?>>SMP / Sederajat</option>
                            <option value="SMA" 
                            <?php if($users['tingkat_sekolah'] == 'SMA'):
                              echo "selected";
                              endif;
                            ?>>SMA / Sederajat</option>
                            <option value="SMK" 
                            <?php if($users['tingkat_sekolah'] == 'SMK'):
                              echo "selected";
                              endif;
                            ?>>SMK / Sederajat</option>
                          </select>
                    </tr>
                   
                    <tr>
                      <td style="border-top: 0px solid #f4f4f4;">Kelas </td>
                      <td style="border-top: 0px solid #f4f4f4;">:</td>
                      <td style="border-top: 0px solid #f4f4f4;">
                           <select name="kelas" class="form-control" id="kelas">
                              <option value="<?php echo $users['kelas'] ?>" <?php echo set_select('kelas', '', true) ?>><?php echo $users['kelas'] ?></option>
                           </select>
                    <tr>
                      <td style="border-top: 0px solid #f4f4f4;">Sekolah 
                      <td style="border-top: 0px solid #f4f4f4;">:</td>
                      <td style="border-top: 0px solid #f4f4f4;">
                        <input type="text" name="sekolah" value="<?php echo $users['nama_sekolah'] ?>" class="form-control">
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #f4f4f4;">HP</td>
                      <td style="border-top: 0px solid #f4f4f4;">:</td>
                      <td style="border-top: 0px solid #f4f4f4;">
                        <input type="number" name="no_hp" value="<?php echo $users['hp'] ?>" class="form-control">
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #f4f4f4;">Email</td>
                      <td style="border-top: 0px solid #f4f4f4;">:</td>
                      <td style="border-top: 0px solid #f4f4f4;">
                        <input type="email" name="email" value="<?php echo $users['email'] ?>" class="form-control">
                      </td>
                    </tr>
                    <tr>
                      <td style="border-top: 0px solid #f4f4f4;">No Rekening</td>
                      <td style="border-top: 0px solid #f4f4f4;">:</td>
                      <td style="border-top: 0px solid #f4f4f4;">
                        <input type="number" name="no_rek" value="<?php echo $users['rekening_bank'] ?>" class="form-control">
                      </td>
                    </tr>
                  </table>
              </div>
            </div>
            <div class="box-footer">
              <button class="btn btn-info pull-right" type="submit">Ubah Data</button>
              <button class="btn btn-success" onclick=self.history.back()>Kembali</button>

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
<?php $this->load->view('template/foot'); ?>