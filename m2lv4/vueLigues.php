<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>
    <link rel="stylesheet" href="styles/styleLigueClub.css">

    <main>
        <div class="texteAccueil">
            <h1><span>Liste des Ligues et Clubs affiliés</span></h1>

            <?php if (isset($_SESSION['identification']) && $_SESSION['identification']): ?>
                <div style="margin-bottom: 20px; text-align: right;">
                    <form method="get" action="index.php">
                        <input type="hidden" name="m2lMP" value="admin">
                        <button type="submit" style="padding: 10px 20px; background-color: #0077cc; color: white; border: none; border-radius: 5px; cursor: pointer;">
                            Gérer les ligues et clubs
                        </button>
                    </form>
                </div>
            <?php endif; ?>

            <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background-color:#f2f2f2;">
                        <th>Nom de la Ligue</th>
                        <th>Site officiel</th>
                        <th>Description</th>
                        <th>Clubs affiliés</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($liguesAvecClubs as $ligue): ?>
                        <tr>
                            <td><?= htmlspecialchars($ligue['nomLigue']) ?></td>
                            <td><a href="<?= htmlspecialchars($ligue['site']) ?>" target="_blank"><?= htmlspecialchars($ligue['site']) ?></a></td>
                            <td><?= htmlspecialchars($ligue['descriptif']) ?></td>
                            <td>
                                <ul style="margin:0; padding-left:20px;">
                                    <?php
                                    $clubsAffiches = [];
                                    foreach ($ligue['clubs'] as $club):
                                        $cle = strtolower(trim($club['nomClub'] . $club['adresseClub']));
                                        if (!in_array($cle, $clubsAffiches)):
                                            echo "<li>" . htmlspecialchars($club['nomClub']) . " – " . htmlspecialchars($club['adresseClub']) . "</li>";
                                            $clubsAffiches[] = $cle;
                                        endif;
                                    endforeach;

                                    if (empty($clubsAffiches)) {
                                        echo "<li><em>Aucun club affilié</em></li>";
                                    }
                                    ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
