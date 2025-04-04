<?php
/**
 * Ce fichier contient toutes les fonctions qui réalisent des opérations
 * sur la base de données, telles que les requêtes SQL pour insérer, 
 * mettre à jour, supprimer ou récupérer des données.
 */

/**
 * Définition des constantes de connexion à la base de données.
 *
 * HOST : Nom d'hôte du serveur de base de données, ici "localhost".
 * DBNAME : Nom de la base de données
 * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
 * DBPWD : Mot de passe pour se connecter à la base de données.
 */
define("HOST", "localhost");
define("DBNAME", "zbalah3");
define("DBLOGIN", "zbalah3");
define("DBPWD", "zbalah3");


/**
 * Récupère le menu pour un jour spécifique dans la base de données.
 *
 * @param string $w La semaine pour laquelle le menu est récupéré.
 * @param string $j Le jour pour lequel le menu est récupéré.
 * @return array Un tableau d'objets contenant l'entrée, le plat principal et le dessert pour le jour spécifié.
 */
function getMovie(){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = "select * from Movie";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Lie le paramètre à la valeur
    // $stmt->bindParam(':category', $category);
    // $stmt->bindParam(':title', $title);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}

function addMovie($name, $year, $length, $description, $director, $id_category, $image, $trailer, $min_age){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = "INSERT INTO Movie (name,year,length,description,director,id_category,image,trailer,min_age) VALUES (:name,:year,:length,:description,:director,:id_category,:image,:trailer,:min_age)";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Lie le paramètre à la valeur
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':length', $length);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':director', $director);
    $stmt->bindParam(':id_category', $id_category);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':trailer', $trailer);
    $stmt->bindParam(':min_age', $min_age);
    // $stmt->bindParam(':category', $category);
    // $stmt->bindParam(':title', $title);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}
