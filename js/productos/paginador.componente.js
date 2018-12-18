var Aplicacion = Aplicacion || {};

Aplicacion.ComponentePaginador = (() => {
    let { ServicioProductos } = Aplicacion;
    
    //Variables de control del paginador.
    const REGISTROS_POR_PAGINA = 5;
    let   TOTAL_DE_REGISTROS   = 0;

    let uiContenido;
    let uiTotalDeRegistros;
    let uiControlDePaginacion;
    
    function cargarComponente () {
        let componente = '#componente-paginador';

        //Carga referencias de los elementos de la interfaz.
        uiContenido           = document.querySelector(`${componente} tbody`);
        uiTotalDeRegistros    = document.querySelector(`${componente} h5`);
        uiControlDePaginacion = document.querySelector(`${componente} .pagination`);
        
        //Carga la primera página del paginador.
        totalDeElementos();
        cargarPagina(1, REGISTROS_POR_PAGINA);
        window.onhashchange = () => renderControlDePaginacion(
            location.hash.split('=')[1]
        );
    }
    
    function cargarPagina(...params) {
        ServicioProductos
        .paginador(...params)
        .then(productos => renderListaDeProductos(productos));
    }
    
    function totalDeElementos(nombre='') {
        ServicioProductos
        .totalDeRegistros(nombre)
        .then(totalDeElementos => TOTAL_DE_REGISTROS = totalDeElementos)
        .then(() => renderControlDePaginacion(1));
    }
    
    function renderControlDePaginacion(pagina) {
        uiTotalDeRegistros.innerHTML  = `Total de productos: ${TOTAL_DE_REGISTROS}`;

        let noDePáginas = Math.floor(
          TOTAL_DE_REGISTROS/REGISTROS_POR_PAGINA
        );
        
        uiControlDePaginacion.innerHTML = `
          <li class="arrow">
            <a href="#pagina=${pagina - 1}">&laquo;</a>
          </li>`;
        
        for(let i=1;i<=noDePáginas; i++) {
            uiControlDePaginacion.innerHTML += i==pagina
              ?`<li class="current"><a href="#pagina=${i}">${i}</a></li>`
              :`<li><a href="#pagina=${i}">${i}</a></li>`;
        }

        uiControlDePaginacion.innerHTML += `
          <li class="arrow">
            <a href="#pagina=${pagina + 1}">&raquo;</a>
          </li>`;
        

        uiControlDePaginacion.innerHTML = '<li class="arrow unavailable"><a>&laquo;</a></li>';
    }
    
    function renderListaDeProductos(productos) {
        uiContenido.innerHTML = '';
        productos.forEach(
          producto => uiContenido.innerHTML += `
            <tr>
              <td>${producto.nombre}</td>
              <td>${producto.cantidad} PZ</td>
              <td>${producto.categoria}</td>
              <td><button href="about.html" class="button">Editar</button></td>
            </tr>`);
    }
    
    return {cargarComponente};
})();