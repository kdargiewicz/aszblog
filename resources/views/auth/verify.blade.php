<h2>Potwierdź swój adres e-mail</h2>
<p>Sprawdź swoją skrzynkę – wysłaliśmy link weryfikacyjny na adres: {{ auth()->user()->email }}.</p>

<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">Wyślij ponownie</button>
</form>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Wyloguj</button>
</form>

<script>
    setInterval(async () => {
        try {
            const response = await fetch("{{ route('api.check-verification') }}", {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (response.ok) {
                const json = await response.json();
                if (json.verified) {
                    window.location.href = "{{ route('dashboard') }}";
                }
            }
        } catch (error) {
            console.error("Błąd sprawdzania weryfikacji:", error);
        }
    }, 5000); // co 5 sekund
</script>
