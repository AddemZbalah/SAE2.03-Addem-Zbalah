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

    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);

    $sql = "select * from Movie";

    $stmt = $cnx->prepare($sql);
   

    $stmt->execute();
   
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; 
}

function addMovie($name, $year, $length, $description, $director, $id_category, $image, $trailer, $min_age){
    
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);

    $sql = "INSERT INTO Movie (name,year,length,description,director,id_category,image,trailer,min_age) VALUES (:name,:year,:length,:description,:director,:id_category,:image,:trailer,:min_age)";
   
    $stmt = $cnx->prepare($sql);
    
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':year', $year);
    $stmt->bindParam(':length', $length);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':director', $director);
    $stmt->bindParam(':id_category', $id_category);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':trailer', $trailer);
    $stmt->bindParam(':min_age', $min_age);
   
    $stmt->execute();
    
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; 
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
    
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    
    $sql = "select * from Category";
    
    $stmt = $cnx->prepare($sql);
    
    
    $stmt->execute();
    
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; 
}


function getMovieCategories($category, $age = null){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    
    
    if ($age == null) {
        $sql = "SELECT Movie.*, Category.name AS category 
                FROM Movie 
                JOIN Category ON Movie.id_category = Category.id 
                WHERE Category.id = :category
                ORDER BY Movie.name ASC";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':category', $category);
    } else {
        
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
    
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    
    $sql = "UPDATE Profile SET name = :name, min_age = :min_age, avatar = :avatar WHERE id = :id;";
    $stmt = $cnx->prepare($sql);

    
    $stmt->bindParam(':name', $Nom);
    $stmt->bindParam(':min_age', $Age);
    $stmt->bindParam(':avatar', $file);
    $stmt->bindParam(':id', $id);

    
    $stmt->execute();

    
    return $stmt->rowCount();
}


// function toggleFavorite($movieid, $profileid) {
//     $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    

//         $sql = "INSERT INTO Favorites (profile.id, movie.id) VALUES (:profile.id, :movie.id)";
//         $stmt = $cnx->prepare($sql);
//         $stmt->bindParam(':profile.id', $profileid);
//         $stmt->bindParam(':movie.id', $movieid);
//         $stmt->execute();
//         return "Film ajouté aux favoris";
// }

function addFavorite($movie_id, $profile_id) {
    try {
        $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
        
        $check = $cnx->prepare("SELECT * FROM Favorites WHERE movie_id = :movie_id AND profile_id = :profile_id");
        $check->execute(['movie_id' => $movie_id, 'profile_id' => $profile_id]);
        if ($check->rowCount() > 0) {
            return "Ce film est déjà dans vos favoris";
        }
        $sql = "INSERT INTO Favorites (movie_id, profile_id) VALUES (:movie_id, :profile_id)";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':movie_id', $movie_id);
        $stmt->bindParam(':profile_id', $profile_id);
        $stmt->execute();
        return "Film ajouté aux favoris";
    } catch (Exception $e) {
        return "Erreur lors de l'ajout aux favoris";
    }
}

function delFavorite($movie_id, $profile_id) {
    
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    
    $sql = "DELETE FROM Favorites WHERE movie_id = :movie_id AND profile_id = :profile_id";
    
    $stmt = $cnx->prepare($sql);
    
    $stmt->bindParam(':movie_id', $movie_id);
    $stmt->bindParam(':profile_id', $profile_id);
    
    $stmt->execute();
    
    return $stmt->rowCount();
}

function getFavorites($profile_id) {
    
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    
    $sql = "SELECT Movie.*, Favorites.profile_id 
            FROM Movie 
            JOIN Favorites ON Movie.id = Favorites.movie_id 
            WHERE Favorites.profile_id = :profile_id";
    
    $stmt = $cnx->prepare($sql);
    
    $stmt->bindParam(':profile_id', $profile_id);
    
    $stmt->execute();
    
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; 
}

function getRecommendedMovies($min_age) {
    
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    
    
    $sql = "SELECT Movie.*, Category.name AS category 
            FROM Movie 
            JOIN Category ON Movie.id_category = Category.id 
            WHERE Movie.min_age <= :min_age AND Movie.id % 2 = 0
            ORDER BY Movie.year DESC ";
            
    
    $stmt = $cnx->prepare($sql);
    
    
    $stmt->bindParam(':min_age', $min_age);
    
    
    $stmt->execute();
    
    
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}