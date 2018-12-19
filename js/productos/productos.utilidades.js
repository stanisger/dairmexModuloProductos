var Aplicacion = Aplicacion || {};

/**
 * Objeto con un conjunto de métodos que se ocupan indefinidamente a lo largo
 * del módulo de productos.
 * 
 * @author Ricardo Bermúdez Bermúdez
 * @since  19 de diciembre del 2018.
 */
Aplicacion.Utilidades = {

    /**
     * Genera un vector con un conjunto de valores ordenados ascendentemente,
     * donde cada valor se encuentra en el intervalo [inicio, fin]. Siendo
     * inicio y fin argumentos de esta funcion.
     *  
     * @param  {number} inicio Referencia inicial para el ciclo de generación
     *                         de enteros.
     * @param  {number} fin    Referencia para finalizar el ciclo.
     * @return {Array} Vector con los números generados  
     */
    generarEnteros(inicio, fin) {
      var vector = [];
      for (i=inicio; i<=fin; vector.push(i), i++);
      return vector;
    },

    /**
     * Generación de vector de índices para paginación. En caso de generarse los
     * índices para paginación de las primeras tres páginas se regresa el mismo vector.
     * En el caso de que sean mas de tres páginas y no las últimas, se regresará
     * un vector procurando dejar en el centro del vector el índice actual. En el
     * caso de ser las últimas tres páginas se regresara un vector con los últimos
     * tres índices.    
     * 
     * @param  {number} noDePaginas    Total de páginas del paginador.
     * @param  {number} mostrarIndices Tamaño del vector o número de índices a
     *                                 mostrar, este número siempre debe ser impar.
     * @return {Array} Vector con los números de índice .
     */
    generadorDeIndices(noDePaginas, mostrarIndices, indiceActual) {
      //Cálculo de límites.
      var limiteInferior = indiceActual - Math.floor( mostrarIndices/2 );
      var limiteSuperior = indiceActual + Math.floor( mostrarIndices/2 );

      //Corrección de desfase del límite inferior.
      if (limiteInferior <= 0) {
        limiteInferior = 1;
        limiteSuperior = limiteInferior + mostrarIndices - 1;
      }

      //Corrección de desfase del límite superior.
      if (limiteSuperior > noDePaginas) {
        limiteSuperior = noDePaginas;
      }

      //Generación de índices.
      return this.generarEnteros(limiteInferior, limiteSuperior);
    }
};