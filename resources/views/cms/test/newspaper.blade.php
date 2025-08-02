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
        }

    </style>
</head>
<body>

<div class="newspaper">
    <div class="line-with-symbols"> </div>

    <h1>Przykładowy Artykuł w Stylu Gazetowym</h1>

    <div class="clearfix">
        <figure class="image">
            <img src="https://placehold.co/400x300" alt="Przykładowe zdjęcie">
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
            <img src="https://placehold.co/400x300" alt="Przykładowe zdjęcie">
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
            <img src="https://placehold.co/400x300" alt="Przykładowe zdjęcie">
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

</body>
</html>
