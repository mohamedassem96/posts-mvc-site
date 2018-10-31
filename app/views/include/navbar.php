<nav class="nav navbar-inverse" role="navigation">

    <div class="container">

        <div class="nav navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="<?= URLROOT ?>">
                <?= SITENAME ?>
            </a>
        </div>

        <div id="collapse" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?= URLROOT ?>">Home</a></li>
                <li><a href="<?=URLROOT?>pages/about">About</a></li>
                <li><a href="<?=URLROOT?>posts">Posts</a></li>

                <?php if (isset($_SESSION['user_id'])): ?>

                <li id="user"><a href=""><?= $_SESSION['user_name']?></a></li>
                <li><a href="<?=URLROOT?>users/logout">Logout</a></li>

                <?php else: ?>

                <li id="user"><a href="<?=URLROOT?>users/register">Register</a></li>
                <li><a href="<?=URLROOT?>users/login">Login</a></li>

                <?php endif; ?>

            </ul>
        </div>
    </div>

</nav>
