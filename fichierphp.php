


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre site internet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .center-table {
            margin: 0 auto;
            margin-top: 10%;
            width: 50%;
            border-collapse: collapse;
        }
        .center-table th, .center-table td {
            padding: 8px;
            border: 1px solid #000000;
            background-color: #ffffff;
        }
        .center-table th {
            background-color: #bedefc;
            text-align: left;
        }
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(196, 254, 255);
        }
        .slide {
            height: 100%;
            width: 180px;
            position: absolute;
            background-color: #fff;
            transition: 0.5s ease;
            transform: translateX(-180px);
        }
        h1 {
            color: darkcyan;
            font-weight: 800;
            text-align: right;
            padding: 10px 0;
            padding-right: 30px;
            pointer-events: none;
        }
        ul li {
            list-style: none;
        }
        ul li a {
            color: rgb(0, 0, 0);
            font-weight: 500;
            padding: 5px 0;
            display: block;
            text-transform: capitalize;
            text-decoration: none;
            transition: 0.2s ease-out;
        }
        ul li:hover a {
            color: #fff;
            background-color: rgb(104, 195, 164);
        }
        ul li a i {
            width: 40px;
            text-align: center;
        }
        input {
            display: none;
            visibility: hidden;
        }
        .toggle {
            position: absolute;
            height: 30px;
            width: 30px;
            top: 20px;
            left: 15px;
            z-index: 1;
            cursor: pointer;
            border-radius: 2px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        .toggle .common {
            position: absolute;
            height: 2px;
            width: 20px;
            background-color: #0b1a1d;
            border-radius: 50px;
            transition: 0.3s ease;
        }
        .toggle .top_line {
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .toggle .middle_line {
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .toggle .bottom_line {
            top: 70%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        input:checked ~ .toggle .top_line {
            left: 2px;
            top: 14px;
            width: 25px;
            transform: rotate(45deg);
        }
        input:checked ~ .toggle .bottom_line {
            left: 2px;
            top: 14px;
            width: 25px;
            transform: rotate(-45deg);
        }
        input:checked ~ .toggle .middle_line {
            opacity: 0;
            transform: translateX(20px);
        }
        input:checked ~ .slide {
            transform: translateX(0);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <label>
        <input type="checkbox">
        <div class="toggle">
            <span class="top_line common"></span>
            <span class="middle_line common"></span>
            <span class="bottom_line common"></span>
        </div>
        <div class="slide">
            <h1>MENU</h1>
            <ul>
                <li><a href='#'><i class="fas fa-user"></i> Profile </a></li>
                <li><a href='#'><i class="far fa-address-book"></i> Télécommande </a></li>
                <li><a href='#'><i class="fas fa-tv"></i> Oeuvre d'art </a></li>
                <li><a href='#'><i class="fas fa-comments"></i> Events </a></li>
            </ul>
        </div>
        <div class="containerEvent">
            <h2 style="text-align: center; color: red;">Alertes !!!</h2>
            <table class="center-table">
                <tr>
                    <th>Nom de l'oeuvre</th>
                    <th>Date d'acquisition</th>
                    <th>Emplacement</th>
                </tr>
                <!-- PHP pour générer les lignes du tableau -->
                <?php
                include 'bd.php';
                $sql = "SELECT NomO, dateAcquisition, Emplacement FROM Oeuvreart";
                $result = $bdd->query($sql);

                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["NomO"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["dateAcquisition"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["Emplacement"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Aucun résultat trouvé</td></tr>";
                }
                $bdd = null;
                ?>
            </table>
        </div>
    </label>
    <footer>
        <p>&copy; 2024 Mon Site Web. Tous droits réservés.</p>
    </footer>
</body>
</html>
