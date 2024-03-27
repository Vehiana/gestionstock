<!DOCTYPE html>
 <head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>Connexion</title>
 <link rel="stylesheet" href="../../public/css/styles.css" type="text/css" />
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
 </head>
 <body>
 
 
 <div id="container">

 <!-- formulaire de connexion -->
 <form action="verifConnexion.php" method="POST">
 
 <h1>Connexion</h1>
 
 <label><b>Nom d'utilisateur</b></label>
 <input type="text" placeholder="prenom.nom" name="username" required/>

 <label><b>Mot de passe</b></label>
 <input id="password" type="password" placeholder="" name="password" required/>
 <!-- <img src="../../public/images/oeilmdp.png" id="eye" onclick="changer()"/> -->

 <input type="submit" id='submit' value='Valider' >
 
 </form>
 </div>
 <script>
// script à faire pour l'affiche ou non du mdp en clair
 	
 </script>

 </body>
</html>