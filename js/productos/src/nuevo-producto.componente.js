console.log('nuevo');

(componente => componente().cargarComponente() ) ( function () {

    //Componentes de la Interfaz de Usuario.
    let uiFormularioProducto;

    /**
     * Inicializa el componente.
     */
    function cargarComponente() {
        uiFormularioProducto = document.querySelector('#producto');

        uiFormularioProducto.addEventListener('submit', enviar);
    }

    /**
     * Envia producto a API REST para registrarlo en la base de datos.
     */
    function enviar(e) {
        e.preventDefault();
        
        let { nombre, medida, unidad_medida,
              imagen, categoría, cantidad } = uiFormularioProducto.elements;

        let producto = {
            nombre: nombre.value,
            medida: medida.value,
            unidad_medida: unidad_medida.value,
            categoría: categoría.value,
            cantidad: cantidad.value,
            imagen: imagen.value,
        };

        
    }

    return {cargarComponente};
});