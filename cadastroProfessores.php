<?php
header('Access-Control-Allow-Origin: *');

$connect = new PDO("mysql:host=localhost;dbname=id20421073_gamedb", "id20421073_aelmartins", "E.E.HomeroA1");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if ($received_data->action == 'fetchall') {
    $query = "
 SELECT * FROM fatec_professores 
 ORDER BY professor_wage DESC
 ";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
if ($received_data->action == 'insert') {
    $data = array(
        ':professor_name' => $received_data->professorName,
        ':professor_address' => $received_data->professorAddress,
        ':professor_course' => $received_data->professorCourse,
        ':professor_wage' => $received_data->professorWage,
    );

    $query = "
 INSERT INTO fatec_professores 
 (professor_name, professor_address, professor_course, professor_wage) 
 VALUES (:professor_name, :professor_address, :professor_course, :professor_wage)
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Professor Adicionado'
    );

    echo json_encode($output);
}
if ($received_data->action == 'fetchSingle') {
    $query = "
 SELECT * FROM fatec_professores 
 WHERE id = '" . $received_data->id . "'
 ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

    foreach ($result as $row) {
        $data['id'] = $row['id'];
        $data['professor_name'] = $row['professor_name'];
        $data['professor_address'] = $row['professor_address'];
        $data['professor_course'] = $row['professor_course'];
        $data['professor_wage'] = $row['professor_wage'];
    }

    echo json_encode($data);
}
if ($received_data->action == 'update') {
    $data = array(
        ':professor_name' => $received_data->professorName,
        ':professor_address' => $received_data->professorAddress,
        ':professor_course' => $received_data->professorCourse,
        ':professor_wage' => $received_data->professorWage,
        ':id' => $received_data->hiddenId
    );

    $query = "
 UPDATE fatec_professores 
 SET professor_name = :professor_name, 
 professor_address = :professor_address,
 professor_course = :professor_course, 
 professor_wage = :professor_wage
 WHERE id = :id
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Professor Atualizado'
    );

    echo json_encode($output);
}

if ($received_data->action == 'delete') {
    $query = "
 DELETE FROM fatec_professores 
 WHERE id = '" . $received_data->id . "'
 ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $output = array(
        'message' => 'Professor Deletado'
    );

    echo json_encode($output);
}

?>