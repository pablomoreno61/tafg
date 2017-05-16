{{ mission.getText()|upper }}
<div class="jumbotron">
    <p>Enregistra't amb dades reals al nostre POKER de campanyes i guanya directament 1€ = 1 punt en el teu menú privat un cop l'anunciant validi els reus registres.</p>

    Finalitza el: {{ mission.getExpireAt().format('d/m/Y H:i') }}
</div>

{% if rewards|length < 4 %}
    <div class="col-md-3">
        <img src="/assets-csp/modules/mission/img/card.png" width="150" /><br>
        <a href="{{ url('/reward/add-user-reward?credits=0.1&name=first_campaign') }}">Campanya 1</a>
    </div>
    <div class="col-md-3">
        <img src="/assets-csp/modules/mission/img/card.png" width="150" /><br>
        <a href="{{ url('/reward/add-user-reward?credits=0.1&name=second_campaign') }}">Campanya 2</a>
    </div>
    <div class="col-md-3">
        <img src="/assets-csp/modules/mission/img/card.png" width="150" /><br>
        <a href="{{ url('/reward/add-user-reward?credits=0.1&name=third_campaign') }}">Campanya 3</a>
    </div>
    <div class="col-md-3">
        <img src="/assets-csp/modules/mission/img/card.png" width="150" /><br>
        <a href="{{ url('/reward/add-user-reward?credits=0.1&name=fourth_campaign') }}">Campanya 4</a>
    </div>
{% else %}
    <h1>Enhorabona! Has completat el poker</h1>
{% endif %}