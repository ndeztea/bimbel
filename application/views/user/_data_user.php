<?php
$this->load->view('template/top');
?>
<!--tambahkan custom css disini-->

<?php
$this->load->view('template/header');
?>
<!-- Content Header (Page header) -->
<section class="content-title">
  <h1>
  Data Anggota
  <!-- <small>it all starts here</small> -->
  </h1>
</section>
<!-- Main content -->
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
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Pencarian</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-xs-12 col-sm-6 col-lg-6">
            <?php
            $attributes = array('class'=>'form-inline','method'=>'GET');
            echo form_open(base_url('users'),$attributes);
            ?>
            <?php search_hidden_query_string(); ?>
            <div class="form-group">
              <label for="keyword">Cari Berdasarkan Kata Kunci :</label><br />
              <select class="form-control" name="keyword_by">
                <?php foreach($keyword_by as $k => $v): ?>
                <option value="<?php echo $v['alias']; ?>" <?php if($v['alias']==$param_keyword_by){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
                <?php endforeach; ?>
              </select>
              <div class="input-group">
                <input type="text" class="form-control" placeholder="ketik kata kunci" name="q"
                value="<?php if(!$keyword){echo '';}else{echo $keyword;} ?>"
                >
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-info">
                  <i class="fa fa-search"></i> Cari</button>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div class="clearfix"></div>


<div class="row">
  <div class="box box-primary">
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-3">
          <span class="text-muted">Urutkan : </span>
            <select class="text-muted select-redirect">
              <?php foreach($sort as $k => $v): ?>
              <option value="<?php echo base_url('users').update_query_string('sort',$v['alias']); ?>" <?php if($v['alias']==$param_sort){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
              <?php endforeach; ?>
            </select>
            <select class="text-muted select-redirect">
              <?php foreach($sort_order as $k => $v): ?>
              <option value="<?php echo base_url('users').update_query_string('sort_order',$v['alias']); ?>" <?php if($v['alias']==$param_sort_order){echo 'selected';} ?>><?php echo $v['alias']; ?></option>
              <?php endforeach; ?>
            </select>
        </div>
        <!-- <div class="col-md-8">
          <button class="btn btn-sm btn-success pull-right" onclick=location.href="<?= base_url() ?>add_anggota"><i class="fa fa-plus-circle"></i> Tambah Anggota</button>
        </div> -->
    </div>
  </div><!-- /.box-header -->
  <div class="box-body">
    <table id="table-1" class="table table-bordered table-consended table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>NISN</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Sekolah</th>
          <th>Email</th> 
          <th>Status</th> 
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($datadb)): ?>
        <?php foreach ($datadb as $k => $v):?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $v['nama']; ?></td>
          <td><?php echo $v['nisn']; ?></td>
          <td><?php echo $v['kelas']; ?></td>
          <td><?php echo $v['nama_sekolah']; ?></td>
          <td><?php echo $v['email']; ?></td>
          <td></td>
          <td>
              <a class="btn btn-success" href="<?= base_url()?>edit_user/<?= $v['nisn'] ?>"><i class="fa fa-pencil"></i></a>
               <a href="<?= base_url() ?>delete_user/<?= $v['nisn']?>" class="btn btn-danger"onclick="return confirm('Anda Yakin Untuk Menghapus Data User ?');"><i class="fa fa-trash"></i></a>
               <a href="<?= base_url() ?>nonaktif_user/<?= $v['nisn']?>" class="btn btn-danger"onclick="return confirm('Anda Yakin Untuk Menonaktifkan User ?');"><i class="fa fa-times"></i></a>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
        
      </tbody>
      <tfoot>
        <tr>
          <th>No</th>
          <th>NISN</th>
          <th>Nama Lengkap</th>
          <th>Username</th>
          <th>Email</th>
          <th>No Telepon</th> 
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </tfoot>
    </table>
    </div><!-- /.box-body -->
    <div class="box-footer">
      <?php echo $pagination; ?>
    </div>
    </div><!-- /.box -->
</div>
</div><!-- /.row -->
          </section><!-- /.content -->
<?php $this->load->view('template/footer-js');?>
<!--tambahkan custom js disini-->
<script type="text/javascript">
  // get your select element and listen for a change event on it
  $('.select-redirect').change(function() {
    // set the window's location property to the value of the option the user has selected
    document.location = $(this).val();
  });


</script>
<?php
$this->load->view('template/foot');
?>