<h2>Ustaw nowe hasło</h2>

<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <label for="password">Nowe hasło:</label>
    <input type="password" name="password" required>

    <label for="password_confirmation">Powtórz hasło:</label>
    <input type="password" name="password_confirmation" required>

    <button type="submit">Zmień hasło</button>
</form>
