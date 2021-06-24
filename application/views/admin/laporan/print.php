    <div class="flashdata_error" data-flashdata="<?= $this->session->flashdata('flashdata_error'); ?>"></div>
    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Catatan:</h4>
        Halaman ini bisa langsung di print atau disimpan.
      </div>
    </div>
    <?php foreach($sisa as $key): ?>
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-md-12">
          <h1 class="page-header text-center">
            LAPORAN <br>
            BANK MINI IQTI
            <small>Periode: <?= $periode; ?></small>
          </h1>
        </div>
        <!-- /.col -->
      </div>
      <br><br><br>
 
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <table class="table table-striped">
            <thead>
              <tr>
                <th width="16%"><strong>Pemasukan</strong></th>
                <th width="16%">ID Akun</th>
                <th width="16%">Nama Akun</th>
                <th width="16%">Jumlah Kredit</th>
                <th width="16%">Jumlah Debit</th>
                <th width="16%" class="text-left">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td>
                  <?= $key->id_akun; ?>
                </td>
                <td>Tabungan Umum</td>
                <td>
                  <?= "Rp ".number_format ($key->t_kredit, 2, ',', '.'); ?>
                </td>
                <td></td>
                <td class="text-left">
                  <?= "Rp ".number_format ($key->t_kredit, 2, ',', '.'); ?>
                </td>
              </tr>
            </tbody>
            <thead>
              <tr>
                <th><strong>Pengeluaran</strong></th>
                <th>ID Akun</th>
                <th>Nama Akun</th>
                <th>Jumlah Kredit</th>
                <th>Jumlah Debit</th>
                <th class="text-left">Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td>
                  <?= $key->id_akun; ?>
                </td>
                <td>Tabungan Umum</td>
                <td></td>
                <td>
                  <?= "Rp ".number_format ($key->t_debit, 2, ',', '.'); ?>
                </td>
                <td class="text-left">
                  <?= "Rp ".number_format ($key->t_debit, 2, ',', '.'); ?>
                </td>
              </tr>
              <tr>
                <td colspan="4"></td>
                <td><b>TOTAL</b></td>
                <td class="text-left">
                  <?= "Rp ".number_format ($key->sisa_saldo, 2, ',', '.');?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <br>
      <!-- Table row -->
      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped">
            <tr>
              <td></td>
              <td></td>
              <td>
                <p class="text-left">Pekalongan, <?= date('d M Y') ?></p>
              </td>
            </tr>
            <tr>
              <td><strong>KKK Akuntansi</strong></td>
              <td><strong>Ketua</strong></td>
              <td><strong>Admin</strong></td>
            </tr>
            <tr>
              <td height="35px"></td>
            </tr>
            <tr>
              <td>Cipto Rahayuningsi, S.E</td>
              <td>Khadziron Nadhifan, S.E</td>
              <td><?= $this->session->userdata('nama') ?></td>
            </tr>
          </table>
        </div>
      </div>

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-md-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default btn-flat print"><i class="fa fa-print"></i> Print</a>
          <form action="<?= base_url();?>LaporanController/save" method="post">
            <input type="hidden" name="periode" value="<?= $periode ?>">
            <input type="hidden" name="kredit" value="<?= $key->t_kredit ?>">
            <input type="hidden" name="debit" value="<?= $key->t_debit ?>">
            <input type="hidden" name="sisa" value="<?= $key->sisa_saldo ?>">
            <input type="hidden" name="nama_petugas" value="<?= $this->session->userdata('nama') ?>">
            <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Simpan</button>
          </form>
        </div>
      </div>
    </section>
    <?php endforeach ?>

    <!-- /.content -->

    <script>
      $('a.print').click(function(){
            window.print();
            return false;
      });
    </script>