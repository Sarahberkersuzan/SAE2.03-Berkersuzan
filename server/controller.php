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

function readMoviesController(){
    $age = $_REQUEST['age'];
    if ($age == null) {
        return false;
    }
    return getAllMovies($age);
}

function addController() {
  header('Content-Type: application/json');

  $name = $_REQUEST['name'];
  $year = $_REQUEST['year'];
  $length = $_REQUEST['length'];
  $description = $_REQUEST['description'];
  $director = $_REQUEST['director'];
  $id_category = $_REQUEST['id_category'];
  $image = $_REQUEST['image'];
  $trailer = $_REQUEST['trailer'];
  $min_age = $_REQUEST['min_age'];

  $ok = addMovie($name, $year, $length, $description, $director, $id_category, $image, $trailer, $min_age);

  if ($ok != 0) {
      echo json_encode(["success" => true, "message" => "Film ajouté à la base de donnée"]);
  } else {
      echo json_encode(["success" => false, "message" => "Erreur lors de l'ajout du film"]);
  }

exit();

}

function detailController() {
 

  $id = $_REQUEST['id'];

  $movie = detailMovie($id);

  if ($movie != null) {
      echo json_encode(["success" => true, "movie" => $movie]);
  } else {
      echo json_encode(["success" => false, "message" => "Erreur lors de la récupération du film"]);
  }
  exit();
}

function categoryController() {
    $category = getCategory();
    return $category ? $category : false;
}

function profilController() {

    // Vérifiez que les paramètres sont définis
    if (!isset($_REQUEST['nom']) || !isset($_REQUEST['avatar']) || !isset($_REQUEST['age'])) {
        echo json_encode(["success" => false, "message" => "Paramètres manquants"]);
        exit();
    }

    $nom = $_REQUEST['nom'];
    $avatar = $_REQUEST['avatar'];
    $age = $_REQUEST['age'];

    // Vérifiez que l'âge est un entier valide
    if ( $age <= 0) {
        echo json_encode(["success" => false, "message" => "Âge invalide"]);
        exit();
    }

    $ok = addProfil($nom, $avatar, $age);

    if ($ok != 0) {
        echo json_encode(["success" => true, "message" => "Profil ajouté à la base de donnée"]);
    } else {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'ajout du Profil"]);
    }

    exit();
}

function readProfilController() {
    $profil = getAllProfil();
    return $profil;
}