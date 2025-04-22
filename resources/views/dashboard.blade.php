no to jestem zalogowany / zarejestrowany -> to musi byc jakies główne okno aplikacji?

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Wyloguj</button>
</form>
