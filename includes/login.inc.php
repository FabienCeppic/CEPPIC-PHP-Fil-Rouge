<?php
// session_start();
?>
<h1>Login</h1>

<?php
if (isset($_POST["frmLogin"])) {
  $message = "je viens du formulaire";
  $mail = htmlentities(trim($_POST['mail']));
  $password = htmlentities($_POST['password']);

  $erreurs = array();

  $erreurs = checkErrors([$mail]);
  if (mb_strlen($mail) === 0 || !filter_var($mail, FILTER_VALIDATE_EMAIL))
    array_push($erreurs, "E-mail invalide.");
  if (mb_strlen($password) === 0)
    array_push($erreurs, "Mot de passe incorrect.");

  if (count($erreurs)) {
    $messageErreur = "<ul>";
    for ($i = 0; $i < count($erreurs); $i++) {
      $messageErreur .= "<li>";
      $messageErreur .= $erreurs[$i];
      $messageErreur .= "</li>";
    }
    $messageErreur .= "</ul>";
    echo $messageErreur;
    include "./includes/frmLogin.php";
  } else {
    displayMessage("Vous êtes connecté");
    $_SESSION['loginUser'] = $mail;
    header('Location:index.php?page=membre');
  }
} else {
  $mail = "";
  // $message = "je ne viens pas du formulaire";
  include "./includes/frmLogin.php";
}
// displayMessage($message);
