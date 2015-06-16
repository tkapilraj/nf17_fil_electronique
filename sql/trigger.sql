CREATE LANGUAGE plpgsql;

-- creation de la fonction qui sera executee par le trigger
CREATE OR REPLACE FUNCTION ajouter_etat_defaut_appreciation() RETURNS TRIGGER AS
'
BEGIN
INSERT INTO changement_etat_app_lec (appreciation,dateModification,etat)
VALUES (NEW._id,NEW.dateCreation,''visible'');
RETURN NEW;
END;
'
LANGUAGE 'plpgsql';

-- creation du trigger
CREATE TRIGGER TR_APPRECIATION_ETAT_DEFAUT
AFTER INSERT ON appreciation
FOR EACH ROW
EXECUTE PROCEDURE ajouter_etat_defaut_appreciation();


