$(document).ready(function(){
 	function inputFormulario(){
 		var elemt = 0;
 		$('.art').each(function ()
	    {
	        elemt++;
	    });

	    return elemt;	
 	}
 	

 	$("#fr-req").submit(function(e){
 		
 		
 		var bad = 0;

	    $('.art').each(function ()
	    {
	        if ($.trim(this.value) == ""){bad++;}
	    });

	    ele = inputFormulario();

	    if(ele === bad){
	    	e.preventDefault();
	    	alert('Ingrese la información de al menos 1 fila');
	    }else{
	    	return true;
	    }

	    
 	})
 	/*
 	jQuery.validator.addClassRules("art", {				  
	  minlength: 3
	});

	$("#fr-req").validate();
	
	$.validator.messages.required 	= "Campo obligatorio *";
	$.validator.messages.minlength  = "2 caracteres mínimo";
	*/

    function CargarComponente(HTML) {
        var contenedor = document.createElement('div');
        $(contenedor).append(HTML);
        return contenedor.firstElementChild;
    }

	let lista = document.querySelector('#tr-1 .autocompletar-productos-cliente');
    !!lista && new Aplicacion.Componentes.AutocompletarProductosCliente()
    .cargarComponente(lista);


	let listaMovil = document.querySelector('#ul-1 .price');
    !!listaMovil && new Aplicacion.Componentes.AutocompletarProductosCliente()
    .cargarComponente(listaMovil);

 	$("#add").click(function(){
 		var idlastsr = $('#tabla_req tr:last').attr('id');
 		var idrow 	 = idlastsr.split('tr-'); 		 		
 		//alert(idrow[1]);
 		if(isNaN(parseInt(idrow[1]))===false){
 			var nuevoId = parseInt(idrow[1])+1;
            $("#limit").val(nuevoId);
            

 			if(rol_usuario=='suscriptor'){
                let nodoFila = CargarComponente('<tr id="tr-'+nuevoId+'" class="tr-number"><td>'+nuevoId+'</td><td class="autocompletar-productos-cliente"><textarea id="entrada" name="articulo-'+nuevoId+'" class="art ar" placeholder="Artículo" required ></textarea><ul class="list-group list-products"></ul></td><td><textarea  name="medida-'+nuevoId+'" class="art me" placeholder="Medida*" required></textarea></td><td><textarea name="cantidad-'+nuevoId+'" class="art ca" placeholder="Cantidad*" required></textarea></td><td><textarea name="proyecto-'+nuevoId+'" class="art pr" placeholder="Proyecto*" required></textarea></td><td><textarea name="comentarios-'+nuevoId+'" class="co" placeholder="Comentarios" ></textarea></td><td><div class="add2 show-for-large"><button type="button" class="del" data-id="tr-'+nuevoId+'">Eliminar</button></div></td></tr>');
                
                console.log(nodoFila);
                new Aplicacion.Componentes.AutocompletarProductosCliente()
                .cargarComponente(nodoFila.querySelector('.autocompletar-productos-cliente'));

 				$("#tabla_req").append(nodoFila);
 			}else{
                let nodoFila = CargarComponente('<tr id="tr-'+nuevoId+'" class="tr-number"><td>'+nuevoId+'</td><td class="autocompletar-productos-cliente"><textarea id="entrada" name="articulo-'+nuevoId+'" class="art ar" placeholder="Artículo" required ></textarea><ul class="list-group list-products"></ul></td><td><textarea  name="medida-'+nuevoId+'" class="art me" placeholder="Medida*" required></textarea></td><td><textarea name="cantidad-'+nuevoId+'" class="art ca" placeholder="Cantidad*" required></textarea></td><td><textarea name="proyecto-'+nuevoId+'" class="art pr" placeholder="Proyecto*" required></textarea></td><td><select name="estatus-'+nuevoId+'" required class="art es"><option value="0">En proceso</option><option value="1">Realizado</option><option value="2">No realizado</option></select></td><td><textarea name="comentarios-'+nuevoId+'" class="co" placeholder="Comentarios" ></textarea></td><td><input type="text" name="fecha_entrega-'+nuevoId+'" class="art fe" placeholder="Fecha de entrega"></td><td><div class="add2 show-for-large"><button type="button" class="del" data-id="tr-'+nuevoId+'">Eliminar</button></div></td></tr>')

                new Aplicacion.Componentes.AutocompletarProductosCliente()
                .cargarComponente(nodoFila.querySelector('.autocompletar-productos-cliente'));

 				$("#tabla_req").append(nodoFila);	
 			}			 			
 			
 		}else{
 			alert('No se puede agregar la fila, refresque su navegador');
 		}
 	});


 	$(document).on('click','.del',function(e){

 		if(confirm("¿Está seguro de eliminar éste elemento?")){

 			var domeleiment = $(this).attr('data-id');
	 		var elemtInt 	= domeleiment.split('tr-');
	 		if(isNaN(parseInt(elemtInt[1]))===false){

	 			var viejoId = $("#limit").val();
	 			var nuevoId = parseInt(viejoId)-1;
	 			
	 			if(nuevoId <= 0){
	 				alert('No se pueden eliminar todas las filas');
	 			}else{

	 				$("#"+domeleiment).remove(); 				 			 
		 				i =1;													
						$('#tabla_req > tbody  > tr').each(function() {
							if(i <= nuevoId){

								tr = $(this).attr('id');							
								$("#"+tr).attr('id','tr-'+i);
								$(this).find('td:first').text(i);
								$(this).find('.ar').attr('name','articulo-'+i);
								$(this).find('.ca').attr('name','cantidad-'+i);
								$(this).find('.me').attr('name','medida-'+i);
								$(this).find('.pr').attr('name','proyecto-'+i);
								$(this).find('.es').attr('name','estatus-'+i);
								$(this).find('.co').attr('name','comentarios-'+i);
								$(this).find('.fe').attr('name','fecha_entrega-'+i);
									
							}
							i++;
						});

					$("#limit").val(nuevoId);					
	 			} 			
	 		}else{
	 			alert('No se puede eliminar la fila, refresque su navegador');
	 		}

 		}else{
 			return false;
 		}	 		 	

	});

 	$("#addMobil").click(function(){
 		
 		var idlastul= $('#wrapper_ul').children().last().attr('id');
 		var idrowul 	 = idlastul.split('ul-');
 		
 		if(isNaN(parseInt(idrowul[1]))===false){
 			var nuevoId = parseInt(idrowul[1])+1;
 			$("#limitmobil").val(nuevoId);

 			if(rol_usuario=='suscriptor'){
                let nodoFila = CargarComponente('<ul class="pricing-table hide-for-large" id="ul-'+nuevoId+'"><li class="title bgFont ">'+nuevoId+'</li><li class="price"><input id="entrada" type="text" name="articulo-'+nuevoId+'" class="art ar" placeholder="Artículo*" required><ul class="list-group list-products"></ul></li><li class="description"><input type="text" name="medida-'+nuevoId+'" class="art me" placeholder="Medida*" required></li><li><input type="text" name="cantidad-'+nuevoId+'" class="art ca" placeholder="Cantidad*" required></li><li><input type="text" name="proyecto-'+nuevoId+'" class="art pr" placeholder="Proyecto*" required></li><li><textarea class="co" name="comentarios-'+nuevoId+'" placeholder="Comentarios"></textarea></li><li class="title bgFont delMovil" data-id="ul-'+nuevoId+'">Eliminar</li></ul>');

                new Aplicacion.Componentes.AutocompletarProductosCliente()
                .cargarComponente(nodoFila.querySelector('.price'));

 				$("#wrapper_ul").append(nodoFila);
 			}else{
                let nodoFila = CargarComponente('<ul class="pricing-table hide-for-large" id="ul-'+nuevoId+'"><li class="title bgFont ">'+nuevoId+'</li><li class="price"><input id="entrada" type="text" name="articulo-'+nuevoId+'" class="art ar" placeholder="Artículo*" required><ul class="list-group list-products"></ul></li><li class="description"><input type="text" name="medida-'+nuevoId+'" class="art me" placeholder="Medida*" required></li><li><input type="text" name="cantidad-'+nuevoId+'" class="art ca" placeholder="Cantidad*" required></li><li><input type="text" name="proyecto-'+nuevoId+'" class="art pr" placeholder="Proyecto*" required></li><li><select name="estatus-'+nuevoId+'" required class="art es"><option value="0">En proceso</option><option value="1">Realizado</option><option value="2">No realizado</option></select></li><li><textarea class="co" name="comentarios-'+nuevoId+'" placeholder="Comentarios"></textarea></li><li><input type="text" name="fecha_entrega-'+nuevoId+'" class="art fe" placeholder="Fecha de entrega"></li><li class="title bgFont delMovil" data-id="ul-'+nuevoId+'">Eliminar</li></ul>');
                
                new Aplicacion.Componentes.AutocompletarProductosCliente()
                .cargarComponente(nodoFila.querySelector('.price'));

 				$("#wrapper_ul").append(nodoFila);
 			}
 			
 		}else{
 			alert('No se puede agregar la fila, refresque su navegador');
 		}
 	});


 	$(document).on('click','.delMovil',function(e){
	 	
	 	if(confirm("¿Está seguro de eliminar éste elemento?")){

	 		var domeleiment = $(this).attr('data-id');
	 		var elemtInt 	= domeleiment.split('ul-');
	 		if(isNaN(parseInt(elemtInt[1]))===false){

	 			var viejoId = $("#limitmobil").val();
	 			var nuevoId = parseInt(viejoId)-1;
	 			
	 			if(nuevoId <= 0){
	 				alert('No se pueden eliminar todas las filas');
	 			}else{

	 				$("#"+domeleiment).remove(); 				 			 
		 				i =1;													
						$('#wrapper_ul > ul').each(function() {
							if(i <= nuevoId){

								ul = $(this).attr('id');							
								$("#"+ul).attr('id','ul-'+i);
								$(this).find('li:first').text(i);
								$(this).find('.ar').attr('name','articulo-'+i);
								$(this).find('.ca').attr('name','cantidad-'+i);
								$(this).find('.me').attr('name','medida-'+i);
								$(this).find('.pr').attr('name','proyecto-'+i);
								$(this).find('.co').attr('name','comentarios-'+i);
								$(this).find('.fe').attr('name','fecha_entrega-'+i);
									
							}
							i++;
						});

					$("#limitmobil").val(nuevoId);					
	 			} 			
	 		}else{
	 			alert('No se puede eliminar la fila, refresque su navegador');
	 		}
	 	}else{
	 		return false;
	 	}	 	

	});

	$(".chg_status").click(function(){

		if(confirm("¿Ésta seguro de realizar la operación, la requisición se enviará a estatus de realizado?")){

			var dataEstatus = $(this).attr('data-estatus');
			var elements 	= dataEstatus.split('-');
			var idr 		= elements[0];
			var estatus 	= elements[1];
			var action		= $(this).attr('href');
			
			if(isNaN(parseInt(idr))===false){

				$.ajax({
	               type: "POST",
	               url: action,
	               dataType:'json',
	               data: {idr:idr, estatus:estatus},
	               success: function(data){                    
	                     if(data.code == 1){
	                        alert(data.txt);
	                        location.reload();                   	                                                
	                     }else{
	                        alert(data.txt);
	                     }
	                }
	            });


			}else{
				alert('Error operación no realizable, inténte de nuevo');
			} 
			
			return false;

		}else{
			
			return false;

		}		
	});

	$("#btn_borrador").click(function(){
		$("#fr-req").append("<input type='hidden' value='1' name='borrador' id='borrador'>");		
	});
	
	$("#btn_borrador-mov").click(function(){
		$("#fr-req-mov").append("<input type='hidden' value='1' name='borrador' id='borrador'>");		
	});

 });