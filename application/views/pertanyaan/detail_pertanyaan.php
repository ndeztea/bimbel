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

<script src="<?= base_url() ?>assets/select2-4.0.2/vendor/jQuery-2.1.0.js"></script>

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
            <img class="img-circle" src="<?= base_url('assets/images/avatar/')."/".$pertanyaan['avatar_penanya'] ?>"
            alt="user image">
            <span class="username"><a href="#"><?= $pertanyaan['nama_penanya'] ?> - <small><?= $wids_penanya ?></small></a></span>
            <span class="description"><?= get_tingkat($pertanyaan['tingkat']) ?> &middot; <?= $pertanyaan['nama_pelajaran'] ?></span>
          </div>
        </div>
        <div class="box-body">
          <p><?= $pertanyaan['pertanyaan'] ?></p>

          <?php if($pertanyaan['gambar'] != NULL): ?>
            <img class="img-responsive pad" src="<?= base_url() ?>assets/images/question/<?= $pertanyaan['gambar']?>" alt="Photo">
          <?php endif; ?>

          <?php if($this->session->userdata('id') == $pertanyaan['id_penanya'] OR $this->session->userdata('level') == "1"): ?>
                  <button class="btn btn-danger btn-xs pull-right" onclick=confirmDelete(<?= $pertanyaan['id_pertanyaan'] ?>)><i class="fa fa-trash"></i> Hapus</button>
                  <button class="btn btn-success btn-xs pull-right" onclick="location.href='<?= base_url() ?>edit_pertanyaan_saya/<?= $pertanyaan['id_pertanyaan'] ?>'"><i class="fa fa-pencil"></i> Edit</button>
          <?php endif; ?>
        </div>
        <div class="box-footer box-comments">
            <?php foreach ($jawaban_pertanyaan->result() as $r): ?>
              <div class="box-comment">
                <img class="img-circle img-sm" src="<?= base_url('assets/images/avatar/')."/".$r->avatar_penjawab?>" alt="user image">


                <div class="comment-text">
                  <span class="username">
                    <?= $r->nama_penjawab ?> - <small><?= count_wids($r->wids_penjawab) ?></small>
                    <span class="text-muted pull-right">8:03 PM Today</span>
                  </span>


                  <?= $r->jawaban ?>

                  <div id="img-jawaban<?= $r->id ?>" class="col-md-6">
                    <?php if($r->gambar_jawaban != NULL): ?>
                        <img src="<?= base_url() ?>/assets/images/answer/<?= $r->gambar_jawaban ?>" alt="Photo" style="width:100% !important; height:auto !important"> 
                    <?php endif;?>
                  </div>
                  <div class="clearfix"></div>


                  <?php if($r->nama_penjawab != $this->session->userdata('nama')): ?>
                      <button class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                      <button class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-down"></i> Dislike</button>
                  <?php endif; ?>


                  <span class="pull-right text-muted"><?= $r->jml_like ?> likes - <?= $r->jml_dislike ?> Dislikes</span>
                  <br />


                  <button class="btn btn-danger btn-xs pull-right" onclick=confirmHapus(<?= $r->id ?>)><i class="fa fa-trash"></i> Hapus</button>
                  <?php if ($this->session->userdata('id') == $r->id_penjawab): ?>
                    <button type="button" class="btn btn-success btn-xs pull-right" onclick=ConfirmEdit(<?= $r->id ?>)><i class='fa fa-pencil'></i> Edit</button>
                  <?php endif ?>
                </div>
              </div>
            <?php endforeach; ?>
          
        </div>

        <?php if($this->session->userdata('id') != $pertanyaan['id_penanya']): ?>
          <div class="box-footer">
               <img class="img-circle img-sm" src="<?= base_url('assets/images/avatar/')."/".$this->session->userdata('avatar') ?>" alt="user image">
                <div class="img-push">
                  <form action="<?= base_url() ?>jawab/<?= $this->uri->rsegment(3) ?>" method="post"  enctype="multipart/form-data">
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
        <script type="text/javascript">
             function confirmHapus(id)
                {
                     if(confirm('Anda yakin untuk menghapus jawaban ?'))
                     {
                        window.location.href='<?= base_url() ?>delete_jawaban/'+id;
                     }
                }
        </script>
        <script type="text/javascript">
          function confirmDelete(id) {

            if(confirm('Anda yakin untuk menghapus pertanyaan ini ?')){
                window.location.href="<?=base_url() ?>delete_pertanyaan/"+id
            }
          }
        </script>
        <script>
          function ConfirmEdit(id){
            window.location.href="<?= base_url() ?>edit_jawaban/"+id;
          }
        </script>
        <script src="<?= base_url() ?>assets/ckeditor/ckeditor.js"></script>
        <script>
          $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1');
            CKEDITOR.replace('comment');

          });
        </script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/ajaxFileUpload.js"></script>

<?php $this->load->view('template/foot'); ?>