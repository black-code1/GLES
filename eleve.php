<?php
require 'header.php';
require 'db.php';

$id = $_GET['id'];
set_time_limit(-1);
//requete de recuperation des détails de l'élèves

$sql = 'SELECT * FROM 
    gles_personnes AS p WHERE p.id = :id ';
$stmt = $connexion->prepare($sql);
$stmt->execute([':id' => $id]);

$student = $stmt->fetch(PDO::FETCH_OBJ);

//requete de recuperation du departement de l'élève

$departement = 'SELECT r.nom FROM
    gles_departements AS d,
    gles_regions AS r,
    gles_personnes AS p

    WHERE
        p.id = :id
    AND
        p.departement_id = d.id
    AND
        d.region_id = r.id
    ';
$stmt2 = $connexion->prepare($departement);
$stmt2->execute([':id' => $id]); 
$dptmt = $stmt2->fetch(PDO::FETCH_OBJ); 

//requete de recuperation de l'évève inscrits

$sql2 = ' SELECT e.pere,e.mere,e.telephonepere,e.telephonemere
    FROM
    gles_personnes AS p,
    gles_etudiants AS e

    WHERE 
    e.id_personne = :id 
    ';
$stmt3 = $connexion->prepare($sql2);
$stmt3->execute([':id' => $id]);
$parent = $stmt3->fetch(PDO::FETCH_OBJ);

$sql3 = 'SELECT * FROM 
        gles_personnes AS p,
        gles_etudiants AS e,
        gles_inscris i
        WHERE
        p.id = :id
        AND
        e.id_personne = p.id
        AND
        e.id = i.id
        ';
$stmt4 = $connexion->prepare($sql3);
$stmt4->execute([':id' => $id]);
$lol = $stmt->fetch(PDO::FETCH_OBJ);
/*
// réquete de recuperation de ala moyenne de l'élève

$sql4 = 'SELECT AVG(note) FROM
        gles_notes AS n,
        gles_personnes AS p,
        gles_etudiants AS e,
        gles_inscris AS i

        WHERE
        e.id_personne = :id 
        AND
        i.id_etudiant = e.id_personne
        AND
        n.id_inscris = i.id_etudiant
        ';
$stmt5 = $connexion->prepare($sql4);
$stmt5->execute([':id'=>$id]);
$moyenne = $stmt5->fetch(PDO::FETCH_OBJ);
*/

$sql = '
    
'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <section class="detail">
            <div class="row">
                <div class="card-detail">
                    <div class="content">
                        <table class="">
                            <tr>
                                <th>Nom</th>
                                <td><?= $student->nom?></td>
                            </tr>
                            <tr>
                                <th>prenom</th>
                                <td><?= $student->prenom?></td>
                            </tr>
                            <tr>
                                <th>Nom</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Matricule</th>
                                <td><?= $student->matricule?></td>
                            </tr>
                            <tr>
                                <th>Sexe</th>
                                <td><?= $student->sexe?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-detail">
                    <div class="content">
                        <h2>Moyenne</h2>
                        <p><span class="moyenne"></span>/20</p>
                    </div>
                </div>
                
            </div>
        </section>
        <section>
            <table class="table">
                <thead>
                    <tr>
                        <th>date de naissance</th>
                        <th>lieu de naissance</th>
                        <th>region</th>
                        <th>téléphone</th>
                        <th>nom père</th>
                        <th>numéro du père</th>
                        <th>nom de la mère</th>
                        <th>numero de la mère</th>
                    </tr>
                    <tr>
                        <td><?= $student->datenaissance?></td>
                        <td><?= $student->lieudenaissance?></td>
                        <td><?= $dptmt->nom?></td>
                        <td><?= $student->telephone?></td>
                        <td><?= $parent->pere ?></td>
                        <td><?= $parent->telephonepere ?></td>
                        <td><?= $parent->mere ?></td>
                        <td><?= $parent->telephonemere ?></td>
                    </tr>
                </thead>
            </table>
        </section>
    </div>
</body>
</html>