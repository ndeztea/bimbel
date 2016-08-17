<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->

<?php $this->load->view('template/header'); ?>

	
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<?php echo validation_errors() ?>
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
		</div>
		<div class="col-md-12">
		<div class="box">
			<form role="form" action="<?php echo base_url() ?>add_user" method="post" class="registration-form">
			<div class="box-header box_primary with-border">
				<h3 class="box-title">Tambah User Baru</h3>
			</div>
			<div class="box-body">
                    <div class="col-md-12">
                    	<div class="form-group">
                    		<label  for="form-first-name">Nama Lengkap *</label>
                        	<input type="text" name="nama_lengkap" placeholder="Nama Lengkap *" class="form-control" value="<?php echo set_value('nama_lengkap') ?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <div class="form-group">
                        	<label  for="form-jkel">Jenis Kelamin *</label>
                        	<div class="form-inline">
                                <div class="radio">
                                    <label>
                                    <input type="radio" name="jkel" value="l" <?php echo set_radio('jkel', 'l', TRUE); ?>>
                                    Laki - laki
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                    <input type="radio" name="jkel" value="p" <?php echo set_radio('jkel', 'p') ?> >
                                    Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <div class="form-group">
                        	<label  for="form-nisn">NISN *</label>
                        	<input type="text" name="NISN" placeholder="NISN *" class="form-control" value="<?php echo set_value('NISN') ?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label  for="form-password">Password *</label>
                            <input type="password" name="password" placeholder="Password *" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label  for="form-confirm-password">Konfirmasi Password *</label>
                            <input type="password" name="confirm_password" placeholder="Konfirmasi Password *" class="form-control">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form-pendidikan">Tingkatan Sekolah *</label>
                            <select name="pendidikan" class="form-control" id="pendidikan" onchange="changePendidikan(this)">
                                <option value="" <?php echo set_select('pendidikan', '', TRUE); ?>>-- Pilih Pendidikan--</option>
                                <option value="SD" <?php echo set_select('pendidikan', 'SD'); ?>>SD</option>
                                <option value="SMP" <?php echo set_select('pendidikan', 'SMP'); ?>>SMP</option>
                                <option value="SMA" <?php echo set_select('pendidikan', 'SMA'); ?>>SMA</option>
                                <option value="SMK" <?php echo set_select('pendidikan', 'SMK'); ?>>SMK</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label  for="form-kelas">Kelas *</label>
                            <select name="kelas" class="form-control" id="kelas">
                                <option value="">-- Pilih Kelas--</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label  for="form-no-hp">No HP *</label>
                            <input type="text" name="no_hp" class="form-control" placeholder="Nomor HP *" value="<?php echo set_value('no_hp') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label  for="form-email">Email *</label>
                            <input type="text" name="email" class="form-control" placeholder="E-Mail *" value="<?php echo set_value('email') ?>">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label  for="form-rekening">No Rekening</label>
                            <input type="text" name="no_rek" class="form-control" placeholder="Nomor Rekening" value="<?php echo set_value('no_rek') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label  for="form-rekening">Level</label>
                            <select name="level" class="form-control">
                              <option value="1">SuperAdmin</option>
                              <option value="2">Administrator</option>
                              <option value="3">Reseller</option>
                              <option value="4" selected="">Member</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                    
                    <div class="col-md-12">
                        <p>*) wajib di isi</p>
                         <button type="submit" class="btn">Daftar !!</button>

                    </div>
                    <div class="clearfix"></div>

                </form>
			</div>
		</div>

	</div>
</section>	


<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->
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