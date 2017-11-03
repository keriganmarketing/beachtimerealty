<div class="card mini-agent" >
    <div class="card-image embed-responsive embed-responsive-4by3">
        <a href="<?= $community['link']; ?>" >
        <img class="card-img-top embed-responsive-item" src="<?= $community['photo']!='' ? $community['photo'] : '/wp-content/themes/kstrap/img/agent-placeholder.jpg'; ?>" alt="<?= $community['title']; ?>" >
        </a>
    </div>
    <div class="card-block">
        <h4 class="card-title"><?= $community['title']; ?></h4>
    </div>
    <div class="card-footer">
        <a href="<?= $community['link']; ?>" class="btn btn-primary btn-rounded">view properties</a>
    </div>
</div>