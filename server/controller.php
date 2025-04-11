<?php

/** ARCHITECTURE PHP SERVEUR  : Rôle du fichier controller.php
 * 
 *  Dans ce fichier, on va définir les fonctions de contrôle qui vont traiter les requêtes HTTP.
 *  Les requêtes HTTP sont interprétées selon la valeur du paramètre 'todo' de la requête (voir script.php)
 *  Pour chaque valeur différente, on déclarera une fonction de contrôle différente.
 * 
 *  Les fonctions de contrôle vont éventuellement lire les paramètres additionnels de la requête, 
 *  les vérifier, puis appeler les fonctions du modèle (model.php) pour effectuer les opérations
 *  nécessaires sur la base de données.
 *  
 *  Si la fonction échoue à traiter la requête, elle retourne false (mauvais paramètres, erreur de connexion à la BDD, etc.)
 *  Sinon elle retourne le résultat de l'opération (des données ou un message) à includre dans la réponse HTTP.
 */

/** Inclusion du fichier model.php
 *  Pour pouvoir utiliser les fonctions qui y sont déclarées et qui permettent
 *  de faire des opérations sur les données stockées en base de données.
 */
require("model.php");

/** readControler
 * 
 * Cette fonction est en charge du traitement des requêtes HTTP pour lesquelles le paramètre 'todo' vaut 'read'.
 * Elle vérifie si le paramètre 'jour' est défini et non vide dans la requête et s'il est valide (un jour de la semaine).
 * Si le paramètre 'jour' est présent, elle appelle la fonction getMenu avec le jour spécifié
 * et retourne le menu. Si le paramètre 'jour' n'est pas présent, vide ou invalide, elle retourne false.
 * 
 * @return mixed Le menu pour le jour spécifié si 'jour' est défini, valide et non vide, sinon false.
 */
function readController(){
 
    // PREMIERE VERIFICATION : LES PARAMETRES EXISTENT ET SONT NON VIDES
    // Vérification du paramètre 'semaine' 
        $movies = getMovie();
        return $movies;
    }
    // Vérification du paramètre 'jour'

    // si on arrive ici c'est que les paramètres existent et sont valides, on peut interroger la BDD
    // Appel de la fonction getMenu déclarée dans model.php pour extraire de la BDD le menu du jour spécifié


function addMovieController(){
 
        // PREMIERE VERIFICATION : LES PARAMETRES EXISTENT ET SONT NON VIDES
        // Vérification du paramètre 'semaine' 
        $name = $_REQUEST['name'];
        $year = $_REQUEST['year'];
        $length = $_REQUEST['length'];
        $description = $_REQUEST['description'];
        $director = $_REQUEST['director'];
        $id_category = $_REQUEST['id_category'];
        $image = $_REQUEST['image'];
        $trailer = $_REQUEST['trailer'];
        $min_age = $_REQUEST['min_age'];


    //     $ok = addMovie($name, $year, $length, $description, $director, $id_category, $image, $trailer, $min_age);
    //     if($ok!=0){
    //         return "Le film $name a correctement été ajouté à la base de donnée";
    //     }
    //     else {
    //         return "Une erreur est survenue";
    //     }
    // }

    if ($name && $year && $length && $description && $director && $id_category && $image && $trailer && $min_age) {
        $ok = addMovie($name, $year, $length, $description, $director, $id_category, $image, $trailer, $min_age);
        if ($ok != 0) {
            return "Le film $name a correctement été ajouté à la base de donnée";
        } else {
            return "Une erreur est survenue";
        }
    } else {
        return "Tous les paramètres sont requis.";
    }
}

function readMovieDetailsController(){
 
    // PREMIERE VERIFICATION : LES PARAMETRES EXISTENT ET SONT NON VIDES
    // Vérification du paramètre 'semaine' 
        $id = $_REQUEST['id'];
        $movie = getMovieDetail($id);
        return $movie;
    }

function readCategoriesController() {
    $categories = getCategory();

    if ($categories != 0){
        return $categories;
    } else {
        return "Les catégories n'ont pas pu être récupérer";
    };
}

function readMovieCategoryController() {
    $id = $_REQUEST['id'];
    $age = $_REQUEST['min_age'];

    $movies = getMovieCategories($id, $age);

    if ($movies != 0) {
        return $movies;
    } else {
        return "La catégorie $category de ces films n'a pas été récupéré";
    }
}


// function readMovieCategoryController() {
//     $category = $_REQUEST['category'];

//     $movies = getMovieCategories($category);

//     if ($movies != 0) {
//         return $movies;
//     } else {
//         return "La catégorie $category de ces films n'a pas été récupéré";
//     }
// }

function addUserProfileController(){
    
    $name = $_REQUEST['name'];
    $avatar = $_REQUEST['avatar'];
    $min_age = $_REQUEST['min_age'];
  
    $ok = addUserProfile($name, $avatar, $min_age);
   
    if ($ok!=0){
        return "$name a été ajouté avec succès";
      }
      else{
        return "Le profile n'a pas pu être ajouté";
      }
  }


  function getUserProfileController(){
    $profiles = getAllUserProfiles();
    return $profiles;
    exit();
}

// function getMoviesOrderByAgeController(){
//     $moviesorder = getMoviesOrderByAge();
//     return $profiles;
//     exit();
// }

function addNewProfileController() {
    try {
        if (empty($_POST['Nom'])) {
            return "Erreur : Le Nom est obligatoire.";
        }
        
        if (empty($_POST['Age'])) {
            return "Erreur : L'Age est obligatoire.";
        }

        if (empty($_POST['id'])) {
            return "Erreur : L'id est obligatoire.";
        }
        
        $Nom = $_POST['Nom'];
        $Age = $_POST['Age'];
        $id = $_POST['id'];
        $file = "default-avatar.png";

        // Gestion du fichier
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = "./images/";
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $filename = basename($_FILES['file']['name']);
            $upload_file = $upload_dir . $filename;
            
            if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                $file = $filename;
            }
        }
        // Appel de la fonction du modèle
        $ok = addNewProfile($Nom, $Age, $file, $id);
        return $ok ? "Profil ajouté avec succès" : "Erreur lors de l'ajout du profil";
        
    } catch (Exception $e) {
        return "Erreur: " . $e->getMessage();
    }
}