<!DOCTYPE html>
<html lang="es">
<head>
    <title>Crud con codeigniter</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/960.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/estilos.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.1/themes/ui-darkness/jquery-ui.css" />
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>js/funciones.js"></script>
</head>
<body>
 
  <div class="container_12">
        <h1>Crud con codeigniter</h1>
        <div class="grid_12">
            <div class="grid_12" id="head">
                <div class="grid_2" id="head_nombre">Nombre</div>
                <div class="grid_3" id="head_email">Email</div>
                <div class="grid_2" id="head_registro">Fecha de registro</div>
                <div class="grid_2" id="head_eliminar">Eliminar</div>
                <div class="grid_2" id="head_editar">Editar</div>
            </div>
            <?php
            foreach($users as $fila):
            ?>
            <div class="grid_12" id="body">
                <div class="grid_2" id="nombre<?=$fila->id?>"><?=$fila->nombre?></div>
                <div class="grid_3" id="email<?=$fila->id?>"><?=$fila->email?></div>
                <div class="grid_2" id="registro<?=$fila->id?>"><?=$fila->registro?></div>
                <div class="grid_2" id="eliminar"><input type="button" value="Eliminar" id="<?=$fila->id?>" class="eliminar"></div>
                <div class="grid_2" id="editar"><input type="button" value="Editar" id="<?=$fila->id?>" class="editar"></div>
            </div>
            <?php
            endforeach;
            ?>
            <div class="grid_12" id="agregar"><input type="button" value="Añadir" id="<?=$fila->id?>" class="agregar"></div>
        </div>
    </div>
   
</body>
</html>