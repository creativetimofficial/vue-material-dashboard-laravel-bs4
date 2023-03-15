@extends('layouts.app')

@section('content')
<br>
<div class="container-fluid mt-7">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card bg-secondary shadow">
              <div class="card-header bg-white border-0">
                  <div class="row align-items-center">
                      <div class="col-8">
                          <h3 class="mb-0">{{ __('Adicione uma Marca') }}</h3>
                      </div>
                      <div class="col-4 text-right">
                          <a href="/brands" class="btn btn-sm btn-primary">{{ __('Voltar à lista') }}</a>
                      </div>
                  </div>
              </div>


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <form role="form" id="createBrandies" method="post" action="/brands?redirect=true">
                        @csrf
                        {{ method_field('POST') }}
                      <div class="form-group">
                        <div class="col">
                            <label for="name" class="form-control-label">Nome da Marca:</label>
                            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nome" name="name" id="name">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col">
                            <label for="description" class="form-control-label">Descrição da Marca:</label>
                            <input type="text" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Descrição..." name="description" id="description">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col">
                            <label for="markup" class="form-control-label">Imagem da Marca:</label>
                          <input type="file" class="form-control {{ $errors->has('url_image_path') ? ' is-invalid' : '' }}" required name="url_image_path">
                        </div>
                      </div>
                      <div class="text-center">
                        <input type="submit" class="btn btn-success" value="Criar Marca">
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@prepend('js')

<!-- Inclusão do jQuery-->
<script src="http://code.jquery.com/jquery-1.11.1.js"></script>
<!-- Inclusão do Plugin jQuery Validation-->
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.js"></script>
<script>

  jQuery.validator.setDefaults({
  highlight: function(element) {
      jQuery(element).closest('.form-control').addClass('is-invalid');
  },
  unhighlight: function(element) {
      jQuery(element).closest('.form-control').removeClass('is-invalid');
  },
  errorElement: 'span',
  errorClass: 'label label-danger',
  errorPlacement: function(error, element) {
      if(element.parent('.input-group').length) {
          error.insertAfter(element.parent());
      } else {
          error.insertAfter(element);
      }
    }
  });
  $( "#createCategories" ).validate({
    rules: {
        name: {
            required: true
        },
        url_image_path: {
            required: true
        }
    },
    messages:{
        name: {
            required: "O campo Nome da Marca deve ser preenchido"
        },
        url_image_path:{
            required:"O campo Url de Imagem da Marca deve ser preenchido"
        }
    }
  });

</script>
@endprepend