var Aplicacion = Aplicacion || {};
    Aplicacion.InterfazDeUsuario = Aplicacion.InterfazDeUsuario || {}; 

/**
 * Este módulo representa el componente de animación de carga o espera de la
 * aplicación.
 * 
 * @author Ricardo bermúdez bermúdez
 * @since  30 de diciembre del 2018. 
 */
Aplicacion.InterfazDeUsuario.AnimacionDeEspera = ( function () {
   //Referencia a componentes en HTML - DOM
   var contenedorPrincipal;

   /**
    * Inicializa el componente.
    * 
    * Realiza la carga directa del componente al asociar un nuevo nodo DIV
    * como hijo del nodo <body> por no requerir ninguna referencia ya
    * predefinida en el código fuente del HTML como si ocurre en otros
    * componentes.  
    */
   function cargarComponente(){
       contenedorPrincipal = renderAnimacionDeEspera();
       document.body.appendChild(contenedorPrincipal);
   }

   /**
    * Carga el componente de la animación de espera en un nuevo nodo DIV.
    * 
    * @returns {DOMNode} Referencia al contenedor de la animación.
    */
   function renderAnimacionDeEspera() {
      let contenedor = document.createElement('div');

      contenedor.innerHTML = `
        <div class="spinner-container spinner-container-no-show">
          <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
          </div>
        </div>`;
      
      return contenedor.querySelector('.spinner-container');
   }

   // Inicializa el internamente el componente de animación para solo dar
   // referencias externas de como utilizarlo (metodos activar y desactivar). 
   cargarComponente();

   return {
       activar:    () => contenedorPrincipal.classList.remove('spinner-container-no-show'),
       desactivar: () => contenedorPrincipal.classList.add('spinner-container-no-show'),
   }
})();