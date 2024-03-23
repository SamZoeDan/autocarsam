<?php
$host = "dbautocar.mysql.database.azure.com"; 
$username = "samoli";
$password = "Autocar24";
$dbname = "autocar";

// Création de la connexion
$conn = mysqli_init();
mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
if (!mysqli_real_connect($conn, $host, $username, $password, $dbname, 3306, NULL, MYSQLI_CLIENT_SSL)) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecter et valider les données du formulaire ici

    // Préparer la requête SQL
    $stmt = $conn->prepare("INSERT INTO commande_formulaire (nom, prenom, telephone, date_naissance, voiture) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    // Lier les paramètres et exécuter la requête
    $stmt->bind_param("sssss", $nom, $prenom, $telephone, $date_naissance, $voiture);
    if ($stmt->execute() === TRUE) {
      echo "Nouvelle commande enregistrée avec succès.";
    } else {
      echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
