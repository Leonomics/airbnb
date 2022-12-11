@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="mb-3">
            <a href="{{ redirect()->back()->getTargetUrl() }}">Torna indietro</a>
        </div>
        <div class="mb-8">
            <h1 class="text-5xl title font-bold mb-8">
                {{ $apartment->title }}
            </h1>
            <p class="text-2xl font-bold mb-2">Tutti i messaggi</p>
            <table class="table-auto border-separate mb-4">                
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
                @foreach ($messages as $message)
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
                @endforeach
            </table>
        </div>  
    </div>
@endsection