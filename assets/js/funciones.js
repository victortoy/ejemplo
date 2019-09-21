function enviarPeticion(objeto, metodo, datos, callback){
	$.ajax({
		url:'class/frontController.php',
		type:'POST',
		dataType: 'json',					
		data: {
				objeto: objeto,
				metodo: metodo,
				datos: datos
		},					
		success: function(respuesta){
			callback(respuesta)
		},
		error: function(xhr, status){
			console.log('Ocurrio un error')
		}
	})
}

function parsearFormulario(form){
	let formulario = $(form).serializeArray()
	let respuesta = {}
	for(let i = 0; i < formulario.length; i++){
		respuesta[formulario[i].name] = formulario[i].value
	}
	return respuesta
}