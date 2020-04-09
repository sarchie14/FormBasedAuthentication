<?php

    function get_username($username) {

        global $db;
        $query = 'SELECT username FROM administrators WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        $user_name = $user['username'];
        return $user_name;
        }
    

    function add_admin($username, $password) {
        global $db;
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = 'INSERT INTO administrators (username, password)
                  VALUES (:username, :password)';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $hash);
        $statement->execute();
        $statement->closeCursor();
    }

    function is_valid_admin_login($username, $password) {
        global $db;
        $query = 'SELECT userPassword FROM administrators
                    WHERE username = :username';
        $statement = $db->prepare($query);
        $statement->bindValue(':username, $username');
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();
        $hash = $row['password'] ?? NULL;
        return password_verify($password, $hash);
    }
?>