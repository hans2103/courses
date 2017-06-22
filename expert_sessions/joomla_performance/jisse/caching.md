class: middle
# Cache handlers
## door Jisse Reitsma
### <a href="http://twitter.com/jissereitsma">@jissereitsma</a>

---
# Cache handlers
- File
- Memcached
- Redis

---
class: middle, center, intro
# Redis

---
# Redis
- In-memory database
    - Name/value paren
    - Inclusief meta-data
- Manier om Joomla cache supersnel te maken
- Support op server nodig
    - Redis service
    - PHP extensie voor Redis (optioneel)

---
# Redis opties in Joomla
- Redis server
    - Host (`localhost`)
    - Port (`6379`)
    - Server authenticatie (`blabla`)
    - Database (`1`)
- Persistent (uitzetten)

---
# Problemen met Redis
- Database conflicten
    - Iedere site moet uniek Redis `database` getal hebben
- Geheugentekort
    - Geen swap-probleem maar wel minder performance
    - [phpRedmin](https://github.com/sasanrose/phpredmin)
- Server support nodig
    - Extra kosten?

---
class: middle, center, intro
# Memcached

---
# Memcached
- In-memory database
    - Name/value paren
    - Exclusief meta-data (!)
- Manier om Joomla cache supersnel te maken
- Support op server nodig
    - Memcached service
    - PHP extensie voor Memcached (optioneel)

---
# Redis opties in Joomla
- Redis server
    - Host (`localhost`)
    - Port (`11211`)
    - Server authenticatie (`blabla`)
    - Database (`1`)
- Persistent (uitzetten)
- Compressie (uitzetten)

---
# Problemen met Memcached
- Geen meta-data opslag
    - Normale Joomla cache gedeeltelijk gebruikt
- Geheugentekort
    - Geen swap-probleem maar wel minder performance
    - [phpMemcachedAdmin](https://code.google.com/archive/p/phpmemcacheadmin/)
- Server support nodig
    - Extra kosten?

---
# Redis vs Memcached
- Redis is sneller dan Memcached
- Memcached is er ook als Sessie Handler
- Memcached kan goed clusteren, Redis minder goed