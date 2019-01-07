var Aplicacion = Aplicacion || {};
    Aplicacion.InterfazDeUsuario = Aplicacion.InterfazDeUsuario || {}; 

Aplicacion.InterfazDeUsuario.Mensaje = ( function () {
    //Importar                  //Desde
    var { DibujarComponente } = Aplicacion.Nucleo.Componente;

    function _cargarComponente(pilaDeMensajes, texto, clase) {
        var mensaje = DibujarComponente(`
          <div class="mensaje ${clase}">
              <p>${texto}</p>
              <i>x</i>
          <div>`, pilaDeMensajes);

        return [mensaje, mensaje.querySelector('i')];
    }

    function _ciMostrarMensaje(mensaje) {
        setTimeout(()=>mensaje.classList.add('js-mostrar'), 50);
    }

    function _ciEliminarMensaje(pilaDeMensajes, mensaje) {
        mensaje.classList.remove('js-mostrar');
        setTimeout( () => 
          pilaDeMensajes.contains(mensaje)
          && pilaDeMensajes.removeChild(mensaje), 1000);
    }
    
    return function (pilaDeMensajes, contenido, tipo) {
        var [mensaje, eiBotonCerrar] = _cargarComponente(
            pilaDeMensajes, contenido, tipo
        );

        this.mostrar = duracion => {
            _ciMostrarMensaje(mensaje);
            
            eiBotonCerrar.onclick = () => 
              _ciEliminarMensaje(pilaDeMensajes, mensaje);
            
            setTimeout(() => 
              _ciEliminarMensaje(pilaDeMensajes, mensaje),
              duracion*1000);
        };
    }
})();