<?php
session_start();
require_once("includes/script.php");
include("fonctions_panier.php");

if (isset($_POST['valider_inscription'])) {
  if (!empty($_POST['membre_nom']) && !empty($_POST['membre_prenom']) && !empty($_POST['membre_pseudo']) && !empty($_POST['membre_adresse']) && !empty($_POST['membre_mail']) && !empty($_POST['membre_MDP_1']) && !empty($_POST['membre_MDP_2'])) {
    $memmbre_nom = htmlspecialchars($_POST['membre_nom']);
    $membre_prenom = htmlspecialchars($_POST['membre_prenom']);
    $membre_pseudo = htmlspecialchars($_POST['membre_pseudo']);
    $membre_adresse = htmlspecialchars($_POST['membre_adresse']);
    $membre_mail = htmlspecialchars($_POST['membre_mail']);
    $membre_MDP_1 = sha1($_POST['membre_MDP_1']);
    $membre_MDP_2 = sha1($_POST['membre_MDP_2']);
    if ($membre_MDP_1 == $membre_MDP_2) {
      $requete = $bdd->prepare("INSERT INTO membres(membre_nom,membre_prenom,membre_adresse,membre_mail,membre_MDP,membre_pseudo,membre_nb_cmd,membre_pdt_vente) VALUES(?,?,?,?,?,?,0,0)");
      $requete->execute(array($memmbre_nom, $membre_prenom, $membre_adresse, $membre_mail, $membre_MDP_1, $membre_pseudo));
      echo "<p>Votre compte a bien été créé.</p>";
    } else {
      echo "<p>Les deux mots de passes doivent être identiques, veuillez recommencer.</p>";
    }
  } else {
    echo "<p>Tous les champs doivent être remplis.</p>";
  }
}
?>

<!doctype html>
<html>
    <?php require_once("includes/head.php")?>
    <body>
        <?php require_once("includes/includes.php")?>
        <nav>
            <ul>
                <li><a href="femmes.php">FEMMES</a></li>
                <li><a href="hommes.php">HOMMES</a></li>
                <li><a href="tout.php">TOUT</a></li>
                <li><a href="vendre.php">VENDRE</a></li>
            </ul>
            <?php require_once("includes/nav.php")?>
        </nav>

        <div id="main">
            <h1>Inscription</h1>
            <?php
            if(isset($_SESSION['mail'])) {
              echo "<p>Vous êtes déjà connecté !</p>";
            } else {
              ?>
              <form action="inscription.php" method="post">
                <table>
                  <tr>
                    <td>Nom de famille :</td>
                    <td><input type="text" name="membre_nom"></td>
                  </tr>
                  <tr>
                    <td>Prénom :</td>
                    <td><input type="text" name="membre_prenom"></td>
                  </tr>
                  <tr>
                    <td>Choisissez un pseudo :</td>
                    <td><input type="text" name="membre_pseudo"></td>
                  </tr>
                  <tr>
                    <td>Adresse complète :</td>
                    <td><input type="text" name="membre_adresse"></td>
                  </tr>
                  <tr>
                    <td>Mail :</td>
                    <td><input type="email" name="membre_mail"></td>
                  </tr>
                  <tr>
                    <td>Choisissez un mot de passe :</td>
                    <td><input type="password" name="membre_MDP_1"></td>
                  </tr>
                  <tr>
                    <td>Confirmez votre mot de passe :</td>
                    <td><input type="password" name="membre_MDP_2"></td>
                  </tr>
                  <tr>
                    <td><input type="submit" name="valider_inscription" value="Valider"></td>
                    <td><button>Annuler</button></td>
                  </tr>
                </table>
              </form>
              <?php
            }
            ?>
        </div>

    </body>
</html>
