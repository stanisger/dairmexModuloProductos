//Construcción del espacio de nombres del módulo.
var Aplicacion = Aplicacion || {};
    Aplicacion.InterfazDeUsuario = Aplicacion.InterfazDeUsuario || {}; 

Aplicacion.InterfazDeUsuario.Mensajes = ( function () {
    //Importar                //Desde ...
    var { DibujarComponente } = Aplicacion.Nucleo.Componente;
    var { Mensaje }           = Aplicacion.InterfazDeUsuario;

    /** Nodo DOM con el contenedor de la pila de mensajes. */
    var _contenedorPrincipal;

    (function cargarComponente() {
        _contenedorPrincipal = DibujarComponente(
            '<div id="componente-mensajes"></div>', document.body);
    })();
    
    function _ciNuevoMensaje(duracion, contenido, tipo) {
        new Mensaje(_contenedorPrincipal, contenido, tipo)
        .mostrar(duracion);
    }

    return {
      correcto: (...args) => _ciNuevoMensaje(...args, 'correcto'),
      error:    (...args) => _ciNuevoMensaje(...args, 'error'),
      alerta:   (...args) => _ciNuevoMensaje(...args, 'alerta'),
      accion:   (...args) => _ciNuevoMensaje(...args, 'accion'),
    }
})();