INSERT INTO comptes (pseudo,nom,prenom,date_naissance)
VALUES ('dartchou','artchounin','daniel','1994-05-12');

INSERT INTO comptes (pseudo,nom,prenom,date_naissance)
VALUES ('tkapil','thangeswaran','kapilraj','1994-05-12');

INSERT INTO comptes (pseudo,nom,prenom,date_naissance)
VALUES ('gmuller','muller','guenael','1994-05-12');

INSERT INTO comptes (pseudo,nom,prenom,date_naissance)
VALUES ('xuminzh','xu','minzhe','1994-05-12');

INSERT INTO comptes (pseudo,nom,prenom,date_naissance)
VALUES ('zinsmatt','zins','matthieu','1994-03-20');

INSERT INTO comptes (pseudo,nom,prenom,date_naissance)
VALUES ('admin','lhussier','benjamin','1975-12-20');

INSERT INTO administrateur (pseudo)
VALUES ('admin');

INSERT INTO redacteur (pseudo)
VALUES ('dartchou');

INSERT INTO comiteEditorial (nom)
VALUES ('commite_editorial1');

INSERT INTO editeur (pseudo, comite)
VALUES ('tkapil','commite_editorial1');

INSERT INTO lecteur (pseudo)
VALUES ('gmuller');

INSERT INTO lecteur (pseudo)
VALUES ('xuminzh');

INSERT INTO lecteur (pseudo)
VALUES ('zinsmatt');

INSERT INTO moderateur (pseudo)
VALUES ('gmuller');


INSERT INTO mot_cle (mot)
VALUES ('medians');

INSERT INTO mot_cle (mot)
VALUES ('finaux');

INSERT INTO mot_cle (mot)
VALUES ('nf17');

INSERT INTO mot_cle (mot)
VALUES ('lo21');

INSERT INTO mot_cle (mot)
VALUES ('mt90');



INSERT INTO rubrique (nom)
VALUES ('utc');

