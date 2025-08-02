<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
            background-color: #f5f5f5;
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

        /* Menu górne */
        header {
            background-color: #2f2f2f; /* ciemny szary */
            width: 90vw;
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 1.25rem;
            font-family: "Georgia", serif;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            border-radius: 5px 5px 0 0;
        }

        header .logo {
            /* proste stylowanie logo */
            font-style: italic;
        }

        /* Footer */
        footer {
            background-color: #2f2f2f; /* ciemny szary */
            width: 90vw;
            max-width: 1200px;
            margin: 2rem auto 1rem auto;
            padding: 1.5rem 2rem;
            color: white;
            font-family: "Georgia", serif;
            font-size: 0.9rem;
            border-radius: 0 0 5px 5px;
            box-shadow: 0 -2px 5px rgba(0,0,0,0.3);
        }

        footer .social-links {
            margin-bottom: 0.8rem;
        }

        footer .social-links a {
            color: #ddd;
            margin-right: 1rem;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        footer .social-links a:hover {
            color: #fff;
            text-decoration: underline;
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

        /*kreska pozioma*/
        .line-with-symbols {
            position: relative;
            height: 2px;
            background: black;
            margin: 40px 0;
            opacity: 0.3;
        }

        .line-with-symbols::before,
        .line-with-symbols::after {
            content: "♦";
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            font-weight: bold;
            color: black;
            opacity: 1;

            background: transparent; /* bez tła */
            padding: 0;
            border-radius: 0;

            /* wklęsły efekt przez cień tekstu */
            text-shadow:
                1px 1px 2px rgba(255,255,255,0.8),
                -1px -1px 2px rgba(0,0,0,0.6);
        }

        .line-with-symbols::before {
            left: 10%;
        }

        .line-with-symbols::after {
            right: 10%;
        }

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

            header, footer {
                width: 95vw; /* na mobilkach trochę szerzej */
                padding: 1rem;
                border-radius: 0;
            }
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Menu górne -->
<nav class="navbar navbar-dark bg-dark" style="width: 90%; margin: 0 auto;">
    <div class="container-fluid px-0">
        <a class="navbar-brand" href="#">
            <img src="https://placehold.co/40x40?text=Logo" alt="Logo" width="40" height="40" class="d-inline-block align-text-top">
            aszblog
        </a>
        <ul class="navbar-nav flex-row">
            <li class="nav-item px-2">
                <a class="nav-link active text-light" aria-current="page" href="#">Strona główna</a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link text-light" href="#">O nas</a>
            </li>
            <li class="nav-item px-2">
                <a class="nav-link text-light" href="#">Kontakt</a>
            </li>
        </ul>
    </div>
</nav>

<div class="newspaper">
    <div class="line-with-symbols"> </div>

    <h1>Przykładowy Artykuł w Stylu Gazetowym</h1>

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

        <div class="line-with-symbols"> </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-light py-3 mt-4" style="width: 90%; margin: 0 auto;">
    <div class="container d-flex justify-content-between align-items-center px-0">
        <div>
            <a href="https://facebook.com" target="_blank" class="text-light me-3 text-decoration-none">Facebook</a>
            <a href="https://twitter.com" target="_blank" class="text-light me-3 text-decoration-none">Twitter</a>
            <a href="https://instagram.com" target="_blank" class="text-light text-decoration-none">Instagram</a>
        </div>
        <div>© Twój :)</div>
    </div>
</footer>

<!-- Dodaj na koniec body Bootstrap JS i popper.js (opcjonalnie, jeśli potrzebujesz np. dropdown) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
