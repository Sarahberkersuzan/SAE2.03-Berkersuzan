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
define("DBNAME", "berkersuzan1");
define("DBLOGIN", "berkersuzan1");
define("DBPWD", "berkersuzan1");

function getAllMovies(){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "select id, name, image from Movie";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; 
}
/**
 * Fonction pour ajouter un film à la base de données.
 *
 * @param string $name Nom du film.
 * @param string $director Nom du réalisateur.
 * @param int $year Année de sortie.
 * @param int $length Durée du film en minutes.
 * @param string $description Description du film.
 * @param int $id_category ID de la catégorie du film.
 * @param string $image URL de l'image du film.
 * @param string $trailer URL de la bande-annonce du film.
 * @param int $min_age Âge minimum recommandé pour le film.
 *
 * @return int Nombre de lignes affectées par l'insertion.
 */
function addMovie($name, $year, $length, $description, $director, $id_category, $image, $trailer, $min_age) {

        $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
        $sql = "INSERT INTO Movie (name, year, length, description, director, id_category, image, trailer, min_age) 
                VALUES (:name, :year, :length, :description, :director, :id_category, :image, :trailer, :min_age)";
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

        return $stmt->rowCount();
}

function detailMovie($id) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT Movie.id, Movie.name, image, description, director, year, length, Category.name AS category_name, min_age, trailer 
            FROM Movie 
            INNER JOIN Category ON Movie.id_category = Category.id 
            WHERE Movie.id = :id";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_OBJ);
    return $res; 
}

function getCategory() {
        try {
            $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
    
            $sql = "SELECT 
                        Category.id, 
                        Category.name AS category_name, 
                        Movie.id, 
                        Movie.name, 
                        Movie.image 
                    FROM Movie
                    JOIN Category ON Movie.id_category = Category.id
                    ORDER BY Category.id";
    
            $stmt = $cnx->query($sql);
            $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
    
            $category = [];
            foreach ($rows as $row) {
                if (!isset($category[$row->category.id])) {
                    $category[$row->category_id] = [
                        "name" => $row->category_name,
                        "movie" => []
                    ];
                }
                $category[$row->category.id]["movie"][] = [
                    "id" => $row->movie.id,
                    "name" => $row->movie.name,
                    "image" => $row->movie.image
                ];
            }
    
            return array_values($category);
        } catch (Exception $e) {
            error_log("Erreur SQL : " . $e->getMessage());
            return false;
        }
    }
    