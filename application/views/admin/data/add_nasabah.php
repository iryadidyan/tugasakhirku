
<div class="box-body">
<div class="flashdata" data-flashdata="<?= $this->session->flashdata('aktivasi'); ?>"></div>

<?php if(validation_errors()): ?>
    <div class="row">
        <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    <?= validation_errors();?>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

    <div class="row">
        <div class="col-md-8">
            <form action="post" class="form-horizontal" id="myForm" role="form" method="post" accept-charset="utf-8">
                <div class="form-group">
                    <label class="control-label col-md-5">NIK / NO. KARTU PELAJAR</label>
                    <div class="col-md-7">
                    <input name="no_nik" onkeyup="this.value = this.value.toUpperCase()" class="form-control" >
                    <input name="tgl_gabung"  type="hidden" value ="<?php echo date('d-m-Y')?>" class="form-control" >
                    <input name="no_rekening" type="hidden" class="form-control" value="<?= $this->Nasabah->token(); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-5">NAMA LENGKAP</label>
                    <div class="col-md-7">
                    <input name="nama" onkeyup="this.value = this.value.toUpperCase()" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-5">TEMPAT  DAN TANGGAL LAHIR</label>
                    <div class="form-inline">
                        <div class="col-md-2">
                            <input name="tmp_lahir" placeholder="Tempat Lahir" id="tmpt_lahir" onkeyup="this.value = this.value.toUpperCase()" class="form-control">
                        </div>
                        <div class="col-md-2 col-md-offset-1">
                            <input id="datepicker" placeholder="Tanggal Lahir" name="tgllahir" type="text" class="form-control " >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-5" for="Select">JENIS KELAMIN</label>
                    <div class="col-md-7">
                    <select name="j_kel" id="Select" class="form-control">
                        <option value='L'>LAKI-LAKI</option>
                        <option value='P'>PEREMPUAN</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-5">NAMA IBU</label>
                    <div class="col-md-7">
                    <input name="ibu_kandung" onkeyup="this.value = this.value.toUpperCase()" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-5" for="Select">AGAMA</label>
                    <div class="col-md-7">
                    <select name="agama" id="Select" class="form-control">
                        <option value='ISLAM'>ISLAM</option>
                        <option value='KATOLIK'>KATOLIK</option>
                        <option value='HINDU'>HINDU</option>
                        <option value='BUDHA'>BUDHA</option>
                        <option value='KONGHUCU'>KONGHUCU</option>
                    </select>
                    </div>
                </div>
            <div class="form-group">
                <label class="control-label col-md-5">Email</label>
                <div class="col-md-7">
                <input name="Email" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-5">NO. HANDPHONE</label>
                <div class="col-md-7">
                <input name="no_hp" onkeyup="this.value = this.value.toUpperCase()" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-5">ALAMAT LENGKAP</label>
                <div class="col-md-7">
                <input name="alamat" onkeyup="this.value = this.value.toUpperCase()" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-5" for="Select">PEKERJAAN</label>
                <div class="col-md-7">
                <select name="pekerjaan" id="Select" class="form-control">
                    <option value='KARYAWAN'>KARYAWAN</option>
                    <option value='P1'>PELAJAR - AP</option>
                    <option value='P2'>PELAJAR - AK</option>
                    <option value='P3'>PELAJAR - BB</option>
                    <option value='P4'>PELAJAR - TKR</option>
                    <option value='P4'>PELAJAR - TKR</option>
                    <option value='P5'>PELAJAR - TSM</option>
                    <option value='P6'>PELAJAR - TKJ</option>
                </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5 col-md-offset-5">
                    <button type="submit" class="btn btn-flat btn-primary">Simpan nasabah
                    </button>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>


