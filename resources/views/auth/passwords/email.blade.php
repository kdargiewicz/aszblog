<h2>Resetowanie hasła</h2>

@if (session('status'))
    <p style="color: green">{{ session('status') }}</p>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <button type="submit">Wyślij link resetujący</button>
</form>
