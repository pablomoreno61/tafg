<div class="row">
{% for userMedal in userMedals %}
    <div class="col-md-4">
        <a href="#" class="thumbnail">
        {% if userMedal['isEarned'] %}
            <img src="/assets-csp/modules/gamification/img/medal.jpg" width="100" height="100" />
        {% else %}
            <img src="/assets-csp/modules/gamification/img/medal-off.jpg" width="100" height="100" />
        {% endif %}
        </a>
        {{ userMedal['medal'].getText() }}
    </div>
{% endfor %}
</div>