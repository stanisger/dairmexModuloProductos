( function () {
    //Importar                                     //Desde ...
    let { Mensajes, AnimacionDeEspera, Textos }  = Aplicacion.InterfazDeUsuario;
    let { ServicioProductos, ServicioArchivos }  = Aplicacion.Servicios;
    let { ArchivoABase64, Formulario }           = Aplicacion.Herramientas;
    let { ComponenteProveedores }                = Aplicacion.Componentes;

    //Componentes de la Interfaz de Usuario.
    let uiFormularioProducto, uiEntradaImagen, uiMostrarImagen, uiBotonImagen;
    let datosImagen = {};

    /**
     * Inicializa el componente.
     */
    (function cargarComponente() {
        uiFormularioProducto = document.querySelector('#producto');
        uiEntradaImagen = uiFormularioProducto.elements.imagen;
        uiMostrarImagen = document.querySelector('#contenedor-imagen');
        uiBotonImagen   = document.querySelector('#boton-imagen');
        
        uiEntradaImagen.addEventListener('change', cargarImagen);
        uiBotonImagen.addEventListener('click', () => uiEntradaImagen.click());
        uiFormularioProducto.addEventListener('submit', altalDeProducto);
        
        ComponenteProveedores.cargarComponente();
    })();

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

    function cargarProducto() {
        return {
          ...Formulario.obtenerCampos(
              ['nombre', 'medida', 'unidad_medida', 'categoria', 'cantidad'],
              uiFormularioProducto
          ),
          extension_imagen: datosImagen.extension,
          proveedores: ComponenteProveedores.obtenerDatosDeProveedores()
        };
    }

    /**
     * Envia producto a API REST para registrarlo en la base de datos.
     */
    function altalDeProducto(e) {
        e.preventDefault();

        AnimacionDeEspera.activar();
        Mensajes.accion(4, Textos.productoAlta);

        ServicioProductos
        .alta( cargarProducto() )
        .then( producto => {
            Mensajes.correcto(4, Textos.productoAltaCorrecta);
            if (!Object.keys(datosImagen).length) {return producto;}
            
            Mensajes.accion(4, Textos.imagenAlta);
            return ServicioArchivos
              .subirImagen({...datosImagen, nombre: 'p-'+producto.id_producto})
              .then( () => Mensajes.correcto(4, Textos.imagenAltaCorrecta))
              .catch(() => Mensajes.error(4, Textos.imagenAltaError));
        })
        .catch( () => Mensajes.error(4, Textos.productoAltaError))
        .finally( () => setTimeout( () => {
          AnimacionDeEspera.desactivar();
          location.href='index';
        }, 5500 ) );
    }
})();