<?php

header('Access-Control-Allow-Origin: *');

$connect = new PDO("mysql:host=localhost;dbname=id20421073_gamedb", "id20421073_aelmartins", "E.E.HomeroA1");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

if($received_data->query != '')
{
	$query = "
	SELECT * FROM fatec_professores 
	WHERE professor_name LIKE '%".$received_data->query."%' 
	OR professor_address LIKE '%".$received_data->query."%' 
    OR professor_course LIKE '%".$received_data->query."%' 
    OR professor_wage LIKE '%".$received_data->query."%'
	ORDER BY professor_wage DESC
	";
}
else
{
	$query = "
	SELECT * FROM fatec_professores 
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