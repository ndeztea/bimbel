<?php $this->load->view('template/top'); ?>
<!-- Custom CSS -->
<style type="text/css">
  .fileInput{
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
    }
</style>

<script src="<?php echo base_url() ?>assets/select2-4.0.2/vendor/jQuery-2.1.0.js"></script>

<?php $this->load->view('template/header'); ?>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<?php
              if($this->session->flashdata('msg_error') != NULL){
              echo '<div class="alert alert-danger" role="alert" style="padding: 6px 12px;height:34px;">';
              echo "<i class='fa fa-info-circle'></i> <strong>".$this->session->flashdata('msg_error')."</strong>";
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
            <img class="img-circle" src="<?php echo base_url('assets/images/avatar/')."/".$pertanyaan['avatar_penanya'] ?>"
            alt="user image">
            <span class="username"><a href="#"><?php echo $pertanyaan['nama_penanya'] ?> - <small><?php echo $wids_penanya ?></small></a></span>
            <span class="description"><?php echo get_tingkat($pertanyaan['tingkat']) ?> &middot; <?php echo $pertanyaan['nama_pelajaran'] ?></span>
          </div>
        </div>
        <div class="box-body">
          <p><?php echo $pertanyaan['pertanyaan'] ?></p>
          <?php if($pertanyaan['gambar'] != NULL): ?>
            <img class="img-responsive pad" src="<?php echo base_url() ?>assets/images/question/<?php echo $pertanyaan['gambar']?>" alt="Photo">
          <?php endif; ?>

          <?php if($this->session->userdata('id') == $pertanyaan['id_penanya'] OR $this->session->userdata('level') == "1"): ?>
                  <button class="btn btn-danger btn-xs pull-right" onclick=confirmDelete(<?php echo $pertanyaan['id_pertanyaan'] ?>)><i class="fa fa-trash"></i> Hapus</button>
                  <button class="btn btn-success btn-xs pull-right" onclick="location.href='<?php echo base_url() ?>edit_pertanyaan_saya/<?php echo $pertanyaan['id_pertanyaan'] ?>'"><i class="fa fa-pencil"></i> Edit</button>

                  <script type="text/javascript">
                      function confirmDelete(id) {

                        if(confirm('Anda yakin untuk menghapus pertanyaan ini ?')){
                            <?php $this->session->set_userdata('url_delete', base_url().'home'); ?>
                            window.location.href="<?php echo base_url() ?>delete_pertanyaan/"+id
                        }
                      }

                  </script>
          <?php endif; ?>
        </div>
        <div class="box-footer box-comments">
            <?php foreach($jawaban_pertanyaan_correct->result() as $r): ?>
              <div class="box-comment" style="background-color:#c8fbd5">
                <img class="img-circle img-sm" src="<?php echo base_url('assets/images/avatar/')."/".$r->avatar_penjawab?>" alt="user image">

                <div class="comment-text">
                  <span class="username">
                    <?php echo $r->nama_penjawab ?> - <small><?php echo count_wids($r->wids_penjawab) ?></small>
                    <span class="text-muted pull-right">8:03 PM Today</span>
                  </span>


                  <?php echo $r->jawaban ?>

                  <div id="img-jawaban<?php echo $r->id ?>" class="col-md-6">
                    <?php if($r->gambar_jawaban != NULL): ?>
                        <img src="<?php echo base_url() ?>/assets/images/answer/<?php echo $r->gambar_jawaban ?>" alt="Photo" style="width:100% !important; height:auto !important"> 
                    <?php endif;?>
                  </div>
                  <div class="clearfix"></div>
                  <span class="pull-right text-muted"><?php echo $r->jml_like ?> likes - <?php echo $r->jml_dislike ?> Dislikes</span>
                  <br />
                  
                  <?php if ($this->session->userdata('id') == $r->id_penjawab OR $this->session->userdata('level') == "1"): ?>
                    <button class="btn btn-danger btn-xs pull-right" onclick=confirmHapus(<?php echo $r->id ?>)><i class="fa fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-success btn-xs pull-right" onclick=ConfirmEdit(<?php echo $r->id ?>)><i class='fa fa-pencil'></i> Edit</button>

                    <script type="text/javascript">
                      function confirmHapus(id)
                        {
                             if(confirm('Anda yakin untuk menghapus jawaban ?'))
                             {
                                window.location.href='<?php echo base_url() ?>delete_jawaban/'+id;
                             }
                        }

                      function ConfirmEdit(id){
                        window.location.href="<?php echo base_url() ?>edit_jawaban/"+id;
                      }
                    </script>
                  <?php endif ?>
                </div>
            </div>
            <?php endforeach?>
            <?php foreach ($jawaban_pertanyaan->result() as $r): ?>
              <div class="box-comment">
                <img class="img-circle img-sm" src="<?php echo base_url('assets/images/avatar/')."/".$r->avatar_penjawab?>" alt="user image">

                <div class="comment-text">
                  <span class="username">
                    <?php echo $r->nama_penjawab ?> - <small><?php echo count_wids($r->wids_penjawab) ?></small>
                    <span class="text-muted pull-right">8:03 PM Today</span>
                  </span>


                  <?php echo $r->jawaban ?>

                  <div id="img-jawaban<?php echo $r->id ?>" class="col-md-6">
                    <?php if($r->gambar_jawaban != NULL): ?>
                        <img src="<?php echo base_url() ?>/assets/images/answer/<?php echo $r->gambar_jawaban ?>" alt="Photo" style="width:100% !important; height:auto !important"> 
                    <?php endif;?>
                  </div>
                  <div class="clearfix"></div>


                  <?php if($r->nama_penjawab != $this->session->userdata('nama')): ?>
                      <button class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                      <button class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-down"></i> Dislike</button>
                  <?php endif; ?>


                  <span class="pull-right text-muted"><?php echo $r->jml_like ?> likes - <?php echo $r->jml_dislike ?> Dislikes</span>
                  <br />
                  
                  <?php if ($this->session->userdata('id') == $r->id_penjawab OR $this->session->userdata('level') == "1"): ?>
                    <button class="btn btn-danger btn-xs pull-right" onclick=confirmHapus(<?php echo $r->id ?>)><i class="fa fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-success btn-xs pull-right" onclick=ConfirmEdit(<?php echo $r->id ?>)><i class='fa fa-pencil'></i> Edit</button>

                    <script type="text/javascript">
                      function confirmHapus(id)
                        {
                             if(confirm('Anda yakin untuk menghapus jawaban ?'))
                             {
                                window.location.href='<?php echo base_url() ?>delete_jawaban/'+id;
                             }
                        }

                      function ConfirmEdit(id){
                        window.location.href="<?php echo base_url() ?>edit_jawaban/"+id;
                      }
                    </script>
                  <?php endif ?>
                  <?php if($this->session->userdata('level') == "1" AND $r->is_correct == "0"): ?>
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                    <i class='fa fa-check-circle'></i> Betul</button>

                  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <form method="POST" action="<?php echo base_url() ?>betul/<?php echo $r->id ?>">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Beri Wids</h4>
                          </div>
                          <div class="modal-body">
                            <input type="hidden" name="id" value="<?php echo $r->nisn_penjawab ?>">
                            <div class="form-group">
                              <label>Tambah wids hadiah :</label>
                              <input type="text" name="wids" class="form-control">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>
                        </form>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          
        </div>

        <?php if($this->session->userdata('id') != $pertanyaan['id_penanya']): ?>
          <div class="box-footer">
               <img class="img-circle img-sm" src="<?php echo base_url('assets/images/avatar/')."/".$this->session->userdata('avatar') ?>" alt="user image">
                <div class="img-push">
                  <form action="<?php echo base_url() ?>jawab/<?php echo $this->uri->rsegment(3) ?>" method="post"  enctype="multipart/form-data">
                  <textarea class="form_control" placeholder="Leave a comment" id="comment" name="jawaban"></textarea>
                  <div class="form-group">
                    <label for="gambar_jawaban">Tambah Gambar</label>
                    <input type="file" name="gambar_jawaban">
                  </div>
                    <button class="btn btn-primary pull-right" type="submit" id="submit"><i class="fa fa-paper-plane"></i> Jawab !</button>
                  </form>
                </div>
          </div>
        <?php endif; ?>
      </div>
  </div>
  <div class="col-md-4">
      <?php $this->load->view('template/profil_widget');?>
      <?php $this->load->view('template/ajukan_pertanyaan'); ?>
    </div>
</section>	
<?php $this->load->view('template/footer-js'); ?>
<!-- custom JS -->
        <script type="text/javascript">
          $(document).ready(function() {
          $(window).keydown(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
            }
          });
        });
        </script>
        <script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
        <script>
          $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1');
            CKEDITOR.replace('comment');

          });
        </script>
        <script type="text/javascript" src="<?php echo base_url() ?>assets/js/ajaxFileUpload.js"></script>

<?php $this->load->view('template/foot'); ?>