<?php
$servername = "dbautocar.mysql.database.azure.com"; 
$username = "samoli";
$password = "Autocar24";
$dbname = "autocar";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

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
    $stmt->bind_param("sssss", $nom, $prenom, $telephone, $date_naissance, $voiture);

    // Exécuter la requête SQL
    if ($stmt->execute() === TRUE) {
      echo "Nouvelle commande enregistrée avec succès.";
    } else {
      echo "Erreur: " . $stmt->error;
    }

    // Fermer la requête préparée
    $stmt->close();
}

// Fermer la connexion
$conn->close();
?>
