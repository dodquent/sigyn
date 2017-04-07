<div class="page-header">
    <h1>Login</h1>
</div>

{{ content() }}

{{ flashSession.output() }}

{{ form("session/login", "class": "row") }}
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
    <a href="#" data-toggle="modal" data-target="#modalPassword">Forgotten password ?</a>
{{ endForm() }}


<!-- Modal -->
<div id="modalPassword" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Please enter your email address</h4>
        </div>
        <div class="modal-body">
            {{ form("account/forgottenPassword") }}
                <div class="form-group has-feedback">
                    <label for="emailRecovery">Email</label>
                    <input name="emailRecovery" type="email" class="form-control" placeholder="Your email address">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div style="text-align: center">
                    <button type="submit" class="btn btn-success">SEND</button>
                </div>
            {{ endForm() }}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>