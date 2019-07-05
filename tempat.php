<?php  include "layout/head.php"; ?>
<?php  include "layout/nav.php"; ?>
<?php include "koneksi.php";
$query = "SELECT * from tempat";
$result=$conn->query($query);
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
          Tempat
        <small>Data Manajemen Tempat</small>
      </h1>
    </section>

    <!-- Main content -->
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Semua Data Tempat</h3><br><br>

            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id Tempat</th>
                  <th>Nama Tempat</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
              <?php $i=0;
            while($r=mysqli_fetch_array($result))
            {
              $id_tempat = $r['id_tempat'];
              $nama_tempat = $r['nama_tempat'];
              ?>

          <tr>
            <td><?php echo $id_tempat ?></td>
            <td><?php echo $nama_tempat ?></td>
            <td><center><a href="input_tempat.php?id_tempat=<?php echo $id_tempat ?>" class="btn btn-danger">Hapus</a></center></td>
           
          </tr>
            <?php $i++; } ?>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
      

    
    </div>
            <!-- /.chat -->
           
   </div>
  </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
      <?php  include "layout/footer.php"; ?>

  </div>
  <!-- /.content-wrapper -->





