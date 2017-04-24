<div class="page-header">
    <h1>Patients</h1>
</div>

{{ content() }}

{{ flashSession.output() }}


<div class="row container">
    
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <button type="button" data-toggle="modal" data-target="#modalPatient" class="btn btn-success">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Patient
        </button>
    </div>

    <div class="col-md-3" style="margin-top: 20px;">
        <ul class="list-group">
            {% for patient in patientsList %}
                <li class="list-group-item">{{ patient.name ~ ' ' ~ patient.firstname }}</li>
            {% endfor %}
        </ul>
    </div>
    
    
</div>

<!-- Modal -->
<div id="modalPatient" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New patient</h4>
            </div>
            <div class="modal-body">
                {{ form("patients/create") }}
                    <div class="form-group">
                        <label for="firstname">First name</label>
                        <input required name="firstname" type="text" class="form-control" id="firstname" placeholder="First name">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last name</label>
                        <input required name="lastname" type="text" class="form-control" id="lastname" placeholder="Last name">
                    </div>
                    <div class="form-group has-feedback">
                        <label for="email">Email</label>
                        <input required name="email" type="email" class="form-control" id="email" placeholder="Email Address">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        <p class="help-block">Your patient will use it for login.</p>
                    </div>
                    <div style="text-align: center">
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                {{ endForm() }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>