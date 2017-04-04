<div class="page-header">
</div>

<?= $this->getContent() ?>

<div class="jumbotron">
    <h1>Internal Error</h1>
    <p>Something went wrong, if the error continue please contact us</p>
    <p><?= $this->tag->linkTo(['index', 'Back to MyDoctor', 'class' => 'btn btn-primary']) ?></p>
</div>
