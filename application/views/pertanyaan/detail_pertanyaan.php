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
            <img class="img-circle" src="<?= base_url('assets/images/avatar/')."/".$pertanyaan['avatar_penanya'] ?>"
            alt="user image">
            <span class="username"><a href="#"><?= $pertanyaan['nama_penanya'] ?> - <small><?= $wids_penanya ?></small></a></span>
            <span class="description"><?= get_tingkat($pertanyaan['tingkat']) ?> &middot; <?= $pertanyaan['nama_pelajaran'] ?> &middot; <?= $pertanyaan['wids_pertanyaan'] ?> Wids</span>
          </div>
        </div>
        <div class="box-body">
          <p><?= $pertanyaan['pertanyaan'] ?></p>
          <!-- <img class="img-responsive pad" src="../dist/img/photo2.png" alt="Photo"> -->
          <?php if($this->session->userdata('id') == $pertanyaan['id_penanya']): ?>
                  <button class="btn btn-danger btn-xs pull-right" onclick=confirmDelete(<?= $pertanyaan['id_pertanyaan'] ?>)><i class="fa fa-times-o"></i> Hapus</button>
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
                        <img src="<?= base_url() ?>/assets/images/question/<?= $r->gambar_jawaban ?>" alt="Photo" style="width:100% !important; height:auto !important"> 
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
                  <button type="button" class="btn btn-success btn-xs pull-right" onclick=ConfirmEdit(<?= $r->id ?>)><i class='fa fa-pencil'></i> Edit</button>


                   <form method="post" action="" id="file_upload" enctype="multipart/form-data" onchange=ajaxFileUpload(<?= $r->id ?>)>
                    <input type='file' name='gambar-jawaban' id='gambar-jawaban' class='fileInput'>
                    <label for='gambar-jawaban' class='btn btn-primary btn-xs'><i class='fa fa-camera'></i> Tambah Gambar</label>
                  </form>
                </div>
              </div>
            <?php endforeach; ?>
          
        </div>

        <?php if($this->session->userdata('id') != $pertanyaan['id_penanya']): ?>
          <div class="box-footer">
               <img class="img-circle img-sm" src="<?= base_url('assets/images/avatar/')."/".$this->session->userdata('avatar') ?>" alt="user image">
              <div class="img-push">
                <form action="" method="post" accept-charset="utf-8">
                  <div class="input-group">
                    <div>
                     <textarea class="form_control" placeholder="Leave a comment" id="comment" name="jawaban"></textarea>
                     </div>
                     <div>
                          <button class="btn btn-primary pull-right" type="button" id="submit"><i class="fa fa-paper-plane"></i> Jawab !</button>
                      </div>
                  </div><!-- /input-group -->   
                </form>
              </div>
          </div>
        <?php endif; ?>
      </div>
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
            $(function() {
 
                $('#submit').click(function() {
           
                  
                    //get input data as a array
                    var post_data = {
                        'jawaban': CKEDITOR.instances.comment.getData(),
                        'id_pertanyaan' : <?= $this->uri->rsegment(3) ?>,
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    };
 
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url(); ?>jawaban/insert_jawaban",
                        data: post_data,
                        success: function(response) {
                            var json = $.parseJSON(response);
                            $(".box-comments").append("<div class='box-comment'>"+
                                                      "<img class='img-circle img-sm' src='<?= base_url()?>assets/images/avatar/"+json.avatar_penjawab+"' alt='images'>"+
                                                      "<div class='comment-text'>"+
                                                      "<span class='username'>"+json.nama_penjawab+
                                                      "<small>"+"</small>"+
                                                      "<span class='text-muted pull-right'>8:03 PM Today</span>"+
                                                      "</span>"+
                                                      json.jawaban+
                                                      "<br />"+
                                                      "<span class='pull-right text-muted'>"+json.jml_like+" likes - "+json.jml_dislike+" Dislkes </span>"+
                                                      "<br >"+
                                                      "<input type='file' name='gambar-jawaban' id='file' class='fileInput'>"+
                                                      "<label for='file' class='btn btn-primary btn-xs'><i class='fa fa-camera'></i> Tambah Gambar</label>"+
                                                      "<button class='btn btn-danger btn-xs pull-right' onclick=confirmHapus("+json.id+")><i class='fa fa-times-o'></i> Hapus</button>"+
                                                      "<button class='btn btn-success btn-xs pull-right' onCLick='ConfirmEdit("+json.id+")'><i class='fa fa-pencil'></i> Edit</button>"+
                                                      "</div>"+
                                                      "</div>"
                                                      )
                        }
                    });
                      CKEDITOR.instances.comment.setData("");
                    
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
        <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
        <script>
          $(function () {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('comment');

          });
        </script>
        <script type="text/javascript" src="<?= base_url() ?>assets/js/ajaxFileUpload.js"></script>
        <script type="text/javascript">
          $('#gambar-jawaban').change(function(){
            ajaxFileUpload(id);
          })

          function ajaxFileUpload(id){
            $.ajaxFileUpload({
              url: '<?= base_url() ?>upload_gambar_jawaban/'+id,
              secureuri:false,
              fileElementId:'gambar-jawaban',
              dataType: 'json',
              success: function(data,status){
                  if(typeof(data.error) != 'undefined'){
                      if(data.error){
                          //print error
                          alert(data.error);
                      }else{
                          //clear
                          // $('#img img').attr('src',url+'cache/'+data.msg);
                          alert("success");
                      }
                  }
                  $('#gambar-jawaban').change(function(){
                    ajaxFileUpload(id);
                  });
              },
              error: function(data,status,e){
                  //print error
                  alert(e);
                  $('#gambar-jawaban').change(function(){
                    ajaxFileUpload(id);
                  });
              }
            });
            return false;
          }
        </script>

<?php $this->load->view('template/foot'); ?>