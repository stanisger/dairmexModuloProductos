var Aplicacion = Aplicacion || {};
    Aplicacion.Servicios = Aplicacion.Servicios || {};

Aplicacion.Servicios.ServicioArchivos = (() => {
    
  var { entornoPrefijo } = Configuracion;
  const API_URL = `${location.origin}/${entornoPrefijo}/ArchivosAPI`;
    
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
