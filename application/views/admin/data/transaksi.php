<?php if($this->session->flashdata('aktivasi')): ?>
    <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-check"></i> Alert!</h4>
        <?= $this->session->flashdata('aktivasi');?>
    </div>
<?php endif ?>

<style>
    .dataTables_filter {
        width: 50%;
        float: right;
        text-align: right;
        margin-right: 30px;
    }
</style>

<div class="row">
    <div class="col-lg-8">
        <div class="box">
            <br>
            <div class="container">
                <div class="btn-group mt-5">
                    <a href="<?= base_url();?>transaksi/tambah" type="button" class="btn btn-block btn-primary btn-flat">Tambah</a>
                </div>
            </div>
            <div class="box-body">
                <table id="example1" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th width="10%">Tanggal</th>
                            <th width="10%">jenis_transaksi</th>
                            <th width="10%">No rekening</th>
                            <th width="10%">Debit</th>
                            <th width="10%">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($transaksi as $key): ?>
                            <tr>
                                <td> <?= $no; ?></td>
                                <td> <?= date('d M Y',strtotime($key->tanggal_simpan)); ?></td>
                                <td> <?= $key->jenis_transaksi; ?></td>
                                <td> <?= $key->no_rekening; ?></td>
                                <td> <?= "Rp ".number_format ($key->jumlah_debit, 2, ',', '.'); ?></td>
                                <td> <?= "Rp ".number_format ($key->jumlah_kredit, 2, ',', '.'); ?></td>
                            </tr>  
                        <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

