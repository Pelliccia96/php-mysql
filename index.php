<?php

require_once('database.php');

var_dump($_POST);

$queryLogin = "SELECT *
                FROM users
                WHERE email = '{$_POST['email']}'
                    AND password = '{$_POST['password']}'";

$resultLogin = $db->query($queryLogin);

/* // SQL Injection --> password = asd' OR '1'='1  |  Prepared Statements  => $conn->prepare(); ->bind_param(); ->execute();
var_dump($queryLogin);
var_dump($resultLogin->num_rows ); */

// Se num_rows > 0, è stato trovato un utente con quelle credenziali
if($resultLogin && $resultLogin->num_rows > 0){
    $user = $resultLogin->fetch_assoc();
    var_dump($user);
}

/* var_dump($resultLogin); */

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php-mysqli</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <main class="container pb-5">
        <div class="my-5">
            <h1 class="text-center">PHP - MySQLi</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3"><label class="form-label fw-semibold">E-mail</label>
                                <input type="text" class="form-control" name="email">
                            </div>
                            <div class="mb-3"><label class="form-label fw-semibold">Password</label>
                                <input type="text" class="form-control" type="password" name="password">
                            </div>
                            <button class="btn btn-dark fw-bold">Accedi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
