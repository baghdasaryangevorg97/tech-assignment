<!DOCTYPE html>
<html>
<head>
    <title>Website</title>
</head>
<body>
    <h1>Website</h1>
    <a href="{{ route('websites.create') }}">Create New website</a>
    <ul>
        @foreach ($websites as $website)
            <li>
                <a href="{{ route('websites.show', $website) }}">{{ $website->url }}</a>
                <a href="{{ route('websites.edit', $website) }}">Edit</a>
                <form action="{{ route('websites.destroy', $website) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>
