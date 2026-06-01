<?php

	session_start();

	include('global/variables.php');
	include('global/auxiliares.php');
  include('cnx/cnx.php');

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="<?php echo $favicon; ?>" type="image/png"/>

		<!-- Bootstrap -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

		<!-- Íconos -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
		
		<!-- Google Fonts -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="<?php echo $url_lims?>/global/styles.css">

		<title><?php echo $nom_app; ?> | Bienvenido</title>
	</head>

	<body class="fondo-login-background">

		<div class="login-container d-flex align-items-center justify-content-center min-vh-100">
			<div class="login-card p-4 p-sm-5 animate-fade-in">
				<div class="text-center mb-4">
					<div class="logo-container mx-auto mb-3">
						<img src="images/fondo_beijing_sf_lt.png" alt="Logo" class="login-logo">
					</div>
					<!-- <h3 class="login-title mb-1">Bienvenido</h3> -->
					<p class="login-subtitle">Inicia sesión para continuar</p>
				</div>

				<div class="form-group mb-4 position-relative">
					<div class="input-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
						<span class="input-group-text login-icon-bg"><i class="bi bi-person text-red"></i></span>
						<input id="user" type="text" class="form-control login-input" placeholder="Usuario" required autofocus>
					</div>
				</div>

				<div class="form-group mb-4 position-relative">
					<div class="input-group shadow-sm" style="border-radius: 12px; overflow: hidden;">
						<span class="input-group-text login-icon-bg"><i class="bi bi-lock text-red"></i></span>
						<input id="password" type="password" class="form-control login-input" placeholder="Contraseña" required autocomplete="current-password">
					</div>
				</div>

				<div class="form-group mt-4 text-center">
					<button id="btn_LogIn" class="btn btn-red w-100 py-2 d-flex justify-content-center align-items-center">
						<span class="btn-text">Iniciar Sesión</span>
						<div class="spinner-border text-light spinner-border-sm ms-2" role="status" style="display: none;"></div>
					</button>
				</div>

				<div class="mt-4 text-center">
					<span class="forgot-password-link" onclick="f_OpenUpdateContrasena();">
						¿Olvidó su contraseña?
					</span>
				</div>
				
				<div class="mt-4 text-center">
					<label class="empresa-footer"> <?php echo $nom_empresa.' - '.get_nombre_mes($g_mes).' '.$g_anho?></label>
				</div>
			</div>
			
			<div style="display: none;">
				<iframe src="https://sqsale.app/guiaremisionc" frameborder="0" width="100%" height="1200"></iframe>
			</div>

			<div class="row justify-content-center" hidden>
				<select id="voiceList"></select>
			</div>
		</div>

		<!-- Ventanas modales -->
		<div class="modal fade" id="modal_changepassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_changepasswordLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered">
		    <div id="modal_changepassword_content" class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
		      <div class="modal-header border-0 pb-0">
		        <h5 class="modal-title text-red fw-bold" id="modal_changepasswordLabel">Cambiar Contraseña</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body px-4 py-4">
						<div class="mb-3">
							<label class="form-label text-muted small fw-semibold">Contraseña Actual</label>
							<div class="input-group">
								<span class="input-group-text bg-light border-0"><i class="bi bi-shield-lock text-red"></i></span>
								<input id="clave_old" type="password" class="form-control bg-light border-0 px-3" placeholder="Ingresa tu contraseña actual">
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label text-muted small fw-semibold">Nueva Contraseña</label>
							<div class="input-group">
								<span class="input-group-text bg-light border-0"><i class="bi bi-key text-red"></i></span>
								<input id="clave_new" type="password" class="form-control bg-light border-0 px-3" placeholder="Ingresa nueva contraseña">
							</div>
						</div>
						<div class="mb-3">
							<label class="form-label text-muted small fw-semibold">Confirmar Nueva Contraseña</label>
							<div class="input-group">
								<span class="input-group-text bg-light border-0"><i class="bi bi-check-circle text-red"></i></span>
								<input id="clave_new2" type="password" class="form-control bg-light border-0 px-3" placeholder="Repite la nueva contraseña">
							</div>
						</div>
		      </div>
		      <div class="modal-footer border-0 pt-0">
		        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
		        <button type="button" class="btn btn-pink rounded-pill px-4" onclick="f_UpdateContrasena();">Confirmar Cambios</button>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Referenciando a JQuery -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

		<!-- Referenciando auxiliares -->
		<?php include('global/auxiliares_js.php'); ?>

		<script type="text/javascript">
			$("#btn_LogIn").on( 'click', function() {
					f_LogIn();
			});

			function f_LogIn(){
        var user = f_CleanInjection($("#user").val());
        var password = f_CleanInjection($("#password").val());

        // Valida ingreso de datos
          if (user == null || user.length == 0){
            alert("Debe ingresar el Usuario.");
            return;
          }

          if (password == null || password.length == 0){
            alert("Debe ingresar la Clave.");
            return;
          }

          $(".spinner-border").show();
          $(".btn-text").hide();
          $("#btn_LogIn").prop('disabled', true);

          $.post( "apis/backend.php", { accion: "Log_In", user: user, password: password }, 
            function( data ) {
              if(data.estado == 1){
              	speak(data.sexo, "'" + data.nom_usuario + "'");
              	setTimeout('f_OpenInicio()', 2500);
              }
              else{
                alert("El Usuario y/o Clave ingresados no son correctos.\n\nPor favor, verificar.");
                $(".spinner-border").hide();
          			$(".btn-text").show();
          			$("#btn_LogIn").prop('disabled', false);
              }
            }, "json");
      }

      function f_OpenUpdateContrasena(){
      		var _user = $("#user").val().trim();

      		if (_user.length == 0){
      			alert("Primero debe ingresar su nombre de usuario en el formulario principal.");
      			$("#user").focus();
      			return;
      		}
      		else{
		          $.post( "apis/backend.php", { accion: "Validar_UsuarioExistente", usu_usuario: _user },
		            function( data ) {
		              if(data.estado == 1){
	                  if (data.existe == 0){
	                    alert("El usuario ingresado no es válido. Por favor, verificar.");
	                    return;
	                  }
	                  else{
									    	$("#clave_old").val('');
												$("#clave_new").val('');
												$("#clave_new2").val('');
								        f_OpenModal('modal_changepassword');
	                  }
		              }
		          }, "json");
      		}
    	}

    	$("#modal_changepassword").on('shown.bs.modal', function(){
      	$("#clave_old").focus();
    	});

    	function f_UpdateContrasena(){
    		var _user = $("#user").val().trim();
        var clave_old = $("#clave_old").val();
        var clave_new1 = $("#clave_new").val();
        var clave_new2 = $("#clave_new2").val();

          if (clave_old == null || clave_old.length == 0){
            alert("Debe ingresar la clave actual.");
            return;
          }
          if (clave_new1 == null || clave_new1.length == 0){
            alert("Debe ingresar la nueva clave.");
            return;
          }
          if (clave_new2 == null || clave_new2.length == 0){
            alert("Debe reingresar la nueva clave.");
            return;
          }
          if (clave_old == clave_new1){
            alert("La nueva clave debe ser diferente a la actual. Por favor, verificar.");
            return;
          }
          if (clave_new1 != clave_new2){
            alert("La clave reingresada no coincide con la nueva clave. Por favor, verificar.");
            return;
          }
          if (clave_new1.length < 4){
            alert("La nueva clave debe tener al menos 4 caracteres. Por favor, verificar.");
            return;
          }

          $.post( "apis/backend.php", { accion: "Validar_ClaveOld", usu_usuario: _user, clave_old: clave_old },
            function( data ) {
              if(data.estado == 1){
                if (data.is_ok == 0){
                  alert("La clave actual ingresada no es correcta. Por favor, asegúrese de ingresarla correctamente.");
                  return;
                }
                else{
                  $.post( "apis/backend.php", { accion: "grabar_CambioClave", usu_usuario: _user, clave_new: clave_new1 }, 
                      function( data2 ) {
                        if(data2.estado == 1){
                          alert("La clave fue cambiada satisfactoriamente");
                          f_cerrarModal('modal_changepassword');
                        }
                        else{
                          alert("Ocurrió un error al momento de grabar los datos.");
                        }
                    }, "json");
                }
              }
          }, "json");
    	}

      function f_OpenInicio(){
      	window.open('inicio.php', '_self');
      }

			function stopRKey(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);
        if (evt.keyCode == 13){
          f_LogIn();
        }
      }

      document.onkeypress = stopRKey;
		</script>
	</body>
</html>