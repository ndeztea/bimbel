<?php 
	$pelajaran 	  		= $this->mpelajaran->getdata()->result();
?>
<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Ajukan Pertanyaan
					</h3>
				</div>
				<div class="box-body text-center">
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
					  Klik disini !!
					</button>
				</div>
			</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        <h4 class="modal-title" id="myModalLabel">Pertanyaan</h4>
					      </div>
					      <div class="modal-body">
					        <form method="post" action="<?= base_url() ?>add_pertanyaan" enctype="multipart/form-data">
			                    <textarea id="editor1" name="pertanyaan" rows="10" cols="80" placeholder="Tulis pertanyaanmu disini">
			                    </textarea><br>
			                    <div class="col-md-3">
			                    	<div class="form-group">
			                    		<label>Tingkatan : </label>
					                    <select name="tingkat" class="form-control">
					                    	<option>SD</option>
					                    	<option>SMP</option>
					                    	<option>SMA</option>
					                    	<option>SMK</option>
					                    </select>
			                    	</div>
			                    </div>
			                    <div class="col-md-4">
			                    	<div class="form-group">
			                    		 <label>Mata Pelajaran : </label>
						                 <select name="mata_pelajaran" class="form-control">
						                    <?php foreach ($pelajaran as $r): ?>
						                    	<option value="<?= $r->id ?>"><?= $r->pelajaran ?></option>
						                    <?php	endforeach; ?>
						                 </select>
			                    	</div>
			                    </div>
			                    <div class="col-md-4">
			                    	<div class="form-group">
			                    		<label>Tambah Gambar (1 MB) :</label>
			                    		<input type="file" name="gambar" class="form-control">
			                    	</div>
			                    </div>
			                    <div class="clearfix"></div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary">Publish</button>
					      </div>
					      </form>
					    </div>
					  </div>
					</div>