SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id`         INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name`       VARCHAR(255) NOT NULL,
  `gender`     TINYINT NOT NULL DEFAULT 0 COMMENT '0 - не указан, 1 - мужчина, 2 - женщина',
  `birth_date` DATE    NOT NULL
) ENGINE=InnoDB CHARSET=utf8;
DROP TABLE IF EXISTS `phone_numbers`;
CREATE TABLE `phone_numbers` (
  `id`      INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `phone`   VARCHAR(255) NOT NULL UNIQUE,
  PRIMARY KEY (`id`),
  INDEX `user` (user_id),
  FOREIGN KEY (user_id)
  REFERENCES users (id)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB CHARSET=utf8;
SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO users SET name = 'Test Male', gender = 1, birth_date = '1985-01-01', id = 1;
INSERT INTO users SET name = 'Test Female', gender = 2, birth_date = '1986-03-20', id = 2;
INSERT INTO users SET name = 'Test Female 2', gender = 2, birth_date = '2010-03-20', id = 3;
INSERT INTO users SET name = 'Test Female 3', gender = 2, birth_date = '2000-03-20', id = 4; # Попадет в выборку

INSERT INTO phone_numbers SET user_id = 1, phone = '+72921112233';
INSERT INTO phone_numbers SET user_id = 2, phone = '+79031112233';
INSERT INTO phone_numbers SET user_id = 3, phone = '+79151112233';

INSERT INTO phone_numbers SET user_id = 4, phone = '+79031234567';
INSERT INTO phone_numbers SET user_id = 4, phone = '+79039998877';
INSERT INTO phone_numbers SET user_id = 4, phone = '+79033332211';

