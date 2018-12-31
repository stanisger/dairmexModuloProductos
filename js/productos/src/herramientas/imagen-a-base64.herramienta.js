//Construcción del espacio de nombres de le aplicación y el módulo.
var Aplicacion = Aplicacion || {};
    Aplicacion.Herramientas = Aplicacion.Herramientas || {};

Aplicacion.Herramientas.ImagenABase64 = (function () {

    function Archivo(archivo, base64) {
        var [nombre, extension]   = archivo.name.split('.'),
            [tipoMIME, contenido] = base64.split(':')[1].split(',');

        this.nombre    = nombre;
        this.extension = extension;
        this.tipoMIME  = tipoMIME;
        this.contenido = contenido;
    };

    function cargarImagen(referenciaDeArchivo) {
        return new Promise( (rs, rj) => {
            var fRead = new FileReader();
            fRead.onload  = evt => rs(new Archivo(referenciaDeArchivo, evt.target.result));
            fRead.onerror = err => rj(err);
            fRead.readAsDataURL(referenciaDeArchivo);
        })
    }

    function formatoValido(referenciaDeArchivo) {
        return !!referenciaDeArchivo
          && !!referenciaDeArchivo.type.match(/^image/);
    }
    
    return {cargarImagen, formatoValido}
})();
