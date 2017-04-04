<div class="page-header">
</div>

<?= $this->getContent() ?>

<div class="jumbotron">
    <h1>Page not found</h1>
    <p>Sorry, you have accessed a page that does not exist or was moved</p>
    <p><?= $this->tag->linkTo(['index', 'Back to MyDoctor', 'class' => 'btn btn-primary']) ?></p>
</div>
