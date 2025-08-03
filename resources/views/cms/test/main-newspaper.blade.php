<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tryb Gazetowy</title>

    <style>
        /* Globalne resetowanie */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            font-family: "Georgia", "Times New Roman", serif;
            background: url('https://www.transparenttextures.com/patterns/paper-fibers.png');
            background-color: #f3f0e8;
            color: #333;
            line-height: 1.6;
        }

        h1, h2 {
            font-family: "Georgia", serif;
            color: #111;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }

        p {
            text-align: justify;
            margin-bottom: 1.2rem;
        }

        /*ten kod css mam w tinymce.css i stamtad trzeba go wziac*/
        figure.image {
            display: block;
            margin: 0 1.5rem 1rem 0;
            max-width: 45%;
            float: left;
            vertical-align: top;
        }

        figure.image img {
            display: block;
            width: 100%;
            height: auto;
        }

        figure.image figcaption {
            font-size: 0.9em;
            color: #666;
            text-align: center;
            margin-top: 0.3em;
            font-style: italic;
        }

        figure.image-right {
            display: block;
            margin: 0 0 1rem 1.5rem; /* margines z lewej, bo float: right */
            max-width: 45%;
            float: right;
            vertical-align: top;
            box-sizing: border-box;
        }

        figure.image-right img {
            display: block;
            width: 100%;
            height: auto;
        }

        figure.image-right figcaption {
            font-size: 0.9em;
            color: #666;
            text-align: center;
            margin-top: 0.3em;
            font-style: italic;
        }

        /*END ten kod css mam w tinymce.css i stamtad trzeba go wziac*/


        /* Po zdjęciu z lewej, dodajmy clearfix */
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .newspaper {
            max-width: 740px;
            margin: 2rem auto;
            padding: 1.5rem;
            /*background: #ffffff;*/
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            /*margin: 0;*/
            /*padding: 0;*/
            font-family: "Georgia", "Times New Roman", serif;
            background-color: #f7f3e7; /* <-- zmienione na kremowo-żółte */
            color: #333;
            line-height: 1.6;
        }

        /*kreska pozioma -- klikalna*/

        .line-with-symbols {
            position: relative;
            height: 2px;
            background: black;
            margin: 40px 0;
            opacity: 0.3;
            z-index: 0;
        }

        /* Główne klikane linki zawierające symbol i tło */
        .line-link {
            position: absolute;
            top: 0;
            height: 100%;
            width: 10%;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            background: transparent;
            transition: all 0.3s ease;
        }

        /* pozycjonowanie: lewa/prawa */
        .line-link.left {
            left: 0;
        }

        .line-link.right {
            right: 0;
        }

        /* Symbol karo */
        .line-link .symbol {
            font-size: 20px;
            font-weight: bold;
            color: black;
            text-shadow:
                1px 1px 2px rgba(255,255,255,0.8),
                -1px -1px 2px rgba(0,0,0,0.6);
            transition: all 0.3s ease;
        }

        /* Efekty po najechaniu */
        .line-link:hover {
            background-color: rgba(179, 0, 0, 0.4);
            transform: scaleY(1.5);
            cursor: pointer;
        }

        .line-link:hover .symbol {
            transform: scale(2.5);
            color: #b30000;
            text-shadow:
                0 0 6px rgba(179, 0, 0, 0.9),
                0 0 20px rgba(0, 0, 0, 0.4);
        }


        /* TOOLTIPY */
        .line-link::after {
            content: attr(data-tooltip);
            position: absolute;
            top: -2.2em;
            left: 50%;
            transform: translateX(-50%);
            background-color: #222;
            color: #fff;
            font-size: 0.75rem;
            padding: 4px 8px;
            border-radius: 4px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.1s ease-in;
            z-index: 5;
        }

        /* natychmiastowe pojawianie się tooltipów */
        .line-link:hover::after {
            opacity: 1;
        }
        /*end kreska pozioma*/

        /*tytul i data arta*/
        .article-meta {
            font-family: "Georgia", serif;
            font-size: 0.9rem;
            color: #666;
            font-style: italic;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-top: 0.3rem;      /* mniejszy odstęp od h1 */
            margin-bottom: 1.2rem;
            user-select: none;
            text-align: center;      /* wyśrodkowanie */
        }

        .article-meta strong {
            font-style: normal;
            color: #333;
        }

        h1 {
            margin-bottom: 0.5rem;   /* mniejszy odstęp pod tytułem */
        }

        /*END tytul i data arta*/


        /* Mobilki — float off, obrazek full width */
        @media (max-width: 768px) {
            body {
                padding: 0.5rem; /* zmniejszamy padding */
                margin: 0.5rem;  /* zmniejszamy margin */
                box-shadow: none; /* opcjonalnie zostaw lub usuń */
            }

            .newspaper {
                margin: 0;       /* usuwamy margines */
                padding: 1rem;   /* padding w środku zostawiamy */
                max-width: 100%;
                width: auto;
            }

            figure.image {
                float: none;
                display: block;
                margin: 1rem auto;
                max-width: 100%;
            }
        }





        /*main fancy line*/
        .subtle-divider {
            height: 2px;
            width: 90%;
            margin: 2rem auto;
            background: linear-gradient(
                to right,
                transparent,
                rgba(0, 0, 0, 0.3) 25%,
                rgba(0, 0, 0, 0.6) 50%,
                rgba(0, 0, 0, 0.3) 75%,
                transparent
            );
            border-radius: 1px;
        }

        /*menu*/
        .site-header {
            /*background-color: #f7f3e7;*/
            /*border-bottom: 1px solid rgba(0, 0, 0, 0.1);*/
        }

        .nav-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }

        .logo {
            font-family: "Georgia", serif;
            font-size: 1.4rem;
            font-weight: bold;
            color: #333;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            text-decoration: none;
            font-family: "Georgia", serif;
            font-size: 1rem;
            color: #555;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #b30000;
        }

        /* Przycisk burgera (ukryty na desktopie) */
        .nav-toggle {
            display: none;
            font-size: 1.5rem;
            background: none;
            border: none;
            color: #333;
            cursor: pointer;
        }

        /*header test*/
        .site-header {
            background-color: #f7f3e7;
            padding: 1rem 2rem;
        }

        .subtle-divider {
            height: 2px;
            width: 90%;
            margin: 0.5rem auto 0; /* mniejszy margines */
            background: linear-gradient(
                to right,
                transparent,
                rgba(0, 0, 0, 0.2) 30%,
                rgba(0, 0, 0, 0.5) 50%,
                rgba(0, 0, 0, 0.2) 70%,
                transparent
            );
            border-radius: 1px;
            opacity: 0.7;
        }

        /*end header test*/

        /* === Mobile === */
        @media (max-width: 768px) {
            .nav-links {
                position: absolute;
                top: 100%;
                right: 0;
                background-color: #f7f3e7;
                flex-direction: column;
                align-items: flex-end;
                gap: 1rem;
                padding: 1rem 2rem;
                display: none;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .nav-links.show {
                display: flex;
            }

            .nav-toggle {
                display: block;
            }
        }
        /*END menu*/


        @media (max-width: 480px) {
            .subtle-divider {
                margin: 1.5rem auto;
                max-width: 90%;
            }
        }



        /*end main fancy line*/

        .site-header {
            background-color: #f7f3e7;
            padding: 1rem 2rem 0.5rem;
            position: relative;
            border-bottom: 2px solid transparent;
            border-image: linear-gradient(
                to right,
                transparent,
                rgba(0, 0, 0, 0.2) 30%,
                rgba(0, 0, 0, 0.5) 50%,
                rgba(0, 0, 0, 0.2) 70%,
                transparent
            ) 1;
            opacity: 0.7;
        }


        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 90%;
            margin: 0 auto;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: #000;
        }

        .subtle-divider {
            height: 2px;
            width: 90%;
            margin: 0.5rem auto 0;
            background: linear-gradient(
                to right,
                transparent,
                rgba(0, 0, 0, 0.2) 30%,
                rgba(0, 0, 0, 0.5) 50%,
                rgba(0, 0, 0, 0.2) 70%,
                transparent
            );
            border-radius: 1px;
            opacity: 0.7;
        }




         /*....................*/
        .newspaper.site-header {
            background-color: #f7f3e7;
            padding: 1rem 2rem 0.5rem;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 90%;
            margin: 0 auto;
            position: relative;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        /* Hamburger menu (mobilne) */
        #menu-toggle {
            display: none;
        }

        .hamburger {
            display: none;
            font-size: 2rem;
            cursor: pointer;
            color: #333;
        }

        /* Nawigacja desktop */
        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: #000;
        }

        /* Subtelna linia */
        .subtle-divider {
            height: 2px;
            width: 90%;
            margin: 0.5rem auto 0;
            background: linear-gradient(
                to right,
                transparent,
                rgba(0, 0, 0, 0.2) 30%,
                rgba(0, 0, 0, 0.5) 50%,
                rgba(0, 0, 0, 0.2) 70%,
                transparent
            );
            border-radius: 1px;
            opacity: 0.7;
        }

        /* ===== Responsive mobile ===== */
        @media (max-width: 768px) {
            .hamburger {
                display: block;
            }

            .nav-links {
                position: absolute;
                top: 100%;
                right: 0;
                background-color: #f7f3e7;
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem;
                gap: 1rem;
                width: 100%;
                display: none;
                z-index: 10;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }

            #menu-toggle:checked + .hamburger + .nav-links {
                display: flex;
            }
        }


    </style>
