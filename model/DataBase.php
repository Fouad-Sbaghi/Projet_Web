<?php

$servername = "localhost";
$username = "postgres";
$password = "postgresql";
//"postgresql";
$port = 5433;

try{
	$conn = new PDO("pgsql:host=$servername;port=$port;dbname=portofolioDB", $username, $password);
	echo "connecté";
}catch(PDOException $e){
	echo 'PDOException : '.$e->getMessage();
}

// Préparer la requete preare(request)

$sql = "CREATE TABLE IF NOT EXISTS site.\"UTILISATEURS\"(
    nom character varying(100),
    prenom character varying(100)
);";

$conn->exec($sql);
/*
$sql = 'insert into site."Personne2" (nom, prenom) values(?,?);';
$stat = $conn->prepare($sql);

// mettre les valeur
$stat->execute(['Lopez', 'Virginie']);
*/

$sql = 'insert into site."Personne2" (nom, prenom) values(:nom, :prenom);';
$stat = $conn->prepare($sql);
$nom = 'Dupond';
$prenom = 'Jean';

$stat->bindParam('nom', $nom);
$stat->bindParam('prenom', $prenom);

$nom = 'Dupond1';
$prenom = 'Jean1';
$stat->execute();

// SElect
$sql = 'SELECT nom, prenom FROM site."Personne2"';
$requete = $conn->query($sql);

$result = $requete->fetchAll();
var_dump($result);

// fetchAll() / fetch()

class Personne {
	public $nom;
	public $prenom;
	public $id;
	
		// faire une erreur sur les noms de fonction 
		// pour montrer qu'il y a une erreur
		// constructeur
		public function __construct($n="", $p=""){
			$this->nom = $n;
			$this->prenom  = $p;
			}
	}

$sql = 'SELECT nom, prenom FROM site."Personne2" where nom=:id;';
$stat = $conn->prepare($sql);
$id = 'Lopez';
$stat->bindValue(':id', $id);
$stat->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Personne');
$stat->execute();
$pers1 = $stat->fetch();
echo "fetch par FETCH_CLASS \n";
var_dump($pers1);

$conn->beginTransaction();
?>