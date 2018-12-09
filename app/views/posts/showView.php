<?php require APPROOT . '/views/include/header.php'; ?>

<a class="btn btn-default" href="<?=URLROOT?>posts"> <i class="glyphicon glyphicon-backward"></i> Back</a>

<?//= var_dump($data) ?>


<div class="caption">
    <h4> <?= $data['post']->title ?> </h4>
</div>

<div>
    Written By: <?= $data['post']->writer_name ?> on <?= $data['post']->posts_time ?>
</div>

<p>
    <?= $data['post']->body ?>
</p>


<?php if($data['post']->user_id == $_SESSION['user_id']): ?>

<a class="btn btn-default" href="<?=URLROOT?>posts/edit/<?= $data['post']->id ?>"> Edit </a>

<a class="btn btn-danger" href="<?=URLROOT?>posts/delete/<?= $data['post']->id ?>"> Delete </a>

<?php endif; ?>

<?php require APPROOT . '/views/include/footer.php'; ?>
