var Aplicacion = Aplicacion || {};

(componente => componente().cargarComponente() ) ( function () {
    let { Mensajes, AnimacionDeEspera, Textos } = Aplicacion.InterfazDeUsuario;
    let { ServicioProductos, ServicioArchivos } = Aplicacion.Servicios;
    let { ImagenABase64, Formulario }           = Aplicacion.Herramientas;
    let { ComponenteProveedores }               = Aplicacion.Componentes;

    //Componentes de la Interfaz de Usuario.
    let uiFormularioProducto, uiEntradaImagen, uiMostrarImagen, uiBotonImagen;
    let datosImagen = {};

    /**
     * Inicializa el componente.
     */
    function cargarComponente() {
        uiFormularioProducto = document.querySelector('#producto');
        uiEntradaImagen = uiFormularioProducto.elements.imagen;
        uiMostrarImagen = document.querySelector('#contenedor-imagen');
        uiBotonImagen   = document.querySelector('#boton-imagen');
        
        uiEntradaImagen.addEventListener('change', cargarImagen);
        uiBotonImagen.addEventListener('click', () => uiEntradaImagen.click());
        uiFormularioProducto.addEventListener('submit', altalDeProducto);
        
        ComponenteProveedores.cargarComponente();
    }

    function cargarImagen() {
        var referenciaDeArchivo = uiEntradaImagen.files[0];

        if (!ImagenABase64.formatoValido(referenciaDeArchivo)) {
            datosImagen = {};
            uiMostrarImagen.src = '';
            Mensajes.error(6, Textos.errorDeFormato);
            return;
        }
        
        ImagenABase64
        .cargarImagen(referenciaDeArchivo)
        .then( imagen => datosImagen = imagen)
        .then( imagen =>
          uiMostrarImagen
          .src = `data:${imagen.tipoMIME}, `
               + `${imagen.contenido}` );
    }

    /**
     * Envia producto a API REST para registrarlo en la base de datos.
     */
    function altalDeProducto(e) {
        e.preventDefault();
        AnimacionDeEspera.activar();
        Mensajes.accion(4, Textos.productoAlta);

        let producto = Formulario.obtenerCampos(
          ['nombre', 'medida', 'unidad_medida', 'categoria', 'cantidad'],
          uiFormularioProducto);
                  
        producto.extension_imagen = datosImagen.extension;
        producto.proveedores = ComponenteProveedores.obtenerDatosDeProveedores();

        ServicioProductos
        .alta( producto )
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

    return {cargarComponente};
});