
<div class="flashdata" data-flashdata="<?= $this->session->flashdata('petugas_aktivasi'); ?>"></div>

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
    <div class="col-xs-10">
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
                        <th width="10%">Nama.</th>
                        <th width="15%">Username</th>
                        <th width="20%">Email</th>
                        <th width="20%">Mulai kerja</th>
                        <th width="5%">Status</th>
                        <th width="10%" align="right">AKSI</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no=1; foreach ($petugas as $key): ?>
                        <tr>
                            <td> <?= $no; ?></td>
                            <td> <?= $key->nama_petugas; ?></td>
                            <td> <?= $key->username; ?></td>
                            <td> <?= $key->email; ?></td>
                            <td> <?= date('d M Y',strtotime($key->tanggal_dibuat)); ?></td>
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
                                                <li><a href="'.base_url().'petugas/aktivasi/'.$key->id_petugas.'">aksivasi</a></li>
                                                <li><a onclick="return confirm(`yakin, akan menghapus akun ini ?`)" href="'.base_url().'petugas/hapus/'.$key->id_petugas.'">hapus</a></li>
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
                                                <li><a onclick="return confirm(`yakin, akan menonaktifkan akun ini ?`)" href="'.base_url().'petugas/blokir/'.$key->id_petugas.'">blokir</a></li>
                                                <li><a onclick="return confirm(`yakin, akan menghapus akun ini ?`)" href="'.base_url().'petugas/hapus/'.$key->id_petugas.'">hapus</a></li>
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
                    <h4 class="modal-title">Form tambah petugas</h4>
                </div>
                <div class="modal-body">
                    <form id="form_transaksi" role="form" method="post" action="<?= base_url(); ?>petugas/tambah">
                        <div class="form-group">
                            <label for="modal_username">Username</label>
                            <input type="text" name="username" class="form-control" id="modal_username" placeholder="Masukan username">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukan nama">
                        </div>
                        <div class="form-group">
                            <label for="pasword">pasword</label>
                            <input type="password" name="pasword" class="form-control" id="pasword" placeholder="Masukan pasword">
                        </div>
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Masukan email">
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



