<h2>
    VEURE PERFIL PÚBLIC DE
    {% if user.getNickname() is empty %}
        usuari{{ user.getId() }}
    {% else %}
        {{ user.getNickname() }}
    {% endif %}
</h2>

<div>
    <div style="width: 20%; float: left">
        {% if user.getAvatar() is empty %}
            <img src="/assets-csp/modules/gamification/img/avatar.jpg" width="100" height="100" />
        {% else %}
            <img src="/uploads/avatars/dev/{{ user.getAvatar() }}" width="100" height="100" />
        {% endif %}
    </div>
    <div style="width: 80%">
        <p>{{ user.getRank().getText() }}</p>
        Progrés
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="{{ user.getRankProgress() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ user.getRankProgress() }}%;">
                {{ user.getRankProgress() }}%
            </div>
        </div>
        <p>En actiu des de: {{ user.getCreatedAt().format('d/m/Y H:i') }}</p>
    </div>
</div>

<br clear="all" />

<h3>Posicions</h3>

{% for leaderBoardPlayer in user.getLeaderBoardPlayers() %}
    {{ leaderBoardPlayer.getLeaderBoard().getText() }}: {{ leaderBoardPlayer.getCurrentPosition() }}
{% endfor %}

<h3>Medalles</h3>

<div class="row">
    {% if user.getEarnedMedals()|length > 0 %}
        {% for earnedMedal in user.getEarnedMedals() %}
            <div class="col-md-4">
                <a href="#" class="thumbnail">
                    <img src="/assets-csp/modules/gamification/img/medal.jpg" width="100" height="100" />
                </a>
                {{ earnedMedal.getMedal().getText() }}
            </div>
        {% endfor %}
    {% else %}
        Encara no hi han medalles guanyades
    {% endif %}
</div>