<?php

    function connect(){
        $host = 'localhost';
        $dbname = 'datatm_sistema1';
        $username = 'datatm_sistema1';
        $password = 'teresita2022';
        $data = "mysql:host=" . $host . ";dbname=" . $dbname . ";";
        try {
            return new PDO($data, $username, $password);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