</head>
<body>

<header class="site-header">
    <div class="container">
        <div class="logo">Aszblog</div>

        <!-- Hamburger menu toggle -->
        <input type="checkbox" id="menu-toggle" />
        <label for="menu-toggle" class="hamburger">&#9776;</label>

        <nav class="nav-links">
            <a href="#">Mapa</a>
            <a href="#">Artykuły</a>
            <a href="#">Pierdoły</a>
            <a href="#">2137</a>
        </nav>
    </div>

</header>

<div class="newspaper">


    <div class="line-with-symbols">
        <a href="https://example.com/lewo" class="line-link left" data-tooltip="poprzedni">
            <span class="symbol">♦</span>
        </a>
        <a href="https://example.com/prawo" class="line-link right" data-tooltip="następny">
            <span class="symbol">♦</span>
        </a>
    </div>


    <h1>Przykładowy Artykuł w Stylu Gazetowym</h1>

    <div class="article-meta">
        <span class="category">Kategoria: <strong>Styl życia</strong></span> |
        <time datetime="2025-08-03">3 sierpnia 2025</time>
    </div>


    <div class="clearfix">
        <figure class="image">
            <img src="https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=400&h=300&q=80" alt="Przykładowe zdjęcie 3" />
            <figcaption>Przykładowy podpis zdjęcia</figcaption>
        </figure>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vulputate diam at magna facilisis, at sagittis
            augue laoreet. Morbi viverra, libero vitae tincidunt dapibus, orci lorem fermentum enim, at fermentum nisl
            ante vel felis. Pellentesque in justo laoreet, viverra nulla ut, porttitor leo.
        </p>

        <p>
            Integer imperdiet risus vitae ipsum volutpat, nec commodo lectus ultrices. Suspendisse potenti. Aenean
            scelerisque, erat eget tempor fermentum, enim erat vulputate enim, nec lacinia nisi lectus nec ex.
            Suspendisse nec sem felis. Nullam a turpis ac mauris pulvinar commodo.
        </p>

        <p>
            Vivamus tempor ipsum vel eros laoreet, a tincidunt nibh lobortis. In nec justo diam. Sed a bibendum
            ligula, nec tempor augue. Nulla facilisi. Maecenas vestibulum, nulla at facilisis commodo, erat velit
            bibendum ligula, at fermentum arcu ex vel sapien.
        </p>

        <figure class="image-right">
            <img src="https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=400&h=300&q=80" alt="Przykładowe zdjęcie 2" />
            <figcaption>Przykładowy podpis zdjęcia</figcaption>
        </figure>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vulputate diam at magna facilisis, at sagittis
            augue laoreet. Morbi viverra, libero vitae tincidunt dapibus, orci lorem fermentum enim, at fermentum nisl
            ante vel felis. Pellentesque in justo laoreet, viverra nulla ut, porttitor leo.
        </p>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vulputate diam at magna facilisis, at sagittis
            augue laoreet. Morbi viverra, libero vitae tincidunt dapibus, orci lorem fermentum enim, at fermentum nisl
            ante vel felis. Pellentesque in justo laoreet, viverra nulla ut, porttitor leo.
        </p>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vulputate diam at magna facilisis, at sagittis
            augue laoreet. Morbi viverra, libero vitae tincidunt dapibus, orci lorem fermentum enim, at fermentum nisl
            ante vel felis. Pellentesque in justo laoreet, viverra nulla ut, porttitor leo.
        </p>

        <figure class="image">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&h=300&q=80" alt="Przykładowe zdjęcie 1" />
            <figcaption>Przykładowy podpis zdjęcia</figcaption>
        </figure>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vulputate diam at magna facilisis, at sagittis
            augue laoreet. Morbi viverra, libero vitae tincidunt dapibus, orci lorem fermentum enim, at fermentum nisl
            ante vel felis. Pellentesque in justo laoreet, viverra nulla ut, porttitor leo.
        </p>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vulputate diam at magna facilisis, at sagittis
            augue laoreet. Morbi viverra, libero vitae tincidunt dapibus, orci lorem fermentum enim, at fermentum nisl
            ante vel felis. Pellentesque in justo laoreet, viverra nulla ut, porttitor leo.
        </p>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vulputate diam at magna facilisis, at sagittis
            augue laoreet. Morbi viverra, libero vitae tincidunt dapibus, orci lorem fermentum enim, at fermentum nisl
            ante vel felis. Pellentesque in justo laoreet, viverra nulla ut, porttitor leo.
        </p>


        <div class="line-with-symbols">
            <a href="https://example.com/lewo" class="line-link left" data-tooltip="poprzedni">
                <span class="symbol">♦</span>
            </a>
            <a href="https://example.com/prawo" class="line-link right" data-tooltip="następny">
                <span class="symbol">♦</span>
            </a>
        </div>


    </div>
