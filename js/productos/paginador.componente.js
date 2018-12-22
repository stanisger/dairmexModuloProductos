var Aplicacion = Aplicacion || {};

Aplicacion.ComponentePaginador = (() => {
    //Módulos importados.
    let { ServicioProductos, Utilidades } = Aplicacion;

    //Variables de control del paginador.
    const REGISTROS_POR_PAGINA     = 5;

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
        let { pagina = 1, nombre = '' } = Utilidades.parametrosEnHash();
        return { pagina: parseInt(pagina), nombre };
    }

    /**
     * Recarga el componente de acuerdo a los parámetros de la sección hash.
     */
    function escuchaCambioDeParametros() {
        window.onhashchange = () => cargaPaginador( cargaParametros() );
    }

    function cargaPaginador( {pagina, nombre} ) {
        //Recarga el total de productos y el contrrol de paginación
        ServicioProductos
        .totalDeRegistros(nombre)
        .then(totalDeElementos => 
             renderEncabezado(totalDeElementos)
          || renderControlDePaginacion(totalDeElementos, pagina, nombre));

        //Obtiene productos desde el servicio de paginación
        ServicioProductos
        .paginador(pagina, REGISTROS_POR_PAGINA, nombre)
        .then(productos => renderListaDeProductos(productos));
    }
    
    function renderEncabezado(totalDeElementos) {
        if (totalDeElementos) {
          uiTotalDeRegistros.innerHTML = `Total de productos: ${totalDeElementos}`;
        } else {
          uiControlDePaginacion.innerHTML = ``;
          uiTotalDeRegistros.innerHTML =`Sin productos registrados`;
        }
    }
    
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
                  <i class="  icon  fi-pencil colorBlueDark"></i>
                  Editar
                </a>
              </td>
            </tr>`)
        .join('');
    }

    function renderControlDePaginacion(totalDeElementos, pagina, nombre) {
        let noDePáginas = Math.ceil(
          totalDeElementos/REGISTROS_POR_PAGINA
        );

        uiControlDePaginacion.innerHTML = `
          <li class="arrow">
            <a ${pagina > 1
               ?`href="#pagina=${pagina - 1}&nombre=${nombre}"`
               :`class="unavailable"`}>
               &laquo; </a>
          </li>
          ${Utilidades
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
})();