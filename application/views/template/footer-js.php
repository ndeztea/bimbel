    </div><!-- /.container -->
    </div><!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Copyright &copy;</b> 2016
                </div>
                <strong><a href="<?php echo base_url()?>">Beranda</a> &bull;<a href="<?php echo base_url()?>guide">Tentang Bimbel</a> &bull; <a href="<?php echo base_url()?>about">Panduan Member</a>  &bull; <a href="<?php echo base_url()?>contact">Kontak Kami</a>
                </div><!-- /.container -->
        </footer>
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url() ?>assets/select2-4.0.2/vendor/jquery-2.1.0.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url() ?>assets/AdminLTE-2.3.0/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url() ?>assets/AdminLTE-2.3.0/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url() ?>assets/AdminLTE-2.3.0/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>assets/AdminLTE-2.3.0/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/select2-4.0.2/dist/js/select2.js"></script>
    <script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
    
    
    <script type="text/javascript">
    $(document).ready(function() { 
        $(".pencarian").select2({
              width:'100%',
              allowClear:true,
              ajax: {
                url: "<?php echo base_url() ?>pertanyaan/cari_pertanyaan",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                  return {
                    q: params.term
                  };
                },
                processResults: function (data) {
                  return {
                    results: data
                  };
                },
                cache: true
              },
              placeholder: {
              id: '0', // the value of the option
              text: 'Cari Pertanyaan Disini'},
              minimumInputLength: 1,
          }).on('change', function(){
          window.location="<?php echo base_url()?>detail_pertanyaan/"+this.value;
        });;
    });
    </script>

    <script type="text/javascript">
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor-pertanyaan');

      });
    </script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="../../dist/js/demo.js" type="text/javascript"></script> -->