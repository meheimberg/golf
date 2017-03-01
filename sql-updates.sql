/*
ALTER TABLE players ADD email VARCHAR( 255 ) after name;
ALTER TABLE players ADD password VARCHAR( 255 ) after email;

INSERT INTO players (id,email,password) VALUES 
(1,'ernie@heimberg.net',''),
(2,'bill',''),
(3,'dana.flint@yahoo.com',''),
(4,'mark@heimberg.net',''),
(19,'steve',''),
(24,'marla',''),
(25,'jonathan@heimberg.net','')
ON DUPLICATE KEY UPDATE email=VALUES(email),password=VALUES(password);



INSERT INTO players (id,password) VALUES 
(1,'$2y$11$3KFfO4WolomIxuCSKg.9iO3tHJknb4AtuMv1h2IrsskBAYKlisgxi'),
(4,'$2y$11$cEkB2lq9L.vFzYZJQktaquxs2jP66W7xKyJuW3OtdNnwkYcYzviMS'),
(25,'$2y$11$v.CX3z/oDNdzbSbogkhf4.rjdqFnPP97f1cG5zt/CnGaY/ADI5BFW')
ON DUPLICATE KEY UPDATE password=VALUES(password);


ALTER TABLE `players` ADD `access` VARCHAR(25) NOT NULL AFTER `password`
ALTER TABLE `players` CHANGE `access` `access` TINYINT NOT NULL;

INSERT INTO players (id,access) VALUES 
(1,10),
(2,1),
(3,1),
(4,10),
(19,1),
(24,1),
(25,1)
ON DUPLICATE KEY UPDATE access=VALUES(access);
*/


ALTER TABLE `scores` ADD `real_date` DATE NULL DEFAULT NULL ;









