<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Cobro de comisiones</title>
    <style>
      body {
        padding: 20px;
      }

      .navbar {
        margin-bottom: 20px;
      }
    </style>
  </head>
    <body>
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
    </ul>
  </div>
</nav>
      <main role="main">
      <br>
        <div class="modal-content">
          <form id="formProduto" class="form-horizontal">
            <div class="modal-header">
              <h5 class="modal-title">Cobro de comisión</h5>
            </div>
            <div class="modal-body">
            <div class="form-group">
                <label for="ModoAmbiente" class="control-label">Modo de ambiente</label>
                <br>
                <label>
              <input type="radio" name="test" value="false"> Pruebas
             </label>
             <br>
            <label>
              <input type="radio" name="test" value="true"> Producción
            </label>
              </div>
              <div class="form-group">
                <label for="Merchand_id" class="control-label">Merchand ID</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="Merchand_id" placeholder="Merchand_id" required>
                </div>
              </div>
              <div class="form-group">
                <label for="secret_key" class="control-label">LLave secreta(sk)</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="secret_key" placeholder="LLave secreta" required>
                </div>
              </div>
              <div class="form-group">
                <label for="customer_id" class="control-label">Customer id</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="customer_id" placeholder="Id Cliente" required>
                </div>
              </div>
              <div class="form-group">
                <label for="Monto" class="control-label">Monto</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="Monto" placeholder="Monto de la comisión" required>
                </div>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary btn-block">Salvar</button>
            </div>
          </form>
        </div>
      
      </main>
    </div>
    <script src="{{ asset('js/app2.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    function crearComision() {

        let produto = {
            ModoAmbiente: $("input[name='test']:checked").val(),
            Merchand_id: $('#Merchand_id').val(),
            secret_key: $('#secret_key').val(),
            customer_id: $('#customer_id').val(),
            Monto: $('#Monto').val()
        };

        console.log(produto);

        $.ajax({
            type: 'POST', //aqui puede ser igual get
            url: '/api/createComision', //aqui va tu direccion donde esta tu funcion php
            data: produto, //aqui tus datos
            success: function(response) {
                var data = JSON.parse(response)
                console.log(data);
                mensaje();
                $('#customer_id').val('');
                $('#Monto').val('');
            },
            error: function(data) {
                mensajeError();
                console.log("bad");
            }
        });
    }

    $('#formProduto').submit(function(event) {
        event.preventDefault();
        crearComision();
    });

    function mensaje() {

      Swal.fire(
      'Comisión exitosa',
      'Saldo cobrado exitosamente',
      'success'
      );
    }

    function mensajeError() {

      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Ocurrio un error, revisa los logs para mayor información',
      });
    }

    </script>
 
  </body>

</html>