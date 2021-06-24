<div class="box-body">
<?php if(validation_errors()):?>
        <div class="row">
            <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        <?= validation_errors();?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if($this->session->flashdata('transfer_gagal')):?>
        <div class="row">
            <div class="col-lg-12">
                    <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        <?= $this->session->flashdata('transfer_gagal');?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>

    <div class="flashdata" data-flashdata="<?= $this->session->flashdata('transfer_sukses'); ?>"></div>
    <div class="row">
        <div class="col-lg-6">
            <!-- general form elements -->
            <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Form Input <?php ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="form_transaksi" role="form" method="post" action="<?= base_url(); ?>transaksi/<?= $url; ?>">
                <div class="box-body">
                    <div class="form-group">
                    <label>Pilih jenis akun tabungan</label>
                    <select class="form-control" name="akun">
                    <?php foreach($akun as $key): ?>
                        <option 
                            <?php 
                                if ($key->id_akun == 101002) {
                                    echo "selected";
                                }
                            ?>
                            value="<?= $key->id_akun; ?>" ><?= $key->id_akun; ?> / <?= $key->nama_akun; ?></option>
                    <?php endforeach?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label >Nomor rekening</label>
                        <input type="text" name="no_rek" class="form-control nomor_rekening" id="no_rek" placeholder="Masukan nomor rekening">
                    </div>
                    <div class="form-group">
                        <label id="pemilik"></label>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jumlah nominal</label>
                        <input type="text" name="jumlah" class="form-control" id="exampleInputPassword1" placeholder="Masukan jumlah nominal">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-lg-6">
            <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Transaksi <?= $jenis; ?> hari ini <?= date('d-m-Y'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Nomor rekening</th>
                        <th>Nominal</th>
                        <th>bukti transaksi</th>
                    </tr>
                    <tr>
                    <?php $no=1; foreach($tabungan as $tab):?>
                        <tr>
                            <td><?= $no;?></td>
                            <td><?= $tab->no_rekening;?></td>
                            <?php $jumlah = $tab->jumlah_debit+$tab->jumlah_kredit ?>
                            <td><?= "Rp ".number_format ($jumlah, 2, ',', '.');?></td>
                            <td>
                                <a href="cetak/<?= $tab->kode_transaksi."/".$tab->no_rekening;?>" target="_blank" class="btn-sm bg-purple">cetak</a>
                            </td>
                        </tr>
                    <?php $no++; endforeach?>
                </table>
            </div>
            <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>


