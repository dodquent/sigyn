<div class="page-header">
    <h1>Create an account</h1>
    <p>Configure your account in a few clics and get started with MyDoctor straight away.</p>
</div>

<?= $this->getContent() ?>

<?= $this->tag->form(['register/create']) ?>
    <div class="form-group has-feedback">
        <label for="email">Email</label>
        <input required name="email" type="email" class="form-control" id="email" placeholder="Email Address">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <p class="help-block">We'll never reveal your personnal details.</p>
    </div>
    <div class="form-group has-feedback">
        <label for="password">Password</label>
        <input required name="password" type="password" class="form-control" id="password" placeholder="Your password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <label for="confirmPassword">Password confirmation</label>
        <input required name="confirmPassword" type="password" class="form-control" id="confirmPassword" placeholder="Please confirm your password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div style="text-align: center">
        <button style="width: 42%" type="submit" class="btn btn-success">Create !</button>
    </div>
<?= $this->tag->endform() ?>
