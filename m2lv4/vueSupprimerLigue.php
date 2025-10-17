<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>
    <link rel="stylesheet" href="styles/gestion-ligues.css">

    <main>
        <section class="formulaire-ligue">
            <h2>🗑️ Supprimer une ligue</h2>

            <?php if (isset($message)): ?>
                <div class="alert alert-success">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <?php if (isset($erreur)): ?>
                <div class="alert alert-error">
                    ⚠️ <?= htmlspecialchars($erreur) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?m2lMP=validerSuppressionLigue" class="form-ligue">
                <div class="form-group">
                    <label for="idLigue">Nom ou ID de la ligue à supprimer <span class="required">*</span></label>
                    <input type="text" id="idLigue" name="idLigue" required maxlength="50">
                    <small>Entrez le nom ou l'identifiant exact</small>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">🗑️ Supprimer</button>
                    <a href="index.php?m2lMP=ligue&action=admin" class="btn btn-secondary">❌ Annuler</a>
                </div>

                <p class="form-note">
                    <span class="required">*</span> Champs obligatoires
                </p>
            </form>
        </section>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
