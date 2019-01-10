Aplicacion = Aplicacion || {};
Aplicacion.Componentes = Aplicacion.Componentes || {};

Aplicacion.Componentes.AutocompletarProductosCliente = (() =>  {
    
    let { ServicioProductos } = Aplicacion.Servicios;

    return class AutocompletarProductosCliente {
        cargarComponente(contenedorPrincipal) {
            this.uiEntrada = contenedorPrincipal.querySelector('#entrada');
            this.uiListaProductos = contenedorPrincipal.querySelector('ul');
            this.uiEntrada.onkeyup = e => 
                this.obtenerProductosSugeridos(e.target.value);
            this.uiEntrada.onblur = () => this.limpiarListaDeProductosSugeridos();
        }

        limpiarListaDeProductosSugeridos() {
           setTimeout(() => this.uiListaProductos.innerHTML = '', 500);
        }

        obtenerProductosSugeridos(entrada) {
            if (entrada.length<3) {
                this.uiListaProductos.innerHTML = '';
                return;
            }

            ServicioProductos
            .obtenerPorNombre(entrada)
            .then(productos =>{
              this.uiListaProductos.innerHTML = ''; 
              productos.reduce( (acc, {nombre, id_producto, extension_imagen}) => {
                let li = document.createElement('li');
                li.classList.add('list-group-item');
                li.addEventListener('click', () => this.uiEntrada.value = nombre)
                li.innerHTML =`${extension_imagen
                  ?`<img class="imagen-redondeada"
                      src="/crm-b/img/subidas/p-${id_producto}.${extension_imagen}">`
                  :''}
                  ${nombre}`;
                acc.appendChild(li);
                return acc;
              }, this.uiListaProductos)}
            );
        }
    }
})();