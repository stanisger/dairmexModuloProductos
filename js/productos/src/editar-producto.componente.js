(function () {
    //Importar                                          //Desde ...
    let { Mensajes, AnimacionDeEspera, Textos }                               = Aplicacion.InterfazDeUsuario;
    let { ServicioProductos, ServicioArchivos, ServicioPreciosDeProveedores } = Aplicacion.Servicios;
    let { ArchivoABase64, Formulario, HerramientaHash }                       = Aplicacion.Herramientas;
    let { ComponenteProveedores }                                             = Aplicacion.Componentes;
    let { entornoPrefijo }                                                    = Configuracion;

    //Componentes de la Interfaz de Usuario.
    let uiFormularioProducto, uiEntradaImagen, uiMostrarImagen, uiBotonImagen;
    let datosImagen = {};
    let _camposFormulario = ['id_producto','nombre', 'medida', 'unidad_medida', 'categoria', 'cantidad'];


    (function cargarComponente() {
        uiFormularioProducto = document.querySelector('#producto');
        uiEntradaImagen = uiFormularioProducto.elements.imagen;
        uiMostrarImagen = document.querySelector('#contenedor-imagen');
        uiBotonImagen   = document.querySelector('#boton-imagen');

        uiBotonImagen.addEventListener('click', () => uiEntradaImagen.click());
        uiEntradaImagen.addEventListener('change', cargarImagen);
        uiFormularioProducto.addEventListener('submit', actualizarProducto);
        uiFormularioProducto.querySelector('#btn-reset').onclick = (e)=>{e.preventDefault();location.reload();};        
        cargarProducto();
    })();

    function cargarProducto() {
        let { id = null } = HerramientaHash.parametrosEnHash();

        AnimacionDeEspera.activar();
        ServicioProductos
        .obtener(id)
        .then(producto => {
            AnimacionDeEspera.desactivar(); 
            Formulario.establecerCampos(producto, _camposFormulario, uiFormularioProducto);
            ComponenteProveedores.cargarComponente(producto.proveedores);
            imagenPrecargada(producto);
        }).catch(e => {
            Mensajes.error(4, 'Error al cargar el producto.');
            setTimeout(() => location.href='index', 1500 );
        });
    }

    function imagenPrecargada({id_producto, extension_imagen = null}) {
        extension_imagen && (uiMostrarImagen.src=`/${entornoPrefijo}/img/subidas/p-${id_producto}.${extension_imagen}`);
    }

    function cargarImagen() {
        var referenciaDeArchivo = uiEntradaImagen.files[0];

        if (!ArchivoABase64.validarImagen(referenciaDeArchivo)) {
            uiEntradaImagen.value=null;
            datosImagen = {};
            uiMostrarImagen.src = '';
            Mensajes.error(6, Textos.errorDeFormato);
            return;
        }
        
        ArchivoABase64
        .cargarArchivo(referenciaDeArchivo)
        .then( imagen => datosImagen = imagen)
        .then( imagen =>
          uiMostrarImagen
          .src = `data:${imagen.tipoMIME}, `
               + `${imagen.contenido}` );
    }

    function actualizarProducto(e) {
        e.preventDefault();

        AnimacionDeEspera.activar();
        Mensajes.accion(4, 'Actualizando los datos del producto.');

        let producto = Formulario.obtenerCampos(_camposFormulario, uiFormularioProducto);
        let proveedoresNuevos = ComponenteProveedores.obtenerDatosDeProveedoresNuevos();
        let proveedoresPorActualizar = ComponenteProveedores.obtenerDatosDeProveedoresActualizados();

        !!Object.keys(datosImagen).length
        && (producto.extension_imagen = datosImagen.extension);

        Promise.all([
          ServicioProductos
          .actualizar(producto),

          ServicioPreciosDeProveedores
          .actualizar(proveedoresPorActualizar),

          !!proveedoresNuevos.length &&
          ServicioPreciosDeProveedores
          .alta(proveedoresNuevos, producto),

          !!Object.keys(datosImagen).length && 
          ServicioArchivos
          .subirImagen({...datosImagen, nombre: 'p-'+producto.id_producto}),
        ])
        .then(() => Mensajes.correcto(4, 'Se actualizo el producto correctamente.'))
        .catch(() => Mensajes.error(4, 'Ocurrio un problema al actualizar el productos. Informe al administrador de la aplicación.'))
        .finally(()=>setTimeout(()=>location.href='index', 1500));
    }
})();