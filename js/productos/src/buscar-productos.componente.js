var Aplicacion = Aplicacion || {};

/**
 * Este módulo encapsula el funcionamiento del Componente de Búsqueda de
 * Productos.
 * 
 * @author Ricardo Bermúdez Bermúdez
 * @since  Dec 18th, 2018.
 */
( componente => componente().cargarComponente() ) ( function () {

    let { ServicioProductos } = Aplicacion.Servicios;
    let uiEntrada;
    let uiSugerencias;

    /**
     * Inicializa la semantica de los elementos del componente de búsqueda
     * de productos.
     */
    function cargarComponente () {
        let componente = '#componente-buscar-productos';

        //Carga referencias de los elementos de la interfaz.
        uiEntrada     = document.querySelector(`${componente} input`);
        uiSugerencias = document.querySelector(`${componente} ul`);
        uiBotonBuscar = document.querySelector(`${componente} button`);

        //Carga de eventos de la interfaz.
        uiBotonBuscar.addEventListener('click', buscarProductos);
        uiEntrada.addEventListener('keyup', obtenerSugerencias);
        uiEntrada.addEventListener('blur',  () => setTimeout(
            () => uiSugerencias.innerHTML = '', 100
          )
        );
    }

    /**
     * Cambia los parametros de la sección hash(#) de la URL. Lo cual activa el
     * evento de recarga del paginador.
     */
    function buscarProductos() {
        location.hash = `#pagina=1&nombre=${uiEntrada.value}`;
    }

    /**
     * Ejecuta la acción de buscar mediante la API REST de productos los
     * productos cuyo nombre es parecido al que se introdujo como entrada
     * del usuario.
     */
    function obtenerSugerencias (evento) {
        if (evento.key === "Enter") {
            renderSugerencias([]);
            buscarProductos();
            return;
        }
        ServicioProductos
        .obtenerPorNombre(uiEntrada.value)
        .then(productos => renderSugerencias(productos));
    }

    /**
     * Muestra al usuario de la aplicación sugerencias de productos a su
     * búsqueda de productos. 
     * 
     * @link  https://foundation.zurb.com/building-blocks/blocks/list-group.html
     * @param {Array<string>} nombres Lista de nombres de productos.
     */
    function renderSugerencias(productos) {
        console.log(productos)
        uiSugerencias.innerHTML = productos
          .map( ({id_producto, nombre, extension_imagen}) => `
            <li
              onclick="location.href='editar#id=${id_producto}'"
              class="list-group-item">
              ${extension_imagen
               ?`<img class="imagen-redondeada"
                   src="/img/subidas/p-${id_producto}.${extension_imagen}">`
               :''}
              ${nombre}
            </li>`)
          .join('');
    }

    return {cargarComponente}
});