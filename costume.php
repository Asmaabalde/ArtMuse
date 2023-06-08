<?php
  // Démarrage de la session
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Catégorie Bijoux</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Catégorie Bijoux</h1><br><br>

  <?php
  // Si le user est connecté
  if(isset($_SESSION["mail"])){
       // Inclusion du fichier de connexion à la base de données
    include 'connect.php';

    // Requête pour récupérer les œuvres de la catégorie "costume"
    $query = "SELECT * FROM oeuvre WHERE categorie = 'Costume'";
    $result = mysqli_query($id, $query);

    // Vérification si des œuvres ont été trouvées
    if (mysqli_num_rows($result) > 0) {
      // Affichage des œuvres
      while ($oeuvre = mysqli_fetch_assoc($result)) {
        echo '<div class="category">';
        // echo '<h2>'.$oeuvre['categorie'].'</h2>';
        echo '<a href="oeuvre.php?ido='.$oeuvre['ido'].'">';
        echo '<img src="'.$oeuvre['photo'].'" alt="Œuvre" width="300" height="350">';
        echo '</a>';
        // Bouton pour liker l'œuvre
        echo '<form method="POST" action="like.php">';
        echo '<input type="hidden" name="ido" value="'.$oeuvre['ido'].'">';
        echo '</form>';
        echo '</div>';
      }
    } else {
      echo 'Aucune œuvre trouvée dans la catégorie "Costume".';
    }

    // Libération des résultats de la requête
    mysqli_free_result($result);

    // Fermeture de la connexion à la base de données
    mysqli_close($id);
  }
  // Sinon redirection vers la page d'accueil
  else{
     header("location:accueil.php");
  }
    
  ?>
<p><button><a class="lien" href="exposition.php">Retour</a></button></p>
</body>
</html>
