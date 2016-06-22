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
		</div>
    <div class="col-md-8">
      <div class="box box-widget">
        <div class="box-header with-border">
          <div class="user-block">
            <img class="img-circle" src="<?php 
                                      if($pertanyaan['avatar_penanya'] == NULL):
                                        echo base_url()."assets/images/avatar/default.jpg";
                                      else:
                                        echo base_url()."assets/images/avatar/".$pertanyaan['avatar_penanya'];
                                      endif;?>"
            alt="user image">
            <span class="username"><a href="#"><?= $pertanyaan['nama_penanya'] ?> - <small><?= $wids_penanya ?></small></a></span>
            <span class="description"><?= get_tingkat($pertanyaan['tingkat']) ?> &middot; <?= $pertanyaan['nama_pelajaran'] ?> &middot; <?= $pertanyaan['wids_pertanyaan'] ?> Wids</span>
          </div>
        </div>
        <div class="box-body">
          <p><?= $pertanyaan['pertanyaan'] ?></p>
          <!-- <img class="img-responsive pad" src="../dist/img/photo2.png" alt="Photo"> -->
        </div>
        <div class="box-footer box-comments">
            <?php foreach ($jawaban_pertanyaan->result() as $r): ?>
              <div class="box-comment">
                <img class="img-circle img-sm" src="<?php 
                                                        if($r->avatar_penjawab == NULL):
                                                          echo base_url()."assets/images/avatar/default.jpg";
                                                        else:
                                                          echo base_url()."assets/images/avatar/".$r->avatar_penjawab;
                                                        endif;?>" alt="user image">
                <div class="comment-text">
                  <span class="username">
                  <?= $r->nama_penjawab ?> - <small><?= count_wids($r->wids_penjawab) ?></small>
                    <span class="text-muted pull-right">8:03 PM Today</span>
                  </span>
                  <?= $r->jawaban ?>
                  <br/>
                  <button class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                  <button class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-down"></i> Dislike</button>
                  <span class="pull-right text-muted"><?= $r->jml_like ?> likes - <?= $r->jml_dislike ?> Dislikes</span>
                  <br />
                  <button class="btn btn-danger btn-xs"><i class="fa fa-times-o"></i> Hapus</button>
                  <button class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> Edit</button>
                </div>
              </div>
            <?php endforeach; ?>
          
        </div>

        <?php if($this->session->userdata('id') != $pertanyaan['id_penanya']): ?>
          <div class="box-footer">
            <form action="#" method="post">
              <img class="img-responsive img-circle img-sm" 
              src="<?php 
                  if($this->session->userdata('avatar') == NULL):
                    echo base_url()."assets/images/avatar/default.jpg";
                  else:
                    echo base_url()."assets/images/avatar/".$this->session->userdata('avatar');
                  endif;?>" alt="alt text">
              <div class="img-push">
                <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
              </div>
            </form>
          </div>
        <?php endif; ?>
      </div>
  </div>
</section>	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->

<?php $this->load->view('template/foot'); ?>