@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<h2>Logowanie</h2>
<form method="POST" action="{{ route('login') }}">
    @csrf

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Hasło</label>
    <input type="password" name="password" id="password" required>

    <button type="submit">Zaloguj</button>
</form>

<div style="margin-top: 1rem;">
    <a href="{{ route('password.request') }}">Odzyskaj konto / Nie pamiętasz hasła?</a>
</div>
