@if(session('success'))
    <div class="mb-4 p-4 bg-deep-green/10 border border-deep-green/20 text-deep-green rounded-md">
        <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm1-5a1 1 0 01-1 1h-2a1 1 0 110-2h2a1 1 0 011 1z" clip-rule="evenodd"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-4 bg-coral/10 border border-coral/20 text-coral rounded-md">
        <svg class="w-5 h-5 inline-block mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-4 p-4 bg-coral/10 border border-coral/20 text-coral rounded-md">
        <ul class="list-none space-y-1">
            @foreach($errors->all() as $error)
                <li class="flex items-start">
                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ $error }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif
