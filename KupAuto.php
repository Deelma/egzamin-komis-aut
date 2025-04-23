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

                    echo '<h4>Oferta Dnia: Toyota ' . $row['model'] .'</h4>';

                    echo '<p>Rocznik: ' . $row['rocznik'] . ', przebieg: ' . $row['przebieg'] . ', rodzaj paliwa: ' . $row['paliwo'] . '</p>';

                    echo '<h4>Cena: ' . $row['cena'] . '</h4>';

                }

            ?>
        </section>
        <section id="blok2">
            <h2>Oferty Wyróżnione</h2>
            <section class="oferty">
            <?php

                $PDO = new PDO('mysql:host=localhost;dbname=kupauto;charset=utf8;port=3306', 'root', '');

                $stmt = $PDO->query('SELECT `nazwa`, `model`, `rocznik`, `cena`, `zdjecie` FROM `marki` INNER JOIN `samochody` ON `samochody`.`marki_id` = `marki`.`id` WHERE `samochody`.`wyrozniony` = 1 LIMIT 4');

                foreach($stmt as $row){

                    echo '<div>';

                    echo '<img src="' . $row['zdjecie'] . '" alt="' . $row['model'] . '">';
                    echo '<h4>' . $row['nazwa'] . " " . $row['model'] . '</h4>';
                    echo '<p>Rocznik: ' . $row['rocznik'] . '</p>';
                    echo '<h4>Cena: ' . $row['cena'] . '</h4>';

                    echo '</div>';

                }

            ?>
            </section>
        </section>
        <section id="blok3">
            <h2>Wybierz markę</h2>
            <form method="post">
                <select name="marka">
                    <?php

                        $PDO = new PDO('mysql:host=localhost;dbname=kupauto;charset=utf8;port=3306', 'root', '');

                        $stmt = $PDO->query('SELECT `nazwa` FROM `marki`');

                        foreach($stmt as $row){

                            echo '<option value="' . $row['nazwa'] . '">' . $row['nazwa'] . '</option>';

                        }

                    ?>
                </select>
                <button name="submit">Wyszukaj</button>
                <section class="oferty" id="ofertymarki">
                <?php

                    $PDO = new PDO('mysql:host=localhost;dbname=kupauto;charset=utf8;port=3306', 'root', '');

                    if(isset($_POST['submit']) && isset($_POST['marka'])){

                        $stmt = $PDO->prepare('SELECT `model`, `cena`, `zdjecie`, `marki`.`nazwa` FROM `samochody` INNER JOIN `marki` ON `marki`.`id` = `samochody`.`marki_id` WHERE `marki`.`nazwa` LIKE :marka');

                        $stmt->bindParam(':marka', $_POST['marka']);

                        $stmt->execute();

                        foreach($stmt as $row){

                            echo '<div>';

                            echo '<img src="' . $row['zdjecie'] . '" alt="' . $row['model'] . '">';
                            echo '<h4>' . $row['nazwa'] . " " . $row['model'] . '</h4>';
                            echo '<h4>Cena: ' . $row['cena'] . '</h4>';

                            echo '</div>';

                        }

                    }

                ?>
                </section>
            </form>
        </section>
    </main>
    <footer>
        <p>Strone wykonał: Nikodem Warmowski</p>
        <p><a href="http://firmy.pl/komis">Znajdź nas także</a></p>
    </footer>
</body>
</html>