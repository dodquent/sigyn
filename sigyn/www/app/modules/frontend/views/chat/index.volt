<h1>Messagerie</h1>
<div id="messages"></div>

{{ content() }}


<div class="col-md-3" style="margin-top: 20px;">
    <ul class="list-group" id="patients">
            {% for patient in PATIENTS %}
            <li class="list-group-item" value={{ patient.id }}>
                {{ patient.name|e }}                
            </li>
        {% endfor %}
    </ul>
</div>

<div class="col-md-9" style="margin-top: 20px;">
    <ul class="list-group" id="message">
        {% for message in MESSAGES %}
        <li class="list-group-item" value={{ message.text }}>
            {{ message.text|e }}
            {{ message.date }}
        </li>
        {% endfor %}
    </ul>
</div>

{{ form("chat/sendMessage") }}

<div class="col-md-9" style="margin-top: 20px;">
    <div class="form-group">
        <input type="text" class="form-control" id="message" name="message" placeholder="Your message">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

{{ endForm() }}


<ul class="list-group" id="messages">
</ul>



<script type="text/javascript">
    var conn = new WebSocket('ws://{{HTTP_HOST}}:{{WEBSOCKET_PORT}}');
    var receiver = null;

    conn.addEventListener('open', function(e) {
        addMessage("Connection established!");
    });
</script>