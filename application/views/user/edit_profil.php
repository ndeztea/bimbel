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
                <img id="imageProfile" class="profile-user-img img-responsive img-circle" alt="User profile picture" src="<?php echo thumb_avatar($this->session->userdata('avatar'),$this->session->userdata('gender'))?>"
                style="width: 150px; height: 150px; margin: 10px auto;">
                <form method="post" action="<?php echo base_url() ?>avatar" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Update foto profil</label>
                    <input id="imgProfile" type="file" name="avatar" class="form-control" accept="image/*">
                  </div>
                  <div class="clearfix"></div>
                  <button class="btn btn-primary btn-block">Upload !</button>
                </form>

                <br>
                <div class="form-group">
                  <label>Kode Daftar</label>
                  <input type="text" class="form-control" id="kode_daftar" style="text-align:center" readonly="true" value="<?php echo $users['kode_daftar']?>"/>
                  <button class="btn btn-primary btn-block" id="btn_kode_daftar" onclick="update_kode_daftar()">Update</button>
                  <i>Bagikan kode ini kepada calon anggota baru</i>
                </div>
                
              </div>
              <div class="col-md-9">
                <form method="post" action="<?php echo base_url() ?>update_profil">
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
                                echo "checked";
                              endif;
                        ?>>
                        Laki - laki
                        <input type="radio" name="jkel" value="p" <?php echo set_radio('jkel', 'p') ?> 
                        <?php if($users['gender'] == 'p'):
                              echo "checked";
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
                            ?>>SD</option>
                            <option value="SMP" 
                            <?php if($users['tingkat_sekolah'] == 'SMP'):
                              echo "selected";
                              endif;
                            ?>>SMP</option>
                            <option value="SMA" 
                            <?php if($users['tingkat_sekolah'] == 'SMA'):
                              echo "selected";
                              endif;
                            ?>>SMA</option>
                            <option value="SMK"
                            <?php if($users['tingkat_sekolah'] == 'SMK'):
                              echo "selected";
                              endif;
                            ?>>SMK</option>
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
                     <tr>
                      <td style="border-top: 0px solid #f4f4f4;" colspan="2">Masukkan password anda untuk merubah data</td>
                      <td style="border-top: 0px solid #f4f4f4;">
                        <input type="password" name="password" class="form-control">
                      </td>
                    </tr>
                  </table>
              </div>
            </div>
            <div class="box-footer">
              <button class="btn btn-info pull-right" type="submit">Ubah Data</button>
              <button class="btn btn-primary pull-right" onclick=self.history.back()><i class="fa fa-arrow-left"></i> Kembali</button>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <?php $this->load->view('template/profil_widget'); ?>
          <?php $this->load->view('template/ajukan_pertanyaan'); ?>
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
        function update_kode_daftar(){
          $('#btn_kode_daftar').val('loading...');
         $.get( "<?php echo site_url('User/update_kode_daftar')?>", function( data ) {
            $('#btn_kode_daftar').val('Update');
            if(data==false){
              alert('Update kode daftar gagal');
            }else{
              alert('Update kode daftar berhasil');
              $('#kode_daftar').val(data);
            }
          });
        }
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
                $(document).ready(function(){
                 var defaultData = $("#pendidikan").val();
                 var kelas = document.getElementById("kelas");
                 var pendidikan = document.getElementById("pendidikan");
                 var optionDefault;

                 while (kelas.options.length > 0) 
                 { 
                    kelas.remove(0); 
                 } 

                 if(defaultData == "SD"){
                    for (var i=1; i <= 6; i++) {
                        optionDefault = document.createElement("option");
                        optionDefault.value = i;
                        optionDefault.text = i;
                        try{
                            kelas.add(optionDefault);
                        }
                        catch (e){
                            kelas.appendChild(optionDefault);
                        }

                    }
                 }
                 else if(defaultData == "SMP"){
                    for (var i=7; i <= 9; i++) {
                        optionDefault = document.createElement("option");
                        optionDefault.value = i;
                        optionDefault.text = i;
                        try{
                            kelas.add(optionDefault);
                        }
                        catch (e){
                            kelas.appendChild(optionDefault);
                        }

                    }
                 }
                 else if(defaultData == "SMA"){
                    for (var i=10; i <= 12; i++) {
                        optionDefault = document.createElement("option");
                        optionDefault.value = i;
                        optionDefault.text = i;
                        try{
                            kelas.add(optionDefault);
                        }
                        catch (e){
                            kelas.appendChild(optionDefault);
                        }

                    }
                 }
                 else if(defaultData == "SMK"){
                    for (var i=10; i <= 12; i++) {
                        optionDefault = document.createElement("option");
                        optionDefault.value = i;
                        optionDefault.text = i;
                        try{
                            kelas.add(optionDefault);
                        }
                        catch (e){
                            kelas.appendChild(optionDefault);
                        }

                    }
                 }
                 else{
                        optionDefault = document.createElement("option");
                        optionDefault.value = "";
                        optionDefault.text = "-- Pilih Kelas--";

                    }

                });


            </script>

<?php $this->load->view('template/foot'); ?>