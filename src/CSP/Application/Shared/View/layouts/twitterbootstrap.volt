<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TFG</title>
    {{ stylesheet_link('assets-csp/plugins/bootstrap/css/bootstrap.min.css') }}

    {{ assets.outputCss() }}
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">TFG Consupermiso</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <form class="navbar-form navbar-right">
                {% if session.has("user")  %}
                    <div class="form-group">
                        <a href="{{ url('logout') }}" class="btn btn-success">Sortir</a>
                    </div>
                {% else %}
                    <div class="form-group">
                        <a href="{{ url('login') }}">Inicia sessió</a>
                    </div>
                    o
                    <div class="form-group">
                        <a href="{{ url('signup') }}" class="btn btn-success">Registra't</a>
                    </div>
                {% endif %}
                </form>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron"></div>

    <div class="container">
        <div class="row">
            {% if session.has("user")  %}
                <div class="col-md-2">
                    <ul class="list-group">
                        <li class="list-group-item"><a href="{{ url('mission/index') }}">Poker</a></li>
                        <li class="list-group-item"><a href="{{ url('medal/show-earned-medals') }}">Medaller</a></li>
                        <li class="list-group-item"><a href="{{ url('leader-board/list-players') }}">Classificació</a></li>
                        <li class="list-group-item"><a href="{{ url('crew/find-crew') }}">Tripulació</a></li>
                        <li class="list-group-item"><a href="{{ url('reward/user-balance') }}">Saldo</a></li>
                    </ul>
                </div>
            {% endif %}
            <div class="col-md-10">
                {{ get_content() }}
            </div>
        </div>

        <hr>

        <footer>
            <p>&copy; 2017 TFG, Inc.</p>
        </footer>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{ javascript_include('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') }}
    {{ javascript_include('assets-csp/plugins/bootstrap/js/bootstrap.min.js') }}

    {{ assets.outputInlineJs() }}
    {{ assets.outputJs() }}
</body>
</html>