<?php require('header.php');?>

<div class="container">
	<div class="row">
		<div class="col text-center">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUsuario" id="crearUsuario">
  				Crear
			</button>
		</div>		
	</div>
	<div class="row mt-2">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre</th>
					<th scope="col">Login</th>
					<th scope="col">Opciones</th>
				</tr>
			</thead>
			<tbody id="contenido">
			</tbody>
		</table>	
	</div>	
</div>

<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Nuevo usuario</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formularioUsuario">
					<div class="form-group">
    					<label for="nombre">Nombre</label>
    					<input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="emailHelp" placeholder="Nombre" required="required">
    				</div>
    				<div class="form-group">
    					<label for="login">Login</label>
    					<input type="text" class="form-control" id="login" name="login" aria-describedby="emailHelp" placeholder="Nombre" required="required">
    				</div>
    				<div class="form-group">
    					<label for="password">Contraseña</label>
    					<input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" placeholder="Nombre">
    				</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary btn-submit" id="botonCrearUsuario" form="formularioUsuario">Crear</button>
				<button type="submit" class="btn btn-secondary btn-submit" id="botonActualizarUsuario" form="formularioUsuario">Actualizar</button>
			</div>
		</div>
	</div>
</div>
    
<?php require('footer.php');?>
<script type="text/javascript">
	var id
	var boton

	$(function(){
		cargarRegistros({'':''}, 'crear', function(){
			console.log('Termino carga de registros!!!')
		})

		$('#crearUsuario').on('click', function(){
			$("#botonCrearUsuario").show()
			$("#botonActualizarUsuario").hide()
		})

		$('.btn-submit').on('click', function(){
			boton = $(this).attr('id')
		})

		$('#formularioUsuario').on('submit', function(e){	
			e.preventDefault()
			let datos = parsearFormulario($(this))
			if(boton == 'botonCrearUsuario'){			
				enviarPeticion('usuarios', 'insert', datos, function(r){
					cargarRegistros({id:r.insertId}, 'crear', function(){
						$('#modalUsuario').modal('hide')
					})
				})
			}else{
				datos.id = id			
				enviarPeticion('usuarios', 'update', datos, function(r){
					cargarRegistros({id:id}, 'actualizar', function(){
						$('#modalUsuario').modal('hide')
					})
				})
			}
		})		
	})

	function cargarRegistros(datos, accion, callback){
		let fila
		enviarPeticion('usuarios', 'select', datos, function(r){
			for(let i = 0; i < r.data.length; i++){
				fila +='<tr id='+r.data[i].id+'>'+
      				'<th>'+r.data[i].id+'</th>'+
      				'<td>'+r.data[i].nombre+'</td>'+
      				'<td>'+r.data[i].login+'</td>'+
      				'<td><button type="button" class="btn btn-primary" onClick="editarUsuario('+r.data[i].id+')">Editar</button></td>'+
    				'</tr>'
			}
			if(accion == 'crear'){
				$('#contenido').append(fila)
			}else{
				$('#'+r.data[0].id).replaceWith(fila)
			}
			callback()
		})
	}

	function editarUsuario(idUsuario){
		id = idUsuario
		$("#botonCrearUsuario").hide()
		$("#botonActualizarUsuario").show()
		enviarPeticion('usuarios', 'select', {id:idUsuario}, function(r){
			$.each(r.data[0], function(campo, valor){
				$('#'+campo).val(valor)
			})
			$('#modalUsuario').modal('show')
		})
	}
</script>
</body>
</html>