<div>
    @foreach ($pessoas as $pessoa )
        <h2>{{ $pessoa->nome }}</h2>
        <p>{{ $pessoa->idade }}</p>
    @endforeach
</div>