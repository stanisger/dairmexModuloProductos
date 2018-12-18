var Aplicacion = Aplicacion || {};

/**
 * Servicio de acceso a los productos. Integración de la API REST de
 * manipulación de productos.
 * 
 * Se utiliza la API de Fetch para realizar las peticiones AJAX a los
 * servicios de productos.
 */
Aplicacion.ServicioProductos = (() => {
    
    const API_URL = `${location.origin}/productosapi`;
    
    return {
        /**
         * Obtiene los elementos de la página requerida.
         *  
         * @param  {number}  pagina    No. de página. 
         * @param  {number}  elementos No. de elementos por página.
         * @param  {string}  nombre    Filtro por nombre.
         * @return {Promise} Productos obtenidos. 
         */
        paginador(pagina, elementos, nombre='') {
            return fetch(
              `${API_URL}/paginador`
              +`?pagina=${pagina}`
              +`&elementos=${elementos}`
              +`&nombre=${nombre}`)
            .then(res => res.json())
            .then(res => res.productos);
        },
        

        /**
         * Establece el total de elementos a páginar. 
         */
        totalDeRegistros() {
            return fetch(`${API_URL}/totalderegistros`)
            .then(res => res.json())
            .then(res => res.total)
        },

        /**
         * Obtiene las referencias a productos cuyo nombre sea parecido a
         * la cadena de texto pasada como argumento de la función.
         * 
         * @param  {string}  nombre Patrón de nombre a buscar.
         * @return {Promise} Productos con nombres parecidos. 
         */
        obtenerPorNombre(nombre) {
            return fetch(
              `${API_URL}/obtenerpornombre?nombre=${nombre}`)
            .then(res => res.json())
            .then(res => res.productos);
        }
    }
})();
