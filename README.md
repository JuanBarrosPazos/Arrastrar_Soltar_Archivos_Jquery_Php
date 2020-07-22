# Arrastrar_Soltar_Archivos_Jquery_Php
Arrastrar Soltar Archivos Jquery Php Dropzone

----

## En el directorio Otras_Versiones encontraremos:

1 Arrastrar Soltar Archivos Jquery Php 04 Ok Validate.zip 2020.05.12
- Esta versión sólo valida del lado cliente:

2 Arrastrar Soltar Archivos Jquery Php 05 Ok Validate Reduccion Img.zip 2020.05.12
- Esta versión valida del lado cliente y servidor. Además redimensiona las imágenes en el servidor, si superan un limite de alto o ancho.

3 Dos nuevas versiones con validación del lado cliente del ancho y alto de la imágen:
- Dropzone Validate Client Full 01.zip 2020.05.14
- Dropzone Validate Client Server Full 01 Auto Reduction Img.zip 2020.05.14 (versión github)

----

* Partiendo de la configuración inicial en js/dropzone.js:
<br>
accept:
 function(file, done) {
            return done();
          },
init: function() {
            return noop;
          },
<br>
* He integrado alguna validación muy fácil de modificar y que nos retorna los errores en pantalla sin problema.
También tememos una pequeña validación en file_upload.php para el file type:
<br>
     accept: function(file, done) {
      ext_img = new Array(".jpg", ".png", "jpeg");
      var namei = file.name;
      var exti = (namei.substring(namei.lastIndexOf("."))).toLowerCase();
      ext_doc = new Array(".pdf", ".doc", "docx");
      var named = file.name;
      var extd = (named.substring(named.lastIndexOf("."))).toLowerCase();
      ext_vid = new Array(".mkv", ".mp4", "avi");
      var namev = file.name;
      var extv = (namev.substring(namev.lastIndexOf("."))).toLowerCase();
      var sizemb = Number(file.size / 1024000).toFixed(2);
      if (ext_img.includes(exti)) {
          // ERROR SI LA IMG > DE 1 MEGA
          if (file.size > (1000 * 1024)){
                  return done ('IMAGEN: '+file.name+' SIZE: '+sizemb+' > 1MB');
            }else{
              /*  VALIDO EL ANCHO Y ALTO DE LA IMAGEN 
                  REALIZO UNA AUTO REDUCCION EN file_upload.php
                  PARA ALTO ANCHO MAX 900
                  AQUI LIMITO EL ANCHO ALTO A > 3000 px
              */
              var reader = new FileReader();
              reader.onload = (function (file) {
                  var image = new Image();
                  image.src = file.target.result;
                  image.onload = function () {
                      var ancho = this.width;
                      var alto = this.height;
                      if (ancho > 3000) { return done("Ancho "+ancho+" > 3000 px"); } 
                      else if (alto > 3000) { return done("Alto "+alto+" > 3000 px"); }
                      else {return done();}
                  };
              });
              reader.readAsDataURL(file);
              // FIN VALIDO EL ANCHO Y ALTO DE LA IMAGEN
              /* SI VALIDO SOLAMENTE EL SIZE, Y NO EL ANCHO Y ALTO.
                 RETURN OK Y UPLOAD IMAGE
                return done(); 
              */
            } // FIN CONDICIONAL SE VALIDA EL SIZE
            } // FIN SI ES IMAGEN
      else if (ext_doc.includes(extd)) {
          // ERROR SI EL DOCUMENTO > DE 2 MEGA
          if (file.size > (2000 * 1024)){
                  return done ('DOC: '+file.name+' SIZE: '+sizemb+' > 2MB');
                      }else{ return done(); }
            } // FIN SI ES DOC
      else if (ext_vid.includes(extv)) {
          // ERROR SI EL VIDEO > DE 50 MEGA
          if (file.size > (60000 * 1024)){
                  return done ('VIDEO: '+file.name+' SIZE: '+sizemb+' > 60MB');
                      }else{ return done(); }
            } // FIN SI ES DOC
      else {
              return done ('TIPO DE ARCHIVO NO PERMITIDO '+file.name);
            }
    }, // FIN accept: function(....
    init: function() {
      return noop;
    },
<br>
Espero que os sea útil.
