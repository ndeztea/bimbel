<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->

<?php $this->load->view('template/header'); ?>
<section class="content">
	<div class="row">
		<div class="col-md-8">
			<!-- List Pertanyaan -->
			<div class="box box-primary table-responsive">
	          	<div class="box-header with-border">
	          		<h2 class="box-title">Pertanyaan</h2>
	            </div>
	            <div class="box-body box-comments">
	            	<?php foreach ($pertanyaan->result() as $r): ?>
	            		<div class="box-comment"> 
	            			<img class="img-circle img-sm" src="
	            			<?php
                                      if($r->avatar_penanya == NULL):
                                        echo base_url()."assets/images/avatar/default.jpg";
                                      else:
                                        echo base_url()."assets/images/avatar/".$r->avatar_penanya;
                                      endif;?>
	            			" alt="user image">
	            			<div class="comment-text">
	            				<span class="username">
	            					<?= $r->nama_pelajaran ?>&middot;
					         	 	<?= $r->wids_pertanyaan ?> Wids &middot;
					         	 	<?= $r->tingkat ?>
	            				</span>
	            				<?= $r->pertanyaan ?>
	            			</div> 
					    </div>
			        <?php endforeach; ?>
	            </div>	
	          </div>
		</div>
		<div class="col-md-4">
			<div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                  <h3 class="widget-user-username"><?= $this->session->userdata('nama'); ?></h3>
                  <h5 class="widget-user-desc"><?= $wids ?></h5>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle" src="<?php
                                      if($this->session->userdata('avatar') == NULL):
                                        echo base_url()."assets/images/avatar/default.jpg";
                                      else:
                                        echo base_url()."assets/images/avatar/".$this->session->userdata('avatar');
                                      endif;?>" 
                   alt="User Avatar" style="width:90px; height:90px; ">
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">0</h5>
                        <span class="description-text">PERTANYAAN</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">0</h5>
                        <span class="description-text">WIDS</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">0</h5>
                        <span class="description-text">JAWABAN</span>
                      </div><!-- /.description-block -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div>
              </div>
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Ajukan Pertanyaan
					</h3>
				</div>
				<div class="box-body text-center">
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