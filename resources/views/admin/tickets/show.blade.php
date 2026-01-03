<h2>{{ $ticket->subject }}</h2>
<p>{{ $ticket->message }}</p>

<h4>Files</h4>
<ul>
    @foreach($ticket->getMedia('attachments') as $file)
        <li>
            <a href="{{ $file->getUrl() }}" target="_blank">
                {{ $file->name }}
            </a>
        </li>
    @endforeach
</ul>

<form method="POST" action="{{ route('admin.tickets.update-status', $ticket) }}">
    @csrf
    @method('PATCH')

    <select name="status">
        @foreach(\App\Models\Ticket::STATUSES as $status)
            <option value="{{ $status }}">{{ ucfirst($status) }}</option>
        @endforeach
    </select>

    <button>Update status</button>
</form>
