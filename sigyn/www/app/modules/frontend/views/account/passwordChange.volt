<div class="page-header">
    <h1>Change your password</h1>
    <p>{{ pro.email }}</p>
</div>

{{ content() }}

{{ flashSession.output() }}

{{ form("account/passwordChange/" ~ pro.id) }}
    
    <input type="hidden" name="token" class="form-control" value="{{ token }}">
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
    <div align="center">
        <button style="width: 42%" type="submit" class="btn btn-success">CONFIRM</button>
    </div>
{{ endForm() }}
