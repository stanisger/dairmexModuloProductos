Aplicacion = Aplicacion || {};
Aplicacion.Componentes = Aplicacion.Componentes || {};

Aplicacion.Componentes.ComponenteProveedores = (function () {
    let { ComponenteProveedor } = Aplicacion.Componentes;

    //Componentes de la Interfaz de Usuario.
    let uiBotonAgregarProveedor,
        uiContenedorDeProveedores;
    
    //Arreglo de proveedores
    let proveedores = [];

    function cargarComponente() {
        uiBotonAgregarProveedor   = document.querySelector('#crear-proveedor');
        uiContenedorDeProveedores = document.querySelector('#contenedor-proveedores');
        uiBotonAgregarProveedor.addEventListener('click', renderNuevoProveedor)
    }

    function renderNuevoProveedor() {
     proveedores.push(
       new ComponenteProveedor(uiContenedorDeProveedores)
       .eliminarProveedor(proveedor => eliminarProveedor(proveedor))
       .render()
     )
    }

    function eliminarProveedor(cmpProveedor) {
        proveedores = proveedores.filter(
            eleProveedor => eleProveedor != cmpProveedor 
        );
    }

    function obtenerDatosDeProveedores() {
        return proveedores.map(
            proveedor => proveedor.obtenerDatosDeProveedor()
        )
    }

    return {cargarComponente, obtenerDatosDeProveedores};
})();