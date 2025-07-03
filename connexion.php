<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=rbi;charset=utf8", "root", "");
    // Active le mode exception pour les erreurs PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optionnel : tu peux afficher un message de succès (à retirer en production)
    // echo "Connexion réussie à la base de données.";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>



<?php
$newsletter = "";

if (isset($_POST["newsletter"])) {
    $newsletter = trim($_POST["newsletter"]);

    // Vérifie si l'entrée n'est pas vide et correspond au motif
    if (!empty($newsletter) && preg_match("/^[A-Za-z ]{4,30}$/", $newsletter)) {

        // Connexion via PDO (connexion.php doit renvoyer un objet $conn PDO)
        include("connexion.php");

        try {
            // Requête préparée pour éviter les injections SQL
            $query = "INSERT INTO newsletter (id, email) VALUES (NULL, :email)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $newsletter, PDO::PARAM_STR);
            $stmt->execute();

            echo "Ajout avec succès !";
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
        }
    } else {
        echo "Adresse invalide. Veuillez entrer entre 4 et 30 lettres.";
    }
}
?>