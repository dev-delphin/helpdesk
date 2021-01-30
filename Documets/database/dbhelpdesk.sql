-- Вызов скрипта из файла
-- psql -h localhost -p 5432 -U postgres -d helpdesk -f "path\to\file" -- 
----------------------------------------------------------
-- Табилца users, для указания пола пользователя
-- "id" уникальный идентификатор 
-- "firstname" имя
-- "email" почта
-- "pwd" пароль
DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE users(
	id SERIAL PRIMARY KEY NOT NULL,
	firstname VARCHAR(50) NOT NULL, --login
    email VARCHAR(100),
    pwd VARCHAR(255) NOT NULL,
    privelege INT REFERENCES privelege (id) ON DELETE CASCADE
);
--- Default user ---
INSERT INTO users (id, firstname, pwd, privelege) VALUES (1, 'SuperAdmin', 'helpdesk', 1);

----------------------------------------------------------
-- Табилца privelege, для указания пола пользователя
-- "id" уникальный идентификатор 
-- "privelege" привелегия
-- "privelegevalue" значение привелегии от 0 - ничего до 5 - максимальное
DROP TABLE IF EXISTS privelege CASCADE;
CREATE TABLE privelege(
	id SERIAL PRIMARY KEY NOT NULL,
	privelege VARCHAR(50) NOT NULL,
    privelegevalue INT NOT NULL
);
-- defaul priveges --
INSERT INTO privelege (id, privelege, privelegevalue) VALUES (1, 'СуперАдминистратор', 5);
INSERT INTO privelege (id, privelege, privelegevalue) VALUES (2, 'Администратор', 4);
INSERT INTO privelege (id, privelege, privelegevalue) VALUES (3, 'Техник', 3);
INSERT INTO privelege (id, privelege, privelegevalue) VALUES (4, 'Пользователь', 2);
INSERT INTO privelege (id, privelege, privelegevalue) VALUES (5, 'Гость', 1);
INSERT INTO privelege (id, privelege, privelegevalue) VALUES (6, 'Disabled', 0);

----------------------------------------------------------
-- Табилца stage, для указания пола пользователя
-- "id" уникальный идентификатор 
-- "stage" привелегия
DROP TABLE IF EXISTS stage CASCADE;
CREATE TABLE stage(
	id SERIAL PRIMARY KEY NOT NULL,
	stage VARCHAR(50) NOT NULL
);
-- default stage --
INSERT INTO stage (id, stage) VALUES (1, 'Не начато');
INSERT INTO stage (id, stage) VALUES (2, 'В процессе');
INSERT INTO stage (id, stage) VALUES (3, 'Завершено');

----------------------------------------------------------
-- Табилца tasks, для указания пола пользователя
-- "id" уникальный идентификатор 
-- "theme" привелегия
-- "description" описание задачи
-- "publisher" пользователь опубликовавший задачу
-- "responsible" пользователь принявший задачу
-- "stage" стадия
-- "createdate" дата создания задачи
-- "editdate" дата принятия задачи
-- "finishdate" дата выполнения задачи
DROP TABLE IF EXISTS tasks CASCADE;
CREATE TABLE tasks(
	id SERIAL PRIMARY KEY NOT NULL,
	theme VARCHAR(255) NOT NULL,
    description VARCHAR (255) NOT NULL,
    publisher INT REFERENCES users (id) NOT NULL,
    responsible INT REFERENCES users (id) NOT NULL,
    stage INT REFERENCES stage (id) ON DELETE CASCADE,
    createdate DATE NOT NULL,
    editdate DATE NOT NULL,
    finishdate DATE NOT NULL
);