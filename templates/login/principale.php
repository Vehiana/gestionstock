<html>
 <head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Connexion</title>
 <!-- importer le fichier de style -->
 <link rel="stylesheet" href="../../public/css/styles.css" type="text/css" />
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 </head>
 <body style='background:#fff;'>
 <div id="content">
 <!-- tester si l'utilisateur est connecté -->
 <?php
 session_start();
 if(isset($_GET['deconnexion']))
 { 
 if($_GET['deconnexion']==true)
 { 
 session_unset();
 header("location:login.php");
 }
 }
 else if($_SESSION['username'] !== ""){
 $user = $_SESSION['username'];
 // afficher un message
 echo "<br>Bonjour $user, vous êtes connectés";
 echo "<a href='../../index.php'>Accéder à l'accueil</a>";
 }
 ?>
 
 </div>
 </body>
</html>