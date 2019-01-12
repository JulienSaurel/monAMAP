setfacl -R -m www-data:rwx ./images
pour pouvoir upload des fichiers
  quelques remarques :
  
     1. FPDF ne gère pas les accents => utilisation de utf8_decode()
     2. FPDF de gère pas le caractère € => chr(128)
