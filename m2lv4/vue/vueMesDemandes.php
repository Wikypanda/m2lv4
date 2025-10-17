<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        <div class="zoneFormations" style="position: relative;">
            <h1>Mes demandes de formation</h1>

            <?php if (!empty($_SESSION['message'])) : ?>
                <p class="message"><?= htmlspecialchars($_SESSION['message']) ?></p>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['listeDemandes'])) : ?>
                <ul class="listeFormations">
                    <?php foreach ($_SESSION['listeDemandes'] as $demande) : ?>
                        <?php
                            // Détermine la classe CSS selon le statut
                            switch ($demande['idStatut']) {
                                case 1: $classeStatut = 'statutAttente'; break;
                                case 2: $classeStatut = 'statutValidee'; break;
                                case 3: $classeStatut = 'statutRefusee'; break;
                                default: $classeStatut = 'statutInconnu';
                            }
                        ?>
                        <li>
                            <div class="carteFormation">
                                <strong><?= htmlspecialchars($demande['intitule']) ?></strong><br>
                                <?= nl2br(htmlspecialchars($demande['descriptif'])) ?><br>
                                Places disponibles : <?= htmlspecialchars($demande['nbPlaces']) ?><br>
                                Durée : <?= htmlspecialchars($demande['duree']) ?> jours<br>
                                Date de demande : <?= formatDateFr($demande['dateDemande']) ?><br>

                                <span class="statutDemande <?= $classeStatut ?>">
                                    Statut : 
                                    <?php
                                        switch ($demande['idStatut']) {
                                            case 1: echo "⏳ En attente"; break;
                                            case 2: echo "✅ Validée"; break;
                                            case 3: echo "❌ Refusée"; break;
                                            default: echo "❓ Inconnu";
                                        }
                                    ?>
                                </span><br>

                                <form method="post" action="index.php" onsubmit="return confirm('Annuler cette demande ?');">
                                    <input type="hidden" name="m2lMP" value="annulerDemande">
                                    <input type="hidden" name="idFormation" value="<?= $demande['idForma'] ?>">
                                    <input type="submit" value="Annuler" class="btnAnnuler">
                                </form>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p class="aucuneFormation">Vous n'avez aucune demande en cours.</p>
            <?php endif; ?>

            <div class="zoneBoutonsActions">
                <form method="post" action="index.php">
                    <input type="hidden" name="m2lMP" value="formations">
                    <input type="submit" value="Retour aux formations" class="btnRetour">
                </form>
            </div>
        </div>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
