<h2>SALDO</h2>

Número de punts: {{ userBalance }}

<h3>RECOMPENSES</h3>

<div>
    {% if rewards|length > 0 %}
        <table class="table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Punts</th>
                </tr>
            </thead>
            <tbody>
                {% for reward in rewards %}
                    <tr>
                        <td>
                            {{ reward.getCreatedAt().format('d/m/Y H:i') }}
                        </td>
                        <td>
                            {{ reward.getCredits() }}
                        </td>
                    </tr>
                {% endfor %}
            </tbody>
        </table>
    {% else %}
        No hi ha tripulants a bord
    {% endif %}
</div>