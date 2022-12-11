@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="mb-3">
            <a href="{{ redirect()->back()->getTargetUrl() }}" class="block text-brand-500 pt-5 router-link-active"><i class="fa-chevron-left fa-solid"></i> Torna indietro</a>
        </div>
        <div class="mb-8 p-5 shadow-xl rounded-lg">
            <h1 class="text-5xl title font-bold mb-8">
                {{ $apartment->title }}
            </h1>
            <p class="text-2xl font-bold mb-2">Messaggio da {{ $message->name }} {{ $message->surname }}</p>
            <p class="text-lg font-bold mb-2 border-b-2 border-brand-400 pb-3">{{ $message->email }}</p>
            <p class="p-2 text-base">{{ $message->text }}</p>
        </div>
    </div>
@endsection