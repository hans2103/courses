class: middle
# Server performance
## door Jisse Reitsma
### <a href="http://twitter.com/jissereitsma">@jissereitsma</a>

---
# Onderwerpen
- HTTP/2
- MySQL
- PHP7
- PHP-FPM

---
# HTTP/2
- Ondersteuning webserver nodig
- SSL certificaat is vereist (HTTPS)
	- Gratis certificaat via LetsEncrypt
- Voordelen
	- Multiplexing & concurrency
	- Header compressie
	- Server push (?)

---
# MySQL tuning
- Root toegang tot server nodig
- Query cache
	- `query_cache_type=1`
	- `query_cache_size=256M`
	- `query_cache_limit=2M`
- InnoDB buffering

---
# PHP tuning
- Basis instellingen
	- `memory_limit`
	- `max_execution_time`
- Geavanceerde instellingen
	- `realpath_cache_size=256k`
	- `realpath_cache_ttl=7200`

---
# PHP modules
- Geen ionCube
	- Encryptie van software
- Geen Xdebug
	- Tool voor PHP development

---
# PHP 7
- Tot soms 200% sneller dan PHP 5.6
- Joomla support vanaf Joomla 3.5
- Versie opmerkingen
	- PHP 5.5: EOL sinds augustus 2016
	- PHP 5.6: Geen actieve support meer
	- PHP 5.6: EOL op 1 januari 2019
	- PHP 7.0: EOL op 3 december 2018
	- PHP 7.1: Huidige stabiele versie

---
# Zend OPCache
- Caching van byte code in geheugen
- Tuning
	- `opcache.enable=1`
	- `opcache.memory_consumption=512`
	- `opcache.validate_timestamps=0` (PAS OP)
	- `opcache.revalidate_freq=60`

---
# Extra uitbreidingen
- Varnish
- ElasticSearch
- Redis / memcached

---
# Quick wins
- Draaien op PHP 7
- Zend OPCache aanzetten
- Geen ionCube of Xdebug
- HTTPS met HTTP/2
- Geoptimaliseerde webhost