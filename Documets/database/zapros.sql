SELECT priveleges.privelegevalue FROM users JOIN priveleges ON users.privelege=priveleges.id AND users.login='".pg_escape_string($connection,$_POST['login'])."'
SELECT pwd FROM users WHERE login='".pg_escape_string($connection,$_POST['login'])."'