var Aplicacion = Aplicacion || {};

/**
 * Este módulo encapsula el funcionamiento del Componente de Búsqueda de
 * Productos.
 * 
 * @author Ricardo Bermúdez Bermúdez
 * @since  Dec 18th, 2018.
 */
( function () {
    //Importar                  //Desde ...
    var { ServicioProductos } = Aplicacion.Servicios;

    //Elementos de la interfaz de usuario para el buscador;
    var _eiEntrada,
        _eiSugerencias,
        _eiBotonBuscar;

    /**
     * Inicializa la semantica de los elementos del componente de búsqueda
     * de productos.
     */
    (function _cargarComponente () {
        var componente = '#componente-buscar-productos';

        //Carga referencias de los elementos de la interfaz.
        _eiEntrada     = document.querySelector(`${componente} input`);
        _eiSugerencias = document.querySelector(`${componente} ul`);
        _eiBotonBuscar = document.querySelector(`${componente} button`);

        //Carga de eventos de la interfaz.
        _eiBotonBuscar.onclick = _evtBuscarProductos;
        _eiEntrada.onkeyup = _evtObtenerSugerencias;
        _eiEntrada.onblur =  _evtLimpiarSugerencias;
    })();

    /**
     * Cambia los parametros de la sección hash(#) de la URL. Lo cual activa el
     * evento de recarga del paginador.
     */
    function _evtBuscarProductos(evento) {
        location.hash = `#pagina=1&nombre=${evento.target.value}`;
    }

    /**
     * Limpia la lista de productos sugeridos.
     */
    function _evtLimpiarSugerencias() {
        setTimeout(() => _eiSugerencias.innerHTML = '', 100);
    }

    /**
     * Ejecuta la acción de buscar mediante la API REST de productos los
     * productos cuyo nombre es parecido al que se introdujo como entrada
     * del usuario.
     */
    function _evtObtenerSugerencias (evento) {
        if (evento.key === "Enter") {
            _evtLimpiarSugerencias()
            _evtBuscarProductos();
            return;
        }

        ServicioProductos
        .obtenerPorNombre(_eiEntrada.value)
        .then(productos => _mostrarSugerencias(productos));
    }

    /**
     * Muestra al usuario de la aplicación sugerencias de productos a su
     * búsqueda de productos. 
     * 
     * @link  https://foundation.zurb.com/building-blocks/blocks/list-group.html
     * @param {Array<string>} nombres Lista de nombres de productos.
     */
    function _mostrarSugerencias(productos) {
        _eiSugerencias.innerHTML = productos
          .map( ({id_producto, nombre, extension_imagen}) => `
            <li
              onclick="location.href='editar#id=${id_producto}'"
              class="list-group-item">
              ${extension_imagen
               ?`<img class="imagen-redondeada"
                   src="/crm-b/img/subidas/p-${id_producto}.${extension_imagen}">`
               :''}
              ${nombre}
            </li>`)
          .join('');
    }
})();