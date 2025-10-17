<?php
function estConnecte() {
    return !empty($_SESSION['utilisateur']) && isset($_SESSION['utilisateur']['idUser']);
}

function estResponsable() {
    return estConnecte() && $_SESSION['utilisateur']['idTypeU'] == 1;
}

function estSalarie() {
    return estConnecte() && $_SESSION['utilisateur']['idTypeU'] == 2;
}

function formatDateFr($dateSql) {
    $date = new DateTime($dateSql);
    $formatter = new IntlDateFormatter(
        'fr_FR', // langue
        IntlDateFormatter::LONG, // format de date
        IntlDateFormatter::NONE // pas d'heure
    );
    return $formatter->format($date);
}

/**
 * Retourne true si l'utilisateur connecté est DRH / administrateur (idTypeU == 1)
 */
function estDRH() {
    return estConnecte() && (($_SESSION['utilisateur']['idTypeU'] ?? 0) == 1);
}

/** CSRF helpers **/
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token']) || !isset($_SESSION['csrf_token_time']) || time() - $_SESSION['csrf_token_time'] > 3600) {
        if (function_exists('random_bytes')) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        } else {
            $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
        $_SESSION['csrf_token_time'] = time();
    }
    return $_SESSION['csrf_token'];
}

function validate_csrf_token($token) {
    if (empty($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    $valid = hash_equals($_SESSION['csrf_token'], (string)$token);
    return $valid;
}

function csrf_input() {
    $token = generate_csrf_token();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
}
