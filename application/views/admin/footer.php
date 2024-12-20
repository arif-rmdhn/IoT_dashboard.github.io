  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- AdminLTE App -->
  <script src=" <?php echo base_url(); ?>assets/adminlte/dist/js/adminlte.min.js"></script>

  <script>
    $(function() {
      $("#datatable_01").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "dom": 'Blfrtip',
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        "buttons": ["excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

 
      // $("#pilih_kelas").click(function() {
      //   var pilih = $("#pd_kelas").val();
      //   window.location.href = "<?php echo base_url('admin/data_logging/'); ?>" + pilih;
      // });

      $("#pd_kelas").change(function() {
        var end = this.value;
        var firstDropVal = $('#pd_kelas').val();
        window.location.href = "<?php echo base_url('admin/data_logging/'); ?>" + firstDropVal;
      });

    });

    function sortTable(columnIndex) {
        const table = document.getElementById("manualTable");
        const rows = Array.from(table.rows).slice(1); // Exclude header row
        const isAscending = table.getAttribute("data-sort") !== "asc";
        
        rows.sort((rowA, rowB) => {
            const cellA = rowA.cells[columnIndex].innerText.toLowerCase();
            const cellB = rowB.cells[columnIndex].innerText.toLowerCase();

            if (isNaN(cellA) || isNaN(cellB)) {
                return cellA > cellB ? (isAscending ? 1 : -1) : (isAscending ? -1 : 1);
            } else {
                return (isAscending ? 1 : -1) * (Number(cellA) - Number(cellB));
            }
        });

        rows.forEach(row => table.tBodies[0].appendChild(row)); // Reorder rows
        table.setAttribute("data-sort", isAscending ? "asc" : "desc");
    }
  </script>



  </body>

  </html>