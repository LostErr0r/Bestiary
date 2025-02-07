## My SQL    
|Команда|Код|
|----------------|-------------------------------|
|Коментарии  | #<br>/*<br>-- -<br>;%00|   
|Получение версии | SELECT VERSION();<br>SELECT @@VERSION;<br>SELECT @@GLOBAL.VERSION;|   
|Получение информации о пользователе | SELECT user()<br>SELECT current_user()<br>SELECT system_user()<br>SELECT session_user()<br>SELECT user,password FROM mysql.user;|   
|Получение хэшей паролей |SELECT host, user, password FROM mysql.user;|   
|Получение текущей базы данных | SELECT database()<br>SELECT db_name();<br>SELECT database();<br>SELECT schema_name FROM<br>information_schema.schemata;|   
|Вывод списка баз данных  |SELECT schema_name FROM information_schema.schemata;<br>SELECT distinct(db) FROM mysql.db |   
|Вывод списка колонок  |SELECT table_schema, table_name, column_name FROM information_schema.columns WHERE table_schema != ‘mysql’ AND table_schema != ‘information_schema’<br>SELECT column_name FROM information_schema.columns WHERE table_name = 'tablename'; |   
| | |
| | |
| | |
| | |
| | |
| | |
| | |
| | |
| | |
| | |

<br>
