	<?php
		$wids_total = $this->users->get_user_by_id($this->session->userdata('nisn'))->row_array()['wids'];
		$jumlah_pertanyaan	= $this->mpertanyaan->get_count_pertanyaan($this->session->userdata('id'))->row_array()['jumlah'];
		$jumlah_jawaban	= $this->mjawaban->get_count_jawaban($this->session->userdata('id'))->row_array()['jumlah'];

		$wids = count_wids($wids_total);
	?>

	<div class="box box-widget widget-user">
		<div class="widget-user-header bg-aqua-active">
			<h3 class="widget-user-username"><?= $this->session->userdata('nama'); ?></h3>
			<h5 class="widget-user-desc"><?= $wids ?></h5>
		</div>
		<div class="widget-user-image">
			<img class="img-circle" src="<?= base_url('assets/images/avatar/')."/".$this->session->userdata('avatar'); ?>"
			alt="User Avatar" style="width:90px; height:90px; ">
		</div>
		<div class="box-footer">
			<div class="row">
				<div class="col-sm-4 border-right">
					<a href="<?= base_url() ?>my_question">
						<div class="description-block">
							<h5 class="description-header"><?= $jumlah_pertanyaan ?></h5>
							<span class="description-text">PERTANYAAN</span>
						</div>
					</a>
				</div>
				<div class="col-sm-4 border-right">
					<a href="#">
						<div class="description-block">
							<h5 class="description-header"><?= $this->session->userdata('wids'); ?></h5>
							<span class="description-text">WIDS</span>
						</div>
					</a>
				</div>
				<div class="col-sm-4">
					<a href="<?= base_url() ?>my_answer" >
						<div class="description-block">
							<h5 class="description-header"><?= $jumlah_jawaban ?></h5>
							<span class="description-text">JAWABAN</span>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>