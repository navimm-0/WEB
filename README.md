:movie_camera: VIDEO TUTORIAL
:link: ¡VER ANTES DE INICIAR!:
    https://youtu.be/F4KcMFW8g7I?si=GQR5Xg4tJTRt7iBF


:wrench: CONFIGURACIÓN INICIAL (solo una vez por usuario)
  Antes de hacer cualquier operación en Git, configura tu identidad:


    git config --global user.name "Tu Nombre"

    git config --global user.email "tucorreo@example.com"

:white_check_mark: Esto garantiza que los commits aparezcan con tu nombre.

:inbox_tray: CLONAR EL REPOSITORIO (una vez por máquina)


    git clone https://github.com/navimm-0/WEB.git
    cd PFEPI

 Esto crea una copia local del repositorio para trabajar desde tu equipo.

:file_folder: ESTRUCTURA OFICIAL DEL PROYECTO

    PFEPI/
      ├── index.html         ← Archivo principal del sitio web

      ├── CSS/               ← Archivos de estilos (style.css, etc.)

      ├── HTML/              ← Páginas HTML adicionales

      ├── SCRIPT/            ← Archivos JavaScript (funcionalidad)
  
      └── IMG/               ← Imágenes y recursos gráficos

Crear esta estructura:

    touch index.html

    mkdir CSS HTML SCRIPT IMG

Si alguna carpeta está vacía y deseas que Git la incluya:


        New-Item -Path .\CSS\.gitkeep -ItemType File
        New-Item -Path .\HTML\.gitkeep -ItemType File
        New-Item -Path .\SCRIPT\.gitkeep -ItemType File
        New-Item -Path .\IMG\.gitkeep -ItemType File


Git no guarda carpetas vacías a menos que tengan al menos un archivo (como .gitkeep).

:writing_hand: AGREGAR O MODIFICAR ARCHIVOS

:small_blue_diamond: Editar un archivo

Abre con tu editor preferido (VS Code, Notepad, nano, etc.):

    code index.html

Haz los cambios necesarios y guarda.

:outbox_tray: SUBIR ARCHIVOS NUEVOS O EDITADOS

  Verifica qué cambió:

    git status

Agrega todos los cambios:

    git add .

Guarda los cambios con un mensaje:

    git commit -m "Agrega nueva funcionalidad en SCRIPT/ y estilos en CSS/"

 Sube los cambios al repositorio remoto:

    git push origin main

:white_check_mark: ¡Listo! Tus cambios ahora están en GitHub.

:arrows_counterclockwise: ACTUALIZAR TU COPIA LOCAL

  Antes de comenzar a trabajar cada día, sincroniza tu repositorio local con los cambios que otros hayan hecho:

    git pull origin main

:x: ELIMINAR ARCHIVOS O CARPETAS

  Eliminar archivo:

    git rm HTML/ayuda.html

    git commit -m "Elimina archivo ayuda.html"

    git push origin main
    
  Eliminar carpeta completa:

    git rm -r IMG/

    git commit -m "Elimina carpeta de imágenes"

    git push origin main

:arrows_clockwise: CAMBIAR NOMBRE DE RAMA Y ENLAZAR A GITHUB (solo si usaste git init)

    git branch -M main
  
    git remote add origin https://github.com/navimm-0/PFEPI.git

    git push -u origin main

:test_tube: COMANDOS ÚTILES Y DE APOYO

  Ver qué archivos han cambiado:

    git status

  Ver historial de commits:


    git log

  Ver las ramas actuales:

    git branch

    Cambiar de rama:

    git checkout nombre-rama

:soap: BUENAS PRÁCTICAS DE TRABAJO EN EQUIPO

:arrows_counterclockwise: Haz "git pull" antes de comenzar a trabajar.

 :white_check_mark: Haz "git status" y git add con frecuencia.

:speech_balloon: Usa mensajes de commit claros y específicos.

:books: Cada carpeta tiene un propósito:

CSS/: estilos (style.css, responsive.css)

HTML/: páginas como contacto.html, nosotros.html

SCRIPT/: funcionalidad con main.js, validaciones.js

 IMG/: logos, íconos, banners

:dividers: EJEMPLO DE CICLO COMPLETO

  Iniciar sesión, clonar repositorio:

    git clone https://github.com/navimm-0/PFEPI.git

    cd PFEPI

  Crear archivo nuevo:

      New-Item -Path HTML/fracciones.html -ItemType File

  Subir el archivo:


    git add HTML/fracciones.html

    git commit -m "Agrega contacto.html a la sección HTML"

    git push origin main
