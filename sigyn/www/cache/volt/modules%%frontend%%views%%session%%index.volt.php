<div class="page-header">
    <h1>Login</h1>
</div>

<?= $this->getContent() ?>

<?= $this->flashSession->output() ?>

<?= $this->tag->form(['session/login']) ?>
    <div class="col-md-6">
        <div class="form-group has-feedback">
          <label for="email">Email</label>
          <input name="email" type="email" class="form-control" id="email" placeholder="Email Address">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group has-feedback">
          <label for="password">Password</label>
          <input name="password" type="password" class="form-control" id="password" placeholder="Your password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
    </div>
    <div style="text-align: center">
        <button style="width: 42%" type="submit" class="btn btn-success">Login</button>
    </div>
<?= $this->tag->endform() ?>