@extends('layouts.app')

@section('content')

    <section class="container mx-auto">

        <div class="mb-3">
            <a href="{{ route('admin.apartments.index') }}" class="block text-brand-500 pt-5 router-link-active"><i class="fa-chevron-left fa-solid"></i> Torna indietro</a>
        </div>        
        <h1 class="text-3xl lg:text-5xl  text-gray-700 title font-bold mb-4">
            {{$apartment->title}}
        </h1>
        <h3 class="text-2xl text-gray-500 mb-8">
            {{$apartment->address}}
        </h3>
        {{-- gallery slider --}}
        <div class="flex flex-col items-center mb-12">

            <figure class="overflow-hidden gallery rounded-xl">
                <img class="gallery_img" src="{{ $apartment->pic_path }}" alt="">
            </figure>


            @if($apartment->images)                
            <ul class="flex gallery_list flex-no-wrap py-4 gap-2 ">
                @foreach ($apartment->images as $image)
                <li class="gallery_pic">
                    <figure class=" cursor-pointer w-40 max-h-24 overflow-hidden rounded-xl">
                        <img class="h-full w-full object-cover object-center" src="{{$image->img_path}}" alt="">
                    </figure>
                    <div class="lg:flex hidden justify-center">
                        <form action="{{route('admin.images.destroy', $image)}}" method="post">
                            @csrf
                            @method('DELETE')

                            <input type="submit" value="Elimina" class="delete_btn mt-1 px-6 py-2 text-white bg-brand-500 rounded-xl text-xs cursor-pointer">
                        </form>
                        </div>
                </li>
                    @endforeach
                </ul>
            @endif

        </div>
            
        <div class="flex flex-wrap gap-12 mb-12">

            {{-- informazioni --}}
            <div class="p-10 shadow-md rounded-lg flex-grow">
                <h3 class="text-2xl text-gray-700 font-bold mb-2 text-center">
                    Informazioni
                </h3>
                
                <ul class="flex justify-around items-center flex-wrap h-full gap-6 mb-8">
                    <li>
                        <div class="font-bold  text-gray-700 text-center text-5xl">{{$apartment->rooms_number}}</div> <br>
                        <span class="text-center text-xl text-gray-500">Stanze</span>
                    </li>
                    <li>
                        <div class="font-bold text-gray-700 text-center text-5xl">{{$apartment->beds_number}}</div> <br>
                        <span class="text-center text-xl text-gray-500">Posti Letto</span>
                    </li>
                    <li>
                        <div class="font-bold text-gray-700 text-center text-5xl">{{$apartment->bath_number}}</div> <br>
                        <span class="text-center text-xl text-gray-500">Bagni</span>

                    </li>
                    <li>
                        <div class="font-bold text-gray-700 text-center text-5xl" > {{$apartment->meters}} </div> <br>
                        <span class="text-center text-xl text-gray-500">Metri Quadrati</span>

                    </li>
                </ul>
            </div>

            {{-- sponsorizzazione --}}
            
            <div class="p-10 flex-grow lg:flex-grow-0 shadow-md wrapper-sm rounded-lg overflow-hidden">
                    <p class="text-2xl text-center text-gray-700 font-bold mb-2"> Sponsorizazzione </p>
                    <ul class="flex justify-center h-full items-center gap-6">
                        <li>
                            <p class="text-2xl text-gray-500 mb-4">{{$plan_name}}</p>
                            @if ($expire !== '')
                                <p class="text-lg text-gray-500">Scade il: {{$expire}}</p>
                            @endif
                        </li> 
                    </ul>
            </div>
        </div>

        <div class="flex flex-wrap gap-12">

            
            {{-- servizi --}}
            <div class="p-10 shadow-md rounded-lg flex-grow">
                <p class="text-2xl text-gray-700 font-bold mb-2"> Servizi </p>
                <ul class="flex md:justify-around flex-wrap sm:flex-nowrap items-center h-full gap-6">
                    @forelse ($apartment->services as $service)
                    <li class="font-bold text-lg text-gray-700">
                        {{$service->name}}
                    </li>
                    @empty
                      <li class="font-bold text-3xl text-gray-500">Nessun servizio</li>
                    @endforelse 
                </ul>
            </div>
            
            {{-- ultimi messaggi --}}
            
            <div class="p-10 wrapper-sm shadow-md rounded-lg relative overflow-auto flex-grow">
                <p class="text-2xl text-gray-700 font-bold "> Ultimi messaggi </p>
                <ul class="">
                    @forelse ($apartment->messages()->orderBy('created_at', 'desc')->get() as $key => $message)
                    <a href="{{ route('admin.messages.show', [$apartment,$message]) }}">
                        
                        <li class="relative flex  flex-col gap-2 -ml-4 p-4 rounded-lg cursor-pointer border-0 border-b-1 border-gray-300">
                            <p class="mb-2 font-bold text-gray-700">
                                {{$message->name . ' ' . $message->surname}}
                            </p>
                            
                            <p class="truncate text-gray-500 ">
                                {{$message->text}}
                            </p>
                            
                            @if (!$message->viewed)
                                <span class="absolute dot right-0 top-1/2 h-2 w-2 -mr-4 translate-y-1/2 rounded-full bg-brand-500"></span>
                            @endif
                        </li>
                    </a>
                    @empty
                    <p class="text-gray-500 text-xl pt-6 text-center">
                        Ancora Nessun Messaggio
                    </p>
                    @endforelse 
                </ul>
            </div>
        </div>

        {{-- <div class="mb-8">
            <p class="text-2xl font-bold mb-2"> Ultimi messaggi </p>
            <table class="table-auto border-separate mb-4">
                @if ( count($apartment->messages) > 0 )
                    <tr class="text-left">
                        <th>
                            Nome
                        </th>
                        <th>
                            Cognome
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Testo
                        </th>
                        <th></th>
                    </tr>
                @endif
                @forelse ($apartment->messages()->orderBy('id', 'desc')->get() as $key => $message)
                    @if ($key < 5)
                        @php
                            $text = $message->text;
                        @endphp
                        <tr class="@if($message->viewed == false) bg-red-200 @endif">
                            <td>
                                {{ $message->name }}
                            </td>
                            <td>
                                {{ $message->surname }}
                            </td>
                            <td>
                                {{ $message->email }}
                            </td>
                            <td>
                                {{ strlen($text) > 50 ? substr($text,0,50)."..." : $text }}
                            </td>
                            <td>
                                <a href="{{ route('admin.messages.show', [$apartment,$message]) }}" class="block rounded-lg bg-green-400 text-white py-2 px-4">Leggi</a>
                            </td>
                        </tr>
                    @else
                        @break
                    @endif
                @empty
                    <tr>
                        <td colspan="5">
                            Nessun messaggio
                        </td>
                    </tr>
                @endforelse
            </table>
            @if (count($apartment->messages) > 5)
                <a href="{{ route('admin.messages.index', $apartment->id) }}" class="rounded-lg bg-blue-400 text-white py-2 px-4">Tutti i messaggi...</a>
            @endif
        </div> --}}
        <div class="flex flex-wrap gap-x-2 gap-y-4 py-8">

            <a href="{{route('admin.apartments.edit', $apartment)}}" class="flex-grow">
                <input class="w-full  cursor-pointer py-4 px-8 rounded-xl bg-brand-500 text-white shadow-md" type="button" value="Modifica Appartamento">
            </a>
            <form action="{{route('admin.apartments.destroy', $apartment)}}" method="post">
                @csrf
                @method('DELETE')
                <input type="submit" value=" Elimina" class="cursor-pointer py-4 px-8 rounded-xl text-brand-500  bg-white shadow-md ">
            </form>
        </div>
    </section>

@endsection