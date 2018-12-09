<?php require APPROOT . '/views/include/header.php'; ?>

<?= flash(); ?>

<div class="row">

    <div class="col-md-6">
        <h1>Posts</h1>
    </div>

    <br>

    <div class="col-md-6">

        <a href="/posts/add" class="btn btn-primary">
        <i class="glyphicon glyphicon-pencil"></i> Add Post
        </a>
    </div>
</div>

<?php foreach($data['posts'] as $post): ?>

    <div class="thumbnail">
        <div class="caption">
            <h4> <?= $post->title ?> </h4>
        </div>

        <div>
            Written By: <?= $post->writer_name ?> on <?= $post->posts_time ?>
        </div>

        <p>
            <?= $post->body ?>
        </p>

        <a class="btn btn-info" href="<?= URLROOT ?>posts/show/<?=$post->id ?>"> More ..</a>
    </div>

<?php endforeach; ?>


<?php require APPROOT . '/views/include/footer.php'; ?>