<?php
require 'header.php';
require 'db.php';

$id = $_GET['id'];
/*
$sql = 'SELECT DISTINCT p.id, p.nom, p.prenom,p.telephone, c.nomclasse,p.nationalite,p.sexe,p.matricule,p.datenaissance FROM
            gles_personnes AS p,
            gles_classes AS c,
            gles_inscris AS i,
            gles_etudiants AS e
            
            WHERE i.id_classe = :id
            AND i.id_etudiant = e.id
            AND e.id_personne = p.id
        ';

$stmt = $connexion->prepare($sql);
$stmt->execute([':id' =>$id]);

$students = $stmt->fetchAll(PDO::FETCH_OBJ);
*/
$sqa = 'SELECT * FROM gles_personnes where gles_personnes.id IN 
                (SELECT id_personne from gles_etudiants WHERE gles_etudiants.id IN 
                    (SELECT id_etudiant from gles_inscris where id_classe = ' . $id . '))';

$stmt = $connexion->prepare($sqa);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_OBJ);

$sql1 = 'SELECT * FROM gles_classes as c WHERE c.id =:id ';
$stmt1 = $connexion->prepare($sql1);
$stmt1->execute([':id' =>$id]);

$class = $stmt1->fetch(PDO::FETCH_OBJ);
?>
    
    <div class="container">
    <section class="landing">
        <div class="jumbotron">
            <p>Bienvenu sur la plateforme de gestion des étudiants de l'ENSPD</p>
            <p>
                ici vous avez accès à un portail vous permettant de voir des informations sur les étudiants ,
                consultation des notes
             </p>	
        </div>
    </section>
    <hr>
    <section class="eleves">
        <h2>Les eleves de la classe de <span><?= $class->nomclasse ?></span></h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Matricule</th>
                    <th>Sexe</th>
                    <th>date de naissance</th>
                    <th>Nationalité</th>
                    <th>Téléphone</th>
                    <th>ACtion</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= $student->nom ?></td>
                        <td><?= $student->prenom ?></td>
                        <td><?= $student->matricule ?></td>
                        <td><?= $student->sexe ?></td>
                        <td><?= $student->datenaissance ?></td>
                        <td><?= $student->nationalite ?></td>
                        <td><?= $student->telephone ?></td>
                        <td><a href="eleve.php?id=<?= $student->id?>"><i class="material-icons md-48">trending_flat</i></a></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </section>
</div>
</body>
</html>