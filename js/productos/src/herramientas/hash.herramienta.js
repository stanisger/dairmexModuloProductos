//Construcción del espacio de nombres de le aplicación y el módulo.
var Aplicacion = Aplicacion || {};
    Aplicacion.Herramientas = Aplicacion.Herramientas || {};

/**
 * Metodos de proposito general para manejar parámetros en hash.
 * 
 * @author Ricardo Bermúdez Bermúdez.
 * @since  22 de diciembre del 2018.
 */
Aplicacion.Herramientas.HerramientaHash = {
    /**
     * Obtiene los parámetros de la URL pasando la sección de hash (#).
     * 
     * @return {Object} Parametros de hash en forma de objeto. 
     */
    parametrosEnHash() {
        try {
          return location.hash
          .split('#')[1]
          .split('&')
          .reduce( (acc, param) => {
            let [llave, valor] = param.split('=');
            acc[llave] = valor;
            return acc;
          }, {});
        } catch (e) {
            return {};
        }
    },
};