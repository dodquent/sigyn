<div class="page-header">
    <h1>Create an account</h1>
    <p>Configure your account in a few clics and get started with Sigyn straight away.</p>
</div>

{{ content() }}

{{ form("register/create") }}
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
        <div class="form-group">
            <label for="type">Account type</label>
            <div class="radio">
                <label class="radio-inline">
                    <input id='pro' type="radio" name="type" value="pro" checked> Professional
                </label>
                <label class="radio-inline">
                    <input id='patient' type="radio" name="type" value="patient"> Patient
                </label>
            </div>
        </div>
        <div id="listType" class="form-group has-feedback">
            <label for="pro_type">Account type</label>
            <select class="form-control" name="pro_type" id="pro_type">
                <option value="generalist">Generalist</option>
                <option value="nutritionnist">Nutritionnist</option>
                <option value="dentist">Dentist</option>
            </select>
            <p class="help-block">Choose your specification</p>
        </div>
    <div style="text-align: center">
        <button style="width: 42%" type="submit" class="btn btn-success">Create !</button>
    </div>
{{ endForm() }}

<script>
    var listType = document.getElementById('listType');
    var pro = document.getElementById('pro');
    var patient = document.getElementById('patient');

    pro.addEventListener('click', (e) => { listType.classList.remove('hide'); });
    patient.addEventListener('click', (e) => { listType.classList.add("hide"); });
    
</script>
