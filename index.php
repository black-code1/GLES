<?php require 'header.php';
require 'db.php';

$sql = 'SELECT * FROM gles_classes';
$stmt = $connexion->prepare($sql);
$stmt->execute();
$people = $stmt->fetchAll(PDO::FETCH_OBJ);

?>	
	
		<div class="container">
		<section class="landing">
			<div class="jumbotron">
				<p>Bienvenu sur la plateforme de gestion des étudiants d'un établissement</p>
				<p>
					ici vous avez accès à un portail vous permettant de voir des informations sur les étudiants ,
					consultation des notes	
				</p>	
			</div>
			<select name="classe" id="">
				<?php foreach($people as $person):?>
					<option value=""><a href="listeeleves.php?id=<?= $person->id ?>"><?= $person->nomclasse ?></a></option>
				<?php endforeach ?>
			</select>
		</section>
		<hr>
		<section class="classes">
			<h2>Choisissez une classe</h2>
			<div class="row">
				<?php foreach($people as $person): ?>
					<div class="card">
						<div class="card-content">
							<a href="listeeleves.php?id=<?= $person->id ?>"><?= $person->nomclasse ?></a>
						</div>
                	</div>

				<?php endforeach ?>
            </div>
		</section>
	</div>	
</body>
</html>