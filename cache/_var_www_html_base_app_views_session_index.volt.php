<?= $this->tag->form(['session/login']) ?>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <input type="submit"  class="btn btn-success" value="LOG IN">
<?= $this->tag->endform() ?>