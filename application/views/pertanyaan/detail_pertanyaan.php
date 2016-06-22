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
            <img class="img-circle" src="<?= base_url('assets/images/avatar/')."/".$pertanyaan['avatar_penanya'] ?>"
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
                <img class="img-circle img-sm" src="<?= base_url('assets/images/avatar/')."/".$r->avatar_penjawab?>" alt="user image">
                <div class="comment-text">
                  <span class="username">
                  <?= $r->nama_penjawab ?> - <small><?= count_wids($r->wids_penjawab) ?></small>
                    <span class="text-muted pull-right">8:03 PM Today</span>
                  </span>
                  <?= $r->jawaban ?>
                  <br/>
                  <?php if($r->nama_penjawab != $this->session->userdata('nama')): ?>
                      <button class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                      <button class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-down"></i> Dislike</button>
                  <?php endif; ?>
                      <span class="pull-right text-muted"><?= $r->jml_like ?> likes - <?= $r->jml_dislike ?> Dislikes</span>
                      <br />
                  <button class="btn btn-danger btn-xs pull-right" onclick=confirmHapus(<?= $r->id ?>)><i class="fa fa-times-o"></i> Hapus</button>
                  <button class="btn btn-success btn-xs pull-right"><i class="fa fa-pencil"></i> Edit</button>
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
                     <input type="text" class="form-control" placeholder="Press enter to post comment" id="jawaban" name="jawaban">
                      <span class="input-group-btn">
                        <button class="btn btn-primary" type="button" id="submit"><i class="fa fa-paper-plane"></i></button>
                      </span>
                  </div><!-- /input-group -->   
              </div>
            </form>
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
                        'jawaban': $("#jawaban").val(),
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
                                                      "<button class='btn btn-danger btn-xs pull-right'><i class='fa fa-times-o'></i> Hapus</button>"+
                                                      "<button class='btn btn-success btn-xs pull-right'><i class='fa fa-pencil'></i> Edit</button>"+
                                                      "</div>"+
                                                      "</div>"
                                                      )
                            $("#jawaban").val('');
                        }
                    });
 
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


<?php $this->load->view('template/foot'); ?>