<?php require('header.php');?>

<div class="container">
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
    
<?php require('footer.php');?>
<script type="text/javascript">
	$(function(){
		enviarPeticion('usuarios', 'select', {'':''}, function(r){			
			console.log(r)
			for(let i = 0; i < r.data.length; i++){
				$('#contenido').append('<tr>'+
      				'<th>'+r.data[i].id+'</th>'+
      				'<td>'+r.data[i].nombre+'</td>'+
      				'<td>'+r.data[i].login+'</td>'+
    				'</tr>')	
			}
		})
	})
</script>
</body>
</html>