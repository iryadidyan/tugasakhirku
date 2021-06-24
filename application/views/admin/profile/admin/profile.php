<div class="flashdata" data-flashdata="<?= $this->session->flashdata('update_profil'); ?>"></div>

<?php if(validation_errors()):?>
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
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="<?= base_url(); ?>img/<?= $this->session->userdata('gambar'); ?>" alt="User profile picture">
            <h3 class="profile-username text-center"><?= $this->session->userdata('nama'); ?></h3>
            <p class="text-muted text-center"><?= $this->session->userdata('status')."(".$this->session->userdata('username').")"; ?></p>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
        <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">About Me</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <strong><i class="fa fa-at margin-r-5"></i> Email</strong>
            <p class="text-muted">
             <?= $this->session->userdata('email'); ?>
            </p>
            <hr>
            <strong><i class="fa fa-calendar margin-r-5"></i>Mulai kerja</strong>
            <p class="text-muted"><?= date('d M Y',strtotime($this->session->userdata('tanggal'))); ?></p>

        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
            <li><a href="#ubahpasword" data-toggle="tab">ubah pasword</a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="settings">
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?= base_url(); ?>profile/update_petugas">
                <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Nama</label>

                <div class="col-sm-10">
                    <input name="nama" type="text" value="<?= $this->session->userdata('nama'); ?>" class="form-control" id="inputName" placeholder="Name">
                </div>
                </div>
                <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-10">
                    <input name="email" type="email" value="<?= $this->session->userdata('email'); ?>" class="form-control" id="inputEmail" placeholder="Email">
                </div>
                </div>
                <div class="form-group">
                <label for="file" class="col-sm-2 control-label">Foto</label>

                <div class="col-sm-10">
                    <input type="file" name="foto" class="form-control" id="file" placeholder="file gambar">
                </div>
                </div>

                <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Update</button>
                </div>
                </div>
            </form>
            </div>
            <div class="tab-pane" id="ubahpasword">
            <form class="form-horizontal">
                <div class="form-group">
                <label for="oldpassword" class="col-sm-3 control-label">Pasword Lama</label>
                <div class="col-sm-9">
                    <input type="password" name="oldpassword" class="form-control" id="oldpassword" placeholder="Masukan Pasword Lama">
                </div>
                </div>
                <div class="form-group">
                <label for="newpassword" class="col-sm-3 control-label">Pasword Baru</label>

                <div class="col-sm-9">
                    <input type="password" name="newpassword" class="form-control" id="newpassword" placeholder="Masukan Pasword Baru">
                </div>
                </div>
                <div class="form-group">
                <label for="confirmpassword" class="col-sm-3 control-label">Konfirmasi Pasword Baru</label>

                <div class="col-sm-9">
                    <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Konfirmasi Pasword Baru">
                </div>
                </div>

                <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-danger">Update</button>
                </div>
                </div>
            </form>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->