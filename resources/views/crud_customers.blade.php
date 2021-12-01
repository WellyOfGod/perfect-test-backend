@extends('layout')

@section('content')
    <h1>@isset($customer->id)
            Editar Cliente - {{ $customer->name }}
            <a class="btn btn-secondary text-white float-right"  href="{{ route('customer.create') }}">
                Cadastrar Novo Cliente
            </a>
        @else
            Cadastrar Cliente
        @endisset</h1>
    <div class='card'>
        <div class='card-body'>
            <form action="{{ $route }}" method="post" enctype="multipart/form-data">
                @if(request()->routeIs('customer.edit'))
                    @method('PUT')
                @endif
                @csrf
                <div class="form-group">
                    <label for="name">Nome do Cliente</label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name" value="{{old('name') ?? $customer->name ?? ''}}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                           value="{{ old('email') ?? $customer->email ?? '' }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $errors->first('email')  }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control @error('cpf') is-invalid @enderror" id="cpf" name="cpf" required
                           value="{{ old('cpf') ?? $customer->cpf ?? '' }}" placeholder="999.999.999-99">
                    @error('cpf')
                    <div class="invalid-feedback">
                        {{ $errors->first('cpf')  }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
@endsection
