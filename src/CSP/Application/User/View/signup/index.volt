<div class="alert alert-danger fade in hide" id="alert-message">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Compte!</strong> L'usuari introduït ja existeix
</div>
<form class="form-sign" id="signup-form">
    <h2 class="form-sign-heading">Registra't al TFG</h2>
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="Adreça e-mail" required autofocus>
    <label for="password">Contrasenya</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Contrasenya" required>
    <label for="repassword">Repeteix contrasenya</label>
    <input type="password" name="repassword" id="repassword" class="form-control" placeholder="Repteix Contrasenya" required><br>
    <label for="refererEmail">E-mail del afiliador</label>
    <input type="email" name="refererEmail" id="refererEmail" class="form-control" placeholder="Adreça e-mail" required autofocus><br>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Registra't</button>
    Si ja tens usuari, <a href="{{ url('login') }}">inicia sessió aquí</a>
</form>