<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->

<?php $this->load->view('template/header'); ?>
<section class="content">
	<div class="row">
		<div class="col-md-8">
			<!-- List Pertanyaan -->
			<div class="box box-primary table-responsive">
	          	<div class="box-header with-border">
	          		<h2 class="box-title">Pertanyaan</h2><br><br>
				<?php
	                  foreach ($pertanyaan as $r):
			             echo $r->nama_penanya." &middot; ";
			         	 echo $r->nama_pelajaran." &middot; ";
			         	 echo $r->wids_penanya." &middot; ";
			         	 echo $r->tingkat;
			         	 echo $r->pertanyaan."<hr>";
	             ?>
	             <?php endforeach; ?>
	             </div>
	          </div>
		</div>
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Ajukan Pertanyaan
					</h3>
				</div>
				<div class="box-body">
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
					  Klik disini !!
					</button>

					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">Pertanyaan</h4>
					      </div>
					      <div class="modal-body">
					        <form method="post" action="<?= base_url() ?>add_pertanyaan">
			                    <textarea id="editor1" name="pertanyaan" rows="10" cols="80" placeholder="Tulis pertanyaanmu disini">
			                    </textarea><br>
			                    <label>Tingkatan : </label>
			                    <select name="tingkat">
			                    	<option>SD</option>
			                    	<option>SMP</option>
			                    	<option>SMK</option>
			                    </select>
			                    <br>
			                    <label>Mata Pelajaran : </label>
			                    <select name="mata_pelajaran">
			                    	<?php foreach ($pelajaran as $r): ?>
			                    		<option value="<?= $r->id ?>"><?= $r->pelajaran ?></option>
			                    	<?php	endforeach; ?>
			                    </select>
			                    <br>
			                    <label>Wids</label>
			                    <select name="wids">
			                    	<?php for ($i=10; $i <=99 ; $i++) : ?>
			                    		<option value="<?= $i ?>"><?= $i ?></option>
			                    	<?php endfor; ?> 
			                    </select>
			                    <small>(Anda memiliki <?= $this->session->userdata('wids')?> Wids)</small>
			                    <br>

			                    
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary">Publish</button>
					      </div>
					      </form>
					    </div>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');

      });
    </script>
<script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>

<?php $this->load->view('template/foot'); ?>