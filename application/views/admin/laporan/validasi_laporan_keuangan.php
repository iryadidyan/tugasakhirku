<div class="flashdata" data-flashdata="<?= $this->session->flashdata('flashdata_validasi'); ?>"></div>
<div class="box-body">
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
                                <th width="10%" align="center">Aksi</th>
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
                                        <td>
                                        <?php switch ($k->validasi) {
                                                case 0:
                                                    echo '<div >
                                                        <div class="btn-group">
                                                            <a class="btn-flat btn-success btn" href="'.base_url().'validasi/aktivasi/'.$k->id_rekap.'">validasi</a>
                                                        </div>
                                                    </div>';
                                                    break;
                                                
                                                default:
                                                    echo '<div >
                                                        <div class="btn-group">
                                                            <a class="btn-flat btn-danger btn" href="'.base_url().'validasi/nonaktivasi/'.$k->id_rekap.'">nonaktif</a>
                                                        </div>
                                                    </div>';
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


