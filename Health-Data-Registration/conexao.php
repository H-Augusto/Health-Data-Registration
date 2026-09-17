<?php

function conectarBD(): PDO
{
    $host   = 'localhost';
    $dbname = 'sistema_exames';
    $usuario = 'root';
    $senha   = ''; 

    try {
        $pdo = new PDO(
            "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
            $usuario,
            $senha
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch (PDOException $e) {
        die('Erro na conexão com o banco: ' . $e->getMessage());
    }
}