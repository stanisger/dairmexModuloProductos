(function () {
    //Importar                                          //Desde ...
    let { Mensajes, AnimacionDeEspera, Textos }         = Aplicacion.InterfazDeUsuario;
    let { ServicioProductos, ServicioArchivos }         = Aplicacion.Servicios;
    let { ArchivoABase64, Formulario, HerramientaHash } = Aplicacion.Herramientas;
    let { ComponenteProveedores }                       = Aplicacion.Componentes;

    //Componentes de la Interfaz de Usuario.
    let uiFormularioProducto, uiEntradaImagen, uiMostrarImagen, uiBotonImagen;
    let datosImagen = {};


    (function cargarComponente() {
        uiFormularioProducto = document.querySelector('#producto');
        uiEntradaImagen = uiFormularioProducto.elements.imagen;
        uiMostrarImagen = document.querySelector('#contenedor-imagen');
        uiBotonImagen   = document.querySelector('#boton-imagen');

        uiBotonImagen.addEventListener('click', () => uiEntradaImagen.click());
        uiEntradaImagen.addEventListener('change', cargarImagen);
        cargarProducto();
    })();

    function cargarProducto() {
        let { id = null } = HerramientaHash.parametrosEnHash();

        ServicioProductos
        .obtener(id)
        .then(producto => { 
            Formulario.establecerCampos(
                producto,
                ['nombre', 'medida', 'unidad_medida', 'categoria', 'cantidad'],
                uiFormularioProducto        
            );

            cargarProveedores(producto.proveedores);

            imagenPrecargada(producto);
        });
    }

    function cargarProveedores(proveedores){
        ComponenteProveedores.cargarComponente(proveedores);
    }

    function imagenPrecargada({id_producto, extension_imagen = null}) {
        if (extension_imagen) {
            uiMostrarImagen.src = `/crm-b/img/subidas/p-${id_producto}.${extension_imagen}`
        }
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
})();