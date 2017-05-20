<div class="alert alert-danger fade in hide" id="alert-message">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Compte!</strong> L'usuari introduït no existeix
</div>
<form class="form-sign" id="login-form">
    <h2 class="form-sign-heading">Entra al TFG</h2>
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="Adreça e-mail" required autofocus>
    <label for="password">Contrasenya</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Contrasenya" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sessió</button>
    Si encara no tens usuari, <a href="{{ url('signup') }}">registra't aquí</a>
</form>