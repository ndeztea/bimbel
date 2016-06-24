
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
					<div class="description-block">
						<h5 class="description-header">0</h5>
						<span class="description-text">PERTANYAAN</span>
					</div>
				</div>
				<div class="col-sm-4 border-right">
					<div class="description-block">
						<h5 class="description-header"><?= $this->session->userdata('wids'); ?></h5>
						<span class="description-text">WIDS</span>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="description-block">
						<h5 class="description-header">0</h5>
						<span class="description-text">JAWABAN</span>
					</div>
				</div>
			</div>
		</div>
	</div>