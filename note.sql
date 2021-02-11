SELECT AVG(note) FROM
        gles_notes AS n,
        gles_personnes AS p,
        gles_etudiants AS e,
        gles_inscris AS i

        WHERE
        e.id_personne = 68 
        AND
        i.id_etudiant = e.id_personne
        AND
        n.id_inscris = i.id_etudiant