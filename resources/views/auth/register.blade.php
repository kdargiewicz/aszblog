@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<h2>Rejestracja</h2>
<form method="POST" action="{{ route('register') }}">
    @csrf

    <label for="name">Imię</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Hasło</label>
    <input type="password" name="password" id="password" required>

    <label for="password_confirmation">Powtórz hasło</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>

    <label for="token">Token</label>
    <input type="text" name="token" id="token" required>

    <button type="submit">Zarejestruj</button>
</form>
