var Aplicacion = Aplicacion || {};

/**
 * Este módulo representa el almacenamiento principal de la aplicación.
 * Además de poder listar las acciones de escucha sobre cambios en el
 * almacenamiento principal.
 * 
 * @author Ricardo Bermúdez Bermúdez
 * @since  Dec 18th, 2018.
 */
Aplicacion.Almacenamiento = (() => {

    let accionesDeEscucha = {}, almacenamiento = {};

    /**
     * Regresa un valor específico asociado con una llave.
     * 
     * @param  {string} llave Valor a buscar.
     * @return {any}    Valor encontrado
     */
    function obtener(llave) {
        return almacenamiento[llave];
    }

    /**
     * Registra un nuevo valor en el almacenamiento principal asociandolo
     * a una llave e inicia la pila de funciones de escucha de cambios
     * de valor sobre de la llave
     * 
     * @param  {string} llave Llave de acceso al valor especificado.
     * @param  {any}    valor Valor asociado a la llave
     * @return {void}
     */
    function establecer(llave, valor) {
        almacenamiento[llave] = valor;

        if (!accionesDeEscucha[llave]) {
            accionesDeEscucha[llave] = [];
        }

        accionesDeEscucha[llave].forEach(
            funcion => funcion(valor)
        );
    }

    /**
     * Agrega una función a la pila de acciones a ejecutar cuando cambie el valor
     * asociado a la llave especificada.
     * 
     * @param  {string}   llave   Llave de acceso al valor especificado.
     * @param  {Function} funcion Función a ejecutar cuando cambie el valor de la
     *                            llave especificada.
     * @return {void}
     */
    function escucharCambios(llave, funcion) {
        if (!accionesDeEscucha[llave]) {
            accionesDeEscucha[llave] = [];
        }

        accionesDeEscucha[llave].push(funcion);
    }

    return { obtener, establecer, escucharCambios };
})();
