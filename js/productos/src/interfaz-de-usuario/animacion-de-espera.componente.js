var Aplicacion = Aplicacion || {};
    Aplicacion.InterfazDeUsuario = Aplicacion.InterfazDeUsuario || {}; 

/**
 * Este módulo representa el componente de animación de carga o espera de la
 * aplicación.
 * 
 * Para utilizar este componente no se requiere código HTML ya prestablecido
 * antes de cargar este módulo.
 * 
 * @author Ricardo bermúdez bermúdez
 * @since  30 de diciembre del 2018. 
 */
Aplicacion.InterfazDeUsuario.AnimacionDeEspera = (function () {
    //Importar                  //Desde
    var { DibujarComponente } = Aplicacion.Nucleo.Componente;

    /** Nodo DOM de animación de espera */
    var _contenedorPrincipal;

    (
    /**
     * Inicializa el internamente el componente de animación para solo dar
     * referencias externas de como utilizarlo (metodos activar y desactivar).
     */
    function _cargarComponente() {
        _contenedorPrincipal = DibujarComponente(`
          <div class="spinner-container spinner-container-no-show">
            <div class="spinner">
              <div class="double-bounce1"></div>
              <div class="double-bounce2"></div>
            </div>
          </div>`, document.body);
    })();

    return {
      activar: () =>
        _contenedorPrincipal.classList.remove('spinner-container-no-show'),
      desactivar: () => 
        _contenedorPrincipal.classList.add('spinner-container-no-show'),
    };
})();