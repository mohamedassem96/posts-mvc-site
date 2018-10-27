<?php require APPROOT . '/views/include/header.php'; ?>

<div class="row">

    <div class="col-md-4 col-md-offset-4">
        <br>
        <a class="btn btn-default" href="<?=URLROOT?>posts"> <i class="glyphicon glyphicon-backward"></i> Back</a>
        <br>
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="panel-title">
                    <h2 class="text-center">Edit Post</h2>
                </span>

            </div>

            <div class="panel-body">

                <form action="<?=URLROOT?>posts/edit/<?=$data['id']?>" method="post">


                    <div class="form-group">


                        <div class="input-group input-group-lg">

                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </span>

                            <input type="text" class="form-control <?= (empty($data['title_err']))?'':'custom_err'?>" id="title" name="title" value="<?= $data['title'] ?>" placeholder="Title">
                        </div>
                        <span class="text-danger"><?= $data['title_err']?></span>
                    </div>


                    <div class="form-group">

                        <div class="input-group input-group-lg">

                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </span>
                            <textarea  class="form-control <?= (empty($data['body_err']))?'':'custom_err'?>" id="body" name="body"><?= $data['body']?></textarea>
                        </div>

                        <span class="text-danger"><?= $data['body_err']?></span>
                    </div>


                    <div class="row">

                        <div class="col">
                            <input type="submit" value="Edit Post" class="btn btn-primary btn-block">
                        </div>

                        <!--                        <div class="col">-->
                        <!--                            <a href="--><?//=URLROOT?><!--/users/register" class="btn btn-link btn-block">Don't Have an account? register</a>-->
                        <!--                        </div>-->

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/include/footer.php'; ?>
