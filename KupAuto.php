<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komis aut</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <header>
        <h1><i>KupAuto!</i> Internetowy Komis Samochodowy</h1>
    </header>
    <main>
        <section id="blok1">
            <?php

                $PDO = new PDO('mysql:host=localhost;dbname=kupauto;charset=utf8;port=3306', 'root', '');

                $stmt = $PDO->query('SELECT `model`, `rocznik`, `przebieg`, `paliwo`, `cena`, `zdjecie` FROM `samochody` WHERE `id` = 10');

                foreach($stmt as $row){

                    echo '<img src="' . $row['zdjecie'] .'" alt="oferta dnia">';

                    echo '<h4>Oferta Dnia: Toyota' . $row['model'] .'</h4>';

                    echo '<p>Rocznik: ' . $row['rocznik'] . ', przebieg: ' . $row['przebieg'] . ', rodzaj paliwa: ' . $row['paliwo'] . '</p>';

                    echo '<h4>Cena: ' . $row['cena'] . '</h4>';

                }

            ?>
        </section>
        <section id="blok2">
            <h2>Oferty Wyróżnione</h2>
            <?php

                $PDO = new PDO('mysql:host=localhost;dbname=kupauto;charset=utf8;port=3306', 'root', '');

                $stmt = $PDO->query('SELECT `nazwa`, `model`, `rocznik`, `cena`, `zdjecie` FROM `marki` INNER JOIN `samochody` ON `samochody`.`marki_id` = `marki`.`id` WHERE `samochody`.`wyrozniony` = 1');

                foreach($stmt as $row){

                    echo '<div>';

                    echo '<img src="' . $row['zdjecie'] . '" alt="' . $row['model'] . '">';
                    echo '<h4>' . $row['nazwa'] . $row['model'] . '</h4>';
                    echo '<p>Rocznik: ' . $row['rocznik'] . '</p>';
                    echo '<h4>Cena: ' . $row['cena'] . '</h4>';

                    echo '</div>';

                }

            ?>
        </section>
        <section id="blok3">
            <h2>Wybierz markę</h2>
            <form method="post">
                <select name="marka">
                    <?php

                        $PDO = new PDO('mysql:host=localhost;dbname=kupauto;charset=utf8;port=3306', 'root', '');

                        $stmt = $PDO->query('SELECT `nazwa` FROM `marki`');

                    ?>
                </select>
                <button onclick="wyszukaj()">Wyszukaj</button>
                <?php

                    $PDO = new PDO('mysql:host=localhost;dbname=kupauto;charset=utf8;port=3306', 'root', '');

                    $stmt = $PDO->query('SELECT `model`, `cena`, `zdjecie` FROM `samochody` INNER JOIN `marki` ON `marki`.`id` = `samochody`.`marki_id` WHERE `marki`.`nazwa` LIKE "Audi"');

                ?>
            </form>
        </section>
    </main>
    <footer>
        <p>Strone wykonał: Nikodem Warmowski</p>
        <p><a href="http://firmy.pl/komis">Znajdź nas także</a></p>
    </footer>
</body>
</html>