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

		<!-- Custom Content Here -->
              <div class="col-md-8">
                     <div class="box box-widget">
                       <?php foreach ($detail_pertanyaan->result() as $r): ?>
                       <div class="box-header with-border">
                         <div class="user-block">
                           <img class="img-circle img-sm" src="
                                          <?php
                                             if($r->avatar_penanya == NULL):
                                               echo base_url()."assets/images/avatar/default.jpg";
                                             else:
                                               echo base_url()."assets/images/avatar/".$r->avatar_penanya;
                                             endif;?>
                                          " alt="user image">
                           <span class="username"><a href="#"><?= $r->nama_penanya ?></a></span>
                         </div><!-- /.user-block -->
                         <div class="box-tools">
                           <button class="btn btn-box-tool" data-toggle="tooltip" title="" data-original-title="Mark as read"><i class="fa fa-circle-o"></i></button>
                           <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                           <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                         </div><!-- /.box-tools -->
                       </div><!-- /.box-header -->
                       <div class="box-body">
                         <!-- post text -->
                        <?= $r->wids_pertanyaan?>
                       </div><!-- /.box-body -->
                       <div class="box-footer box-comments">
                         <div class="box-comment">
                           <!-- User image -->
                           <img class="img-circle img-sm" src="../dist/img/user3-128x128.jpg" alt="user image">
                           <div class="comment-text">
                             <span class="username">
                               Maria Gonzales
                               <span class="text-muted pull-right">8:03 PM Today</span>
                             </span><!-- /.username -->
                             It is a long established fact that a reader will be distracted
                             by the readable content of a page when looking at its layout.
                           </div><!-- /.comment-text -->
                         </div><!-- /.box-comment -->
                         <div class="box-comment">
                           <!-- User image -->
                           <img class="img-circle img-sm" src="../dist/img/user5-128x128.jpg" alt="user image">
                           <div class="comment-text">
                             <span class="username">
                               Nora Havisham
                               <span class="text-muted pull-right">8:03 PM Today</span>
                             </span><!-- /.username -->
                             The point of using Lorem Ipsum is that it has a more-or-less
                             normal distribution of letters, as opposed to using
                             'Content here, content here', making it look like readable English.
                           </div><!-- /.comment-text -->
                         </div><!-- /.box-comment -->
                       </div><!-- /.box-footer -->
                       <div class="box-footer">
                         <form action="#" method="post">
                           <img class="img-responsive img-circle img-sm" src="../dist/img/user4-128x128.jpg" alt="alt text">
                           <!-- .img-push is used to add margin to elements next to floating images -->
                           <div class="img-push">
                             <input type="text" class="form-control input-sm" placeholder="Press enter to post comment">
                           </div>
                         </form>
                       </div><!-- /.box-footer -->
                      <?php endforeach; ?>
                     </div>
              </div>
</section>	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->

<?php $this->load->view('template/foot'); ?>