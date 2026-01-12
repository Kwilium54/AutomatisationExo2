INSERT INTO `companies` VALUES
    (1,'Stack Exchange','0601010101','stack@exchange.com','https://stackexchange.com/','https://i.stack.imgur.com/UPdHB.jpg',null),
    (2,'Google','0602020202','contact@google.com','https://www.google.com','https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Google_office_%284135991953%29.jpg/800px-Google_office_%284135991953%29.jpg?20190722090506',null);

INSERT INTO `offices` VALUES
    (1,'Bureau de Nancy','1 rue Stanistlas','Nancy','54000','France','nancy@stackexchange.com',NULL,1),
    (2,'Burea de Vandoeuvre','46 avenue Jeanne d\'Arc','Vandoeuvre','54500','France',NULL,NULL,1),
    (3,'Siege sociale','2 rue de la primatiale','Paris','75000','France',NULL,NULL,2),
    (4,'Bureau Berlinois','192 avenue central','Berlin','12277','Allemagne',NULL,NULL,2);

INSERT INTO `employees` VALUES
    (1,'Camille','La Chenille',1,'camille.la@chenille.com',NULL,'Ingénieur'),
    (2,'Albert','Mudhat',2,'albert.mudhat@aqume.net',NULL,'Superviseur'),
    (3,'Sylvie','Tesse',3,'sylive.tesse@factice.local',NULL,'PDG'),
    (4,'John','Doe',4,'john.doe@generique.org',NULL,'Testeur'),
    (5,'Jean','Bon',1,'jean@test.com',NULL,'Developpeur'),
    (6,'Anais','Dufour',2,'anais@aqume.net',NULL,'DBA'),
    (7,'Sylvain','Poirson',3,'sylvain@factice.local',NULL,'Administrateur réseau'),
    (8,'Telma','Thiriet',4,'telma@generique.org',NULL,'Juriste');

update companies set head_office_id = 1 where id = 1;
update companies set head_office_id = 3 where id = 2;
