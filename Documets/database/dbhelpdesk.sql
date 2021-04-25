-- Вызов скрипта из файла
-- psql -h localhost -p 5432 -U postgres -d helpdesk -f "path\to\file" -- 
-- TEMPLATE = template0;
----------------------------------------------------------
-- Табилца privelege, для указания пола пользователя
-- "id" уникальный идентификатор 
-- "privelege" привелегия
-- "privelegevalue" значение привелегии от 0 - ничего до 5 - максимальное
DROP TABLE IF EXISTS priveleges CASCADE;
CREATE TABLE priveleges(
	id SERIAL PRIMARY KEY NOT NULL,
	privelegename VARCHAR(50) NOT NULL,
    privelegevalue INT NOT NULL
);
-- defaul priveges --
INSERT INTO priveleges (id, privelegename, privelegevalue) VALUES (1, 'Disabled', 0);
INSERT INTO priveleges (id, privelegename, privelegevalue) VALUES (2, 'SuperAdministrator', 3);
INSERT INTO priveleges (id, privelegename, privelegevalue) VALUES (3, 'Administrator', 2);

----------------------------------------------------------
-- Табилца users, для указания пола пользователя
-- "id" уникальный идентификатор 
-- "login" имя, логин
-- "email" почта
-- "pwd" пароль
DROP TABLE IF EXISTS users CASCADE;
CREATE TABLE users(
	id SERIAL PRIMARY KEY NOT NULL,
	login VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    pwd VARCHAR(255) NOT NULL,
    privelege INT REFERENCES priveleges (id) ON DELETE CASCADE,
    description VARCHAR(255)
);
--- Default user ---
INSERT INTO users (id, login, pwd, privelege, description) VALUES (1, 'disabled', 'helpdesk', 1, 'Standart user');
INSERT INTO users (id, login, pwd, privelege, description) VALUES (2, 'SuperAdmin', 'helpdesk', 2, 'Standart user');
INSERT INTO users (id, login, pwd, privelege, description) VALUES (3, 'Admin', 'helpdesk', 3, 'Standart user');

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
-- "theme" тема
-- "descriptions" описание задачи
-- "publisher" пользователь опубликовавший задачу
-- "termdatetime" срок выполнить до
-- "createdate" дата создания задачи
-- "stage" стадия
-- "responsible" пользователь принявший задачу
-- "editdate" дата принятия задачи
-- "finishdate" дата выполнения задачи
DROP TABLE IF EXISTS tasks CASCADE;
CREATE TABLE tasks(
	id SERIAL PRIMARY KEY NOT NULL,
	theme VARCHAR(255) NOT NULL,
    descriptions VARCHAR (255) NOT NULL,
    publisher varchar NOT NULL,
    termdate  DATE,
    createdate DATE NOT NULL,
    responsible VARCHAR,
    stage INT REFERENCES stage (id) ON DELETE CASCADE,
    editdate DATE,
    finishdate DATE
);

----------------------------------------------------------
-- Табилца sessions, для указания пола пользователя
-- "id" уникальный идентификатор 
DROP TABLE IF EXISTS sessions CASCADE;
CREATE TABLE sessions(
	id SERIAL PRIMARY KEY NOT NULL,
	username VARCHAR,
--    hashs varchar(128) NOT NULL,
    ip varchar
);