</div>
<footer style="width: 90%; margin: 3rem auto 2rem; text-align: center; font-size: 0.9em; color: #777;">
    <nav style="margin-bottom: 1rem;">
        <a href="#" style="margin: 0 10px; text-decoration: none; color: #888;">CMS</a>
        <a href="#" style="margin: 0 10px; text-decoration: none; color: #888;">O mnie</a>
        <a href="#" style="margin: 0 10px; text-decoration: none; color: #888;">Galeria</a>
        <a href="#" style="margin: 0 10px; text-decoration: none; color: #888;">Kontakt</a>
        <a href="#" style="margin: 0 10px; text-decoration: none; color: #888;">Mapa</a>
        <a href="#" style="margin: 0 10px; text-decoration: none; color: #888;">ZDJĘCIA KRZYŚKA :P</a>
    </nav>

    <div style="font-style: italic; margin-bottom: 1rem; color: #555; font-size: 1em;">
        „Żyj tak, aby Twoje motto mówiło więcej niż słowa.”
    </div>

    <div style="font-style: italic;">© {{ date('Y') }} {{ __('footer.main') }} {{ __('footer.author') }}</div>
</footer>

<script>
    // menu
    const toggleButton = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');

    toggleButton.addEventListener('click', () => {
        navLinks.classList.toggle('show');
    });
</script>

</body>
</html>
