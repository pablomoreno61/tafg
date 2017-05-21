<h2>CLASSIFICACIÓ HISTÒRICA PER CRÈDITS</h2>

<div>
    {% if leaderBoardPlayers|length > 0 %}
        <table class="table">
            <thead>
            <tr>
                <th>Posició</th>
                <th>Avatar</th>
                <th>Nickname</th>
                <th>Nivell</th>
                <th>Punts</th>
                <th>Posició anterior</th>
            </tr>
            </thead>
            <tbody>
            {% for player in leaderBoardPlayers %}
                <tr>
                    <td>
                        {{ player.getCurrentPosition() }}
                    </td>
                    <td>
                        {% if player.getUser().getAvatar() is empty %}
                            <img src="/assets-csp/modules/gamification/img/avatar.jpg" width="50" height="50" />
                        {% else %}
                            <img src="/uploads/avatars/dev/{{ player.getUser().getAvatar() }}" width="50" height="50" />
                        {% endif %}
                    </td>
                    <td>
                        {% if player.getUser().getNickname() is empty %}
                            usuari{{ player.getUser().getId() }}
                        {% else %}
                            {{ player.getUser().getNickname() }}
                        {% endif %}
                    </td>
                    <td>
                        {{ player.getUser().getRank().getText() }}
                    </td>
                    <td>
                        {{ player.getCredits() }}
                    </td>
                    <td>
                        {% if player.getLatestPosition() is empty %}
                            -
                        {% else %}
                            {{ player.getLatestPosition() }}
                        {% endif %}
                    </td>
                </tr>
            {% endfor %}
            </tbody>
        </table>
    {% else %}
        No hi ha tripulants a bord
    {% endif %}
</div>