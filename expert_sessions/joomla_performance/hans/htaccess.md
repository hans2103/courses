class: middle, center, intro
# .htaccess performance
## door Hans Kuijpers
### <a href="http://twitter.com/hans2103">@hans2103</a>
<img src="/images/logos.png">

---
# Wat is .htaccess ?

- bestandstype zonder naam
- voor websites op Apache servers
- om serverinstellingen te wijzigen of te omzeilen
- voor requests in directory waar het in zit en alle subdirectories.

---
# Mogelijkheden van .htaccess

- rewrites /index.php?option=com_content.... = /contact
- redirects /verlopen-aanbieding naar /nieuwe-aanbieding
- beveiliging uitsluiten van bepaalde ip-adressen
- optimalisatie
- en meer...

---
# Wat zeggen de makers zelf: 

--

> Using .htaccess files slows down your Apache http server.
>
> <cite>http://httpd.apache.org/docs/2.2/howto/htaccess.html</cite>

---
# Voorbeeld van vertraging
in httpd.conf activeer je mogelijkheid .htaccess

```xml
<Directory /www>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>```

--
stel... de volgende server request
```xml
/www/perfectsite/test/index.html
```

--
dan zoekt server naar .htaccess in de root van de site en alle subdirectories

```xml
/www/.htaccess
/www/perfect/.htaccess
/www/perfect/test/.htaccess
```

---
# Waar moet het dan wel?

In de server configuratie httpd.conf

```xml
<Directory /www/perfect/test>
  # Jouw regels hier
</Directory>
```

--

## Maar... alleen voor hen die bij serverconfiguratie kunnen

--

## En die heb ik vaak niet

---
# Dus toch .htaccess

- want... de gevreesde vertraging is haast niet merkbaar
- en... alleen van toepassing op de site waarin ik bezig ben
	- niet op de andere sites van de server
- en... wijziging direct van toepassing
	- httpd.conf wordt alleen bij opstarten ingelezen. 
	- .htaccess bij elk verzoek

---
# Hoe in Joomla!

- Log in met sFTP/SSH
- hernoem de standaard Joomla! htaccess.txt naar .htaccess

```bash
$ mv htaccess.txt .htaccess
```

--
## uitbreiden standaard .htaccess
- Toevoegen Gzip compressie
- Toevoegen Expire Headers

---
class: code-14
# Toevoegen Gzip compressie - 1

- Activeren via Joomla! Algemene configuratie
<img src="/joomla_performance/hans/gzip.png">

- en toevoegen van .htaccess regels

```text
AddOutputFilterByType DEFLATE text/plain
AddOutputFilterByType DEFLATE text/html
AddOutputFilterByType DEFLATE text/xml
AddOutputFilterByType DEFLATE text/css
AddOutputFilterByType DEFLATE application/xml
AddOutputFilterByType DEFLATE application/xhtml+xml
AddOutputFilterByType DEFLATE application/rss+xml
AddOutputFilterByType DEFLATE application/javascript
AddOutputFilterByType DEFLATE application/x-javascript
```

---
class: code-14
# Toevoegen Gzip compressie - 2
uitgebreide lijst https://github.com/h5bp/server-configs-apache/blob/master/dist/.htaccess#L714

```text
<IfModule mod_deflate.c>
    #<IfModule mod_filter.c>
        AddOutputFilterByType DEFLATE "application/atom+xml" \
                                      "application/javascript" \
                                      "application/json" \
                                      "application/ld+json" \
                                      "application/manifest+json" \
                                      "application/rdf+xml" \
                                      "application/rss+xml" \
                                      "application/schema+json" \
                                      "application/vnd.geo+json" \
                                      "application/vnd.ms-fontobject" \
                                      "application/x-font-ttf" \
                                      "application/x-javascript" \
                                      "application/x-web-app-manifest+json" \
                                      "application/xhtml+xml" \
                                      "application/xml" \
                                      "font/eot" \
                                      "font/opentype" \
                                      "image/bmp" \
                                      "image/svg+xml" \
                                      "image/vnd.microsoft.icon" \
                                      "image/x-icon" \
                                      "text/cache-manifest" \
                                      "text/css" \
                                      "text/html" \
                                      "text/javascript" \
                                      "text/plain" \
                                      "text/vcard" \
                                      "text/vnd.rim.location.xloc" \
                                      "text/vtt" \
                                      "text/x-component" \
                                      "text/x-cross-domain-policy" \
                                      "text/xml"
    #</IfModule>
</IfModule>
```

---

<img src="/joomla_performance/hans/giftofspeed-gzip-0.png">

---

<img src="/joomla_performance/hans/giftofspeed-gzip-1.png">

---
# Verwijder ETags
ETags = entity tags

Zijn uniek voor een specifieke server, dus niet handig voor clusterhosting

Toevoegen aan .htaccess
```text
<IfModule mod_headers.c>
    Header unset ETag
</IfModule>

FileETag None
```

---
# Expire Headers - 1
Vertel de browser dat files in cache opgeslagen moeten worden en hoe lang
 
```text
<IfModule mod_expires.c>

    ExpiresActive on
    ExpiresDefault "access plus 1 month"

</IfModule>    
```

--

Alle bestanden worden nu 1 maand in browsercache opgeslagen.

---
# Expire Headers - 2
Kunt ook per type instellen

```text
<IfModule mod_expires.c>

    ExpiresActive on
    ExpiresDefault "access plus 1 month"

  # CSS (1 year)
  # Data interchange (0 sec -> 1 hour)
  # Favicon (cannot be renamed!) and cursor images (1 week)
  # HTML (0 sec)
  # JavaScript (1 year)
  # Manifest files (0 sec and 1 week)
  # Media files (1 month)
  # Web fonts (1 month)
  # Other (1 month)

</IfModule>
```
https://github.com/h5bp/server-configs-apache/blob/master/dist/.htaccess#L836

---

<img src="/joomla_performance/hans/giftofspeed-cache-0.png">

---

<img src="/joomla_performance/hans/giftofspeed-cache-1.png">

---

# Handige links

- http://httpd.apache.org/docs/2.2/howto/htaccess.html
- https://github.com/h5bp/server-configs-apache
- https://www.giftofspeed.com/gzip-test/
- https://www.giftofspeed.com/cache-checker/

---
class: center, middle, intro
# Bedankt!

<img src="/images/logos.png">
