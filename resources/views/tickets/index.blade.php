@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Управление тикетами</h1>

        <form method="GET" action="{{ route('tickets.index') }}" class="card mb-4">
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-3">
                        <label class="form-label">Статус</label>
                        <select name="status" class="form-select">
                            <option value="">Все</option>
                            <option value="new" @selected(request('status') === 'new')>Новый</option>
                            <option value="in_progress" @selected(request('status') === 'in_progress')>В работе</option>
                            <option value="done" @selected(request('status') === 'done')>Обработан</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Email клиента</label>
                        <input type="text"
                               name="email"
                               value="{{ request('email') }}"
                               class="form-control"
                               placeholder="example@mail.com">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Телефон</label>
                        <input type="text"
                               name="phone"
                               value="{{ request('phone') }}"
                               class="form-control"
                               placeholder="+380...">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Дата от</label>
                        <input type="date"
                               name="date_from"
                               value="{{ request('date_from') }}"
                               class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Дата до</label>
                        <input type="date"
                               name="date_to"
                               value="{{ request('date_to') }}"
                               class="form-control">
                    </div>

                </div>

                <div class="mt-3">
                    <button class="btn btn-primary">Фильтровать</button>

                    <a href="{{ route('tickets.index') }}"
                       class="btn btn-outline-secondary ms-2">
                        Сбросить
                    </a>
                </div>
            </div>
        </form>

        @if ($tickets->count())
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Клиент</th>
                    <th>Тема</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tickets as $ticket)
                    <tr>
                        <td>#{{ $ticket->id }}</td>

                        <td>
                            {{ $ticket->customer->email }}<br>
                            <small class="text-muted">
                                {{ $ticket->customer->phone }}
                            </small>
                        </td>

                        <td>{{ $ticket->subject }}</td>

                        <td>
                            <span class="badge bg-secondary">
                                {{ $ticket->status }}
                            </span>
                        </td>

                        <td>{{ $ticket->created_at->format('d.m.Y H:i') }}</td>

                        <td class="text-end">
                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-outline-primary">
                                Открыть
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $tickets->links() }}
        @else
            <div class="alert alert-info">
                Тикетов пока нет
            </div>
        @endif
    </div>
@endsection
