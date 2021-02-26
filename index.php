<!DOCTYPE html>

<html lang="fr">

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Mikail_Tiki-Tacos_DESIGNER</title>
		<meta name="description" content="Site d'experimentation" />
		<meta name="author" content="Mikail" />

		<link rel="stylesheet" href="assets/css/style.css" />

	</head>

	<body>
		<header>
			<h1></h1>
		</header>

		<article>
			<!--alert messages end-->
			<section class="section">
				<h1>Tableau d'insertion de donne dans la base de donné(a usage d'exemple)</h1>

				<div class="form">
					<form action="" method="POST">
						<div class="row justify-content-around">
							<fieldset class="col">
								<legend>Table</legend>
								<label for="table">Numero de la Table:</label>
								<input type="number" name="table" class="text-box" placeholder="Numero de la Table*"
									maxlength="20" required />

								<label for="situationExterieur">Selection de l' emplacement:</label>
								<select name="situationExterieur" id="emplacement" required>
									<option value="exterieur">Soleil</option>
									<option value="interieur">Ombre</option>
								</select>

								<label for="chaise">Nombre de Chaise:</label>
								<input type="number" name="chaise" class="text-box" placeholder="Nombre Chaise*" required
									maxlength="20" />
							</fieldset>
							<fieldset class="col">
								<legend>QrCode</legend>
								<label for="qrName">Nom du QrCode:</label>
								<input type="text" name="qrName" class="text-box" placeholder="Nom QrCode*" maxlength="20"
									required />

								<label for="qrIdTable">Numero de la Table:</label>
								<input type="number" name="qrIdTable" class="text-box" placeholder="Numero de la Table*"
									maxlength="20" required />

								<label for="qrIdTelephone">Categorie (id) du telephone qui à flasher ce QrCode:</label>
								<input type="number" name="qrIdTelephone" class="text-box"
									placeholder="id du telephone ex 1 ,2 ,3 *" maxlength="20" required />

							</fieldset>
							<fieldset class="col">
								<legend>Utilisateur</legend>

								<label for="marqueTelephone">Marque du Telephone</label>
								<input type="text" name="marqueTelephone" class="text-box" placeholder="Marque du Telephone*"
									maxlength="20" required />

								<label for="langueUtilisateur">Langue de l'utilsateur</label>
								<input type="text" name="langueUtilisateur" class="text-box"
									placeholder="Langue de l'utilisateur*" maxlength="20" required />
							</fieldset>
						</div>

						<input type="submit" name="submit" class="send-btn" value="Envoyer" />
						<input type="reset" value="Réinitialiser le formulaire">
						<p>
							<span>Tous les champs (*) sont obligatoires.<br /></span>
						</p>
					</form>

			</section>
		</article>

		<hr />

		<article>
			<!-- DB CREATE -->
			<section>
				<h1>Creation de la base de donée</h1>
				<div class="db-create">
					<?php
                    include "create.php";
                    ?>
				</div>

			</section>

			<!-- DB INSERT  -->
			<section>
				<h1>Populer la base de donée</h1>
				<div class="db-insert">
					<?php
                        include "insert.php";
                    ?>
				</div>

			</section>

			<!-- DB SELECT -->
			<section>
				<div class="db-select">
					<?php
                        include "select.php";
                    ?>
				</div>

			</section>
		</article>

		<article>
			<section>
				<div class="customTableaux">
					<h1>
						Tableaux récapitulatif des resultats de Février
					</h1>
					<table>
						<tr>
							<th>
								Numero de la Table
							</th>
							<th>
								Nombre de fois flasher
							</th>
							<th>
								Emplacement
							</th>
						</tr>
						<?php 

                        foreach($resultatFevrier as $clef => $value){
                                echo 

                        "<tr> 

                        <td>" .  $resultatFevrier[$clef]['numeroTable'] . "</td>

                        <td>" .  $resultatFevrier[$clef]['nbrFlasher'] . "</td>

                        <td>" .  $resultatFevrier[$clef]['situationExterieur'] . "</td>

                        </tr>";
                            };
                        ?>
					</table>

					<h1>
						Tableaux récapitulatif des resultats du Trimestre
					</h1>
					<table>
						<tr>
							<th>
								Numero de la Table
							</th>
							<th>
								Nombre de fois flasher
							</th>
							<th>
								Emplacement
							</th>
						</tr>
						<?php 

                            foreach($resultatTrimestre as $clef => $value){
                                    echo 

                            "<tr> 

                            <td>" .  $resultatTrimestre[$clef]['numeroTable'] . "</td>

                            <td>" .  $resultatTrimestre[$clef]['nbrFlasher'] . "</td>

                            <td>" .  $resultatTrimestre[$clef]['situationExterieur'] . "</td>

                            </tr>";
                                };
                            ?>
					</table>
				</div>

			</section>
		</article>

	</body>

</html>
