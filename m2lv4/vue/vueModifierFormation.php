<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        <div class="zoneModifierFormation">
            <h2>Modifier une formation</h2>
            <p style="text-align:center; font-size:16px; color:gray;">
                Modifie les informations ci-dessous puis clique sur <strong>Valider</strong>.
            </p>

            <form method="post" action="index.php">
                <input type="hidden" name="m2lMP" value="validerModificationFormation">
                <input type="hidden" name="idFormation" value="<?= htmlspecialchars($formation['idForma']) ?>">

                <div class="ligneForm">
                    <label for="intitule">Intitulé :</label>
                    <input type="text" id="intitule" name="intitule" value="<?= htmlspecialchars($formation['intitule']) ?>" required>
                </div>

                <div class="ligneForm">
                    <label for="descriptif">Descriptif :</label>
                    <textarea id="descriptif" name="descriptif" required><?= htmlspecialchars($formation['descriptif']) ?></textarea>
                </div>

                <div class="ligneForm">
                    <label for="places">Nombre de places :</label>
                    <input type="number" id="nbPlaces" name="nbPlaces" value="<?= htmlspecialchars($formation['nbPlaces']) ?>" required>
                </div>

                <div class="ligneForm">
                    <label for="duree">Durée (en jours) :</label>
                    <input type="number" id="duree" name="duree" value="<?= htmlspecialchars($formation['duree']) ?>" required>
                </div>

                <div class="ligneForm">
                    <label for="dateOuvert">Date d'ouverture :</label>
                    <input type="date" id="dateOuvert" name="dateOuvert" value="<?= htmlspecialchars($formation['dateOuvertInscriptions']) ?>" required>
                </div>

                <div class="ligneForm">
                    <label for="dateCloture">Date de clôture :</label>
                    <input type="date" id="dateCloture" name="dateCloture" value="<?= htmlspecialchars($formation['dateClotureInscriptions']) ?>" required>
                </div>

                <button type="submit" class="btnValider">Valider</button>
            </form>

            <?php if (isset($_SESSION['message'])) : ?>
                <p class="message"><?= htmlspecialchars($_SESSION['message']) ?></p>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
