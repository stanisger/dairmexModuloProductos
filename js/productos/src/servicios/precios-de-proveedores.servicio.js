var Aplicacion = Aplicacion || {};
    Aplicacion.Servicios = Aplicacion.Servicios || {};

Aplicacion.Servicios.ServicioPreciosDeProveedores = (() => {
   
   var { entornoPrefijo } = Configuracion;
   const API_URL = `${location.origin}/${entornoPrefijo}/PreciosDeProveedoresAPI`;
   
   return {
       alta(precios, {id_producto}) {
         return fetch(`${API_URL}/alta`, {
               method: 'POST',
               body: JSON.stringify({precios, id_producto}),
               headers: {'Content-Type': 'application/json'}
           })
         .then(res => res.json())
         .then(res => res.proveedores)
       },

       actualizar(precios) {
         return fetch(`${API_URL}/actualizar`, {
               method: 'PUT',
               body: JSON.stringify({precios}),
               headers: {'Content-Type': 'application/json'}
           })
         .then(res => res.json())
         .then(res => res.proveedores)
       },

       eliminar(identificador) {
            return fetch(
               `${API_URL}/eliminar`
              +`?identificadores[]=${identificador}`,
             {method: 'DELETE'})
            .then(res => res.json())
            .then(res => res.proveedores);
       },
   };

})();