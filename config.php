<!-- A parte mais importante deste código é a conexão com o banco de dados MySQL.
 Esta conexão é feita utilizando o objeto mysqli_connect(), que recebe quatro 
 parâmetros: o nome do servidor MySQL, o usuário do MySQL, a senha do MySQL e o 
 nome do banco de dados. Em seguida, é verificado se houve erro na conexão 
 utilizando o operador de negação ! e a função mysqli_connect_error(). Caso haja 
 erro na conexão, o código morre e exibe uma mensagem de erro. -->

<?php

$host = "localhost"; // nome do servidor MySQL
$user = "id20421073_aelmartins"; // usuário do MySQL
$pass = "E.E.HomeroA1"; // senha do MySQL
$dbname = "id20421073_gamedb"; // nome do banco de dados

// Conexão com o banco de dados MySQL
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Verifica se houve erro na conexão
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}
