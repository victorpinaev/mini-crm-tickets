@extends('layouts.app')

@section('title', 'Ticket #' . $ticket->id)

@section('content')

    <div class="mb-4">
        <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary btn-sm">
            ← Назад к списку
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <strong>Заявка #{{ $ticket->id }}</strong>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Клиент:</strong> {{ $ticket->customer->name }}</p>
                    <p><strong>Email:</strong> {{ $ticket->customer->email }}</p>
                    <p><strong>Телефон:</strong> {{ $ticket->customer->phone }}</p>
                </div>

                <div class="col-md-6">
                    <p><strong>Статус:</strong>
                        <span class="badge bg-secondary">
                        {{ $ticket->status }}
                    </span>
                    </p>

                    <p><strong>Создано:</strong>
                        {{ $ticket->created_at->format('d.m.Y H:i') }}
                    </p>

                    @if($ticket->answered_at)
                        <p><strong>Дата ответа:</strong>
                            {{ $ticket->answered_at->format('d.m.Y H:i') }}
                        </p>
                    @endif
                </div>
            </div>

            <hr>

            <div class="mb-3">
                <h5>Тема</h5>
                <p>{{ $ticket->subject }}</p>
            </div>

            <div class="mb-3">
                <h5>Сообщение</h5>
                <p>{{ $ticket->message }}</p>
            </div>

            @if($ticket->media->count())
                <hr>
                <h5>Файлы</h5>

                <table class="table table-sm align-middle">
                    <thead>
                    <tr>
                        <th>Файл</th>
                        <th class="text-end">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ticket->media as $file)
                        <tr>
                            <td>
                                {{ $file->file_name }}
                                <div class="text-muted small">
                                    {{ round($file->size / 1024, 1) }} KB
                                </div>
                            </td>
                            <td class="text-end">
                                <a href="{{ $file->getFullUrl() }}" target="_blank"
                                   class="btn btn-sm btn-outline-secondary me-1">
                                    Просмотр
                                </a>

                                <a href="{{ route('media.download', $file) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    Скачать
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- Смена статуса --}}
    <div class="card">
        <div class="card-header">
            Сменить статус
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('tickets.updateStatus', $ticket) }}">
                @csrf
                @method('PATCH')

                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Статус</label>
                        <select name="status" class="form-select">
                            <option value="new" @selected($ticket->status === 'new')>Новый</option>
                            <option value="in_progress" @selected($ticket->status === 'in_progress')>В работе</option>
                            <option value="done" @selected($ticket->status === 'done')>Обработан</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-primary">
                            Сохранить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

