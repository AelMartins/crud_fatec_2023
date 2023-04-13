<!-- A parte mais importante desse código é a consulta SQL, 
pois é o que realiza a busca no banco de dados com base no 
parâmetro recebido através do método POST. Dependendo do 
valor recebido, a consulta SQL será diferente, mas ambas as 
consultas vão ordenar os resultados pelo ID em ordem decrescente 
e retornar um array de resultados em formato JSON, que é retornado 
para a aplicação front-end que fez a requisição. -->

<?php

header('Access-Control-Allow-Origin: *');

$connect = new PDO("mysql:host=localhost;dbname=id20421073_gamedb", "id20421073_aelmartins", "E.E.HomeroA1");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

if($received_data->query != '')
{
	$query = "
	SELECT * FROM fatec_alunos 
	WHERE first_name LIKE '%".$received_data->query."%' 
	OR last_name LIKE '%".$received_data->query."%' 
	ORDER BY id DESC
	";
}
else
{
	$query = "
	SELECT * FROM fatec_alunos 
	ORDER BY id DESC
	";
}

$statement = $connect->prepare($query);

$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	$data[] = $row;
}

echo json_encode($data);

?>