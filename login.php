<!-- A parte mais importante deste código é a verificação de validade do email e senha
 fornecidos pelo usuário no início do código. Esta verificação é crucial para garantir 
 que somente usuários autorizados tenham acesso à área restrita do site. Além disso, a 
 utilização de criptografia md5 na senha também é importante para garantir a segurança 
 das informações do usuário. Outro ponto importante é a utilização de sessões para 
 manter o usuário autenticado após o login, evitando a necessidade de autenticação a 
 cada nova página acessada na área restrita. -->

<?php

ob_start();

session_start(); // Inicia a sessão

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email_login'];
    $senha = $_POST['senha_login'];

    // Verifica se o email e senha são válidos
    $query = "SELECT id, nome FROM fatec_admin WHERE email='$email' AND senha=md5('$senha')";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['id'];
        $_SESSION['nome'] = $row['nome'];
        header('Location: dashboard.html'); // Redireciona para a página de dashboard
    } else {
        echo '<script>alert("Email ou senha incorretos!")</script>'; 
        header("Location: index.html#paralogin");               
    }
}

ob_end_flush();

?>

