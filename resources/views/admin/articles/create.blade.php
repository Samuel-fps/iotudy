@extends('adminlte::page')

@section('title', 'Nuevo artículo')

@section('content_header')
    <h1>Nuevo artículo</h1>
@endsection

@section('content')

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Título</label>
                <input type="text" class="form-control" id="title" name='title'
                    placeholder="Ingrese el nombre del artículo" minlength="5" maxlength="255" 
                    value="{{ old('title') }}">

                @error('title')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="form-group">
                <label for="">Slug</label>
                <input type="text" class="form-control" id="slug" name='slug' 
                    placeholder="Slug del artículo" readonly value="{{ old('slug') }}">

                @error('slug')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="form-group">
                <label>Introducción</label>
                <input type="text" class="form-control" id="introduction" name='introduction'
                    placeholder="Ingrese la introducción del artículo" minlength="5" maxlength="255"
                    value="{{ old('introduction') }}">

                @error('introduction')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="form-group">
                <label for="">Subir imagen</label>
                <input type="file" class="form-control-file" id="image" name='image'>

                @error('image')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>

            <div class="form-group w-5">
                <label for="">Desarrollo del artículo</label>
                <textarea class="ckeditor form-control" id="body" name="body">{{ old('body') }}</textarea>

                @error('body')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror
                
            </div>

            <label for="">Estado</label>
            <div class="form-group">
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Privado</label>
                    <input class="form-check-input ml-2" type="radio" name='status' 
                    id="status" value="0" checked>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="">Público</label>
                    <input class="form-check-input ml-2" type="radio" name='status' 
                    id="status" value="1">
                </div>

                
                @error('status')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror
            
            </div>

            <div class="form-group">
                <select class="form-control" name="category_id" id="category_id">
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }} {{ old('category_id') == $category->id ? 'selected' : '' }}">
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
       
                @error('category_id')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror
                
            </div>

            <input type="submit" value="Agregar artículo" class="btn btn-primary">
        </form>
    </div>
</div>

@endsection

@section('js')

<script>
    $(document).ready(function() {
        $('#title').on('keyup keydown blur', function() {
            // Obtener el valor del título
            var title = $(this).val();
            // Reemplazar espacios y caracteres especiales
            var slug = title.toLowerCase()
                .replace(/[^a-z0-9 -]/g, '') // eliminar caracteres no válidos
                .trim()
                .replace(/\s+/g, '-') // reemplazar espacios por guiones
                .replace(/-+/g, '-'); // reemplazar múltiples guiones por uno solo
            // Asignar el slug al campo correspondiente
            $('#slug').val(slug);
        });
    });
</script>

@endsection
