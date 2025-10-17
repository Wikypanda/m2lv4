<?php
require_once __DIR__ . '/../lib/fonctionsUtiles.php';
?>
<div class="conteneur">
	<header>
		<?php include 'haut.php'; ?>
	</header>

	<main>
		<div class="zoneModifierIntervenant">
			<h2>Modifier un intervenant</h2>
			<p style="text-align:center; font-size:16px; color:gray;">
				Modifie les informations ci-dessous puis clique sur <strong>Enregistrer</strong>.
			</p>

			<?php if (!empty($message)) : ?>
				<p class="message <?= htmlspecialchars($messageType ?? 'info') ?>"><?= htmlspecialchars($message) ?></p>
			<?php endif; ?>

			<?php
			// Pré-remplir à partir des données de formulaire en session si présentes (après une erreur)
			$formData = $_SESSION['formData'] ?? null;
			$formErrors = $_SESSION['formErrors'] ?? [];

			if ($formData) {
				// construire un objet Intervenant minimal pour la vue
				$intervenant = $intervenant ?? null;
			}

			?>

			<?php if (empty($intervenant) && empty($formData)) : ?>
				<p>Intervenant introuvable.</p>
			<?php else : ?>
				<?php if (!empty($formErrors)) : ?>
					<p class="message messageErreur">Veuillez corriger les erreurs ci-dessous.</p>
				<?php endif; ?>
				<form method="post" action="index.php">
					<input type="hidden" name="m2lMP" value="validerModificationIntervenant">
					<input type="hidden" name="id_intervenant" value="<?= htmlspecialchars($formData['id_intervenant'] ?? ($intervenant->getIdIntervenant() ?? '')) ?>">
					<?= csrf_input() ?>

					<div class="ligneForm">
						<label for="nom">Nom *</label>
						<input type="text" id="nom" name="nom" value="<?= htmlspecialchars($formData['nom'] ?? ($intervenant->getNom() ?? '')) ?>" required>
					</div>
					<?php if (!empty($formErrors['nom'])): ?>
						<p class="messageErreur"><?= htmlspecialchars($formErrors['nom']) ?></p>
					<?php endif; ?>

					<div class="ligneForm">
						<label for="prenom">Prénom *</label>
						<input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($formData['prenom'] ?? ($intervenant->getPrenom() ?? '')) ?>" required>
					</div>
					<?php if (!empty($formErrors['prenom'])): ?>
						<p class="messageErreur"><?= htmlspecialchars($formErrors['prenom']) ?></p>
					<?php endif; ?>

					<div class="ligneForm">
						<label for="email">Email *</label>
						<input type="text" id="email" name="email"
							   value="<?= htmlspecialchars($formData['email'] ?? ($intervenant->getEmail() ?? '')) ?>"
							   required
							   pattern="^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.(com|fr)$"
							   title="Veuillez saisir une adresse email valide se terminant par .com ou .fr">
					</div>
					<?php if (!empty($formErrors['email'])): ?>
						<p class="messageErreur"><?= htmlspecialchars($formErrors['email']) ?></p>
					<?php endif; ?>

					<div class="ligneForm">
						<label for="telephone">Téléphone</label>
						<input type="text" id="telephone" name="telephone" value="<?= htmlspecialchars($formData['telephone'] ?? ($intervenant->getTelephone() ?? '')) ?>">
					</div>
					<?php if (!empty($formErrors['telephone'])): ?>
						<p class="messageErreur"><?= htmlspecialchars($formErrors['telephone']) ?></p>
					<?php endif; ?>

					<div class="ligneForm">
						<label for="adresse">Adresse</label>
						<input type="text" id="adresse" name="adresse" value="<?= htmlspecialchars($formData['adresse'] ?? ($intervenant->getAdresse() ?? '')) ?>">
					</div>
					<?php if (!empty($formErrors['adresse'])): ?>
						<p class="messageErreur"><?= htmlspecialchars($formErrors['adresse']) ?></p>
					<?php endif; ?>

					<div class="ligneForm">
						<label for="statut">Statut *</label>
						<select id="statut" name="statut" required>
							<option value="salarie" <?= ( ($formData['statut'] ?? ($intervenant->getStatut() ?? '')) === 'salarie') ? 'selected' : '' ?>>Salarié</option>
							<option value="benevole" <?= ( ($formData['statut'] ?? ($intervenant->getStatut() ?? '')) === 'benevole') ? 'selected' : '' ?>>Bénévole</option>
						</select>
					</div>
					<?php if (!empty($formErrors['statut'])): ?>
						<p class="messageErreur"><?= htmlspecialchars($formErrors['statut']) ?></p>
					<?php endif; ?>

					<div class="ligneForm">
						<label for="date_embauche">Date d'embauche</label>
						<input type="date" id="date_embauche" name="date_embauche" value="<?= htmlspecialchars($formData['date_embauche'] ?? ($intervenant->getDateEmbauche() ?? '')) ?>">
					</div>
					<?php if (!empty($formErrors['date_embauche'])): ?>
						<p class="messageErreur"><?= htmlspecialchars($formErrors['date_embauche']) ?></p>
					<?php endif; ?>

					<div class="ligneForm">
						<label for="rattachement_type">Rattachement type</label>
						<input type="text" id="rattachement_type" name="rattachement_type" value="<?= htmlspecialchars($formData['rattachement_type'] ?? ($intervenant->getRattachementType() ?? '')) ?>">
					</div>
					<?php if (!empty($formErrors['rattachement_type'])): ?>
						<p class="messageErreur"><?= htmlspecialchars($formErrors['rattachement_type']) ?></p>
					<?php endif; ?>

					<div class="ligneForm">
						<label for="rattachement_nom">Rattachement nom</label>
						<input type="text" id="rattachement_nom" name="rattachement_nom" value="<?= htmlspecialchars($formData['rattachement_nom'] ?? ($intervenant->getRattachementNom() ?? '')) ?>">
					</div>
					<?php if (!empty($formErrors['rattachement_nom'])): ?>
						<p class="messageErreur"><?= htmlspecialchars($formErrors['rattachement_nom']) ?></p>
					<?php endif; ?>

					<button type="submit" class="btnValider">Enregistrer</button>
					<a href="index.php?m2lMP=intervenants" class="btnAnnuler">Annuler</a>
				</form>
			<?php endif; ?>

		</div>
	</main>

	<script>
	document.addEventListener('DOMContentLoaded', function() {
		// cibler précisément le formulaire de modification d'intervenant
		var form = document.querySelector('form input[name="m2lMP"][value="validerModificationIntervenant"]');
		if (!form) return;
		form = form.closest('form');

		function clearErrors() {
			var errs = document.querySelectorAll('.messageErreur, .message.messageErreur');
			errs.forEach(function(e) { e.remove(); });
		}

		function showError(fieldName, msg) {
			var field = form.querySelector('[name="' + fieldName + '"]');
			if (!field) return;
			var row = field.closest('.ligneForm');
			if (!row) row = field.parentElement;
			// trouver un <p class="messageErreur"> existant ou créer un nouveau
			var p = row.nextElementSibling;
			if (!p || !p.classList || (!p.classList.contains('messageErreur') && !p.classList.contains('message'))) {
				p = document.createElement('p');
				p.className = 'messageErreur';
				row.parentNode.insertBefore(p, row.nextSibling);
			}
			p.textContent = msg;
		}

		form.addEventListener('submit', function(e) {
			clearErrors();
			var errors = {};
			var nom = form.querySelector('[name="nom"]').value.trim();
			var prenom = form.querySelector('[name="prenom"]').value.trim();
			var email = form.querySelector('[name="email"]').value.trim();
			var statut = form.querySelector('[name="statut"]').value;

			if (!nom) errors.nom = 'Le nom est obligatoire.';
			if (!prenom) errors.prenom = 'Le prénom est obligatoire.';
			if (!email) {
				errors.email = 'L\'email est obligatoire.';
			} else {
				var re = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.(com|fr)$/i;
				if (!re.test(email)) {
					errors.email = "Veuillez saisir une adresse email valide se terminant par .com ou .fr";
				}
			}
			if (!statut || (['salarie','benevole'].indexOf(statut) === -1)) {
				errors.statut = "Le statut doit être 'salarie' ou 'benevole'.";
			}

			if (Object.keys(errors).length > 0) {
				e.preventDefault();
				// afficher les erreurs inline
				console.log('Validation client — erreurs détectées :', errors);
				for (var k in errors) {
					if (errors.hasOwnProperty(k)) showError(k, errors[k]);
				}
				// scroller vers la première erreur
				var firstField = form.querySelector('.messageErreur');
				if (firstField) firstField.scrollIntoView({behavior:'smooth', block:'center'});
				return false;
			}

			return true;
		});
	});
	</script>

	<footer>
		<?php include 'bas.php'; ?>
	</footer>
</div>
<?php
// Nettoyer les données d'erreur/formulaire stockées en session après affichage
if (isset($_SESSION['formData'])) unset($_SESSION['formData']);
if (isset($_SESSION['formErrors'])) unset($_SESSION['formErrors']);
?>

