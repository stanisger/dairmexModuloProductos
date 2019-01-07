var Aplicacion = Aplicacion || {};
    Aplicacion.InterfazDeUsuario = Aplicacion.InterfazDeUsuario || {}; 

Aplicacion.InterfazDeUsuario.DialogoDeConfirmacion = ( function () {
    //Importar                  //Desde
    var { DibujarComponente } = Aplicacion.Nucleo.Componente;

    //Referencia a componentes en HTML - DOM
    var _contenedorPrincipal,
        _eiBotonConfirmar,
        _eiBotonCancelar,
        _eiPregunta;

    function _dibujarComponente() {
        return DibujarComponente(`
          <div class="mod-modal confirmacion">
            <div class="mod-modal__content">
              <div class="mod-modal__body">
                <p></p>
              </div>
              <div class="mod-modal__footer">
                <hr>
                <div class="save">
                  <input type="submit" class="cancelar" value="Cancelar">
                  <input type="submit" class="aceptar"  value="Aceptar">
                </div>
              </div>
            </div>
          </div>`, document.body);
    }

    (function _cargarComponente(){
        _contenedorPrincipal = _dibujarComponente();
        _eiBotonConfirmar = _contenedorPrincipal.querySelector('.aceptar');
        _eiBotonCancelar  = _contenedorPrincipal.querySelector('.cancelar');
        _eiPregunta       = _contenedorPrincipal.querySelector('p');
    })();
    
    function _ciMostrarContenedorPrincipal() {
        _contenedorPrincipal.style.display='block';
    }

    function _ciOcultarContenedorPrincipal() {
        _contenedorPrincipal.style.display='none';
    }

    function _ciDibujarPregunta(pregunta) {
        _eiPregunta.innerHTML = pregunta;
    }

    return {
      preguntar: pregunta => {
          _ciMostrarContenedorPrincipal();

          return new Promise( (rs,rj) => {
              _ciDibujarPregunta(pregunta);

              _eiBotonConfirmar.onclick = () => {
                _ciOcultarContenedorPrincipal(), rs(true)
              };
              _eiBotonCancelar.onclick = () => {
                _ciOcultarContenedorPrincipal(), rj(false)
              };
          });
      }
    };
})();