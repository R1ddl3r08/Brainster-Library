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

    public function getUser($username)
    {
        $sql = "SELECT * FROM users WHERE username=:username";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $user;
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


    // Reviews
    public function addReview($userId, $bookId, $comment)
    {
        $sql = "INSERT INTO public_comments (user_id, book_id, comment)
                VALUES (:userId, :bookId, :comment)";

        $data = [
            ':userId' => $userId,
            ':bookId' => $bookId,
            ':comment' => $comment,
        ];

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    public function validateReview($userId, $bookId)
    {
        $sql = "SELECT * FROM public_comments WHERE user_id = :userId";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_STR);
        $stmt->execute();

        $comment = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(empty($comment)){
            return true;
        }

        if($comment['book_id'] == $bookId){
            return false;
        }

        return true;
    }

    public function getReviews($status)
    {
        if($status === 'approved'){
            $condition = "is_approved = 1";
        } elseif($status === 'rejected'){
            $condition = "is_approved = 0";
        } elseif($status === 'pending'){
            $condition = "is_approved IS NULL";
        }

        $sql = $sql = "SELECT pc.*, u.username, b.title
        FROM public_comments pc
        LEFT JOIN users u ON pc.user_id = u.id
        LEFT JOIN books b ON pc.book_id = b.id
        WHERE $condition";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $reviews = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $reviews;
    }

    public function getReviewsByUser($userId)
    {
        $sql = "SELECT pc.*, u.username, b.title
        FROM public_comments pc
        LEFT JOIN users u ON pc.user_id = u.id
        LEFT JOIN books b ON pc.book_id = b.id
        WHERE user_id=:userId";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $stmt->execute();

        $reviews = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $reviews;
    }

    public function getReviewsByBook($bookId)
    {
        $sql = "SELECT pc.*, u.username, b.title
        FROM public_comments pc
        LEFT JOIN users u ON pc.user_id = u.id
        LEFT JOIN books b ON pc.book_id = b.id
        WHERE book_id=:bookId AND is_approved=1";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':bookId', $bookId, \PDO::PARAM_INT);
        $stmt->execute();

        $reviews = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $reviews;
    }

    public function changeReviewStatus($status, $reviewId)
    {
        $sql = "UPDATE public_comments SET is_approved = :status WHERE id = :reviewId";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':status', $status, \PDO::PARAM_INT);
        $stmt->bindParam(':reviewId', $reviewId, \PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function deleteReview($reviewId)
    {
        $sql = "DELETE FROM public_comments WHERE id=:id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $reviewId, \PDO::PARAM_INT);
        
        return $stmt->execute();
    }


    // Notes
    public function addNote($userId, $bookId, $note)
    {
        $sql = "INSERT INTO private_notes (user_id, book_id, note)
                VALUES (:userId, :bookId, :note)";

        $data = [
            ':userId' => $userId,
            ':bookId' => $bookId,
            ':note' => $note,
        ];

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    public function getNotesByUserAndBook($userId, $bookId)
    {
        $sql = "SELECT * FROM private_notes WHERE user_id=:userId AND book_id=:bookId";

        $data = [
            ':userId' => $userId,
            ':bookId' => $bookId
        ];

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);

        $notes = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $notes;
    }

    public function getNotesByUser($userId)
    {
        $sql = "SELECT pn.*, u.username, b.title
        FROM private_notes pn
        LEFT JOIN users u ON pn.user_id = u.id
        LEFT JOIN books b ON pn.book_id = b.id
        WHERE user_id=:userId";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $stmt->execute();

        $notes = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $notes;
    }

    public function deleteNote($noteId)
    {
        $sql = "DELETE FROM private_notes WHERE id=:id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $noteId, \PDO::PARAM_INT);
        
        return $stmt->execute();
    }

    public function editNote($noteId, $note)
    {
        $sql = "UPDATE private_notes SET note = :note WHERE id = :id";

        $data = [
            ':note' => $note,
            ':id' => $noteId
        ];

        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

}


?>