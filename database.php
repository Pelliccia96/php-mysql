<?php

// Definizione delle costanti per le informazioni di connessione al database
define('DB_SERVERNAME', 'localhost');  // Nome del server MySQL
define('DB_USERNAME', 'root');         // Nome utente del database
define('DB_PASSWORD', 'root');         // Password dell'utente del database
define('DB_NAME', 'mysqli');           // Nome del database che verrà utilizzato
define('DB_PORT', 3306);               // Porta del server MySQL

// Creazione di un oggetto mysqli per gestire la connessione al database
$db = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, null, DB_PORT);

// Verifica la connessione al server MySQL
if($db && $db->connect_error){
    throw new Exception("Connessione al database fallita: " . $db->connect_error);
}

/* var_dump($db); */

// Crea il database 'mysqli' se non esiste
$createDatabase = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($db->query($createDatabase) === TRUE) {
    echo "Database creato con successo o già esistente.\n";
} else {
    echo "Errore durante la creazione del database: " . $db->error . "\n";
}

// Seleziona il database 'mysqli'
$db->select_db(DB_NAME);

// Crea la tabella 'users' se non esiste
$createTable = "CREATE TABLE IF NOT EXISTS users (
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
    last_name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
    email VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_general_ci UNIQUE,
    password VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci
)";
if ($db->query($createTable) === TRUE) {
    echo "Tabella 'users' creata con successo o già esistente.\n";
} else {
    echo "Errore durante la creazione della tabella: " . $db->error . "\n";
}

// Creazione di un nuovo utente nella tabella 'users'
$newUserFirstName = 'CognomeUtente';
$newUserLastName = 'NomeUtente';
$newUserEmail = 'email@gmail.com';
$newUserPassword = password_hash('password', PASSWORD_DEFAULT);

$insertUser = "INSERT INTO users (first_name, last_name, email, password)
                   VALUES ('$newUserFirstName', '$newUserLastName', '$newUserEmail', '$newUserPassword')";

if ($db->query($insertUser) === TRUE) {
    echo "Nuovo utente creato con successo.\n";
} else {
    echo "Errore durante la creazione del nuovo utente: " . $db->error . "\n";
}


// $result è un istanza di msqli_result. Questa classe contiene SOLO delle statistiche riguardanti i dati letti
// $result->num_rows contiene il numero totale di righe trovate per la query utilizzata
$sql = "SELECT * FROM users";
$result = $db->query($sql);

if($result && $result->num_rows >= 0) {
    var_dump($result);

    // Finchè la var $row ha un valore, assegna come valore della var $row il risultato della funzione $result->fetch_assoc()
    while($row = $result->fetch_assoc()) {
        var_dump($row);
    }
}


// Resetta l'indice di lettura
$result->data_seek(0);

// Recupera sotto forma di Array Associativo TUTTE le righe del db (utilizzabile quando bisogna ritornare i dati per creare un API, es. sottoforma di JSON)
$users = $result->fetch_all();
var_dump($users);


/* // Chiude la connessione al database
$db->close(); */

?>
