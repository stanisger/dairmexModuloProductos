var Aplicacion = Aplicacion || {};

/**
 * Este módulo encapsula el funcionamiento del Componente de Búsqueda de
 * Productos.
 * 
 * @author Ricardo Bermúdez Bermúdez
 * @since  Dec 18th, 2018.
 */
Aplicacion.ComponenteBuscarProductos = (() => {

    let { ServicioProductos } = Aplicacion;
    let entrada;
    let sugerencias;

    /**
     * Inicializa la semantica de los elementos del componente de búsqueda
     * de productos.
     */
    function cargarComponente () {
        let componente = '#componente-buscar-productos';

        //Carga referencias de los elementos de la interfaz.
        entrada     = document.querySelector(`${componente} > input`);
        sugerencias = document.querySelector(`${componente} >ul`);
         
        //Carga de eventos de la interfaz.
        entrada.addEventListener('keyup', buscarProductos);
    }

    /**
     * Ejecuta la acción de buscar mediante la API REST de productos los
     * productos cuyo nombre es parecido al que se introdujo como entrada
     * del usuario.
     */
    function buscarProductos () {
        ServicioProductos
        .obtenerPorNombre(entrada.value)
        .then(productos => productos.map(producto => producto.nombre))
        .then(nombres   => renderSugerencias(nombres));
    }

    /**
     * Muestra al usuario de la aplicación sugerencias de productos a su
     * búsqueda de productos. 
     * 
     * @link  https://foundation.zurb.com/building-blocks/blocks/list-group.html
     * @param {Array<string>} nombres Lista de nombres de productos.
     */
    function renderSugerencias(nombres) {
        sugerencias.innerHTML = '';
        nombres.forEach(
          nombre => sugerencias.innerHTML += `
             <li class="list-group-item">${nombre}</li>`);
    }

    return {cargarComponente}
})();