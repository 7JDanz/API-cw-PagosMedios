<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Computer World</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>
  <body id="bg-image">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
            <div class="container">
            <a class="navbar-brand" href="https://www.uecomputerworld.edu.ec/">
                    <img src="../images/logo.png" alt="">
                    <img src="../images/slog.png" alt="">
                </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">

            </div>
            </div>
        </nav>

    <div class="container">
        <div class="bg"></div>

	<div class="row justify-content-around">
        <div class="w-50 p-3"></div>
        <div class="col-md-12" id="columna1">

            <div class="w-50 p-3"></div>
			<div class="row">
				<div class="col-md-4 rounded">
					<h4>
						Información Requerida
					</h4>
                    <!--<form role="form" action="buscar/persona" method="GET">-->
                    <form>
                        {{ csrf_field() }}
                        <div class="form-group form-selectRadio">
                            <label for="exampleInputText1">
								Pago por concepto
							</label>
                            <div id="selectRadio" class="btn-group pull-right" data-toggle="buttons">
                                <label class="btn btn-secondary active">
                                  <input type="radio" name="options" id="option1" value="Pensión" checked>
                                  <i class="fa fa-university" aria-hidden="true"></i> Pensión
                                </label>
                                <!--<label class="btn btn-secondary">
                                  <input type="radio" name="options" id="option2" value="Matrícula">
                                  <i class="fa fa-graduation-cap" aria-hidden="true"></i> Matrícula
                                </label>-->
                            </div>
                        </div>
                        <div class="form-group">
							<label for="exampleInputText1">
								# Ingrese el código del estudiante
							</label>
							<input type="text" class="form-control" name="identificacion" id="identificacion" autofocus="autofocus" placeholder="Código" required="required">
						</div>
                        <div class="form-group" id="selectMes">
                            <label for="exampleFormControlSelect1">Mes de Pensión</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                              <option value="1">Enero</option>
                              <option value="2">Febrero</option>
                              <option value="3">Marzo</option>
                              <option value="4">Abril</option>
                              <option value="5">Mayo</option>
                              <option value="6">Junio</option>
                              <option value="7">Julio</option>
                              <option value="8">Agosto</option>
                              <option value="9">Septiembre</option>
                              <option value="10">Octubre</option>
                              <option value="11">Noviembre</option>
                              <option value="12">Diciembre</option>
                            </select>
                        </div>
						<button type="submit" id="btn-buscar" class="btn btn-primary float-right">
							<i class="fa fa-search" aria-hidden="true"></i> Buscar
						</button>
					</form>
				</div>
				<div class="col-md-8 rounded">
                    <div class="form-group">
                        <h4>Datos del Representante</h4>
                    </div>
					<a id="modal-911093" href="#modal-container-911093" role="button" class="btn" data-toggle="modal">
                        <i class="fa fa-user-circle" aria-hidden="true"></i> Representante Legal: <span id="nombre_respresentante"></span>
                    </a>



                    <div class="w-50 p-3"></div>

					<table class="table table-bordered">
						<thead>
							<tr>
                                <th>
                                    Cantidad
                                </th>
								<th>
									Concepto
								</th>
								<th>
									Estudiante
								</th>
								<th>
									Codigo Grado
								</th>
							</tr>
						</thead>
						<tbody id="datos_factura">
						</tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table" style="line-height: 0.5">
                                <tbody id="detalle_factura">
                                    <tr>
                                        <td>Subtotal 12%</td><td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Subtotal 0%</td><td>0</td>
                                    </tr>
                                    <tr>
                                        <td>Descuento:</td><td>0</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total</strong></td><td>0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
				    </div>

                    <div class="row">
                        <div class="col"></div>
                        <div class="col col-6 text-center">
					        <button id="pagar" type="button" class="btn btn-success btn-md btn-block" disabled="disabled">
						        <i class="fa fa-credit-card-alt" aria-hidden="true"></i> Pagar <span id="valor"></span>
                            </button>
                        </div>
                        <div class="col"></div>
                    </div>
				</div>
			</div>
		</div>
    </div>
    <div class="modal fade" id="modal-container-911093" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">
                        Información del representante
                    </h5>

                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">

                        <label for="inputName"> Nombres </label>
                        <input type="text" class="form-control" id="inputName" autofocus="autofocus" disabled>

                        <label for="inputLast_Name"> Apellidos </label>
                        <input type="text" class="form-control" id="inputLast_Name" autofocus="autofocus" disabled>

                        <label for="inputAddress"> Dirección </label>
                        <input type="text" class="form-control" id="inputAddress" autofocus="autofocus" disabled>
                        <div class="col-xs-2">
                            <label for="inputPhone"> Teléfono </label>
                            <input type="text" class="form-control" id="inputPhone" autofocus="autofocus" disabled>
                        </div>
                        <div class="col-xs-3">
                            <label for="inputEmail"> Email </label>
                            <input type="text" class="form-control" id="inputEmail" autofocus="autofocus" disabled>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>

        </div>

    </div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script_cw.js"></script>


  </body>
</html>
