var Aplicacion = Aplicacion || {};

Aplicacion.ServicioPreciosDeProveedores(() => {
   const API_URL = `${location.origin}/preciosdeproveedoresapi`;
   
   return {
       
       alta(precios) {
         return fetch(`${API_URL}/alta`, {
               method: 'POST',
               body: JSON.stringify(precios),
               headers: {'Content-Type': 'application/json'}
           })
         .then(res => res.json())
         .then(res => res.proveedores)
       },

       actualizar(precios) {
         return fetch(`${API_URL}/actualizar`, {
               method: 'PUT',
               body: JSON.stringify(precios),
               headers: {'Content-Type': 'application/json'}
           })
         .then(res => res.json())
         .then(res => res.proveedores)
       },

       eliminar(iddentificador) {
            return fetch(
               `${API_URL}/eliminar`
              +`?identificadores[]=${identificador}`,
             {method: 'DELETE'})
            .then(res => res.json())
            .then(res => res.proveedores);
       },
   }
})();