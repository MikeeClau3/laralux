@section('content')
<div class="container">
    <h1>Members</h1>
    <a href="{{ route('members.create') }}" class="btn btn-primary">Add Member</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Points</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->points }}</td>
                <td>
                    <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
