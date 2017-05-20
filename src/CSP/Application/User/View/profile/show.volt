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
            <img src="https://s-media-cache-ak0.pinimg.com/736x/d6/84/0d/d6840d9e413c59fab3d9c843518fe351.jpg" width="100" height="100" />
        {% else %}
            <img src="/uploads/avatars/dev/"{{ user.getAvatar() }}" />
        {% endif %}
    </div>
    <div style="width: 80%">
        <p>{{ user.getRank().getText() }}</p>
        Progrés
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="{{ user.getRankProgress() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ user.getRankProgress() }}%;">
                {{ user.getRankProgress() }}
            </div>
        </div>
        <p>En actiu des de: {{ user.getCreatedAt().format('d/m/Y H:i') }}</p>
    </div>
</div>

<br clear="all" />

<h3>Classificació</h3>

<h3>Medalles</h3>