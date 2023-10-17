<?php 

// Connexion à la base de données
function getPosts() {
    try
    {
       $database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
    }
    catch(Exception $e){
       die( 'Erreur : '.$e->getMessage());
    }
 
    // On récupère les 5 derniers posts
    $statement = $database->query("SELECT id, title, content, 
    DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') 
    AS date_creation_fr FROM posts
    ORDER BY creation_date DESC LIMIT 0, 5");
    //print_r($statement);
    $posts = [];
    while ($row = $statement->fetch()) {
       $post = [
          'title' => $row['title'],
          'content' => $row['content'],
          'frenchCreationDate' => $row['date_creation_fr'],
       ];
       $posts[] = $post;
       //print_r($posts);
    }
    return $posts;
 }
?>