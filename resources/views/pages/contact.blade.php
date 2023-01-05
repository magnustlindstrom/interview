@extends('layouts.front')

@section('content')
    <div class="w-2/3 m-auto flex flex-col items-center py-24">

        @if($errors->any())
            <div class="w-full bg-red-300 text-red-700 mb-8 rounded p-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif(session('success'))
            <div class="w-full bg-green-300 text-green-700 mb-8 rounded p-4">
                {{ session('success') }}
            </div>

            <a class="bg-gray-300 hover:bg-gray-500 mt-6 px-2 px-4 py-4 rounded-md transition-colors" href="/contact">Send another message</a>
        @endif

        @if(!session('success'))
            <form action="/contact" method="POST" class="w-full flex flex-col bg-white p-4 rounded gap-y-4">

                <div class="text-red-600">Vill du veta mera om projektet?<br>Skriv till mig!
                </div>

                <div class="flex flex-col">
                    <label for="name">Namn:</label>
                    <input type="text" name="name" id="name" class="border-gray-200 rounded-sm"
                           value="{{ old('name') }}">
                </div>

                <div class="flex flex-col">
                    <label for="email">e-post:</label>
                    <input type="email" name="email" id="email" class="border-gray-200 rounded-sm"
                           value="{{ old('email') }}">
                </div>

                <div class="flex flex-col">
                    <label for="content">Meddelande:</label>
                    <textarea id="content" name="content" class="border-gray-200 rounded-sm" rows="8">{{ old('content') }}</textarea>
                </div>

                <div>
                    <button type="submit"
                            class="py-2 px-4 bg-green-600 hover:bg-green-700 transition-colors text-white rounded">
                        Skicka
                    </button>
                </div>
            </form>
        @endif
    </div>
@endsection
