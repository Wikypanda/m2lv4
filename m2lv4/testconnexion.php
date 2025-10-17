<?php
$motDePasseSaisi = 'admin';
$hashEnBase = '$2y$10$oGswGGvaU9LG9793XaQE2.Kgw2aHfEovWKLDalJmRnw1/DKBARhoO'; // remplace par ton vrai hash

if (password_verify($motDePasseSaisi, $hashEnBase)) {
    echo "Mot de passe valide ✅";
} else {
    echo "Mot de passe incorrect ❌";
}
