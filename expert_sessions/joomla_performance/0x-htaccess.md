class: middle
# Optimalisatie met .htaccess
## door Hans Kuijpers
### <a href="http://twitter.com/hans2103">@hans2103</a>

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

server request /www/perfectsite/test/index.html

test voor .htaccess in de root van de site en alle subdirectories

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

## Alleen voor hen die bij serverconfiguratie kunnen

--

## En die heb ik vaak niet

---
# Dus toch .htaccess

- want... Vertraging is haast niet merkbaar
- en... alleen van toepassing op de site waarin ik bezig ben
- en... wijziging direct van toepassing

---
# Hoe in Joomla!

- Log in met sFTP en wijzig de standaard Joomla! htaccess.txt naar .htaccess

```bash
$ mv htaccess.txt .htaccess
```

- Toevoegen Gzip compressie
- Toevoegen Expire Headers

---
class: code-14
# Toevoegen Gzip compressie - 1
korte lijst

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
# Verwijder ETags
ETags = entity tags
Zijn uniek voor een specifieke server, dus niet handig voor clusthosting

```text
<IfModule mod_headers.c>
    Header unset ETag
</IfModule>

FileETag None
```

---
# Expire Headers - 1
Verteld de browser dat files in cache opgeslagen moeten worden en hoe lang
 
```text
<IfModule mod_expires.c>

    ExpiresActive on
    ExpiresDefault "access plus 1 month"

</IfModule>    
```

---
# Expire Headers - 2
uitgewerkte lijst: https://github.com/h5bp/server-configs-apache/blob/master/dist/.htaccess#L836
```text
<IfModule mod_expires.c>

    ExpiresActive on
    ExpiresDefault "access plus 1 month"

  # CSS
  # Data interchange
  # Favicon (cannot be renamed!) and cursor images
  # HTML
  # JavaScript
  # Manifest files
  # Media files
  # Web fonts
  # Other

</IfModule>
```

---
# Bron van dit alles
Opgezet door de mensen achter H5BP

https://github.com/h5bp/server-configs-apache


---

thx
