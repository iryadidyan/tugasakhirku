<div class="flashdata_error" data-flashdata="<?= $this->session->flashdata('rekap_error'); ?>"></div>
<div class="flashdata" data-flashdata="<?= $this->session->flashdata('rekap'); ?>"></div>
<div class="box-body">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Periode</h3>
                </div>
                <div class="box-body">
                <div class="form-group">
                    <div class="input-group">
                    <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                        <span>
                        <i class="fa fa-calendar"></i> Date range picker
                        </span>
                        <i class="fa fa-caret-down"></i>
                    </button>
                    </div>
                </div>
                    <div class="row">
                        <form action="<?= base_url();?>LaporanController/print" method="post">
                            <div class="col-xs-2">
                                <input type="text" name="awal" id="p_awal" class="form-control" placeholder="Tanggal awal">
                            </div>
                            <div class="col-xs-2">
                                <input type="text" name="akhir" id="p_akhir" class="form-control" placeholder="Tanggal akhir">
                            </div>
                            <div class="col-xs-3">
                                <input type="submit" class="bg-purple btn btn-flat" value="cari">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3>Laporan tersimpan</h3>
                </div>
                <div class="box-body">
                    <!--<table id="example1" class="table table-bordered table-striped">-->
                    <table id="example1" class="display responsive nowrap">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th width="10">Periode</th>
                                <th width="15%">Nama petugas</th>
                                <th width="15%">Kredit</th>
                                <th width="15%">Debit</th>
                                <th width="15%">Sisa</th>
                                <th width="5%" align="center">status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($rekap):?>
                                <?php 
                                $no = 1;
                                foreach($rekap as $k):?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $k->periode ?></td>
                                        <td><?= $k->nama_petugas ?></td>
                                        <td><?= "Rp ".number_format ($k->kredit, 2, ',', '.') ?></td>
                                        <td><?= "Rp ".number_format ($k->debit, 2, ',', '.') ?></td>
                                        <td><?= "Rp ".number_format ($k->sisa, 2, ',', '.') ?></td>
                                        <td>
                                        <?php switch ($k->validasi) {
                                            case 0:
                                                echo '<span class="label label-warning">belum divalidasi</span>';
                                                break;
                                            default:
                                                echo '<span class="label label-success">tervalidasi</span>';
                                                break;
                                        } ?>
                                        </td>
                                    </tr>

                                <?php $no++; endforeach?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


