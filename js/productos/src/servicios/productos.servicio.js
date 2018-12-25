var Aplicacion = Aplicacion || {};
    Aplicacion.Servicios = Aplicacion.Servicios || {};

/**
 * Servicio de acceso a los productos. Integración de la API REST de
 * manipulación de productos.
 * 
 * Se utiliza la API de Fetch para realizar las peticiones AJAX a los
 * servicios de productos.
 */
Aplicacion.Servicios.ServicioProductos = (() => {
    
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
        paginador(pagina, elementos, nombre) {
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
         * 
         * @param   {string} nombre Este parámetro establece que el total de
         *                          productos se calcule para el número de productos
         *                          cuyo nombre sea parecido al que se pasa como
         *                          argumento, cuando se pasa una cadena vacía
         *                          entonces el cálculo se efectua sobre el total
         *                          de productos registrados en la base de datos.
         * @returns {Promise} Promesa con el total de productos. 
         */
        totalDeRegistros(nombre) {
            return fetch(`${API_URL}/totalderegistros?nombre=${nombre}`)
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
        },

        /**
         * Da de alta nuevos productos en la base de datos.
         * 
         * @param  {Boject}  producto Producto a registrar.
         * @return {Promise} Producto registrado en la base de datos.
         */
        alta(producto) {
            return fetch(
              `${API_URL}/alta`, {
                  method: 'POST',
                  body: JSON.stringify({productos: [producto]}),
                  headers: {'Content-Type': 'application/json'}
              })
            .then(res => res.json())
            .then(res => res.productos.pop())
        },

        /**
         * Modifica los datos de algún producto ya registrado.
         * 
         * @param  {Object}  producto Producto a actualizar.
         * @return {Promise} Promesa con los datos del producto
         *                   ya completamente modificado. 
         */
        actualizar(producto) {
            return fetch(
              `${API_URL}/actualizar`, {
                  method: 'PUT',
                  body: JSON.stringify({productos: [producto]}),
                  headers: {'Content-Type': 'application/json'}
              })
            .then(res => res.json())
            .then(res => res.productos.pop());
        },

        /**
         * Elimina un producto registrado en el sistema.
         * 
         * @param {number} identificador Identificador del producto que se eliminará.
         * @return {Promise} Promesa con los datos del producto eliminado
         */
        eliminar(identificador) {
            return fetch(
              `${API_URL}/eliminar?identificadores[]=${identificador}`, {
                  method: 'DELETE'
              })
            .then(res => res.json())
            .then(res => res.productos.pop());
        }
    }
})();
