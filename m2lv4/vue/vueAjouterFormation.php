<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        <div class="zoneAjoutFormation">
            <h1>Ajouter une formation</h1>

            <form method="post" action="index.php">
                <input type="hidden" name="m2lMP" value="validerAjoutFormation">

                <div class="ligneForm">
                    <label for="intitule">Intitulé :</label>
                    <input type="text" name="intitule" id="intitule" required>
                </div>

                <div class="ligneForm">
                    <label for="descriptif">Descriptif :</label>
                    <textarea name="descriptif" id="descriptif" rows="4" required></textarea>
                </div>

                <div class="ligneForm">
                    <label for="nbPlaces">Nombre de places :</label>
                    <input type="number" name="nbPlaces" id="nbPlaces" min="1" required>
                </div>

                <div class="ligneForm">
                    <label for="duree">Durée (en jours) :</label>
                    <input type="number" name="duree" id="duree" required>
                </div>

                <div class="ligneForm">
                    <label for="dateOuvert">Ouverture des inscriptions :</label>
                    <input type="date" name="dateOuvert" id="dateOuvert" required>
                </div>

                <div class="ligneForm">
                    <label for="dateCloture">Clôture des inscriptions :</label>
                    <input type="date" name="dateCloture" id="dateCloture" required>
                </div>

                <div class="ligneForm">
                    <input type="submit" value="Ajouter la formation" class="btnValider">
                </div>  
            </form>
        </div>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
