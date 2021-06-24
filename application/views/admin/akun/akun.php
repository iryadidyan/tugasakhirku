<div class="flashdata" data-flashdata="<?= $this->session->flashdata('update_akun'); ?>"></div>
<?php if(validation_errors()): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <?= validation_errors();?>
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
    <div class="col-xs-8">
        <div class="box">
            <br>
            <div class="box-header">
                <div class="btn-group mt-5">
                    <a type="button" class="btn btn-block btn-primary btn-flat" data-toggle="modal" data-target="#modal-add">Tambah</a>
                </div>
            </div>
            <div class="box-body">
                <table id="example1" class="display responsive nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th width="5%">NO</th>
                        <th width="10%">id.</th>
                        <th width="15%">Nama akun</th>
                        <th width="5%">Status</th>
                        <th width="10%" align="right">AKSI</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; foreach ($akun as $key): ?>
                        <tr>
                            <td> <?= $no; ?></td>
                            <td> <?= $key->id_akun; ?></td>
                            <td> <?= $key->nama_akun; ?></td>
                            <td>
                            <?php switch ($key->status) {
                                    case 0:
                                        # code...
                                        echo '<span class="label label-danger">nonaktif</span>';
                                        break;
                                    
                                    default:
                                        # code...
                                        echo '<span class="label label-success">aktif</span>';
                                        break;
                                } ?>    
                            </td>
                            <td>
                                <?php switch ($key->status) {
                                    case 0:
                                        # code...
                                        echo '<div >
                                                
                                            <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                                                aksi
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="'.base_url().'akun/aktivasi/'.$key->id_akun.'">aksivasi</a></li>
                                                <li><a onclick="return confirm(`yakin, akan menghapus akun ini ?`)" href="'.base_url().'akun/hapus/'.$key->id_akun.'">hapus</a></li>
                                            </ul>
                                            </div>
                                        </div>';
                                        break;
                                    
                                    default:
                                        # code...
                                        echo '<div >
                                            <div class="btn-group">
                                            <button type="button" class="btn bg-purple btn-sm dropdown-toggle" data-toggle="dropdown">
                                                aksi
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a onclick="return confirm(`yakin, akan menonaktifkan akun ini ?`)" href="'.base_url().'akun/blokir/'.$key->id_akun.'">blokir</a></li>
                                                <li><a onclick="return confirm(`yakin, akan menghapus akun ini ?`)" href="'.base_url().'akun/hapus/'.$key->id_akun.'">hapus</a></li>
                                            </ul>
                                            </div>
                                        </div>';
                                        break;
                                } ?>
                            </td>
                        </tr>  
                    <?php $no++; endforeach; ?>
                    </tbody>
                </table>
            </div>
                <!-- /.box-body -->
        </div>
    </div>
    <div class="modal modal-default fade" id="modal-add">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Form tambah akun</h4>
                </div>
                <div class="modal-body">
                    <form id="form_transaksi" role="form" method="post" action="<?= base_url(); ?>akun/tambah">
                        <div class="form-group">
                            <label for="modal_id_akun">ID Akun</label>
                            <input type="text" name="id_akun" class="form-control" id="modal_id_akun" placeholder="Masukan id_akun">
                        </div>
                        <div class="form-group">
                            <label for="nama_akun">Nama Akun</label>
                            <input type="text" name="nama_akun" class="form-control" id="nama_akun" placeholder="Masukan nama_akun">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>



