Aplicacion = Aplicacion || {};
Aplicacion.Componentes = Aplicacion.Componentes || {};

Aplicacion.Componentes.ComponenteProveedores = (function () {
    let { ComponenteProveedor }             = Aplicacion.Componentes;
    let { DialogoDeConfirmacion, Mensajes } = Aplicacion.InterfazDeUsuario;
    let { ServicioPreciosDeProveedores }    = Aplicacion.Servicios;

    //Componentes de la Interfaz de Usuario.
    let uiBotonAgregarProveedor,
        uiContenedorDeProveedores;
    
    //Arreglo de proveedores
    let proveedores = [];

    function cargarComponente(proveedoresDefecto = []) {
        uiBotonAgregarProveedor   = document.querySelector('#crear-proveedor');
        uiContenedorDeProveedores = document.querySelector('#contenedor-proveedores');
        uiBotonAgregarProveedor.addEventListener('click', renderNuevoProveedor);

        cargarProveedoresDefecto(proveedoresDefecto);
    }

    function cargarProveedoresDefecto(proveedoresDefecto) {
        proveedoresDefecto.forEach(
            proveedorPorDefecto => proveedores.push(
                new ComponenteProveedor(uiContenedorDeProveedores)
                .establecerDatosDeProveedor(proveedorPorDefecto)
                .eliminarProveedor(proveedor => eliminarProveedorDeBD(proveedor))
                .render()
            )
        )
    }

    function renderNuevoProveedor() {
     proveedores.push(
       new ComponenteProveedor(uiContenedorDeProveedores)
       .eliminarProveedor(proveedor => eliminarProveedor(proveedor))
       .render()
     )
    }

    function eliminarProveedorDeBD(cmpProveedor) {
        let proveedor = cmpProveedor.obtenerDatosDeProveedor();
        return DialogoDeConfirmacion.preguntar(`¿Deseas eliminar los datos`
        +` del proveedor <i>${proveedor.nombre}</i> asociados `
        +`a este producto?`)
        .then(() => {
            return ServicioPreciosDeProveedores
            .eliminar(proveedor.id_precio)
            .then(()=>{
                Mensajes.correcto(4,'Datos de proveedor eliminados correctamente.');
            }).catch( (e) => {
               console.log(e.message)
               Mensajes.error(4,'Ocurrió un problema al eliminar los datos de proveedor solicitado.');
            });
        });
    }

    function eliminarProveedor(cmpProveedor) {
        return new Promise( (rs) => {
          proveedores = proveedores.filter(
            eleProveedor => eleProveedor != cmpProveedor 
          );
          rs(1);
        });
    }

    function obtenerDatosDeProveedores() {
        return proveedores
        .map(proveedor => proveedor.obtenerDatosDeProveedor())
        .filter(proveedor => !proveedor.id_precio)
    }

    return {cargarComponente, obtenerDatosDeProveedores};
})();