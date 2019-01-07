Aplicacion = Aplicacion || {};
Aplicacion.Componentes = Aplicacion.Componentes || {};

Aplicacion.Componentes.ComponenteBuscarProveedor = (function () {
    let { ServicioProveedores } = Aplicacion.Servicios;

    function _renderBuscarProveedor() {
      div = document.createElement("div");
      div.classList.add("autocomplete-proveedor")
      div.innerHTML =`
          <label>Nombre del proveedor</label>
          <input name="nombre" type="text" autocomplete="off"
            placeholder="Ingresa el nombre del proveedor"
            pattern=".{3}.*" required>
          </label>
          <ul class="list-group list-products"></ul>`;
      return div;
    }

    function obtenerSugerenciasDeProveedores(
        event, uiEntradaProveedores,
        uiSugerenciasProveedores, onclick) {
        
        if (event.target.value.length<3) {
            uiSugerenciasProveedores.innerHTML = '';
            onclick('');
            return;
        }

        ServicioProveedores
        .obtenerPorNombre(event.target.value)
        .then(proveedores => {
            uiSugerenciasProveedores.innerHTML = '';
            onclick('');

            proveedores.reduce( (acc, {nombre, id_proveedor}) => {
                let li = document.createElement('li');
                li.classList.add('list-group-item');
                li.addEventListener('click', () => {
                    uiEntradaProveedores.value=nombre;
                    onclick(id_proveedor)
                })
                li.innerHTML = nombre;
                acc.appendChild(li);
                return acc;
            }, uiSugerenciasProveedores);
        });
    }

    //Constructor
    return function (contenedor, onclick) {

        //Elementos de la interfaz.
        let uiBuscarProveedor = _renderBuscarProveedor();
        let uiEntradaProveedores = uiBuscarProveedor.querySelector('input');
        let uiSugerenciasProveedores = uiBuscarProveedor.querySelector('ul');

        uiEntradaProveedores
        .addEventListener('keyup', event =>
          obtenerSugerenciasDeProveedores(
            event, 
            uiEntradaProveedores,
            uiSugerenciasProveedores, onclick));

        uiEntradaProveedores.addEventListener('blur',  () => setTimeout(
            () => uiSugerenciasProveedores.innerHTML = '', 500
          )
        );

        this.render = () => {
            contenedor.appendChild(uiBuscarProveedor);
            return this;
        };
    };

})();