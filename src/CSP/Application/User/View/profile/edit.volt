<h2>EDITAR PERFIL</h2>

<div class="alert alert-danger fade in hide" id="alert-message">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Compte!</strong> L'usuari introduït ja existeix
</div>
<a href="{{ url('/profile/show') }}">Veure perfil públic</a>
<form class="form-sign" id="profile-form" method="post" action="{{ url('/profile/save') }}" enctype="multipart/form-data">
    <h2 class="form-sign-heading">Personalitza el teu perfil</h2>
    <label for="nickname">Nickname</label>
    <input type="text" name="nickname" id="nickname" class="form-control" placeholder="Nickname" autofocus value="{{ user.getNickname() }}">
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="Adreça e-mail" required autofocus value="{{ user.getEmail() }}">
    <label for="password">Contrasenya</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Contrasenya">
    <label for="repassword">Repeteix contrasenya</label>
    <input type="password" name="repassword" id="repassword" class="form-control" placeholder="Repteix Contrasenya"><br>
    <label for="avatar">Avatar</label>
    {% if user.getAvatar() %}
        <a href="#" class="thumbnail"><img src="/uploads/avatars/dev/{{ user.getAvatar() }}" width="100" height="100" /></a>
    {% endif %}
    <input type="file" name="avatar" id="avatar" autofocus><br>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Actualitza</button>
</form>