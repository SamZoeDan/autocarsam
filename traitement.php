<?php
$host = "dbautocar.mysql.database.azure.com"; 
$username = "samoli";
$password = "Autocar24";
$dbname = "autocar";

// Création de la connexion
$conn = new mysqli($host, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
  die("Échec de la connexion: " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecter les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $date_naissance = $_POST['date_naissance'];
    $voiture = $_POST['voiture'];

    // Préparer la requête SQL
    $stmt = $conn->prepare("INSERT INTO commande_formulaire (nom, prenom, telephone, date_naissance, voiture) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    // Lier les paramètres à la déclaration préparée en tant que chaînes
    $stmt->bind_param("sssss", $nom, $prenom, $telephone, $date_naissance, $voiture);

    // Exécuter la requête SQL
    if ($stmt->execute() === TRUE) {
      echo "Nouvelle commande enregistrée avec succès.";
    } else {
      echo "Erreur lors de l'exécution de la requête : " . $stmt->error;
    }

    // Fermer la requête préparée
    $stmt->close();
}

// Fermer la connexion
$conn->close();
?>
