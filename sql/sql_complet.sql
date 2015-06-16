CREATE TYPE etat_article_redacteur AS ENUM('supprime','en_redaction');
CREATE TYPE etat_article_editeur AS ENUM('en_relecture','rejete','valide','publie','a_reviser');
CREATE TYPE etat_appreciation_moderateur AS ENUM('en_exergue','masque','supprime');
CREATE TYPE etat_appreciation_lecteur AS ENUM('visible','supprime');

CREATE TABLE comptes (
   pseudo varchar(32) PRIMARY KEY
  ,nom varchar(64) NOT NULL
  ,prenom varchar(64) NOT NULL
  ,date_naissance date NOT NULL
);

CREATE TABLE administrateur(
    pseudo varchar(32) PRIMARY KEY REFERENCES comptes(pseudo)
);

CREATE VIEW v_administrateur AS
  SELECT C.pseudo, nom, prenom, date_naissance 
  FROM comptes C, administrateur A
  WHERE C.pseudo=A.pseudo
;

CREATE TABLE redacteur(
    pseudo varchar(32) PRIMARY KEY REFERENCES comptes(pseudo)
);


CREATE VIEW v_redacteur AS
  SELECT comptes.pseudo, nom, prenom, date_naissance 
  FROM comptes, redacteur
  WHERE comptes.pseudo=redacteur.pseudo
;

CREATE TABLE comiteEditorial(
  nom varchar(64) PRIMARY KEY
);

CREATE TABLE editeur(
   pseudo varchar(32) PRIMARY KEY REFERENCES comptes(pseudo)
  ,comite varchar(64) REFERENCES comiteEditorial(nom) NOT NULL
);

CREATE VIEW v_editeur AS
  SELECT comptes.pseudo, nom, prenom, date_naissance 
  FROM comptes, editeur
  WHERE comptes.pseudo=editeur.pseudo
;

CREATE TABLE lecteur(
    pseudo varchar(32) PRIMARY KEY REFERENCES comptes(pseudo)
);

CREATE VIEW v_lecteur AS
  SELECT comptes.pseudo, nom, prenom, date_naissance  
  FROM comptes, lecteur
  WHERE comptes.pseudo=lecteur.pseudo
;

CREATE TABLE moderateur(
    pseudo varchar(32) PRIMARY KEY REFERENCES comptes(pseudo)
);

CREATE VIEW v_moderateur AS
  SELECT comptes.pseudo, nom, prenom, date_naissance   
  FROM comptes, moderateur
  WHERE comptes.pseudo=moderateur.pseudo
;


CREATE TABLE mot_cle(
   mot varchar(64) PRIMARY KEY
);

CREATE TABLE indexation(
   _date timestamp PRIMARY KEY
);

CREATE TABLE mc_appartient_index(
   mc varchar(64) REFERENCES mot_cle(mot)
  ,_index timestamp REFERENCES indexation(_date)
  ,PRIMARY KEY (mc, _index)
);


CREATE TABLE ed_creer_index(
   ed varchar(32) REFERENCES editeur(pseudo)
  ,_index timestamp REFERENCES indexation(_date)
  ,PRIMARY KEY (ed, _index)
);


CREATE TABLE honneur(
  nom varchar(64) PRIMARY KEY
);

CREATE TABLE gestion(
   _date timestamp PRIMARY KEY
  ,honneur varchar(64) REFERENCES honneur(nom)
);

CREATE TABLE ed_propose_gestion(
   ed varchar(32) REFERENCES editeur(pseudo)
  ,gestion timestamp REFERENCES gestion(_date)
  ,PRIMARY KEY(ed, gestion)
);


CREATE TABLE article(
   titre varchar(64) PRIMARY KEY
  ,_date timestamp
);

CREATE TABLE art_faipartie_indexation(
   article varchar(64) REFERENCES article(titre)
  ,_index timestamp REFERENCES indexation(_date)
  ,PRIMARY KEY (article, _index)
);

CREATE TABLE art_estpropose_gestion(
   article varchar(64) REFERENCES article(titre)
  ,gestion timestamp REFERENCES gestion(_date)
  ,PRIMARY KEY (article, gestion)
);

CREATE TABLE changement_etat_art_ed(
   article varchar(64) REFERENCES article(titre)
  ,editeur varchar(32) REFERENCES editeur(pseudo)
  ,_date timestamp
  ,etat etat_article_editeur NOT NULL
  ,explication text
  ,PRIMARY KEY (article, editeur, _date)
);


CREATE TABLE rubrique(
   nom varchar(64) PRIMARY KEY
  ,rubrique_mere varchar(64) REFERENCES rubrique(nom)
);

