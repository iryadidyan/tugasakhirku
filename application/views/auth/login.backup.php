<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Login Admin</title>
        <link href="<?= base_url();?>asset/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url();?>asset/css/metisMenu.min.css" rel="stylesheet">
        <link href="<?= base_url();?>asset/css/startmin.css" rel="stylesheet">
        <link href="<?= base_url();?>asset/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body class="bg-primary">
        <div class="container">
            <div class="row">
                <?php if ($this->session->flashdata('gagal')): ?>
                    <div class='col-md-8 col-md-offset-2  alert alert-danger text-center'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        <strong>PERHATIAN!</strong> Username / Parword salah.
                    </div>
                <?php endif ?>
                    
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post" action="login">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    </div>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= base_url();?>asset/js/jquery.min.js"></script>
        <script src="<?= base_url();?>asset/js/bootstrap.min.js"></script>
        <script src="<?= base_url();?>asset/js/metisMenu.min.js"></script>
        <script src="<?= base_url();?>asset/js/startmin.js"></script>
    </body>
</html>
