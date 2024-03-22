<?php
$servername = "localhost"; // ou l'adresse de votre serveur
$username = "root";
$password = "";
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
