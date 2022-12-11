@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.apartments.index') }}" class="block text-brand-500 pt-5 router-link-active"><i class="fa-chevron-left fa-solid"></i>Torna indietro</a>
        </div>


        <h1 class="text-4xl title font-bold mb-8">
            Aggiungi un appartamento
        </h1>

        <div class="pb-8">
            <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data" id="form">
                @csrf
                <div class="flex flex-col gap-2 mb-4 title-wrapper">
                    <label class="text-2xl mr-2 font-bold" for="title">Titolo *</label>
                    <input class="p-2 flex-grow" type="text" name="title" maxlength="255" id="title" placeholder="Inserisci un titolo" value="{{ old('title') }}" required>
                    <div class="title-error"></div>

                    @error('title')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="flex border-0 flex-col gap-2 mb-6">
                    <label class="text-2xl mr-2 font-bold">Aggiungi immagine di copertina *</label>

                    {{-- IMAGE PREVIEW --}}

                    <preview-comp label="Scegli un'immagine di copertina" name="image" multiple="{{false}}"/>

                    @error('image')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                    <p class="hidden text-red-700" id="image_error">
                        Seleziona un'immagine valida. Dimensione massima 2 megabyte
                    </p>
                </div>

                <div class="flex flex-col gap-2 mb-6">
                    <label class="text-2xl mr-2 font-bold">Aggiungi immagine/i alla galleria</label>
                    {{-- <div class="rounded-2xl border py-4 pl-4">
                        <input type="file" name="images[]" accept="image/*" id="images" multiple>
                    </div> --}}

                    <preview-comp label="Scegli una o più immagini per la galleria" name="images[]" multiple="{{true}}" />

                    @error('images[]')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                    <p class="hidden text-red-700" id="images_error">
                        Selezione delle immagini valide. Dimensione massima 2 megabyte
                    </p>
                </div>

                
                <div class="text-2xl font-bold mb-4">Informazioni: </div>
                <div class="flex-row  md:flex md:gap-6 justify-between border p-3 rounded-lg items-center mb-4">
                    <div class="flex flex-col meters-wrapper">
                        <label class="mb-4 font-bold" for="meters">Metri quadri *</label>
                        <input class="px-4 py-4 flex-grow" type="number" min="0" max="65535" name="meters" id="meters" placeholder="" value="{{ old('meters') }}" required>
                        <div class="meters-error"></div>

                        @error('meters')
                            <p class="text-red-700">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="flex flex-col rooms-wrapper">
                        <label class="mb-4 font-bold" for="rooms">Numero camere *</label>
                        <input class="px-4 py-4 flex-grow" type="number" min="1" max="255" name="rooms_number" id="rooms" placeholder="" value="{{ old('rooms_number') }}" required>
                        <div class="rooms-error"></div>

                        @error('rooms_number')
                            <p class="text-red-700">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="flex flex-col beds-wrapper">
                        <label class="mb-4 font-bold" for="beds">Numero letti *</label>
                        <input class="px-4 py-4 flex-grow" type="number" min="1" max="255" name="beds_number" id="beds" placeholder="" value="{{ old('beds_number') }}" required>
                        <div class="beds-error"></div>

                        @error('beds_number')
                            <p class="text-red-700">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                    <div class="flex flex-col baths-wrapper">
                        <label class="mb-4 font-bold" for="baths">Numero bagni *</label>
                        <input class="px-4 py-4 flex-grow" type="number" min="0" max="255" name="bath_number" id="baths" placeholder="" value="{{ old('bath_number') }}" required>
                        <div class="baths-error"></div>

                        @error('bath_number')
                            <p class="text-red-700">
                                {{$message}}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-2 mb-4 price-wrapper">
                    <label class="text-2xl mr-2 font-bold" for="price">Prezzo *</label>
                    <input class="p-2 flex-grow" type="number" min="0" name="price" id="price" placeholder="Inserisci il prezzo" value="{{ old('price') }}" required>
                    <div class="price-error"></div>

                    @error('price')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                @php
                    $key = env('TOMTOM_API_KEY');
                @endphp
                <search-input-component page="create" class="mb-6" api-key="{{ $key }}"></search-input-component>

                @error('address')
                    <p class="text-red-700">
                        {{$message}}
                    </p>
                @enderror

                <div class="flex flex-col gap-2 mb-4">
                    <label class="text-2xl mr-2 font-bold">Visibilità *</label>
                    <div class="rounded-2xl border pl-4 py-4">
                        <div class="mb-2">
                            <input class="p-2" type="radio" name="visible" id="visible" value="true" required>
                            <label class="mr-2" for="visible">Visibile</label>
                        </div>
                        <div>
                            <input class="p-2" type="radio" name="visible" id="hidden" value="false">
                            <label class="mr-2" for="hidden">Nascosto</label>
                        </div>
                    </div>
                    <div class="visibility-error"></div>

                    @error('visible')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="flex flex-col gap-2 mb-6">
                    <label class="text-2xl mr-2 font-bold">Servizi</label>
                    <ul class="flex-row  md:flex md:gap-6 md:justify-between border p-3 rounded-lg">
                        @foreach ($services as $service)
                            <li>
                                <input class="p-2" type="checkbox" name="services[]" @if( in_array($service->id, old('service', []))) checked @endif id="{{$service->name}}" value="{{$service->id}}">
                                <label class="mr-2" for="{{$service->name}}">{{$service->name}}</label>
                            </li>
                        @endforeach
                    </ul>
                    @error('services.*')
                        <p  class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <input class="p-2 rounded-lg text-white bg-brand-400 hover:bg-brand-500 cursor-pointer mb-3 px-8 py-3" type="submit" id="submit" value="Salva">
            </form>
            <div><strong>*</strong> indica un campo obbligatorio</div>
        </div>
    </div>

@endsection


{{-- <script>
    var loadFile = function()
</script>



<style>

    /*style file selection button
    */
    input[type="file"]::file-selector-button{
        color: white;
        background-color: #ff385c;
        padding: 3px;
        cursor: pointer;
        padding: 5px;
        border-radius: 5px;
        border-color: transparent;
    }

    input[type="text"]{
        border: 1px solid #C3C6D1;
        border-radius: 8px;
    }

    input[type="number"]{
        border: 1px solid #C3C6D1;
        border-radius: 8px;
    }

    .image-preview{
        width: 300px;
        min-height: 100px;
        border: 2px solid #dddddd;
        margin-top:15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #cccccc
    }

    .image-preview__image{
        display: none;
        width: 100%;
    }
</style> --}}