@extends('layouts.app')

@section('content')
    <div class="container mx-auto flex flex-wrap gap-y-3 items-center justify-between mb-6">
        <div>
            <h2 class="text-3xl">Appartamenti</h1>
        </div>
        <div class="hidden sm:block">
            <a class="py-3 px-6 bg-white text-brand-500 shadow-md rounded-lg" href="{{ route('admin.apartments.create') }}">Aggiungi appartamento</a>
        </div>
        <a class="sm:hidden" href="{{ route('admin.apartments.create') }}">
            <div class="ml-auto flex justify-center items-center shadow-md h-10 w-10 rounded-full font-bold text-brand-500 bg-white">
                <span class="bar-1"></span>
                <span class="bar-2"></span>
            </div>
        </a>
    </div>
    <div class="container mx-auto">
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($apartments as $apartment)
                <div class="flex-col">
                    <li class="flex h-full flex-col relative">
                        <a href="{{ route('admin.apartments.show', $apartment) }}">
                            <figure class="pb-2/3 relative mb-3">
                                <img class="absolute w-full h-full object-cover object-center rounded-xl" src="{{ $apartment->pic_path }}" alt="">
                            </figure>
                        </a>                        
                            <div class="relative">
                                <a href="{{ route('admin.apartments.show', $apartment) }}">
                                    <h3 class="font-bold capitalize">
                                        {{ $apartment->title }}
                                    </h3>
                                </a>
                                <promotion-component class="px-1 absolute right-2 promotion" :apartment="{{$apartment}}"/>
                            </div>
                        @php
                            $unviewedMessages = 0;
                        @endphp
                        @foreach ($apartment->messages as $message)
                            @if ($message->viewed == false)
                                @php                                    
                                    $unviewedMessages++;
                                @endphp
                            @endif
                        @endforeach
                        @if ($unviewedMessages > 0)
                            <div class="absolute notification flex items-center justify-center  rounded-full h-6 w-6 text-center text-xs bg-red-500 text-white">
                                <span> {{ $unviewedMessages }} </span>
                            </div>
                        @endif                        
                    </li>     
                </div>
            @endforeach
        </ul>

        {{ $apartments->links() }}
    </div>
@endsection

