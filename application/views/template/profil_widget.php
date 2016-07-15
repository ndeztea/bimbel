	<?php
		$wids_total = $this->Users->get_user_by_id($this->session->userdata('nisn'))->row_array()['wids'];
		$jumlah_pertanyaan	= $this->Mpertanyaan->get_count_pertanyaan($this->session->userdata('id'))->row_array()['jumlah'];
		$jumlah_jawaban	= $this->Mjawaban->get_count_jawaban($this->session->userdata('id'))->row_array()['jumlah'];

		$wids = count_wids($wids_total);
	?>

	<div class="box box-widget widget-user">
		<div class="widget-user-header bg-aqua-active">
			<h3 class="widget-user-username"><?php echo $this->session->userdata('nama'); ?></h3>
			<h5 class="widget-user-desc"><?php echo $wids ?></h5>
		</div>
		<div class="widget-user-image">
			<img class="img-circle" src="<?php echo thumb_avatar($this->session->userdata('avatar'),$this->session->userdata('gender'))?>"
			alt="User Avatar" style="width:90px; height:90px; ">
		</div>
		<div class="box-footer">
			<div class="row">
				<div class="col-sm-4 border-right">
					<a href="<?php echo base_url() ?>my_question">
						<div class="description-block">
							<h5 class="description-header"><?php echo $jumlah_pertanyaan ?></h5>
							<span class="description-text">PERTANYAAN</span>
						</div>
					</a>
				</div>
				<div class="col-sm-4 border-right">
					<a href="#">
						<div class="description-block">
							<h5 class="description-header"><?php echo $wids_total; ?></h5>
							<span class="description-text">WIDS</span>
						</div>
					</a>
				</div>
				<div class="col-sm-4">
					<a href="<?php echo base_url() ?>my_answer" >
						<div class="description-block">
							<h5 class="description-header"><?php echo $jumlah_jawaban ?></h5>
							<span class="description-text">JAWABAN</span>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>