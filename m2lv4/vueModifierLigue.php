<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>
    <link rel="stylesheet" href="styles/gestion-ligues.css">

    <main>
        <section class="formulaire-ligue">
            <h2>✏️ Modifier la ligue</h2>
            
            <?php if (isset($message)): ?>
                <div class="alert alert-success">
                    ✅ <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($erreur)): ?>
                <div class="alert alert-error">
                    ⚠️ <?= htmlspecialchars($erreur) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="index.php?m2lMP=ligue&action=modifier" class="form-ligue">
                
                <input type="hidden" name="idLigue" value="<?= htmlspecialchars($ligue['idLigue']) ?>">
                
                <div class="form-group">
                    <label for="nomLigue">Nom de la ligue <span class="required">*</span></label>
                    <input type="text" 
                           id="nomLigue" 
                           name="nomLigue" 
                           required 
                           maxlength="50"
                           value="<?= htmlspecialchars($ligue['nomLigue']) ?>">
                    <small>Maximum 50 caractères</small>
                </div>
                
                <div class="form-group">
                    <label for="site">Site web officiel</label>
                    <input type="url" 
                           id="site" 
                           name="site" 
                           maxlength="50"
                           placeholder="https://www.exemple.com"
                           value="<?= htmlspecialchars($ligue['site']) ?>">
                    <small>Format : https://www.exemple.com (maximum 50 caractères)</small>
                </div>
                
                <div class="form-group">
                    <label for="descriptif">Description</label>
                    <textarea id="descriptif" 
                              name="descriptif" 
                              rows="6" 
                              maxlength="100"><?= htmlspecialchars($ligue['descriptif']) ?></textarea>
                    <small>Maximum 100 caractères</small>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        ✅ Enregistrer les modifications
                    </button>
                    <a href="index.php?m2lMP=ligue&action=admin" class="btn btn-secondary">
                        ❌ Annuler
                    </a>
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
