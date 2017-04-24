<div class="page-header">
    <h1>Configure your account</h1>
    <p>Please choose a password.</p>
</div>

{{ content() }}

{{ flashSession.output() }}

{{ form("patients/patientPassword") }}
    
    <input type="hidden" name="patient_id" id="patient_id" class="form-control" value="{{ patient.id }}">
    
    <div class="form-group">
        <label for="firstname">First name</label>
        <input value="{{ patient.firstname }}" required name="firstname" type="text" class="form-control" id="firstname" placeholder="First name">
    </div>
    <div class="form-group">
        <label for="lastname">Last name</label>
        <input value="{{ patient.name }}" required name="lastname" type="text" class="form-control" id="lastname" placeholder="Last name">
    </div>
    <div class="form-group has-feedback">
        <label for="email">Email</label>
        <input value="{{ patient.email }}" required name="email" type="email" class="form-control" id="email" placeholder="Email Address">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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
        <button style="width: 42%" type="submit" class="btn btn-success">Confirm</button>
    </div>
{{ endForm() }}
