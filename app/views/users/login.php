<?php require APPROOT . '/views/include/header.php'; ?>

<div class="row">

    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title">
                    <h2 class="text-center">Login</h2>
                </span>

            </div>

            <?= flash() ?>

            <div class="panel-body">

                <form action="<?=URLROOT?>users/login" method="post">


                    <div class="form-group">


                        <div class="input-group input-group-lg">

                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </span>

                            <input type="email" class="form-control <?= (empty($data['email_err']))?'':'custom_err'?>" id="email" name="email" value="<?= $data['email'] ?>" placeholder="Email">
                        </div>
                        <span class="text-danger"><?= $data['email_err']?></span>
                    </div>


                    <div class="form-group">

                        <div class="input-group input-group-lg">

                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </span>
                            <input type="password" class="form-control <?= (empty($data['password_err']))?'':'custom_err'?>" id="password" name="password" value="<?= $data['password']?>" placeholder="Password">
                        </div>

                        <span class="text-danger"><?= $data['password_err']?></span>
                    </div>


                    <div class="row">

                        <div class="col">
                            <input type="submit" value="Login" class="btn btn-success btn-block">
                        </div>

                        <div class="col">
                            <a href="<?=URLROOT?>/users/register" class="btn btn-link btn-block">Don't Have an account? register</a>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>
