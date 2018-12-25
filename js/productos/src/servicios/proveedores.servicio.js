var Aplicacion = Aplicacion || {};
    Aplicacion.Servicios = Aplicacion.Servicios || {};

/**
 * Servicio de acceso a los proveedores. Integración de la API REST de
 * obtención de datos de los proveedores.
 * 
 * @author Ricardo Bermúdez Bermúdez
 * @since  22 de diciembre del 2018.
 */
Aplicacion.Servicios.ServicioProveedores = (() => {

    const API_URL = `${location.origin}/proveedoresapi`;

    return {
        /**
         * Hace una consulta al sistema de los proveedores cuyo nombre es 
         * parecido al que se pasa como argumento de este método.
         * 
         * @param {string} nombre 
         */
        obtenerPorNombre(nombre) {
            return fetch(
                `${API_URL}/obtenerpornombre`
               +`?nombre=${nombre}`
            )
            .then(res => res.json())
            .then(res => res.proveedores);
        },
    }
})();