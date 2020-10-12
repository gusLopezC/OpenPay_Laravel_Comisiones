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
      <li class="nav-item">
        <a class="nav-link" href="/produtos">Produtos</a>
      </li>
      <li  class="nav-item">
        <a class="nav-link" href="/categorias">Categorias</a>
      </li>
    </ul>
  </div>
</nav>
      <main role="main">
      <br>
        <div class="modal-content">
          <form id="formProduto" class="form-horizontal">
            <div class="modal-header">
              <h5 class="modal-title">Novo Produto</h5>
            </div>
            <div class="modal-body">
              <input type="hidden" id="id" class="form-control">
              <div class="form-group">
                <label for="nomeProduto" class="control-label">Nome do Produto</label>
                <div class="input-group">
                  <input type="text" class="form-control" id="nomeProduto" placeholder="Nome do produto">
                </div>
              </div>
              <div class="form-group">
                <label for="precoProduto" class="control-label">Preço</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="precoProduto" placeholder="Preço do produto">
                </div>
              </div>
              <div class="form-group">
                <label for="quantidadeProduto" class="control-label">Quantidade</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="quantidadeProduto" placeholder="Quantidade do produto">
                </div>
              </div>
              
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Salvar</button>
              <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      
      </main>
    </div>
    <script src="{{ asset('js/app2.js') }}"></script>

    <script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    function criarProduto() {
        let produto = {
            nome: $('#nomeProduto').val(),
            preco: $('#precoProduto').val(),
            estoque: $('#quantidadeProduto').val(),
            categoria_id: $('#departamentoProduto').val()
        };

        console.log(produto);

        $.post('/api/createComision', produto, function(data) {
            let produto = JSON.parse(data);
            console.log(produto);

            let linha = montarLinha(produto);
            $('#tabelaProdutos>tbody').append(linha);
        });
    }

    $('#formProduto').submit(function(event) {
        event.preventDefault();
        if($('#id').val() != '') {
            editarProduto();
        } else {
            criarProduto();
        }
    });

    </script>
 
  </body>

</html>