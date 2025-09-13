<?php
/*
 * Copyright (c) 2025. Brusegan Samuele, Davanzo Andrea
 * Questo file fa parte di GradeCraft ed è rilasciato
 * sotto la licenza MIT. Vedere il file LICENSE per i dettagli.
 */

// use cvv\Collegamenti;
// use cvv\CvvIntegration;
// Definisci il percorso base dell'applicazione

define('BASE_PATH', dirname(__DIR__));
session_start();
const URL_PATH = "https://todos.test";
const COMMON_HTML_HEAD = BASE_PATH . '/public/commons/head.php';
const COMMON_HTML_FOOT = BASE_PATH . '/public/commons/bottom_navigation.php';

const THEME = (0) ? 'light' : 'dark';

// Includi i file necessari, a mano o con l'autoloader di Composer
require_once BASE_PATH . '/app/Router.php';
require_once BASE_PATH . '/public/functions.php';
require_once BASE_PATH . '/app/controllers/Controller.php';


checkSessionExpiration();


// Inizializza il router
$router = new Router();

// Definisci le rotte
require BASE_PATH . '/public/routes.php';

//Send globals to JS
echo "
<script>
    sessionStorage.setItem('url', '" . URL_PATH . "');
    sessionStorage.setItem('theme', '" . THEME . "');
</script>";

// Ottieni l'URL richiesto e fai partire il router
$url = $_SERVER['REQUEST_URI'];
$router->dispatch($url);
?>
