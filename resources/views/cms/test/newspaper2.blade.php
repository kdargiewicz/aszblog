<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Artykuł – aszblog' }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f9f7f1;
        }

        /* ==== HEADER ==== */
        header {
            background: #f1efe6;
            color: #333;
            padding: 1rem 0;                /* usuwamy duże boczne paddingi */
            display: flex;
            justify-content: center;        /* centrum kontenera */
            position: relative;
        }
        header .inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;              /* szerokość jak content */
            padding: 0 2rem;                /* odsunięcie od samego brzegu */
        }
        header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0; right: 0;
            height: 1px;
            background: linear-gradient(
                to right,
                transparent,
                rgba(0,0,0,0.35),
                transparent
            );
        }

        header .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* ===== MENU / NAV ===== */
        nav ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }
        nav a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
        }

        /* hamburger */
        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            width: 30px;
            gap: 5px;
            z-index: 1001; /* wyższy od menu */
        }
        .menu-toggle span {
            display: block;
            height: 3px;
            width: 100%;
            background: #333;
            border-radius: 3px;
            transition: 0.3s;
        }

        /* mobile menu */
        @media (max-width: 768px) {
            nav {
                overflow: hidden;
                max-height: 0;                  /* niewidoczne w stanie zamkniętym */
                opacity: 0;
                transition: max-height 0.4s ease, opacity 0.3s ease;
                width: 100%;
                background: #f1efe6;
                position: absolute;
                top: 100%;
                left: 0;
                border-top: 1px solid rgba(0,0,0,0.1);
                z-index: 1000;
            }
            nav.active {
                max-height: 400px;              /* wystarczająco, by pomieścić linki */
                opacity: 1;
            }
            nav ul {
                flex-direction: column;
                padding: 1rem;
                gap: 1rem;
            }
            .menu-toggle {
                display: flex;
            }
        }

        .menu-toggle.open span:nth-child(1) {
            transform: rotate(45deg) translateY(8px);
        }
        .menu-toggle.open span:nth-child(2) {
            opacity: 0;
        }
        .menu-toggle.open span:nth-child(3) {
            transform: rotate(-45deg) translateY(-8px);
        }

        /* ==== MAIN ==== */
        main {
            flex: 1;
            max-width: 900px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        main img {
            width: 100%;
            border-radius: 5px;
            margin: 1rem 0;
        }

        /* ==== FOOTER ==== */
        footer {
            background: #f1efe6;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
            margin-top: auto;
            position: relative;
        }
        footer::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0; right: 0;
            height: 1px;
            background: linear-gradient(
                to right,
                transparent,
                rgba(0,0,0,0.35),
                transparent
            );
        }
    </style>
</head>
<body>
<header>
    <div class="inner">
        <div class="logo">Aszblog</div>

        <div class="menu-toggle" id="menuToggle">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <nav id="navMenu">
            <ul>
                <li><a href="#">Mapa</a></li>
                <li><a href="#">Artykuły</a></li>
                <li><a href="#">Pierdoly</a></li>
                <li><a href="#">2137</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <article>
        <h1>{{ $title ?? 'Tytuł artykułu' }}</h1>
        <p><em>Opublikowano: {{ $date ?? '01-03-2024' }}</em></p>

        <img src="https://picsum.photos/900/400" alt="Zdjęcie do artykułu">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur a nisl in augue maximus mollis...</p>
        <img src="https://picsum.photos/800/300" alt="Drugie zdjęcie">
        <p>Ut ac ligula malesuada, interdum mi nec, gravida felis. Phasellus ut turpis quis dui condimentum pellentesque...</p>
    </article>
</main>

<footer>
    <p>&copy; {{ date('Y') }} aszblog – wszystkie prawa zastrzeżone</p>
</footer>

<script>
    const menuToggle = document.getElementById("menuToggle");
    const navMenu = document.getElementById("navMenu");

    menuToggle.addEventListener("click", (e) => {
        e.stopPropagation(); // żeby klik nie leciał dalej
        navMenu.classList.toggle("active");
    });

    // zamykanie przy kliknięciu poza menu
    document.addEventListener("click", (e) => {
        if (navMenu.classList.contains("active")
            && !navMenu.contains(e.target)
            && !menuToggle.contains(e.target)) {
            navMenu.classList.remove("active");
        }
    });

    // klik na link w menu też zwija
    navMenu.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", () => {
            navMenu.classList.remove("active");
        });
    });
</script>
</body>
</html>
