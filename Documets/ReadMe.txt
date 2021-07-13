DataBase = PostgreSQL v.13

Server = Apache

PHP + HTML + BOOTSTRAP + JavaScript(JQuery)

Устанавливаем ОС

Устанавливаем на  Apache, PHP, PostgreSQL

Настраиваем Apache

Настраиваем Apache на работу php в html добавив 
AddType application/x-httpd-php .html
в конце между
<IfModule mime_module> и </IfModule>

Устанавливаем PostgreSQL и выполняем скрипт dbhelpdesk.sql в папке database