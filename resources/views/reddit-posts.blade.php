
@section('content')
    <h1>Reddit Posts</h1>
    <ul>
        @foreach($posts['data']['children'] as $post)
            <li>
                <a href="{{ $post['data']['url'] }}" target="_blank">{{ $post['data']['title'] }}</a>
            </li>
        @endforeach
    </ul>
@endsection
