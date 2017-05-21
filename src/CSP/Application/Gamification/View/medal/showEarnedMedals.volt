<div class="row">
{% if userMedals|length > 0 %}
    {% for userMedal in userMedals %}
        <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                {% if userMedal['isEarned'] %}
                    <img src="/assets-csp/modules/gamification/img/medal.jpg" width="100" height="100" />
                {% else %}
                    <img src="/assets-csp/modules/gamification/img/medal-off.jpg" width="100" height="100" />
                {% endif %}
                <div class="caption">
                    <p>{{ userMedal['medal'].getText() }}</p>
                </div>
            </div>
        </div>
    {% endfor %}
{% else %}
    Encara no hi han medalles guanyades
{% endif %}
</div>