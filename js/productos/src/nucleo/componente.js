var Aplicacion = Aplicacion || {};
Aplicacion.Nucleo = Aplicacion.Nucleo || {};

Aplicacion.Nucleo.Componente = {
    DibujarComponente(HTML, contenedorPadre=null) {
        var contenedor = document.createElement('div');
        contenedor.innerHTML = HTML;
        resultado = contenedor.firstElementChild;
        contenedorPadre!=null && contenedorPadre.appendChild(resultado);
        return resultado;
    },
}