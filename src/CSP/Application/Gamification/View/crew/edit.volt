<h2>EDITAR TRIPULACIÓ</h2>

<div class="alert alert-danger fade in hide" id="alert-message">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Compte!</strong> La tripulació introduida ja existeix
</div>
<form class="form-sign" id="profile-form" method="post" action="{{ url('/crew/save') }}" enctype="multipart/form-data">
    <h2 class="form-sign-heading">Personalitza la teva tripulació</h2>
    <label for="text">Nom</label>
    <input type="text" name="text" id="text" class="form-control" placeholder="Nom" autofocus value="{{ crew.getText() }}">
    <label for="logo">Logo</label>
    {% if crew.getLogo() %}
        <a href="#" class="thumbnail"><img src="/uploads/crews/dev/{{ crew.getLogo() }}" width="100" height="100" /></a>
    {% endif %}
    <input type="file" name="logo" id="logo" autofocus><br>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Actualitza</button>
</form>