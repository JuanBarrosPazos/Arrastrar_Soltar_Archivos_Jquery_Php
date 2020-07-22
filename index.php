<!DOCTYPE html>

<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<title>Subir archivos arrastrar y soltar con PHP, jQuery</title>

	<script src="js/jquery-1.7.js"></script>
	<script src="js/jquery-1.7.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/dropzone.css" />
	<script src="js/dropzone.js" type="text/javascript"></script>

	<style type="text/css">
		.file_upload{
			border: 4px solid #28f;
			}
		h5{
			color: #28f;
			font-weight: bold;  
		}
	</style>

</head>

<body class="">

	<div class="container-fluid" style="min-height:500px;">

	<h5>Subir archivos arrastrar y soltar con PHP, jQuery</h5>
    <h5>Cargar Archivos Usando Drag and Drop</h5>
	  
	<div class="file_upload ">
		<form action="file_upload.php" class="dropzone">
			<div class="dz-message needsclick">
				<h5>ARRASTRA ARCHIVOS PARA SUBIRLOS</h5>
				<span class="note needsclick">
                <span class="glyphicon glyphicon-open" aria-hidden="true" style="font-size:60px;"></span>
                </span>
			</div>
		</form>		
	</div>
    	
 </div>	
    	
	<script src="js/bootstrap.min.js"></script>

</body>

</html>