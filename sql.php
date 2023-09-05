<?php

// Prepared Statements -> Evitare le SQL Injections
// Le prepared statements sono un diverso modo di eseguire le query: consistono nel "preparare"
// l'istruzione utilizzando dei segnaposto per i valori da inserire nella query.
// Questi vengono sostituiti con una successiva funzione bind_param(), la quale riceve come parametri i valori effettivi da inserire nella query.

// prepare and bind
$stmt = $conn->prepare("INSERT INTO my_quests (firstname, lastname, email) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $firstname, $lastname, $email);

// set parameters and execure
$firstname = 'Name';
$lastname = 'Surname';
$email = 'email@example.com';
$stmt->execute();

// get result
$result = $stmt->get_result();

?>
