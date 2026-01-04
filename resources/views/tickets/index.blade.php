@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Управление тикетами</h1>

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
