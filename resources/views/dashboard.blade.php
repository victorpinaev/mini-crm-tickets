@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h1>Админ-панель</h1>

        <div class="mt-4">
            @role('manager')
            <a href="{{ route('tickets.index') }}" class="btn btn-primary me-2">
                Управление тикетами
            </a>
            @endrole

            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button class="btn btn-outline-danger">
                    Выход
                </button>
            </form>
        </div>
    </div>
@endsection
