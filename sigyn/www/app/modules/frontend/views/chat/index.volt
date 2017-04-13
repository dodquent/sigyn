<h1>Websocket Chat Server</h1>
<div id="messages"></div>

{{ content() }}


<ul class="list-group" id="patients">
        {% for patient in PATIENTS %}
        <li class="list-group-item" value={{ patient.id }}>
            {{ patient.email|e }}
        </li>
    {% endfor %}
</ul>

{{ form("chat/sendMessage") }}

    <div class="form-group">
        <label for="">Message</label>
        <input type="text" class="form-control" id="message" name="message" placeholder="Your message">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>

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