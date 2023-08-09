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

    public function checkRole($username){
        $sql = "SELECT * FROM users WHERE username=:username";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $user['role'];
    }

}


?>