INSERT INTO ed_cree_rub (editeur, rubrique, _date)
VALUES ('tkapil', 'utc', TO_TIMESTAMP('2015-05-20 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO rubrique (nom, rubrique_mere)
VALUES ('informatique', 'utc');

INSERT INTO ed_cree_rub (editeur, rubrique, _date)
VALUES ('tkapil', 'informatique', TO_TIMESTAMP('2015-05-21 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO rubrique (nom)
VALUES ('escom');

INSERT INTO ed_cree_rub (editeur, rubrique, _date)
VALUES ('tkapil', 'escom', TO_TIMESTAMP('2015-05-22 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO rubrique (nom)
VALUES ('essec');

INSERT INTO ed_cree_rub (editeur, rubrique, _date)
VALUES ('tkapil', 'essec', TO_TIMESTAMP('2015-05-23 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO rubrique (nom)
VALUES ('effrei');

INSERT INTO ed_cree_rub (editeur, rubrique, _date)
VALUES ('tkapil', 'effrei', TO_TIMESTAMP('2015-05-24 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO rubrique (nom, rubrique_mere)
VALUES ('mecanique', 'utc');

INSERT INTO ed_cree_rub (editeur, rubrique, _date)
VALUES ('tkapil', 'mecanique', TO_TIMESTAMP('2015-05-25 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO rubrique (nom, rubrique_mere)
VALUES ('procedes', 'utc');

INSERT INTO ed_cree_rub (editeur, rubrique, _date)
VALUES ('tkapil', 'procedes', TO_TIMESTAMP('2015-05-26 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO rubrique (nom, rubrique_mere)
VALUES ('systèmes urbains', 'utc');

INSERT INTO ed_cree_rub (editeur, rubrique, _date)
VALUES ('tkapil', 'systèmes urbains', TO_TIMESTAMP('2015-05-27 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));


INSERT INTO article (titre, _date)
VALUES ('ProjectCalendar', TO_TIMESTAMP('2015-06-01 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO red_concoit_art (redacteur, article)
VALUES ('dartchou', 'ProjectCalendar');

INSERT INTO changement_etat_art_red (redacteur, article, _date, etat)
VALUES ('dartchou', 'ProjectCalendar', TO_TIMESTAMP('2015-06-02 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'), 'en_redaction');

INSERT INTO text (titreBloc, titreArticle, contenu_txt)
VALUES 
('Introduction', 'ProjectCalendar', 'Sed ut omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed  consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?'),
('Paragraphe 1', 'ProjectCalendar', 'Lorem ipsum dolor sit amet, adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

INSERT INTO text (titreBloc, titreArticle, contenu_txt)
VALUES 
('Paragraphe 2', 'ProjectCalendar', 'But I must explain to you how this idea of denouncing pleasure and praising pain was born and I will give you a complete account of the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?'),
('Paragraphe 3', 'ProjectCalendar', 'At vero eos et accusamus et iusto odio ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.');

INSERT INTO text (titreBloc, titreArticle, contenu_txt)
VALUES 
('Paragraphe 4', 'ProjectCalendar', 'On the other hand, we denounce with indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases  simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.'),
('Paragraphe 5', 'ProjectCalendar', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

INSERT INTO text (titreBloc, titreArticle, contenu_txt)
VALUES 
('Paragraphe 6', 'ProjectCalendar', 'Sed ut perspiciatis unde omnis iste natus sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?'),
('Conclusion', 'ProjectCalendar', 'But I must explain to you how all this idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?');


INSERT INTO article (titre, _date)
VALUES ('Anniversaire', TO_TIMESTAMP('2015-06-03 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO red_concoit_art (redacteur, article)
VALUES ('dartchou', 'Anniversaire');

INSERT INTO changement_etat_art_red (redacteur, article, _date, etat)
VALUES ('dartchou', 'Anniversaire', TO_TIMESTAMP('2015-06-04 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'), 'en_redaction');

INSERT INTO text (titreBloc, titreArticle, contenu_txt)
VALUES 
('Introduction', 'Anniversaire', 'At vero eos et accusamus et iusto odio dignissimos qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.'),
('Paragraphe 1', 'Anniversaire', 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.');

INSERT INTO text (titreBloc, titreArticle, contenu_txt)
VALUES 
('Paragraphe 2', 'Anniversaire', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
('Paragraphe 3', 'Anniversaire', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?');

INSERT INTO text (titreBloc, titreArticle, contenu_txt)
VALUES 
('Paragraphe 4', 'Anniversaire', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?'),
('Paragraphe 5', 'Anniversaire', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo id quod maxime placeat facere possimus, omnis voluptas est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.');

INSERT INTO text (titreBloc, titreArticle, contenu_txt)
VALUES 
('Paragraphe 6', 'Anniversaire', 'On the other hand, we denounce with righteous indignation and men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.'),
('Conclusion', 'Anniversaire', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est.');


INSERT INTO article (titre, _date)
VALUES ('Décès', TO_TIMESTAMP('2015-06-05 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO red_concoit_art (redacteur, article)
VALUES ('dartchou', 'Décès');

INSERT INTO changement_etat_art_red (redacteur, article, _date, etat)
VALUES ('dartchou', 'Décès', TO_TIMESTAMP('2015-06-06 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'), 'en_redaction');

INSERT INTO text (titreBloc, titreArticle, contenu_txt)
VALUES 
('Introduction', 'Décès', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?'),
('Paragraphe 1', 'Décès', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?.');

INSERT INTO text (titreBloc, titreArticle, contenu_txt)
VALUES 
('Paragraphe 2', 'Décès', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.'),
('Paragraphe 3', 'Décès', 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.');

INSERT INTO text (titreBloc, titreArticle, contenu_txt)
VALUES 
('Paragraphe 4', 'Décès', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt anim id est laborum.'),
('Paragraphe 5', 'Décès', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?');

INSERT INTO text (titreBloc, titreArticle, contenu_txt)
VALUES 
('Paragraphe 6', 'Décès', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?'),
('Conclusion', 'Décès', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.');



INSERT INTO changement_etat_art_red (redacteur, article, _date, etat)
VALUES ('dartchou', 'ProjectCalendar', TO_TIMESTAMP('2015-06-07 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'), 'supprime');

INSERT INTO changement_etat_art_red (redacteur, article, _date, etat)
VALUES ('dartchou', 'ProjectCalendar', TO_TIMESTAMP('2015-06-08 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'), 'en_redaction');

INSERT INTO changement_etat_art_red (redacteur, article, _date, etat)
VALUES ('dartchou', 'ProjectCalendar', TO_TIMESTAMP('2015-06-09 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'), 'supprime');



INSERT INTO soumission (_date, redacteur, comite_editorial)
VALUES (TO_TIMESTAMP('2015-06-10 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'), 'dartchou', 'commite_editorial1');

INSERT INTO art_appartient_soum (article, soumis)
VALUES ('Anniversaire', TO_TIMESTAMP('2015-06-10 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO changement_etat_art_ed (article, editeur, _date, etat, explication)
VALUES ('Anniversaire', 'tkapil', TO_TIMESTAMP('2015-06-12 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'), 'en_relecture', 'Intéressant');

INSERT INTO changement_etat_art_ed (article, editeur, _date, etat, explication)
VALUES ('Anniversaire', 'tkapil', TO_TIMESTAMP('2015-06-13 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'), 'valide', 'Intéressant');


INSERT INTO indexation(_date)
VALUES (TO_TIMESTAMP('2015-06-14 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO ed_creer_index(ed, _index)
VALUES ('tkapil', TO_TIMESTAMP('2015-06-14 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO mc_appartient_index(mc, _index)
VALUES ('lo21', TO_TIMESTAMP('2015-06-14 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO art_faipartie_indexation(article, _index)
VALUES('Anniversaire', TO_TIMESTAMP('2015-06-14 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));


INSERT INTO association(_date, article)
VALUES (TO_TIMESTAMP('2015-06-15 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'), 'Anniversaire');

INSERT INTO ed_cree_assoc(editeur, _date)
VALUES ('tkapil', TO_TIMESTAMP('2015-06-15 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO assoc_appartient_rub(_date, rubrique)
VALUES(TO_TIMESTAMP('2015-06-15 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'), 'informatique');



INSERT INTO honneur(nom)
VALUES ('UTC');

INSERT INTO gestion(_date, honneur)
VALUES (TO_TIMESTAMP('2015-06-16 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'), 'UTC');

INSERT INTO ed_propose_gestion(ed, gestion)
VALUES ('tkapil', TO_TIMESTAMP('2015-06-16 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));

INSERT INTO art_estpropose_gestion(article, gestion)
VALUES ('Anniversaire', TO_TIMESTAMP('2015-06-16 06:14:00.742000000', 'YYYY-MM-DD HH24:MI:SS.FF'));
