    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer no-print">
    <div class="pull-right hidden-xs">
      <b>Bank Mini IQTI</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 </strong> Tugas Akhir Dhiyan Iryadi
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<script src="<?= base_url(); ?>asset/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>asset/AdminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="<?= base_url(); ?>asset/AdminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="<?= base_url(); ?>asset/AdminLTE/bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url(); ?>asset/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url(); ?>asset/AdminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>asset/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?= base_url(); ?>asset/AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url(); ?>asset/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?= base_url(); ?>asset/AdminLTE/dist/js/adminlte.min.js"></script>
<script src="<?= base_url(); ?>asset/js/jquery-ui.js"></script>

<script src="<?= base_url(); ?>asset/AdminLTE/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script src="<?= base_url(); ?>asset/swal/sweetalert2.all.min.js"></script>
<script src="<?= base_url(); ?>asset/js/fungsi_swal.js"></script>

<script type='text/javascript'>
  $(function() {
    
    $('#example1').DataTable( {
        'language'    : {
              'url': 'http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json'
            },
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return '<h4><strong>'+data[1]+' an '+data[2]+'</strong></h4><hr>';
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );

    $('#datepicker').datepicker({
      autoclose: true
    })
    $('#p_awal').datepicker({
      autoclose: true,
      dateFormat: 'yy-m-d'
    })
    $('#p_akhir').datepicker({
      autoclose: true,
      dateFormat: 'yy-m-d'
    })

    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Hari ini'       : [moment(), moment()],
          'Kemarin'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          '7 Hari terakhir' : [moment().subtract(6, 'days'), moment()],
          '30 Hari terakhir': [moment().subtract(29, 'days'), moment()],
          'Bulan ini'  : [moment().startOf('month'), moment().endOf('month')],
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('Y-MM-D') + ' - ' + end.format('Y-MM-D'))
        
        const awal = start.format('Y-MM-D');
        const akhir = end.format('Y-MM-D');
        $('#p_awal').val(awal);
        $('#p_akhir').val(akhir);
        
      }
    )


    $( "#no_rek" ).autocomplete({
      source: function( request, response ) {
        $.ajax( {
          url     : "<?= base_url(); ?>AutoController/get_autocomplete",
          type    : "get",
          dataType: "json",
          data: {
            term: request.term
          },
          success: function( data ) {
            response( data );
            console.log(data);
          }
        } );
      },
      select: function( event, ui ) {
        $(this).val(ui.item.id);
        $("#pemilik").html( "<b>" + ui.item.id + "/ " + ui.item.value + "</b>" );     
        return false;
      }
    });



  })



</script>
</body>
</html>
