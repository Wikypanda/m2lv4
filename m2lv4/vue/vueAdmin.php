<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>
    <link rel="stylesheet" href="styles/gestion-ligues.css">

    <main>
        <section class="gestion-ligues">
            <h2>Gestion des Ligues</h2>
            <p>Choisissez une action à effectuer :</p>

            <div class="btn-group">
                <button class="btn" onclick="afficherFormulaire('ajouter')">Ajouter une ligue</button>
                <button class="btn" onclick="afficherFormulaire('modifier')">Modifier une ligue</button>
                <button class="btn" onclick="afficherFormulaire('supprimer')">Supprimer une ligue</button>
            </div>

            <div id="formulaire-action" style="margin-top: 40px;">
                <!-- Le formulaire s'affichera ici -->
            </div>
        </section>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>

    <script>
        function afficherFormulaire(action) {
            let formHTML = '';

            if (action === 'ajouter') {
                formHTML = `
                    <div class="form-block">
                        <h3>Ajouter une ligue</h3>
                        <form method="post" action="index.php?m2lMP=validerAjoutLigue">
                            <div class="form-group">
                                <h4>Nom de la ligue</h4>
                                <label for="nomLigue">Entrez le nom :</label>
                                <input type="text" id="nomLigue" name="nomLigue" required>
                            </div>

                            <div class="form-group">
                                <h4>Site officiel</h4>
                                <label for="site">Entrez l’URL du site :</label>
                                <input type="url" id="site" name="site" required>
                            </div>

                            <div class="form-group">
                                <h4>Description</h4>
                                <label for="descriptif">Ajoutez une description :</label>
                                <textarea id="descriptif" name="descriptif" rows="4" required></textarea>
                            </div>

                            <button type="submit" class="btn">Valider</button>
                        </form>
                    </div>
                `;
            } else if (action === 'modifier') {
                formHTML = `
                    <div class="form-block">
                        <h3>Modifier une ligue</h3>
                        <form method="post" action="index.php?m2lMP=validerModificationLigue">
                            <div class="form-group">
                                <h4>Ligue à modifier</h4>
                                <label for="idLigue">Nom ou ID :</label>
                                <input type="text" id="idLigue" name="idLigue" required>
                            </div>

                            <div class="form-group">
                                <h4>Nouveau nom</h4>
                                <label for="nouveauNom">Saisissez le nouveau nom :</label>
                                <input type="text" id="nouveauNom" name="nouveauNom">
                            </div>

                            <div class="form-group">
                                <h4>Nouveau site officiel</h4>
                                <label for="nouveauSite">Saisissez l’URL :</label>
                                <input type="url" id="nouveauSite" name="nouveauSite">
                            </div>

                            <div class="form-group">
                                <h4>Nouvelle description</h4>
                                <label for="nouveauDescriptif">Modifiez la description :</label>
                                <textarea id="nouveauDescriptif" name="nouveauDescriptif" rows="4"></textarea>
                            </div>

                            <button type="submit" class="btn">Modifier</button>
                        </form>
                    </div>
                `;
            } else if (action === 'supprimer') {
                formHTML = `
                    <div class="form-block">
                        <h3>Supprimer une ligue</h3>
                        <form method="post" action="index.php?m2lMP=validerSuppressionLigue">
                            <div class="form-group">
                                <h4>Ligue à supprimer</h4>
                                <label for="idLigue">Nom ou ID :</label>
                                <input type="text" id="idLigue" name="idLigue" required>
                            </div>

                            <button type="submit" class="btn">Supprimer</button>
                        </form>
                    </div>
                `;
            }

            document.getElementById('formulaire-action').innerHTML = formHTML;
        }
    </script>
</div>
