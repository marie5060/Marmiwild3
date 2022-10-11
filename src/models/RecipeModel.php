<?php

class RecipeModel{
    
    private $connection;
    
    // create pdo
    public function __construct()
    {
        $this->connection = new \PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
    }

    //select *
    public function getAll(): array
    {
        $statement = $this->connection->query('SELECT id, title FROM recipe');
        $recipes = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $recipes;
    }

    //get by id 
    public function getRecipeById(int $id)
    {
        $statement = $this->connection->prepare('SELECT title, description FROM recipe WHERE id=:id');
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    
        $recipe = $statement->fetch(PDO::FETCH_ASSOC);
    
        return $recipe;
    }

    public function save($recipe)
    {
        $statement = $this->connection->prepare('INSERT INTO recipe (title, description) VALUES (:title, :description)');
        $statement->bindValue(':title', $recipe['title'], PDO::PARAM_STR);
        $statement->bindValue(':description', $recipe['description'], PDO::PARAM_STR);
        $statement->execute();
    }

}