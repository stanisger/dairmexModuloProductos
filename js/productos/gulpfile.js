/**
 * Ejemplo de como usar gulp-concat junto con gulp-minify.
 * 
 * @link https://www.toptal.com/javascript/optimize-js-and-css-with-gulp
 */
var gulp        = require('gulp'),
    concat      = require('gulp-concat'),
    minify      = require('gulp-minify');

var productosCliente = [
    './src/servicios/productos.servicio.js',
    './src/buscar-productos-cliente.componente.js'
],
paginador = [
    "./src/nucleo/componente.js",
    "./src/interfaz-de-usuario/mensaje.componente.js",
    "./src/interfaz-de-usuario/mensajes.componente.js",
    "./src/interfaz-de-usuario/animacion-de-espera.componente.js",
    "./src/interfaz-de-usuario/dialogo-de-confirmacion.componente.js",
    "./src/herramientas/hash.herramienta.js",
    "./src/herramientas/paginador.herramienta.js",
    "./src/servicios/productos.servicio.js",
    "./src/buscar-productos.componente.js",
    "./src/paginador-de-productos.componente.js"
],
altaEdicion=[
    "./src/nucleo/componente.js",
    "./src/interfaz-de-usuario/mensaje.componente.js",
    "./src/interfaz-de-usuario/mensajes.componente.js",
    "./src/interfaz-de-usuario/animacion-de-espera.componente.js",
    "./src/interfaz-de-usuario/dialogo-de-confirmacion.componente.js",
    "./src/interfaz-de-usuario/textos.js",
    "./src/herramientas/archivo-a-base64.herramienta.js",
    "./src/herramientas/formulario.herramienta.js",
    "./src/servicios/productos.servicio.js",
    "./src/servicios/archivos.servicio.js",
    "./src/servicios/proveedores.servicio.js",
    "./src/servicios/precios-de-proveedores.servicio.js",
    "./src/buscar-proveedor.componente.js",
    "./src/proveedor.componente.js",
    "./src/proveedores.componente.js",
],
alta = [
    ...altaEdicion,
    "./src/nuevo-producto.componente.js"
],
edicion = [
    ...altaEdicion,
    "./src/herramientas/hash.herramienta.js",
    "./src/editar-producto.componente.js",
];

var construye = (ambiente, scripts, scriptFinal) => 
    gulp.src([`./src/configuracion/ambiente.${ambiente}.js`, ...scripts])
    .pipe(concat(scriptFinal))
    .pipe(minify({ext:{min:'.js'}, noSource: true}))
    .pipe(gulp.dest('./dist'));

gulp.task('productos-paginador--produccion', () =>
    construye('produccion', paginador, 'productos.paginador.js'));

gulp.task('productos-alta--produccion', () =>
    construye('produccion', alta, 'productos.alta.js'));

gulp.task('productos-edicion--produccion', () => 
    construye('produccion', edicion, 'productos.edicion.js'));

gulp.task('productos-cliente--produccion', () =>
    construye('produccion', productosCliente, 'productos.cliente.js'));

gulp.task('productos-paginador--local', () => 
    construye('local', paginador, 'productos.paginador.js'));

gulp.task('productos-alta--local', () => 
    construye('local', alta, 'productos.alta.js'));

gulp.task('productos-edicion--local', () =>
    construye('local', edicion, 'productos.edicion.js'));

gulp.task('productos-cliente--local', () =>
    construye('local', productosCliente, 'productos.cliente.js'));


gulp.task('productos--produccion', gulp.parallel(
    'productos-paginador--produccion',
    'productos-alta--produccion',
    'productos-edicion--produccion',
    'productos-cliente--produccion',
));

gulp.task('productos--local', gulp.parallel(
    'productos-paginador--local',
    'productos-alta--local',
    'productos-edicion--local',
    'productos-cliente--local',
));