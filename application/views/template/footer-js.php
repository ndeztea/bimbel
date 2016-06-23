    </div><!-- /.container -->
    </div><!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.3.0
                </div>
                <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
                </div><!-- /.container -->
        </footer>
    </div><!-- ./wrapper -->
    <!-- jQuery 2.1.3 -->
    <script src="<?= base_url() ?>assets/select2-4.0.2/vendor/jQuery-2.1.0.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?= base_url() ?>assets/AdminLTE-2.3.0/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?= base_url() ?>assets/AdminLTE-2.3.0/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?= base_url() ?>assets/AdminLTE-2.3.0/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>assets/AdminLTE-2.3.0/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/select2-4.0.2/dist/js/select2.js"></script>
    <script type="text/javascript">
    $(document).ready(function() { 
        $(".pencarian").select2({
              width:'100%',
              allowClear:true,
              ajax: {
                url: "<?= base_url() ?>pertanyaan/cari_pertanyaan",
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
          window.location="<?= base_url()?>detail_pertanyaan/"+this.value;
        });;
    });
    </script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="../../dist/js/demo.js" type="text/javascript"></script> -->