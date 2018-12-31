//Construcción del espacio de nombres del módulo.
var Aplicacion = Aplicacion || {};
    Aplicacion.InterfazDeUsuario = Aplicacion.InterfazDeUsuario || {}; 

Aplicacion.InterfazDeUsuario.Mensajes = ( function () {
    var contenedorDeMensajes;

    function cargarComponente() {
        contenedorDeMensajes = document.createElement('div');
        contenedorDeMensajes.id = 'componente-mensajes';
        document.body.appendChild(contenedorDeMensajes);
    }
    
    cargarComponente();

    function renderMensaje(duracion, texto, clase) {
        /** Se crean elementos HTML. */
        var alerta  = document.createElement('div'),
            mensaje = document.createElement('p'),
            cerrar  = document.createElement('i');
        
        /** Se cargan clases CSS. */
        alerta.classList.add('mensaje', clase);
        
        /** Se carga contenido de los nodos. */
        cerrar.innerHTML  = 'x';
        mensaje.innerHTML = texto;
        
        /** se carga árbol nodos. */
        alerta.appendChild(mensaje);
        alerta.appendChild(cerrar);
        contenedorDeMensajes.appendChild(alerta);

        /** Acciones para mostrar animación de los mensajes. */
        // Retardo para dar tiempo al navegador que termine los calculos para
        // cargar nodo. 
        setTimeout(() => alerta.classList.add('js-mostrar'), 500);

        //Eventos para cerrar automáticamente o por orden del usuario el
        //mensaje
        var remover = true;

        cerrar.addEventListener('click', () => {
            remover = false;
            alerta.classList.remove('js-mostrar');
            setTimeout(()=>contenedorDeMensajes.removeChild(alerta), 1000);
        })
         
        setTimeout(() => {
            if (remover) {
              alerta.classList.remove('js-mostrar');
              setTimeout(()=>contenedorDeMensajes.removeChild(alerta), 1000);
            }
        }, duracion*1000);
    }

    return {
      correcto: (...args) => renderMensaje(...args, 'correcto'),
      error:    (...args) => renderMensaje(...args, 'error'),
      alerta:   (...args) => renderMensaje(...args, 'alerta'),
      accion:   (...args) => renderMensaje(...args, 'accion'),
    }
})();