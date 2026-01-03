<form method="GET" class="mb-4">
    <input name="email" placeholder="Email" value="{{ request('email') }}">
    <input name="phone" placeholder="Phone" value="{{ request('phone') }}">

    <select name="status">
        <option value="">All statuses</option>
        @foreach(\App\Models\Ticket::STATUSES as $status)
            <option value="{{ $status }}" @selected(request('status') === $status)>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>

    <button type="submit">Filter</button>
</form>

<table>
    @foreach($tickets as $ticket)
        <tr>
            <td>{{ $ticket->id }}</td>
            <td>{{ $ticket->customer->email }}</td>
            <td>{{ $ticket->status }}</td>
            <td>
                <a href="{{ route('admin.tickets.show', $ticket) }}">
                    View
                </a>
            </td>
        </tr>
    @endforeach
</table>

{{ $tickets->links() }}
