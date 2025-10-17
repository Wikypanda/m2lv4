<?php require_once 'modele/dao/DemandeDAO.php'; ?>

<div class="conteneur">
    <header>
        <?php include 'haut.php'; ?>
    </header>

    <main>
        <h1 class="titrePage">Gestion des demandes de formation</h1>

        <form method="post" action="index.php" class="formFiltres">
            <input type="hidden" name="m2lMP" value="adminDemandes">

            <div class="filtres">
                <label for="filtreFormation">Formation :</label>
                <select name="filtreFormation" id="filtreFormation">
                    <option value="all">Toutes</option>
                    <?php foreach ($_SESSION['formations'] as $f) : ?>
                        <option value="<?= $f['idForma'] ?>"><?= htmlspecialchars($f['intitule']) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="filtreIntervenant">Intervenant :</label>
                <select name="filtreIntervenant" id="filtreIntervenant">
                    <option value="all">Tous</option>
                    <?php foreach ($_SESSION['intervenants'] as $i) : ?>
                        <option value="<?= $i['idUser'] ?>"><?= htmlspecialchars($i['nom'] . ' ' . $i['prenom']) ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="submit" value="Filtrer" class="btnFiltrer">
            </div>
        </form>

        <div class="tableContainer">
            <table class="tableDemandes">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Formation</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Admis</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['demandesFiltrees'] as $d) : ?>
                        <tr>
                            <td><?= htmlspecialchars($d['nom'] . ' ' . $d['prenom']) ?></td>
                            <td><?= htmlspecialchars($d['intitule']) ?></td>
                            <td><?= formatDateFr($d['dateDemande']) ?></td>
                            <td>
                                <span class="statut <?= strtolower($d['statutDemande']) ?>">
                                    <?= htmlspecialchars($d['statutDemande']) ?>
                                </span>
                            </td>
                            <td>
                                <?= $d['nbAdmis'] ?>/<?= $d['nbPlaces'] ?>
                            </td>
                            <td>
                                <?php if ($d['idStatut'] == 1) : ?>
                                    <form method="post" action="index.php" style="display:inline;">
                                        <input type="hidden" name="m2lMP" value="validerDemande">
                                        <input type="hidden" name="idDemande" value="<?= $d['idDemande'] ?>">
                                        <input type="submit" value="Valider" class="btnAction valider">
                                    </form>
                                    <form method="post" action="index.php" style="display:inline;">
                                        <input type="hidden" name="m2lMP" value="refuserDemande">
                                        <input type="hidden" name="idDemande" value="<?= $d['idDemande'] ?>">
                                        <input type="submit" value="Refuser" class="btnAction refuser">
                                    </form>
                                    <?php if (isset($_SESSION['messageErreur'])) : ?>
                                        <div class="messageErreur">
                                            <?= htmlspecialchars($_SESSION['messageErreur']) ?>
                                        </div>
                                        <?php unset($_SESSION['messageErreur']); ?>
                                <?php endif; ?>

                                <?php else : ?>
                                    <span class="statutFixe">—</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="zoneRetour">
    <form method="post" action="index.php">
        <input type="hidden" name="m2lMP" value="formations">
        <input type="submit" value="Retour aux formations" class="btnRetour">
    </form>
</div>

    </main>

    <footer>
        <?php include 'bas.php'; ?>
    </footer>
</div>
