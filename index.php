<?php
$servername = 'dbautocar.mysql.database.azure.com';
$username = 'samoli';
$password = 'Autocar24';
$dbname = 'autocar';

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Échec de la connexion: " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecter les données du formulaire
    $nom = $conn->real_escape_string($_POST['nom']);
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $telephone = $conn->real_escape_string($_POST['telephone']);
    $date_naissance = $conn->real_escape_string($_POST['date_naissance']);
    $voiture = $conn->real_escape_string($_POST['voiture']);

    // Préparer la requête SQL
    $sql = "INSERT INTO commande_formulaire (nom, prenom, Telephone, Date_naissance, voiture)
    VALUES ('$nom', '$prenom', '$telephone', '$date_naissance', '$voiture')";

    // Exécuter la requête SQL
    if ($conn->query($sql) === TRUE) {
      echo "Nouvelle commande enregistrée avec succès.";
    } else {
      echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    // Fermer la connexion
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/form.css">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>
</head>
<body>
    <?php if($message) echo "<p>$message</p>"; ?>
    <form action="index.php" method="post" class="formulaire-achat">
        <div class="input-group">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required>
        </div>
        <div class="input-group">
            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" required>
        </div>
        <div class="input-group">
            <label for="telephone">Téléphone:</label>
            <input type="tel" id="telephone" name="telephone" required>
        </div>
        <div class="input-group">
            <label for="date_naissance">Date de naissance:</label>
            <input type="date" id="date_naissance" name="date_naissance" required>
        </div>
        <div class="input-group">
            <label for="voiture">Voiture:</label>
            <input type="text" id="voiture" name="voiture" required>
        </div>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
