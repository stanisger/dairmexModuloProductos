//Construcción del espacio de nombres de le aplicación y el módulo.
var Aplicacion = Aplicacion || {};
    Aplicacion.Herramientas = Aplicacion.Herramientas || {};

Aplicacion.Herramientas.Formulario = {
    obtenerCampos(campos, formulario) {
        return campos.reduce( (acc, campo) => {
            acc[campo] = formulario.querySelector('#'+campo).value;
            return acc;
        }, {});
    },
    establecerCampos(datos, campos, formulario) {
        campos.forEach( campo => {
          formulario.querySelector('#'+campo).value = datos[campo];
        });
    }
};