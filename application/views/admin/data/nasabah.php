<div class="flashdata" data-flashdata="<?= $this->session->flashdata('aktivasi'); ?>"></div>

<style>
    .dataTables_filter {
        width: 50%;
        float: right;
        text-align: right;
        margin-right: 30px;
    }
</style>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <br>
            <div class="container">
                <div class="btn-group mt-5">
                    <a href="<?= base_url();?>nasabah/tambah" type="button" class="btn btn-block btn-primary btn-flat">Tambah</a>
                </div>
            </div>
            <div class="box-body">
                <!--<table id="example1" class="table table-bordered table-striped">-->
                <table id="example1" class="display responsive nowrap">
                    <thead>
                        <tr>
                            <th width="5%">NO</th>
                            <th width="10%">NO REK.</th>
                            <th width="15%">NAMA</th>
                            <th width="25%">TMP & TGL. LAHIR</th>
                            <th width="30%">ALAMAT</th>
                            <th width="5%" align="center">STATUS</th>
                            <th width="10%" align="right">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($nasabah as $key): ?>
                            <tr>
                                <td> <?= $no; ?></td>
                                <td> <?= $key->no_rekening; ?></td>
                                <td> <?= $key->nama; ?></td>
                                <td> <?= $key->tmp_lahir."/".date("d-m-Y",strtotime($key->tgl_lahir)); ?></td>
                                <td> <?= $key->alamat; ?></td>
                                <td>
                                    <?php switch ($key->status) {
                                        case 0:
                                            # code...
                                            echo '<span class="label label-warning">non-aktif-app</span>';
                                            break;
                                        
                                        default:
                                            # code...
                                            echo '<span class="label label-success">Active</span>';
                                            break;
                                    } ?>
                                </td> 
                                <td>
                                    <?php switch ($key->status) {
                                        case 0:
                                            # code...
                                            echo '<div >
                                                    
                                                <div class="btn-group">
                                                <button type="button" class="btn btn-flat btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    aksi
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="'.base_url().'nasabah/profile/'.$key->no_rekening.'">profile</a></li>
                                                    <li><a target="_blank" href="'.base_url().'nasabah/tabungan/'.$key->no_rekening.'">print tabungan</a></li>
                                                    <li><a href="'.base_url().'nasabah/aktivasi/'.$key->id_anggota.'">aksivasi</a></li>
                                                </ul>
                                                </div>
                                            </div>';
                                            break;
                                        
                                        default:
                                            # code...
                                            echo '<div >
                                                <div class="btn-group">
                                                <button type="button" class="btn btn-flat bg-purple btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    aksi
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="'.base_url().'nasabah/profile/'.$key->no_rekening.'">profile</a></li>
                                                    <li><a href="'.base_url().'nasabah/tabungan/'.$key->no_rekening.'">print tabungan</a></li>
                                                    <li><a onclick="return confirm(`yakin, mobile app akan dinonaktifkan`)" href="'.base_url().'nasabah/blokir/'.$key->id_anggota.'">blokir</a></li>
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
        </div>
    </div>
</div>