CREATE TABLE ed_cree_rub(
   editeur varchar(32) REFERENCES editeur(pseudo)
  ,rubrique varchar(64) REFERENCES rubrique(nom)
  ,_date timestamp
  ,PRIMARY KEY (editeur, rubrique, _date)
);

CREATE TABLE association(
   _date timestamp PRIMARY KEY
  ,article varchar(64) REFERENCES article(titre) NOT NULL
);

CREATE TABLE ed_cree_assoc (
   editeur varchar(32) REFERENCES editeur(pseudo)
  ,_date timestamp REFERENCES association(_date)
  ,PRIMARY KEY(editeur, _date)
);

CREATE TABLE assoc_appartient_rub(
   _date timestamp REFERENCES association(_date)
  ,rubrique varchar(64) REFERENCES rubrique(nom)
  ,PRIMARY KEY(_date, rubrique)
);

CREATE TABLE lien(
   _date timestamp
  ,editeur varchar(32) REFERENCES editeur(pseudo) NOT NULL
  ,article1 varchar(64) REFERENCES article(titre) NOT NULL
  ,article2 varchar(64) REFERENCES article(titre) NOT NULL
  ,PRIMARY KEY(_date, article1, article2)
  ,CHECK (article1 <> article2)
);

CREATE TABLE image(
   titreBloc varchar(64)
  ,titreArticle varchar(64) REFERENCES article(titre)
  ,contenu_img varchar(24) UNIQUE NOT NULL
  ,PRIMARY KEY(titreBloc, titreArticle)
);

CREATE TABLE text(
   titreBloc varchar(64)
  ,titreArticle varchar(64) REFERENCES article(titre)
  ,contenu_txt text UNIQUE NOT NULL
  ,PRIMARY KEY (titreBloc, titreArticle)
);

CREATE VIEW v_Bloc AS
  SELECT titreBloc, titreArticle FROM image
  UNION
  SELECT titreBloc, titreArticle FROM text
;

CREATE TABLE soumission(
   _date timestamp PRIMARY KEY
  ,redacteur varchar(32) REFERENCES redacteur(pseudo) NOT NULL
  ,comite_editorial varchar(64) REFERENCES comiteEditorial(nom) NOT NULL
);

CREATE TABLE red_concoit_art(
    redacteur varchar(32) REFERENCES redacteur(pseudo)
   ,article varchar(64) REFERENCES article(titre)
   ,PRIMARY KEY (redacteur, article)
);


CREATE TABLE changement_etat_art_red(
   redacteur varchar(32) REFERENCES redacteur(pseudo)
  ,article varchar(64) REFERENCES article(titre)
  ,_date timestamp
  ,etat etat_article_redacteur NOT NULL
  ,PRIMARY KEY(redacteur, article, _date)
);


CREATE TABLE art_appartient_soum(
   article varchar(64) REFERENCES article(titre)
  ,soumis timestamp REFERENCES soumission(_date)
  ,PRIMARY KEY(article, soumis)
);


CREATE TABLE appreciation(
   _id serial PRIMARY KEY
  ,dateCreation timestamp NOT NULL
  ,lecteur varchar(32) REFERENCES lecteur(pseudo) NOT NULL
  ,article varchar(64) REFERENCES article(titre) NOT NULL
  ,UNIQUE(dateCreation, lecteur, article)
);

CREATE TABLE changement_etat_app_lec(
   appreciation integer REFERENCES appreciation(_id)
  ,dateModification timestamp
  ,etat etat_appreciation_lecteur NOT NULL
  ,PRIMARY KEY(appreciation, dateModification)
);


CREATE TABLE note(
   appreciation integer PRIMARY KEY REFERENCES appreciation(_id)
  ,valeur integer NOT NULL
  ,CHECK (valeur >= 0 AND valeur <= 10)
);

CREATE VIEW v_note AS
  SELECT _id,dateCreation,lecteur,article,valeur 
  FROM note, appreciation
  WHERE note.appreciation=appreciation._id
;

CREATE TABLE commentaire(
   appreciation integer PRIMARY KEY REFERENCES appreciation(_id)
  ,titre varchar(64) UNIQUE NOT NULL
  ,texte text
);

CREATE VIEW v_commentaire AS
  SELECT _id,dateCreation,lecteur,article,titre,texte
  FROM commentaire, appreciation
  WHERE commentaire.appreciation=appreciation._id
;

CREATE TABLE changement_etat_app_mod(
   _date timestamp
   ,moderateur varchar(32) REFERENCES moderateur(pseudo)
   ,appreciation integer REFERENCES appreciation(_id)
  ,etat etat_appreciation_moderateur NOT NULL
  ,explication text
  ,PRIMARY KEY(_date, moderateur, appreciation)
);