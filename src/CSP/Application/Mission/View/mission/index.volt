{{ mission.getText()|upper }}
<div class="jumbotron">
    <p>Enregistra't amb dades reals al nostre POKER de campanyes i guanya directament 1€ = 1 punt en el teu menú privat un cop l'anunciant validi els reus registres.</p>

    Finalitza el: {{ mission.getExpireAt().format('d/m/Y H:i') }}
</div>

{% if rewards|length < 4 %}
    {% for campaign in campaigns %}
        <div class="col-md-3">
            <img src="/assets-csp/modules/mission/img/card.png" width="150" /><br>
            {% if (campaign['isRewarded']) %}
                {{ campaign['title'] }} [COMPLETADA]
            {% else %}
                <a href="/reward/add-user-reward?credits={{ campaign['credits']}}&name={{ campaign['name'] }}">{{ campaign['title'] }}</a>
            {% endif %}
        </div>
    {% endfor %}
{% else %}
    <h1>Enhorabona! Has completat el poker</h1>
{% endif %}