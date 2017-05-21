<h2>TRIPULACIÓ</h2>

<div>
    {% if not crew %}
    <a href="{{ url('/crew/edit') }}">Crear tripulació</a>
    {% else %}
        <div style="width: 20%; float: left">
            {% if crew.getLogo() %}
                <a href="#" class="thumbnail"><img src="/uploads/crews/dev/{{ crew.getLogo() }}" width="100" height="100" /></a>
            {% endif %}
        </div>
        <div style="width: 80%">
            <p>{{ crew.getText() }}
                {% if (session.user.getId() == crew.getUser().getId()) %}
                    <a href="/crew/edit?id={{ crew.getId() }}">Editar</a>
                {% endif %}
            </p>
            <p>Data de fundació: {{ crew.getCreatedAt().format('d/m/Y H:i') }}</p>
            <p>Data d'últim allistament: {{ crew.getLatestEnrollmentAt().format('d/m/Y H:i') }}</p>
        </div>
    {% endif %}
</div>

<br clear="all">

<h3>COMPONENTS</h3>

<div>
    {% if crewMembers|length > 0 %}
        <table class="table">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Tripulant</th>
                    <th>Nivell</th>
                    <th>Punts</th>
                </tr>
            </thead>
            <tbody>
                {% for crewMember in crewMembers %}
                    <tr>
                        <td>
                            {% if crewMember.getUser().getAvatar() is empty %}
                                <img src="/assets-csp/modules/gamification/img/avatar.jpg" width="50" height="50" />
                            {% else %}
                                <img src="/uploads/avatars/dev/{{ crewMember.getUser().getAvatar() }}" width="50" height="50" />
                            {% endif %}
                        </td>
                        <td>
                            <a href="{{ url('/profile/show?id=' ~ crewMember.getUser().getId()) }}">
                                {% if crewMember.getUser().getNickname() is empty %}
                                    {{ crewMember.getUser().getEmail() }}
                                {% else %}
                                    {{ crewMember.getUser().getNickname() }}
                                {% endif %}
                            </a>
                        </td>
                        <td>{{ crewMember.getUser().getRank().getText() }}</td>
                        <td>{{ crewMember.getUser().getRankScore() }}</td>
                    </tr>
                {% endfor %}
            </tbody>
        </table>
    {% else %}
        No hi ha tripulants a bord
    {% endif %}
</div>