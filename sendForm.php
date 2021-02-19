<?php 
   //je déclare mes variables qui contienne les info de la BDD
$servername = "localhost";
$username = "root";
$password = "";
$port = "3306";
$dbname = "basetest";



//je fait un 'try' cela veut dire que j'essaye de lancer ma requête si elle passe je recois un message ou une data
try {
  $uploaddir = './img/';
  $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

  $filename = $_FILES['userfile']['name'];
  if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Le fichier est valide, et a été téléchargé
           avec succès. Voici plus d'informations :\n";
  } else {
    echo "Attaque potentielle par téléchargement de fichiers.
          Voici plus d'informations :\n";
  }

//$conn stock le nouvelle objet PDO il est la pour requêter les methode de PDO

  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//on stock dans $sql le résultat de la métode "INSERT"
  // $sql = "INSERT INTO MyGuests (firstname, lastname, email)
  // VALUES ('John', 'Doe', 'john@example.com')";
  // echo var_dump($_FILES);

  $sql = "INSERT INTO `image` (`filename`) VALUES ('$filename')";

  // use exec() because no results are returned
  $conn->exec($sql);


  echo "New record created successfully";

//on utilise "catch" ou recevoir les potentiels érreur que le try aura rencontré  on appelle cela les "exception"
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

//enfin je réinitialise ma vairable $conn pour pouvoir y stocker d'autre info par la suite
$conn = null;
?>