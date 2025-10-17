<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        <div class="zoneModifierContrat">
            <h2>Modifier un contrat</h2>

            <?php if (!empty($message)) : ?>
                <p class="message <?= htmlspecialchars($messageType) ?>"><?= $message ?></p>
            <?php endif; ?>

            <form method="post" action="index.php">
                <input type="hidden" name="m2lMP" value="validerModificationContrat">
                <input type="hidden" name="idContrat" value="<?= htmlspecialchars($contrat->getIdContrat()) ?>">
                <?= csrf_input() ?>

                <fieldset class="fieldsetSection">
                    <legend>Informations du contrat</legend>

                    <div class="ligneForm">
                        <label>ID Contrat</label>
                        <input type="text" value="<?= htmlspecialchars($contrat->getIdContrat()) ?>" disabled>
                    </div>                    
                    <div class="ligneForm">
                        <label for="idUser">Utilisateur *</label>
                        <select id="idUser" name="idUser" required>
                            <option value="">-- Sélectionner un utilisateur --</option>
                            <?php foreach ($utilisateurs as $user) : ?>
                                <option value="<?= $user['idUser'] ?>" 
                                    <?= ($contrat->getIdUser() == $user['idUser']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($user['nom'] . ' ' . $user['prenom'] . ' (' . $user['login'] . ')') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="ligneForm">
                        <label for="typeContrat">Type de contrat *</label>
                        <select id="typeContrat" name="typeContrat" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="CDI" <?= $contrat->getTypeContrat() === 'CDI' ? 'selected' : '' ?>>CDI</option>
                            <option value="CDD" <?= $contrat->getTypeContrat() === 'CDD' ? 'selected' : '' ?>>CDD</option>
                            <option value="Stage" <?= $contrat->getTypeContrat() === 'Stage' ? 'selected' : '' ?>>Stage</option>
                            <option value="Alternance" <?= $contrat->getTypeContrat() === 'Alternance' ? 'selected' : '' ?>>Alternance</option>
                            <option value="Temps partiel" <?= $contrat->getTypeContrat() === 'Temps partiel' ? 'selected' : '' ?>>Temps partiel</option>
                        </select>
                    </div>

                    <div class="ligneForm">
                        <label for="dateDebut">Date de début *</label>
                        <input type="date" id="dateDebut" name="dateDebut" 
                               value="<?= htmlspecialchars($contrat->getDateDebut()) ?>" required>
                    </div>

                    <div class="ligneForm">
                        <label for="dateFin">Date de fin</label>
                        <input type="date" id="dateFin" name="dateFin" 
                               value="<?= htmlspecialchars($contrat->getDateFin()) ?>">
                        <small>Laisser vide pour un CDI ou contrat sans date de fin</small>
                    </div>

                    <div class="ligneForm">
                        <label for="nbHeures">Nombre d'heures</label>
                        <input type="number" id="nbHeures" name="nbHeures" 
                               placeholder="35" min="1" max="168"
                               value="<?= htmlspecialchars($contrat->getNbHeures() ?? '') ?>">
                        <small>Heures par semaine</small>
                    </div>

                    <div class="ligneForm">
                        <label for="salaireBrut">Salaire brut (€)</label>
                        <input type="number" step="0.01" id="salaireBrut" name="salaireBrut" 
                               placeholder="2500.00"
                               value="<?= htmlspecialchars($contrat->getSalaireBrut() ?? '') ?>">
                    </div>

                    <div class="ligneForm">
                        <label for="actif">Statut</label>
                        <select id="actif" name="actif">
                            <option value="1" <?= $contrat->getActif() ? 'selected' : '' ?>>Actif</option>
                            <option value="0" <?= !$contrat->getActif() ? 'selected' : '' ?>>Inactif</option>
                        </select>
                    </div>
                </fieldset>

                <div class="formActions">
                    <button type="submit" class="btnValider">Enregistrer les modifications</button>
                    <a href="index.php?m2lMP=contrats" class="btnAnnuler">Annuler</a>
                </div>

                <p class="formNote">
                    <span class="required">*</span> Champs obligatoires
                </p>
            </form>
        </div>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
