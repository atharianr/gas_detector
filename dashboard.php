<?php  include "layout/head.php"; ?>
<?php  include "layout/nav.php"; ?>
<?php include "koneksi.php";
$query = "SELECT data.id_data,data.waktu,data.lpg,tempat.nama_tempat FROM `data` INNER JOIN tempat on data.tempat=tempat.id_tempat ORDER BY data.id_data DESC";
$result=$conn->query($query);
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
    </section>

    <!-- Main content -->
 <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hasil Monitoring Data</h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id Data</th>
                  <th>Waktu</th>
                  <th>LPG</th>
                  <th>Tempat</th>
                  
                </tr>
                </thead>
                <tbody>
              <?php $i=0;
            while($r=mysqli_fetch_array($result))
            {
              $id_data = $r['id_data'];
              $waktu = $r['waktu'];
              $lpg = $r['lpg'];
              $tempat = $r['nama_tempat'];
              ?>

          <tr>
            <td><?php echo $id_data ?></td>
            <td><?php echo $waktu ?></td>
            <td><?php echo $lpg ?></td>
            <td><?php echo $tempat ?></td>
           
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





