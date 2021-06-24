<div class="row">
    <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $jumlah_nasabah; ?></h3>

              <p>Nasabah Terdaftar</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
    </div>
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $jumlah_transaksi; ?></h3>

              <p>Total transaksi</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">
                    <?php 
                        foreach ($jumlah_total_pemasukan as $key) {
                            echo "Rp ".number_format ($key->sisa_saldo, 2, ',', '.');
                        }
                    ?>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $total_tr_kredit; ?></h3>

              <p>Transaksi Kredit</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
                <?php 
                    foreach ($total_kredit as $key) {
                        echo "Rp ".number_format ($key->total_kredit, 2, ',', '.');
                    }
                ?>
            </a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $total_tr_debit;?></h3>

              <p>Transaksi Debit</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">
                <?php 
                    foreach ($total_debit as $key) {
                        echo "Rp ".number_format ($key->total_debit, 2, ',', '.');
                    }
                ?>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-5 connectedSortable presentase-transaksi">
          <div class="box">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Tabel persentase transaksi</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <button type="button" class="btn-xs bg-info" data-widget="collapse"><i class="text-info fa fa-minus"></i>
                </button>
                <button type="button" class="btn-xs bg-info" data-widget="remove"><i class="text-danger fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Jenis Transaksi</th>
                  <th>Jumlah</th>
                  <th>Progress</th>
                  <th style="width: 40px">Label</th>
                </tr>
                <?php
                 $no=0; 
                 $bg = [ 1 => 'bg-red',2 => 'bg-yellow',3 => 'bg-blue',4 => 'bg-green',5 => 'bg-red',6 => 'bg-red'];
                 
                 foreach($transaksi as $trs): ?>
                <tr>
                  <td><?= $no; ?>.</td>
                  <td><?= $trs->jenis_transaksi; ?></td>
                  <td><?= $this->M_transaksi->jml_transaksi($trs->jenis_transaksi); ?></td>
                  <td>
                    <div class="progress progress-xs">
                      <div class="progress-bar <?= $bg[$no]; ?>" style="width: <?= $this->M_transaksi->progres($trs->jenis_transaksi);?>%"></div>
                    </div>
                  </td>
                  <td>
                    <span class="badge <?= $bg[$no]; $no++; ?>"><?= $this->M_transaksi->progres($trs->jenis_transaksi);?>%</span>
                  </td>
                </tr>
                <?php endforeach?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-7 connectedSortable">
          <!-- solid sales graph -->

          <div class="box">
          <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Presentase pengguna aplikasi</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <button type="button" class="btn-xs bg-info" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn-xs bg-info" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Task</th>
                  <th>Progress</th>
                  <th style="width: 40px">Label</th>
                </tr>
                <tr>
                  <?php if($this->M_nasabah->aktif_app() > 0): ?>
                  <td>1.</td>
                  <td>Nasabah pengguna aplikasi (<?= $this->M_nasabah->aktif_app(); ?>)</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-primary" style="width: <?= $this->M_nasabah->progres($this->M_nasabah->aktif_app());?>%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-light-blue"><?= $this->M_nasabah->progres($this->M_nasabah->aktif_app());?>%</span></td>
                  <?php endif?>
                </tr>
                <tr>
                  <?php if($this->M_nasabah->nonaktif_app() > 0): ?>
                  <td>2.</td>
                  <td>Nasabah konvensional (<?= $this->M_nasabah->nonaktif_app(); ?>)</td>
                  <td>
                    <div class="progress progress-xs progress-striped active">
                      <div class="progress-bar progress-bar-danger" style="width: <?= $this->M_nasabah->progres($this->M_nasabah->nonaktif_app());?>%"></div>
                    </div>
                  </td>
                  <td><span class="badge bg-green"><?= $this->M_nasabah->progres($this->M_nasabah->nonaktif_app());?>%</span></td>
                  <?php endif?>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </section>
        <!-- right col -->
</div>

