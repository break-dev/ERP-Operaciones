<?php

if (!isset($_SESSION["nom_usuario"]) || !isset($_SESSION["des_sucursal"]) || !isset($_SESSION["modo_auditoria"])) {
  return;
}

// Navbar principal — diseño premium (versión más grande)
$navbar_maintop = '
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  .gelsac-navbar {
      background: rgba(20, 20, 20);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      box-shadow: 0 4px 15px rgba(0,0,0,.6);
      border-bottom: 1px solid rgba(255,255,255,0.1);
      height: 68px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 24px;
      gap: 0;
      font-family: "Inter", sans-serif;
      position: relative;
      z-index: 1030;
  }
  .gelsac-navbar::after {
    content: "";
    position: absolute;
    bottom: -1px; left: 0; right: 0;
    height: 3px;
    background: #d32f2f;
  }
.gelsac-nav-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-shrink: 0;
    position: relative;
    z-index: 2;
}
  .gelsac-nav-brand img { height: 28px; }  /* Tamaño reducido */
  .gelsac-menu-btn {
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 12px;
    width: 42px; height: 42px;
    display: flex; align-items: center; justify-content: center;
    color: #fff;
    font-size: 22px;
    cursor: pointer;
    transition: background .2s, color .2s;
    margin-left: 10px;
    text-decoration: none;
  }
  .gelsac-menu-btn:hover { background: rgba(255,255,255,.15); color: #ffa7a7ff; }
  .gelsac-nav-center {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      text-align: center;
      color: #fff;
      font-size: 16px;
      font-weight: 600;
      letter-spacing: .4px;
      pointer-events: none;
      white-space: nowrap;
  }
  .gelsac-nav-center span { color: #60ffafff; font-weight: 700; }
.gelsac-nav-right {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-shrink: 0;
    position: relative;
    z-index: 2;
}
  /* Botón Centro de Ayuda */
  .gelsac-help-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 20px;
    background: rgba(30, 30, 30, 0.7);
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 24px;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    font-family: "Inter", sans-serif;
    text-decoration: none;
    cursor: pointer;
    transition: all .22s cubic-bezier(.4,0,.2,1);
    white-space: nowrap;
    letter-spacing: .3px;
  }
  .gelsac-help-btn:hover {
    background: #d32f2f;
    border-color: #d32f2f;
    color: #ffffff;
    box-shadow: 0 4px 14px rgba(211, 47, 47, 0.4);
    transform: translateY(-1px);
  }
  .gelsac-help-btn i { font-size: 15px; }
  /* Dropdown usuario */
  .gelsac-user-toggle {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 6px 16px 6px 6px;
    background: rgba(0,0,0,0.4);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 28px;
    cursor: pointer;
    transition: background .2s;
    color: #fff;
    font-size: 14px;
    font-family: "Inter", sans-serif;
    font-weight: 500;
    white-space: nowrap;
  }
  .gelsac-user-toggle:hover { background: rgba(255,255,255,.1); }
  .gelsac-user-avatar {
    width: 34px; height: 34px;
    background: #d32f2f;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px;
    font-weight: 700;
    color: #ffffff;
    flex-shrink: 0;
  }
  .gelsac-user-info { display: flex; flex-direction: column; line-height: 1.3; }
  .gelsac-user-name { font-size: 13px; font-weight: 600; color: #fff; }
  /* Dropdown menu */
  .gelsac-dropdown {
    position: relative;
  }
  .gelsac-dropdown-menu {
    position: absolute;
    top: calc(100% + 12px);
    right: 0;
    background: rgba(30, 30, 30, 0.95);
    backdrop-filter: blur(12px);
    border-radius: 14px;
    box-shadow: 0 10px 35px rgba(0,0,0,.5);
    border: 1px solid rgba(255,255,255,0.1);
    min-width: 240px;
    padding: 10px;
    display: none;
    z-index: 9999;
    animation: ddFadeIn .2s ease;
    font-family: "Inter", sans-serif;
  }
  @keyframes ddFadeIn {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .gelsac-dropdown.open .gelsac-dropdown-menu { display: block; }
  .gelsac-dd-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    color: #eeeeee;
    transition: background .18s;
    text-decoration: none;
    border: none;
    width: 100%;
    background: none;
    font-family: "Inter", sans-serif;
  }
  .gelsac-dd-item:hover { background: rgba(255,255,255,0.1); color: #ffffff; }
  .gelsac-dd-item i {
    width: 36px; height: 36px;
    background: rgba(0,0,0,0.5);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 17px;
    color: #aaaaaa;
    flex-shrink: 0;
  }
  .gelsac-dd-item:hover i { background: #d32f2f; color: #ffffff; }
  .gelsac-dd-divider { border: none; border-top: 1px solid rgba(255,255,255,0.1); margin: 8px 0; }
  .gelsac-dd-logout i { color: #ef4444 !important; }
  .gelsac-dd-logout:hover { background: rgba(239, 68, 68, 0.1) !important; color: #ef4444 !important; }
  .gelsac-dd-logout:hover i { background: #ef4444 !important; color: #ffffff !important; }
  .gelsac-dd-audit i { color: #a855f7 !important; }
  .gelsac-dd-audit:hover { background: rgba(168, 85, 247, 0.1) !important; color: #a855f7 !important; }
  .gelsac-dd-audit:hover i { background: #a855f7 !important; color: #ffffff !important; }
</style>

<nav class="gelsac-navbar">
  <!-- Brand + menu -->
  <div class="gelsac-nav-brand">
    <img src="' . $img_logo . '" alt="Logo">
    <a class="gelsac-menu-btn" role="button" data-bs-toggle="modal" data-bs-target="#menuModal" title="Menú principal">
      <i class="bi bi-list"></i>
    </a>
  </div>

  <!-- Título centrado -->
  <div class="gelsac-nav-center">
    ' . $nom_app . ' &nbsp;<span id="nv_titulo"></span>
  </div>

  <!-- Acciones derecha -->
  <div class="gelsac-nav-right">

    <!-- Botón Centro de Ayuda -->
    <a href="centro-ayuda.html" target="_blank" class="gelsac-help-btn" title="Abrir Centro de Ayuda">
      <i class="bi bi-headset"></i>
      <span>Centro de Ayuda</span>
    </a>

    <!-- Dropdown usuario -->
    <div class="gelsac-dropdown" id="gelsac-user-dropdown">
      <div class="gelsac-user-toggle" onclick="toggleNavDropdown()">
        <div class="gelsac-user-avatar">' . strtoupper(substr($_SESSION['nom_usuario'], 0, 1)) . '</div>
        <div class="gelsac-user-info">
          <span class="gelsac-user-name">' . $_SESSION['nom_usuario'] . '</span>
        </div>
        <i class="bi bi-chevron-down" style="font-size:12px; color:rgba(255,255,255,.6); margin-left:3px;"></i>
      </div>

      <div class="gelsac-dropdown-menu">';

if ($_SESSION["modo_auditoria"] == 1) {
  if ($_SESSION["modo_auditoria_ison"] == 0) {
    $navbar_maintop .= '
			<button class="gelsac-dd-item gelsac-dd-audit" onclick="f_ModoAuditoria(1);">
				<i class="bi bi-shield-lock-fill"></i> Activar Modo Auditoría
			</button>
			<hr class="gelsac-dd-divider">';
  } else {
    $navbar_maintop .= '
			<button class="gelsac-dd-item gelsac-dd-audit" onclick="f_ModoAuditoria(0);">
				<i class="bi bi-shield-slash-fill"></i> Desactivar Auditoría
			</button>
			<hr class="gelsac-dd-divider">';
  }
}

$navbar_maintop .= '
			<button class="gelsac-dd-item gelsac-dd-logout" onclick="f_CerrarSesion();">
				<i class="bi bi-box-arrow-right"></i> Cerrar Sesión
			</button>
		</div>
	  </div>
	</div>
</nav>

<script>
function toggleNavDropdown() {
	var dd = document.getElementById("gelsac-user-dropdown");
	dd.classList.toggle("open");
}
document.addEventListener("click", function(e) {
	var dd = document.getElementById("gelsac-user-dropdown");
	if (dd && !dd.contains(e.target)) dd.classList.remove("open");
});
</script>

<div id="tst_container" class="toast-container position-fixed top-0 end-0 p-3"></div>
<div id="tst_visitas" class="toast-container position-fixed top-0 end-0 p-3"></div>';

$modal_clientescredito = '<div class="modal fade" id="modal_clientescredito_sendemail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_clientescredito_sendemailLabel" aria-hidden="true" style="display: none;">
															  <div class="modal-dialog">
															    <div class="modal-content">
															      <div class="modal-header">
															        <h1 class="modal-title fs-5" id="modal_clientescredito_sendemailLabel">Enviar Recordatorio</h1>
															        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															      </div>
															      <div class="modal-body">
															        <div class="row" style="padding: 5px;">
																				<div class="col-md-2 col-sm-2 col-xs-2" style="padding: 5px;">
																					Cliente:
																				</div>

																				<div class="col-md-10 col-sm-10 col-xs-10">
																					<textarea id="clientescredito_cliente" type="text" class="form-control col-md-12 col-xs-12" rows="2" disabled></textarea>
																				</div>
																			</div>

																			<div class="row" style="padding: 5px;">
																				<div class="col-md-2 col-sm-2 col-xs-2" style="padding: 5px;">
																					Correo:
																				</div>

																				<div class="col-md-10 col-sm-10 col-xs-10">
																					<input id="clientescredito_correo" type="email" class="form-control col-md-12 col-xs-12">
																				</div>
																			</div>

																			<div class="row" style="padding: 5px;">
																				<div class="col-md-2 col-sm-2 col-xs-2" style="padding: 5px;">
																					Texto:
																				</div>

																				<div class="col-md-10 col-sm-10 col-xs-10">
																					<textarea id="clientescredito_texto" type="text" class="form-control col-md-12 col-xs-12" rows="10"></textarea>
																				</div>
																			</div>
															      </div>

															      <input id="hd_idcliente" type="hidden">
															      <input id="hd_modograbar" type="hidden">

															      <div class="modal-footer">
															        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
															        <button type="button" class="btn btn-primary" onclick="f_GrabarCliente();">Enviar correo</button>
															      </div>
															    </div>
															  </div>
															</div>';

echo $modal_clientescredito;