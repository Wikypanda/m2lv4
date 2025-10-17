<?php
$formData = $_SESSION['formData'] ?? [];
unset($_SESSION['formData']);
?>

<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        <div class="zoneAjouterContrat">
            <h2>Ajouter un contrat</h2>

            <?php if (!empty($message)) : ?>
                <p class="message <?= htmlspecialchars($messageType) ?>"><?= $message ?></p>
            <?php endif; ?>

            <form method="post" action="index.php">
                <input type="hidden" name="m2lMP" value="validerAjoutContrat">
                <?= csrf_input() ?>

                <fieldset class="fieldsetSection">
                    <legend>Informations du contrat</legend>

                    <div class="ligneForm">
                        <label for="idContrat">ID Contrat *</label>
                        <input type="text" id="idContrat" name="idContrat" 
                               placeholder="Ex: CTR2025001" 
                               value="<?= htmlspecialchars($formData['idContrat'] ?? '') ?>" required>
                    </div>

                    <div class="ligneForm">
                        <label for="idUser">Utilisateur *</label>
                        <select id="idUser" name="idUser" required>
                            <option value="">-- Sélectionner un utilisateur --</option>
                            <?php foreach ($utilisateurs as $user) : ?>
                                <option value="<?= $user['idUser'] ?>" 
                                        <?= ($formData['idUser'] ?? '') == $user['idUser'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($user['nom'] . ' ' . $user['prenom'] . ' (' . $user['login'] . ')') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="ligneForm">
                        <label for="typeContrat">Type de contrat *</label>
                        <select id="typeContrat" name="typeContrat" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="CDI" <?= ($formData['typeContrat'] ?? '') === 'CDI' ? 'selected' : '' ?>>CDI</option>
                            <option value="CDD" <?= ($formData['typeContrat'] ?? '') === 'CDD' ? 'selected' : '' ?>>CDD</option>
                            <option value="Stage" <?= ($formData['typeContrat'] ?? '') === 'Stage' ? 'selected' : '' ?>>Stage</option>
                            <option value="Alternance" <?= ($formData['typeContrat'] ?? '') === 'Alternance' ? 'selected' : '' ?>>Alternance</option>
                            <option value="Temps partiel" <?= ($formData['typeContrat'] ?? '') === 'Temps partiel' ? 'selected' : '' ?>>Temps partiel</option>
                        </select>
                    </div>

                    <div class="ligneForm">
                        <label for="dateDebut">Date de début *</label>
                        <input type="date" id="dateDebut" name="dateDebut" 
                               value="<?= htmlspecialchars($formData['dateDebut'] ?? '') ?>" required>
                    </div>

                    <div class="ligneForm">
                        <label for="dateFin">Date de fin</label>
                        <input type="date" id="dateFin" name="dateFin" 
                               value="<?= htmlspecialchars($formData['dateFin'] ?? '') ?>">
                        <small>Laisser vide pour un CDI ou contrat sans date de fin</small>
                    </div>

                    <div class="ligneForm">
                        <label for="nbHeures">Nombre d'heures</label>
                        <input type="number" id="nbHeures" name="nbHeures" 
                               placeholder="35" min="1" max="168"
                               value="<?= htmlspecialchars($formData['nbHeures'] ?? '') ?>">
                        <small>Heures par semaine</small>
                    </div>

                    <div class="ligneForm">
                        <label for="salaireBrut">Salaire brut (€)</label>
                        <input type="number" step="0.01" id="salaireBrut" name="salaireBrut" 
                               placeholder="2500.00"
                               value="<?= htmlspecialchars($formData['salaireBrut'] ?? '') ?>">
                    </div>
                </fieldset>

                <div class="formActions">
                    <button type="submit" class="btnValider">Enregistrer</button>
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