var Aplicacion = Aplicacion || {};
    Aplicacion.Servicios = Aplicacion.Servicios || {};

Aplicacion.Servicios.ServicioArchivos = (() => {
    
    const API_URL = `${location.origin}/crm-b/archivosapi`;
    
    return {
        subirImagen(datosDeImagen) {
          return fetch(`${API_URL}/imagenes`,{
            method: 'POST',
            body: JSON.stringify(datosDeImagen),
            headers:{
              'Content-Type': 'application/json'
            }
          })
          .then(res => res.json())
          .then(res => { 
              if(res.error) {
                 throw Error(res.error);
              }
              return res;
          }) 
        },
    }
})();
