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
// define("HOST", "localhost");
// define("DBNAME", "SAE203");
// define("DBLOGIN", "usersae203");
// define("DBPWD", "mdp_username203");

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

function getMovieDetail($id){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT Movie.id, Movie.name, Movie.director, Movie.year, Movie.length, Movie.description, Movie.image, Movie.trailer, Movie.min_age, Movie.id_category, Category.name 
    AS category FROM Movie JOIN Category ON Movie.id_category = Category.id WHERE Movie.id = :id";
    $stmt = $cnx->prepare($sql);

    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $movieDetail = $stmt->fetch(PDO::FETCH_OBJ);

    return $movieDetail;

}

function getCategory(){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer le menu avec des paramètres
    $sql = "select * from Category";
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


function getMovieCategories($category, $age = null){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    
    // Si age n'est pas défini, sélectionner tous les films de la catégorie
    if ($age == null) {
        $sql = "SELECT Movie.*, Category.name AS category 
                FROM Movie 
                JOIN Category ON Movie.id_category = Category.id 
                WHERE Category.id = :category
                ORDER BY Movie.name ASC";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':category', $category);
    } else {
        // Sinon, filtrer par âge
        $sql = "SELECT Movie.*, Category.name AS category 
                FROM Movie 
                JOIN Category ON Movie.id_category = Category.id 
                WHERE Category.id = :category 
                AND Movie.min_age <= :age";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':age', $age);
    }
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function addUserProfile($name, $avatar, $min_age) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "INSERT INTO Profile (name, avatar, min_age) 
            VALUES (:name, :avatar, :min_age)";

    $stmt = $cnx->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':avatar', $avatar);
    $stmt->bindParam(':min_age', $min_age);

    $stmt->execute();
    $res = $stmt->rowCount();
    return $res; 
}

function getAllUserProfiles(){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT * FROM `Profile`";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

// function getMoviesOrderByAge($age){
//     $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
//     $sql = "SELECT id, name, year, description, length, director, id_category, min_age, trailer, image FROM Movie
//             WHERE min_age <= 8
//             ORDER BY Movie.min_age ASC";
//     $stmt = $cnx->prepare($sql);
//     $stmt->bindParam(':age', $age);
//     $stmt->execute();
//     $res = $stmt->fetchAll(PDO::FETCH_OBJ);
//     return $res;
// }

function addNewProfile($Nom, $Age, $file, $id) {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    // Requête SQL d'insertion du profil
    $sql = "UPDATE Profile SET name = :name, min_age = :min_age, avatar = :avatar WHERE id = :id;";
    $stmt = $cnx->prepare($sql);

    // Lie les paramètres
    $stmt->bindParam(':name', $Nom);
    $stmt->bindParam(':min_age', $Age);
    $stmt->bindParam(':avatar', $file);
    $stmt->bindParam(':id', $id);

    // Exécute la requête SQL
    $stmt->execute();

    // Retourne le nombre de lignes affectées
    return $stmt->rowCount();
}


// function toggleFavorite($movieid, $profileid) {
//     $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    
//         // Essaie d'abord d'insérer
//         $sql = "INSERT INTO Favorites (profile.id, movie.id) VALUES (:profile.id, :movie.id)";
//         $stmt = $cnx->prepare($sql);
//         $stmt->bindParam(':profile.id', $profileid);
//         $stmt->bindParam(':movie.id', $movieid);
//         $stmt->execute();
//         return "Film ajouté aux favoris";
// }