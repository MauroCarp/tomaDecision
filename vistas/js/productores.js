// const distritos = ['BELGRANO','ARMSTRONG','BOUQUET','ITURRASPE','LA CALIFORNIA','LAS PAREJAS','LAS ROSAS','MONTES DE OCA','TORTUGAS','TORTUGAS AG ACA'];

const distritos = ['IRIONDO','ANDINO','BERRETTA','BUSTINZA','CA&ntilde;ADA DE GOMEZ','CLARKE','CLASSON','CORREA','LARGUIA','LUCIO V LOPEZ','OLIVEROS','SALTO GRANDE','SAN ESTANISLAO','SAN RICARDO','SERODINO','TOTORAS','VILLA ELOISA','CARRIZALES'];

const iva = ['RI','MT','EX','CF'];

const tipoDoc = ['DNI','CUIL','CUIT'];

const tipoExplotacion = ['CabaÃ±a','CIA','CrÃ­a','CrÃ­a/Invernada','Feedlot','U.P Feedlot'];

const regimen = ['Arrendatario','CapitalizaciÃ³n','Pastajero','Propietario'];

const utf8 = (texto)=>{
  
  let respuesta;
  
  switch (texto) {
    case 'CabaÃ±a':

        respuesta = 'Cabaña';

      break;
      
    case 'CrÃ­a':

      respuesta = 'Cría';
      
    break;
  
    case 'CrÃ­a/Invernada':

      respuesta = 'Crí­a/Invernada';
      
    break;
  
    case 'CapitalizaciÃ³n':

      respuesta = 'Capitalización';
      
    break;
  
    default:
      respuesta = texto;
      break;
  }

  return respuesta;
}

/*=============================================
EDITAR PRODCUTOR
=============================================*/
$(".tablas").on("click", ".btnEditarProductor", function(){

	var idProductor = $(this).attr("idProductor");

	var datos = new FormData();
    
  datos.append("idProductor", idProductor);

    $.ajax({

      url:"ajax/productores.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
      	$("#idEdit").val(respuesta["productor_id"]);
      	
        $("#renspaEdit").val(respuesta["renspa"]);
	      
        $("#propietarioEdit").val(respuesta["propietario"]);
	      
        $("#establecimientoEdit").val(respuesta["establecimiento"]);
	      
        $("#tipoExplotacionEdit").html(generarSelect(tipoExplotacion, respuesta["explotacion"],'explotacion'));
	      
        $("#regimenEdit").html(generarSelect(regimen,respuesta["regimen"],null));
	      
        $("#tipoDocEdit").html(generarSelect(tipoDoc,respuesta["tipoDoc"],null));

        $("#numDocEdit").val(respuesta["numDoc"]);
        
        $("#ivaEdit").html(generarSelect(iva,respuesta["iva"],'iva'));

        $("#telefonoEdit").val(respuesta["telefono"]);

        $("#mailEdit").val(respuesta["email"]);

        $("#domicilioEdit").val(respuesta["domicilio"]);

        respuesta["localidad"] == 'CAÃ‘ADA DE GOMEZ' ? $("#localidadEdit").val('Cañada de Gómez') : $("#localidadEdit").val(respuesta["localidad"]); 

        $("#provinciaEdit").val(respuesta["provincia"]);
       
        switch (respuesta["departamento"]) {
          case 8:
            
            $("#departamentoEdit").val('IRIONDO');
            
            break;
        
          case 1:
            
            $("#departamentoEdit").val('BELGRANO');

            break;
        
          default:
            break;
        }
       
        $("#distritoEdit").html(generarSelect(distritos,respuesta["distrito"],'distritos'));
        
	  }

  	})

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarProductor", function(){

	var idProductor = $(this).attr("idProductor");
	// console.log(idProductor);
  
	swal({
        title: '¿Está seguro de borrar el productor?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar productor!'
      }).then(function(result){
        
        if (result.value) {
          
            window.location = "index.php?ruta=productores&idProductor=" + idProductor;

        }

      })

})

/*=============================================
GENERAR SELECTS
=============================================*/

const generarSelect = (array,valueBD,tipo)=>{
  console.log(valueBD);
  
  let select = '';
  
  array.forEach((value,key)=>{
    
    tipo == 'distritos' ? select += `<option value="${key}" ` : select += `<option value="${value}" `;

    if (tipo == 'distritos') {
      
      if(valueBD == key)
        select += 'selected';

    }

    if(valueBD == value)
      select += 'selected';


    if(tipo == 'iva'){
      
      switch (value) {
        case 'RI':
            select += '>Responsable Inscripto</option>';
          break;
      
        case 'MT':
            select += '>Responsable Monotributo</option>';
          break;
      
        case 'EX':
            select += '>Exento</option>';
          break;
      
        case 'CF':
            select += '>Consumidor Final</option>';
          break;
      
        default:
          break;
      }

    }else{
      
      select += `>${utf8(value)}</option>`;

    }

  });
  
  return select;

}
