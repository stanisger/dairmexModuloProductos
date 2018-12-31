Aplicacion = Aplicacion || {};
Aplicacion.Componentes = Aplicacion.Componentes || {};

Aplicacion.Componentes.ComponenteProveedor = (function () {
    let { ComponenteBuscarProveedor } = Aplicacion.Componentes;

    function _renderProveedor() {
        div = document.createElement('div');
        div.innerHTML =`
          <div class="proveedor grid-x grid-margin-x">
            <input name="id_proveedor" type="hidden">
            <div class="medium-5 cell autocomplete proveedor"></div>
            <div class="medium-2 cell">
              <label>Precio por unidad
              <input name="precio_por_unidad" type="number"
                placeholder="Ingresa el precio" min="0">
              </label>
            </div>
            <div class="medium-2 cell">
              <div class="switch">
                <small class="colorFont" >MX</small>
                <small class="colorFont" >USD</small>
                <input name="unidad_precio"  type="checkbox" class="switch-input" value="MXN">
                <label class="switch-paddle block"></label>
              </div>
            </div>
            <div class="medium-2 cell">
              <a class="eliminar">eliminar</a>
            </div>
          </div>`;
      return div;
    }

    function _obtenerDatosDeProveedor(campos) {
        let proveedor = {};
        for ( var i=0;i<campos.length; i++) {
            if (campos[i].value!='') {
              proveedor[campos[i].name] = campos[i].value;
            }
        }
        return proveedor;
    }

    function _eliminarProveedor(contenedor, uiProveedor) {
         contenedor.removeChild(uiProveedor)
    }


    //Constructor
    return function (contenedor) {

        //Elementos de la interfaz.
        let uiProveedor     = _renderProveedor(),
            uiBotonEliminar = uiProveedor.querySelector('a.eliminar'),
            uiCheckBoxUnidadPrecio      = uiProveedor.querySelector('input[name="unidad_precio"]'),
            uiEntradaIdProveedor        = uiProveedor.querySelector('input[name="id_proveedor"]'),
            uiComponenteBuscarProveedor = uiProveedor.querySelector('.autocomplete.proveedor');
        
        new ComponenteBuscarProveedor(
            uiComponenteBuscarProveedor, id_proveedor => uiEntradaIdProveedor.value=id_proveedor
        ).render();

        //Elementos de control e inyección.
        let _fnEliminarProveedor = () => {};

        //Evento para eliminar proveedor.
        uiBotonEliminar
        .addEventListener('click', () => {
          _eliminarProveedor(contenedor,uiProveedor)
          _fnEliminarProveedor(this);
        });

        uiCheckBoxUnidadPrecio
        .addEventListener('change', (e) => {
            checkbox = e.target;
            if (checkbox.checked) {
                checkbox.value = 'USD';
            } else {
                checkbox.value = 'MXN';
            }
        });

        uiProveedor.querySelector('.switch-paddle')
        .addEventListener('click', () => uiCheckBoxUnidadPrecio.click());

        this.obtenerDatosDeProveedor = () => _obtenerDatosDeProveedor(
            uiProveedor.querySelectorAll('input')
        );

        this.eliminarProveedor = (fnEliminarProveedor) => {
            _fnEliminarProveedor = fnEliminarProveedor;
            return this;
        };

        this.render = () => {
            contenedor.appendChild(uiProveedor)
            return this;
        };
    };

})();