@extends('layout')

@section('content')
    <h1>@isset($product->id)
            Editar Produto - {{ $product->name }}
            <a class="btn btn-secondary text-white float-right"  href="{{ route('product.create') }}">
                Cadastrar Novo Produto
            </a>
        @else
            Criar Produto
        @endisset</h1>
    <div class='card'>
        <div class='card-body'>
            <form action="{{ $route }}" method="post" enctype="multipart/form-data">
                @if(request()->routeIs('product.edit'))
                    @method('PUT')
                @endif
                @csrf
                <div class="form-group">
                    <label for="name">Nome do produto</label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name" value="{{old('name') ?? $product->name ?? ''}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" name="description" rows='5'
                              class="form-control @error('description') is-invalid @enderror"
                              id="description">{{old('description') ?? $product->description ?? ''}}
                    </textarea>
                    @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Preço</label>
                    <input type="number" step="0.01"  name="price"
                           class="form-control @error('price') is-invalid @enderror"
                           id="price" placeholder="Digite o preço do produto"
                           value="{{old('price') ?? $product->price ?? ''}}">
                    @error('price')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
