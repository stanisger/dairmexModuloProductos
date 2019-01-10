Aplicacion = Aplicacion || {};
Aplicacion.Componentes = Aplicacion.Componentes || {};

Aplicacion.Componentes.ComponenteProveedores = (function () {
    let { ComponenteProveedor }                                = Aplicacion.Componentes;
    let { DialogoDeConfirmacion, Mensajes, AnimacionDeEspera } = Aplicacion.InterfazDeUsuario;
    let { ServicioPreciosDeProveedores }                       = Aplicacion.Servicios;

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
            AnimacionDeEspera.activar();
            return ServicioPreciosDeProveedores
            .eliminar(proveedor.id_precio)
            .then(()=> {
                AnimacionDeEspera.desactivar();
                Mensajes.correcto(4,'Datos de proveedor eliminados correctamente.')
            }).catch( () => {
                Mensajes.error(4,'Ocurrió un problema al eliminar los datos de proveedor solicitado.');
                setTimeout(location.reload(), 2000);
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

    function obtenerDatosDeProveedoresNuevos() {
        return proveedores
        .map(proveedor => proveedor.obtenerDatosDeProveedor())
        .filter(proveedor => !proveedor.id_precio);
    }

    function obtenerDatosDeProveedoresActualizados() {
        return proveedores
        .map(proveedor => proveedor.obtenerDatosDeProveedor())
        .filter(proveedor => !!proveedor.id_precio)
        .map( ({id_precio,id_proveedor,precio_por_unidad,unidad_precio}) =>
              ({id_precio,id_proveedor,precio_por_unidad,unidad_precio}));
    }

    return {cargarComponente, obtenerDatosDeProveedoresNuevos, obtenerDatosDeProveedoresActualizados};
})();