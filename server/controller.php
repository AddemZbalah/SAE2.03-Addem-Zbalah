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
    }
}

function readMovieCategoryController() {
    $category = $_REQUEST['category'];

    $movies = getMovieCategories($category);

    if ($movies != 0) {
        return $movies;
    } else {
        return "La catégorie $category de ces films n'a pas été récupéré";
    }
}