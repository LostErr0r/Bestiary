
## FAZZING ЧЕРЕЗ ИНЕТ

- https://viewdns.info/iphistory/ История IP                                                                                                                                                  
- https://myip.ms/browse/sites_history/ сёрч по ip                                                                                                                                           
- https://viewdns.info/reverseip/ ревёрс по IP
###
                                                                                                                                                                                                
## sudo apt install dirbuster                                                                                                                                                                        
dirbuster словари для dirbuster /usr/share/wordlists/dirbuster/directory-list-lowercase-2.3-medium.txt                                                                                          
                                                                                                                                                                                                
                                                                                                                                                                                                
gobuster предназначен много для чего, но мы делаем перебор директорий, достаточно быстро выполняется запрос get                                                                                 
gobuster dir -u http://172.23.212.251/files -w /usr/share/wordlists/dirbuster/directory-list-2.3-medium.txt -t 400 -x php,html,txt,zip                                                          
                                                                                                                                                                                                
.txt, .php, .html, .zip                                                                                                                                                                         
Здесь -u – URL или IP-адрес сайта, -w – словарь, -t – количество потоков, -x – расширения файлов и -s – ответы сервера, которые будут отображаться.                                             
перебор файлов 





Можно сделать перебор паролей вот так тоже через ffuf, так же краткий экскурс по ffuf https://cisoclub.ru/rukovodstvo-po-fuzz-faster-u-fool-ffuf/
ffuf -u "http://172.23.118.28" -X POST -H "Content-Type: application/x-www-form-urlencoded" -d "login=admin&passwd=WFUZZ" -w /usr/share/wordlists/rockyou.txt:WFUZZ -c -fs 14 -t 500 -mc 302 -H "HOST: localhost"
                                                                                                                                                                                                
/usr/share/wordlists/dirbuster/ где лежат переборы                                                                                                                                              
                                                                                                                                                                                                
                                                                                                                                                                                              
Чтобы зафазить id сайта можно сделать так                                                                                                                                                       
htt://[адрес:порт]/?id= и тут произвольное число                                                                                                                                                

чтобы брутфорсить нужно иметь приложение burp suite

ссылка на репозиторий всех словарей 

Директории и файлы:
/SecLists-master/Discovery/Web-Content/directory-list-2.3-medium.txt
Имена параметров:
/SecLists-master/Discovery/Web-Content/burp-parameter-names.txt
/SecLists-master/Discovery/Web-Content/directory-list-2.3-medium.txt
Имена пользователей или логины:
https://github.com/danielmiessler/SecLists/blob/master/Usernames/top-usernames-shortlist.txt
https://github.com/danielmiessler/SecLists/blob/master/Usernames/Names/names.txt


### выбирать для подбора паролей в этой последовательности
 - https://github.com/danielmiessler/SecLists/blob/master/Passwords/xato-net-10-million-passwords-10000.txt
 - https://github.com/danielmiessler/SecLists/blob/master/Passwords/xato-net-10-million-passwords-100000.txt
 - https://github.com/danielmiessler/SecLists/blob/master/Discovery/Web-Content/directory-list-2.3-medium.txt
 - https://github.com/danielmiessler/SecLists/blob/master/Passwords/xato-net-10-million-passwords-1000000.txt
 - так же словарь rockyou который лежит по адресу /usr/share/wordlists/rockyou.txt.tar






https://github.com/Madhava-mng/RockYou.txt/blob/main/rockyou.txt.zip
