<?php

return [
    'article_list' => [
        'pagination' => 10,
        ],
    'errors_log' => [
        'pagination' => 20,
    ],

    /*
     * Ustawienia gridu .tall dla widoku głównego listy artykułów.
     * Kluczem jest liczba artykułów (1–10), a wartością – tablica indeksów, które powinny być rozciągnięte.
     * Dzięki temu layout jest dopasowany do liczby artykułów i wygląda spójnie.
     * np dla ilości art = 6 art 1, 2 i 5 są rozciągniete w pionie
     * max liczba artykułow na chwile obecna to 10 ! ! !
     */
    'articles_grid' => [
        1 => [],
        2 => [],
        3 => [],
        4 => [2, 3],
        5 => [2],
        6 => [1, 2, 5],
        7 => [0, 6],
        8 => [1, 5, 6, 7],
        9 => [1, 6, 5],
        10 => [0, 4, 2, 5, 9],
        11 => [10],
        12 => [0, 4, 2, 5, 9, 11],
    ]
];
