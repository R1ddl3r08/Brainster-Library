<?php

namespace Database;

class Query
{
    protected \PDO $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function userExists($column, $value) : bool
    {
        $sql = "SELECT {$column} FROM users WHERE {$column} = :value;";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([":value" => $value]);

        return (bool) $stmt->rowCount();
    }

    public function registerUser($email, $username, $password)
    {
        $sql = "INSERT INTO users (email, username, password, role)
        VALUES (:email, :username, :password, :role)";
    
        $data = [
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'role' => "client",
        ];
    
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    public function validatePassword($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username=:username";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(password_verify($password, $user['password'])){
            return true;
        }

        return false;
    }

    public function checkRole($username)
    {
        $sql = "SELECT * FROM users WHERE username=:username";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $user['role'];
    }

    public function getAll($tableName)
    {
        $sql = "SELECT * FROM $tableName WHERE is_archived = 0";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getBooks()
    {
        $sql = "SELECT 
                    books.*,
                    authors.first_name, authors.last_name, authors.short_bio,
                    categories.category
                FROM books
                JOIN authors ON books.author_id = authors.id
                JOIN categories ON books.category_id = categories.id
                WHERE books.is_archived = 0";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getBook($id)
    {
        $sql = "SELECT 
        books.*,
        authors.first_name, authors.last_name, authors.short_bio,
        categories.category
        FROM books
        JOIN authors ON books.author_id = authors.id
        JOIN categories ON books.category_id = categories.id
        WHERE books.id = :id;";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


    //BOOKS CRUD OPEARTIONS
    public function addBook($title, $author, $publicationYear, $numberOfPages, $image, $category)
    {
        $sql = "INSERT INTO books (title, author_id, publication_year, number_of_pages, image, category_id) VALUES (:title, :author, :publicationYear, :numberOfPages, :image, :category)";

        $data = [
            'title' => $title,
            'author' => $author,
            'publicationYear' => $publicationYear,
            'numberOfPages' => $numberOfPages,
            'image' => $image,
            'category' => $category
        ];

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    public function updateBook($bookId, $title, $author, $publicationYear, $numberOfPages, $image, $category)
    {
        $sql = "UPDATE books 
                SET title = :title, 
                    author_id = :author, 
                    publication_year = :publicationYear, 
                    number_of_pages = :numberOfPages, 
                    image = :image, 
                    category_id = :category
                WHERE id = :bookId";

        $data = [
            'title' => $title,
            'author' => $author,
            'publicationYear' => $publicationYear,
            'numberOfPages' => $numberOfPages,
            'image' => $image,
            'category' => $category,
            'bookId' => $bookId
        ];

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    public function deleteBook($id)
    {
        $sql = "
        UPDATE books
        SET is_archived = 1
        WHERE id = :bookId;
        
        DELETE FROM public_comments
        WHERE book_id = :bookId;
        
        DELETE FROM private_notes
        WHERE book_id = :bookId;";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':bookId', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    // CATEGORIES CRUD OPERATIONS
    public function getCategory($id)
    {
        $sql = "SELECT * FROM categories WHERE id=:id";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function addCategory($category)
    {
        $sql = "INSERT INTO categories (category) VALUES (:category)";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':category', $category, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function updateCategory($categoryId, $category)
    {
        $sql = "UPDATE categories 
                SET category = :category 
                WHERE id = :id";

        $data = [
            'id' => $categoryId,
            'category' => $category,
        ];

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    public function deleteCategory($id)
    {
        $sql = "
        UPDATE categories
        SET is_archived = 1
        WHERE id = :categoryId;";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':categoryId', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    // AUTHORS CRUD OPERATIONS
    public function getAuthor($id)
    {
        $sql = "SELECT * FROM authors WHERE id=:id";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute(['id' => $id]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function addAuthor($firstName, $lastName, $shortBio)
    {
        $sql = "INSERT INTO authors (first_name, last_name, short_bio) VALUES (:first_name, :last_name, :short_bio)";

        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'short_bio' => $shortBio,
        ];

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    public function updateAuthor($authorId, $firstName, $lastName, $shortBio)
    {
        $sql = "UPDATE authors 
                SET first_name = :first_name, 
                    last_name = :last_name, 
                    short_bio = :short_bio
                WHERE id = :id";

        $data = [
            'id' => $authorId,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'short_bio' => $shortBio
        ];

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    public function deleteAuthor($id)
    {
        $sql = "
        UPDATE authors
        SET is_archived = 1
        WHERE id = :authorId;";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':authorId', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }




}


?>