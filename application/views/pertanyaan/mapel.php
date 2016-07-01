<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->
<style type="text/css">
	.mata-pelajaran{
		width: 100% !important;
		height: auto !important;
		padding: 10px;
		font-size: 30px;
		background-color: #DDD;
		border-radius: 50%;
		-webkit-border-radius:50%;
		-moz-border-radius:50%; 
		margin: 20px 0;
	}
</style>
<?php $this->load->view('template/header'); ?>
<section class="content">
	<div class="row">
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
          <div class="col-md-12">
			<div class="box text-center">
				<div class="box-body">
					<a href="<?= base_url() ?>home">
						<div class="col-md-1">
							<div class="mata-pelajaran">
								<i class="fa fa-list"></i>
							</div>
							<br />
							Semua
						</div>
					</a>
					<?php foreach ($pelajaran->result() as $r): ?>
						<?php if ($r->is_active == "1"): ?>
							<a href="<?= base_url() ?>mapel/<?= $r->id ?>">
								<div class="col-md-1">
									<div class="mata-pelajaran">
										<i class="fa <?= $r->params ?>"></i>
									</div>
									<br />
									<?= $r->pelajaran?>
								</div>
							</a>
						<?php endif ?>
					<?php endforeach ?>
				</div>
				<div class="collapse" id="collapseExample">
					<?php foreach ($pelajaran_more->result() as $r): ?>
							<a href="<?= base_url() ?>mapel/<?= $r->id ?>">
								<div class="col-md-1">
										<div class="mata-pelajaran">
											<i class="fa <?= $r->params ?>"></i>
										</div>
										<br />
										<?= $r->pelajaran?>
								</div>
							</a>
					<?php endforeach ?>
				</div>
				<div class="clearfix"></div>
				<div class="box-footer">
					<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
					Tampilkan Semua
					</button>
				</div>
			</div>
        </div>
        <div class="clearfix"></div>
        <br />
		<div class="col-md-8">

			<!-- List Pertanyaan -->
			<div class="box box-primary table-responsive">
				<div class="box-header with-border">
					<h2 class="box-title">Pertanyaan - <?php echo $pelajaran_detail['pelajaran']?></h2>
				</div>
				<?php if ($pertanyaan->num_rows() < 1): ?>
	            	<p class="alert alert-danger" >Belum ada pertanyaan untuk mata pelajaran ini</p>
	            <?php else: ?>
					
						
						<div class="box-body box-comments">
							<?php foreach ($pertanyaan->result() as $r): ?>
							<div class="box-comment">
								<img class="img-circle img-sm" src="
								<?php echo base_url('assets/images/avatar')."/".$r->avatar_penanya; ?>">
								<div class="comment-text">
									<span class="username">
										<?php echo $r->nama_pelajaran ?>&middot;
										<?php echo get_tingkat($r->tingkat) ?>
									</span>
									<a href="<?php echo base_url() ?>detail_pertanyaan/<?php echo $r->id_pertanyaan ?>"><?php echo $r->pertanyaan ?></a>
									<button class="btn btn-success btn-xs pull-right" onclick=location.href="<?php echo base_url() ?>detail_pertanyaan/<?php echo $r->id_pertanyaan ?>"><i class="fa fa-share"></i> Jawab</button>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
						<input type="hidden" name="offset" value="5" id="offset">
						<button class="btn btn-block btn-info" id="loadmore"> Load More...
						</button>
					
	            <?php endif ?>
	        </div>
		</div>
		<div class="col-md-4">
			<?php $this->load->view('template/profil_widget');?>
			<?php $this->load->view('template/ajukan_pertanyaan'); ?>
		</div>
	</div>
</section>




<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->
<script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
<script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');

      });
    </script>
<script type="text/javascript">
$(document).on('click','#loadmore',function () {
  $(this).text('Loading...');
  		var offset = $("#offset").val();
  		var id = "<?php echo $this->uri->rsegment(3) ?>"
        $.ajax({
		      url: "<?php echo base_url() ?>loadmore_mapel",
		      type: 'POST',
		      data: {offset: offset,
		      		 id : id},
		      success: function(response){
		          if(response){
		          	if(response == "Tidak ada data lagi"){
			            $("#loadmore").text('Tidak ada data lagi');
		          	}
		          	else{
		          		 $(".box-comments").append(response);
			             $("#loadmore").text('Load More...');
			             $("#offset").val(parseInt(offset)+5);
		          	}
		          }
	      	  }
   		});
});
</script>
<?php $this->load->view('template/foot'); ?>