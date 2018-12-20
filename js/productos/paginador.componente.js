var Aplicacion = Aplicacion || {};

Aplicacion.ComponentePaginador = (() => {
    //Módulos importados.
    let { ServicioProductos, Utilidades } = Aplicacion;
    
    //Variables de control del paginador.
    const REGISTROS_POR_PAGINA     = 5;
    let   TOTAL_DE_REGISTROS       = 0;
    
    //Referencia de componentes en HTML.
    let uiComponentePrincipal,
        uiContenido,
        uiTotalDeRegistros,
        uiControlDePaginacion;
    
    /**
     * Inicializa la funcionalidad del componente de paginación.
     */
    function cargarComponente () {
        let componente = '#componente-paginador',
            pagina =  (location.hash
                      .match(/#pagina=\d+/ig)
                      && parseInt(location.hash.split('=')[1])) || 1;

        //Carga referencias de los elementos de la interfaz.
        uiComponentePrincipal = document.querySelector(`${componente}`);
        uiContenido           = document.querySelector(`${componente} tbody`);
        uiTotalDeRegistros    = document.querySelector(`${componente} h5`);
        uiControlDePaginacion = document.querySelector(`${componente} .pagination`);
        
        //Carga la primera página del paginador.
        escuchaCambioDePagina();
        cargaPaginador(pagina);
    }

    /**
     * Agrega acción de escucha de cambios de página sobre el cambio de hash.
     */
    function escuchaCambioDePagina() {
        window.onhashchange = () =>
            location.hash.match(/#pagina=\d+/ig) 
            && cargaPaginador(
              parseInt(location.hash.split('=')[1]
            )
        );
    }
    
    function cargaPaginador(pagina=1, nombre='') {
        //Recarga el total de productos y el contrrol de paginación
        ServicioProductos
        .totalDeRegistros(nombre)
        .then(totalDeElementos => TOTAL_DE_REGISTROS=totalDeElementos)
        .then(() => 
             renderEncabezado()
          || renderControlDePaginacion(pagina));

        //Obtiene productos desde el servicio de paginación
        ServicioProductos
        .paginador(pagina, REGISTROS_POR_PAGINA)
        .then(productos => renderListaDeProductos(productos));
    }
    
    function renderEncabezado() {
        if (TOTAL_DE_REGISTROS) {
          uiTotalDeRegistros.innerHTML = `Total de productos: ${TOTAL_DE_REGISTROS}`;
        } else {
          uiComponentePrincipal.innerHTML =`<h5>Sin productos registrados</h5>`
          throw Error('Sin productos registrados');
        }
    }
    
    function renderListaDeProductos(productos) {
        uiContenido.innerHTML = productos
        .map(
          producto => `
            <tr>
              <td>${producto.nombre}</td>
              <td>${producto.cantidad} PZ</td>
              <td>${producto.categoria}</td>
              <td>
                <button
                  onclick="location.href='productoalta#id=${producto.id_producto}'"
                  class="button">
                  Editar
                </button>
              </td>
            </tr>`)
        .join('');
    }

    function renderControlDePaginacion(pagina) {

        let noDePáginas = Math.ceil(
          TOTAL_DE_REGISTROS/REGISTROS_POR_PAGINA
        );

        uiControlDePaginacion.innerHTML = `
          <li class="arrow">
            <a ${pagina > 1
               ?`href="#pagina=${pagina - 1}"`
               :`class="unavailable"`}>
               &laquo; </a>
          </li>
            ${Utilidades
              .generadorDeIndices(noDePáginas, 5, pagina)
              .map(
                indice => indice==pagina
                ?`<li class="current"> <a>${indice}</a> </li>`
                :`<li> <a href="#pagina=${indice}">${indice}</a> </li>`)
              .join('')}
          <li class="arrow">
            <a ${pagina < noDePáginas
               ?`href="#pagina=${pagina + 1}"`
               :'class="unavailable"'}>
               &raquo; </a>
          </li>`;
    }

    return {cargarComponente};
})();