<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        @if(count($errors->all()) > 0)
            <div class="alert alert-danger">
                <ol>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                <span> {{ session('error') }} </span>
            </div>
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible mb-2" role="alert">
                <span> {{ session('success') }} </span>
            </div>
        @endif
    </div>
</div>
