Bulletins (schéma minimal requis)

La fonctionnalité "bulletins" attend une table SQL `bulletins` avec la structure minimale suivante :

CREATE TABLE bulletins (
  id_bulletin INT AUTO_INCREMENT PRIMARY KEY,
  id_intervenant INT NOT NULL,
  mois VARCHAR(7) NOT NULL, -- format YYYY-MM
  net_a_payer DECIMAL(10,2) DEFAULT 0,
  date_emission DATE DEFAULT NULL,
  fichier VARCHAR(255) DEFAULT NULL
);

Notes :
- Le champ `id_intervenant` doit correspondre à l'identifiant utilisé pour les intervenants dans votre application.
- Les vues ajoutées supposent que l'authentification place `$_SESSION['utilisateur']['idUser']` pour l'utilisateur connecté.

Test rapide :
1. Créer quelques enregistrements dans la table `bulletins`.
2. Se connecter en DRH (idTypeU == 1) et accéder à l'onglet "Bulletins".
3. Se connecter en tant qu'intervenant et accéder à l'onglet "Mes bulletins".

Améliorations possibles :
- Upload/stockage sécurisé des fichiers PDF.
- Pagination et filtres (par intervenant, par date).
- Vérification des permissions plus fine (vérifier que `idUser` correspond bien à un intervenant).