var Aplicacion = Aplicacion || {};

/**
 * Este módulo encapsula el funcionamiento del Componente de Paginación de Productos.
 * 
 * Este componente requiere que se le comuniquen dos variables desde el Componente de
 * Búsqueda de Productos: pagina y nombre. Para lograr estacomunicación de variables
 * se cambia el estado de la sección hash de la URL con los datos de estas variables.
 * 
 * @author Ricardo Bermúdez Bermúdez
 * @since  !8 de Diciembre del 2018.
 */
( componente => componente().cargarComponente() ) ( function () {

    //Módulos importados.
    let { ServicioProductos } = Aplicacion.Servicios;
    let { HerramientaPaginador, HerramientaHash } = Aplicacion.Herramientas;

    //Referencia de componentes en HTML.
    let uiContenido,
        uiTotalDeRegistros,
        uiControlDePaginacion;

    /**
     * Inicializa la funcionalidad del componente de paginación.
     */
    function cargarComponente () {
        let componente = '#componente-paginador';

        //Carga referencias de los elementos de la interfaz.
        uiContenido           = document.querySelector(`${componente} tbody`);
        uiTotalDeRegistros    = document.querySelector(`${componente} h5`);
        uiControlDePaginacion = document.querySelector(`${componente} .pagination`);
        
        //Carga la primera página del paginador.
        cargaPaginador( cargaParametros() );
        escuchaCambioDeParametros();
    }

    /**
     * Carga los parametros pasados a través de la sección hash de la URL que
     * necesita el componente.
     */
    function cargaParametros() {
        let { pagina = 1, nombre = '', registrosPorPagina = 5 } = HerramientaHash.parametrosEnHash();
        
        return {
            pagina: parseInt(pagina),
            nombre,
            registrosPorPagina: parseInt(registrosPorPagina)
        };
    }

    /**
     * Recarga el componente de acuerdo a los parámetros de la sección hash.
     */
    function escuchaCambioDeParametros() {
        window.onhashchange = () => cargaPaginador( cargaParametros() );
    }

    /**
     * Carga o recarga en caso de cambios(de página o parámetros de búsqueda) los
     * registros a mostrar en el paginador. Recibe parámetros por destructuring.
     * 
     * @param {number} Pagina No. de página del paginador.
     * @param {string} nombre Referencia de nombre de productos buscados.
     */
    function cargaPaginador( {pagina, nombre, registrosPorPagina} ) {
        //Recarga el total de productos y el control de paginación
        ServicioProductos
        .totalDeRegistros(nombre)
        .then(totalDeElementos => 
             renderEncabezado(totalDeElementos)
          || renderControlDePaginacion(totalDeElementos, pagina, registrosPorPagina, nombre));

        //Obtiene productos desde el servicio de paginación
        ServicioProductos
        .paginador(pagina, registrosPorPagina, nombre)
        .then(productos => renderListaDeProductos(productos));
    }
    
    /**
     * Muestra en la interfaz de usuario el total de registros del paginador.
     * 
     * @param {number|string} totalDeElementos Numero total de elementos del paginador.
     */
    function renderEncabezado(totalDeElementos) {
        if (totalDeElementos) {
          uiTotalDeRegistros.innerHTML = `Total de productos: ${totalDeElementos}`;
        } else {
          uiControlDePaginacion.innerHTML = ``;
          uiTotalDeRegistros.innerHTML =`Sin productos registrados`;
        }
    }

    /**
     * Muestra en la interfaz de usuario los registros del paginador.
     * 
     * @param {Array} productos Registros a mostrar en determinada página del paginador.
     */
    function renderListaDeProductos(productos) {
        uiContenido.innerHTML = productos
        .map(
          ({nombre, cantidad, categoria, id_producto}) => `
            <tr>
              <td>${nombre}</td>
              <td>${cantidad} PZ</td>
              <td>${categoria}</td>
              <td>
                <a
                  onclick="location.href='editar#id=${id_producto}'"
                  >
                  <i class="icon fi-pencil colorBlueDark"></i>
                  Editar
                </a>
              </td>
            </tr>`)
        .join('');
    }

    /**
     * Muestra en la interfaz de usuario los indices de paginación.
     * 
     * @param {number} totalDeElementos   No. total de elementos del paginador.
     * @param {number} pagina             Pagina actual del paginador.
     * @param {number} registrosPorPagina No. de registros por página.
     * @param {string} nombre             Referencia de la búsqueda por nombre de los productos.
     */
    function renderControlDePaginacion(totalDeElementos, pagina, registrosPorPagina, nombre) {
        let noDePáginas = Math.ceil(
          totalDeElementos/registrosPorPagina
        );

        uiControlDePaginacion.innerHTML = `
          <li class="arrow">
            <a ${pagina > 1
               ?`href="#pagina=${pagina - 1}&nombre=${nombre}"`
               :`class="unavailable"`}>
               &laquo; </a>
          </li>
          ${HerramientaPaginador
            .generadorDeIndices(noDePáginas, 5, pagina)
            .map(
              indice => indice==pagina
              ?`<li class="current bgBlueStrong"> <a style="color: white">${indice}</a> </li>`
              :`<li> <a href="#pagina=${indice}&nombre=${nombre}">${indice}</a> </li>`)
            .join('')}
          <li class="arrow">
            <a ${pagina < noDePáginas
               ?`href="#pagina=${pagina + 1}&nombre=${nombre}"`
               :'class="unavailable"'}>
               &raquo; </a>
          </li>`;
    }

    return {cargarComponente};
});