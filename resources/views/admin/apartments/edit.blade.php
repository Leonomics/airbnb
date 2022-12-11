@extends('layouts.app')

@section('content')

    <section class="container mx-auto">
        <div class="mb-3">
            <a href="{{ route('admin.apartments.index') }}" class="block text-brand-500 pt-5 router-link-active"><i class="fa-chevron-left fa-solid"></i> Annulla l'operazione</a>
        </div>
        <h1 class="text-4xl title font-bold mb-8">
            Modifica il tuo appartamento
        </h1>

        <form action="{{route('admin.apartments.update', $apartment)}}" method="post" enctype="multipart/form-data" id="form">
            @csrf
            @method('PUT')


            <div class="mb-8 title-wrapper">
                <label class="text-2xl block mb-4 font-bold" for="title">Modifica il titolo *</label>
                <input type="text" placeholder="Qui va il titlo del tuo annuncio" name="title" id="title" maxlength="255" required value="{{old('title', $apartment->title)}}"
                class="w-full px-4 py-4 rounded-xl @error('title') border border-red-700 @enderror">
                <div class="title-error"></div>

                @error('title')
                    <p class="text-red-700">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="text-2xl block mb-4 font-bold" for="image">Modifica l'immagine di copertina *</label>
                <input type="file" placeholder="Aggiungi l'immagine di copertina " name="image" id="image" value="{{old('image', $apartment->image)}}"
                class="w-full border px-4 py-4 rounded-xl @error('image') border border-red-700 @enderror">

                @error('image')
                    <p class="text-red-700">
                        {{$message}}
                    </p>
                @enderror
                <p class="hidden text-red-700" id="image_error">
                    The image failed to upload. Max size exceed.
                </p>
            </div>

            <div class="mb-8">
                <label class="text-2xl block mb-4 font-bold" for="images">Aggiungi o elimina foto dalla galleria</label>
                <div class="rounded-2xl border">
                    <input type="file" multiple placeholder="Aggiungi qui un'immagine" name="images[]" id="images" value="{{old('images', $apartment->images)}}"
                    class="w-full px-4 py-4 rounded-xl @error('images') border border-red-700 @enderror">
                    {{-- Gallery preview --}}
    
                    @if (count($apartment->images) > 0)
                        <ul class="flex items-center gap-2 relative pl-4 pb-4">
                            @foreach ($apartment->images as $img)
                                <li class="gallery_pic">
                                    <label for="{{$img->id}}" class="cursor-pointer">
                                        <figure class="h-12 w-24 overflow-hidden rounded-xl relative mb-2">
                                            <img class="w-full h-full object-cover object-center" src="{{$img->img_path}}" alt="">
                                        </figure>
                                    </label>
                                    <div class="flex">
                                        <input type="checkbox" name="delete_pic[]"  value="{{$img->id}}" id="{{$img->id}}" class="mr-1 cursor-pointer">
                                        <label for="{{$img->id}}" class="cursor-pointer">Elimina</label>
                                    </div>
                                </li>
        
                            {{-- @empty
                            <p class="text-bold text-xl">Aggiungi foto alla galleria</p> --}}
                            @endforeach
        
                            {{-- <li>
                                <label for="images" class="file flex">
                                    <input type="file" multiple name="images[]" id="images" class=" custom-file-input order-2 @error('images') border border-red-700 @enderror">
                                    <div class="custom_file _tooltip">
                                        <span class="_tooltiptext">Aggiungi immagine</span>
                                    </div>
                                </label>
                            </li> --}}
                        </ul>                        
                    @endif
                </div>


                @error('images.*')
                    <p class="text-red-700">
                        {{$message}}
                    </p>
                @enderror
                <p class="hidden text-red-700" id="images_error">
                    The image failed to upload. Max size exceed.
                </p>
            </div>
            <div class="text-2xl font-bold mb-4">Informazioni: </div>
            <div class="justify-between flex-row  md:flex md:gap-6 border p-3 rounded-lg items-center mb-4">

                <div class="meters-wrapper ">
                    <label class="block mb-4 font-bold" for="meters">Metri quadri *</label>
                    <input type="number" min="0" max="65535" placeholder="" name="meters" id="meters" required value="{{old('meters', $apartment->meters)}}"
                    class="w-full px-4 py-4 rounded-xl @error('meters') border border-red-700 @enderror">
                    <div class="meters-error"></div>

                    @error('meters')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>
                <div class="rooms-wrapper">
                    <label class="block mb-4 font-bold" for="rooms">N. Stanze *</label>
                    <input type="number" min="1" max="255" required placeholder="" name="rooms_number" id="rooms" required value="{{old('rooms_number', $apartment->rooms_number)}}"
                    class="w-full px-4 py-4 rounded-xl @error('rooms_number') border border-red-700 @enderror">
                    <div class="rooms-error"></div>

                    @error('rooms_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="beds-wrapper">
                    <label class="block mb-4 font-bold" for="beds">N. Posti letto *</label>
                    <input type="number" min="1" max="255" placeholder="" name="beds_number" id="beds" required value="{{old('beds_number', $apartment->beds_number)}}"
                    class="w-full px-4 py-4 rounded-xl @error('beds_number') border border-red-700 @enderror">
                    <div class="beds-error"></div>

                    @error('beds_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>

                <div class="baths-wrapper">
                    <label class="block mb-4 font-bold" for="baths">N. Bagni *</label>
                    <input type="number" min="0" max="255" placeholder="" name="bath_number" id="baths" required value="{{old('bath_number', $apartment->bath_number)}}"
                    class="w-full px-4 py-4 rounded-xl @error('rooms_number') border border-red-700 @enderror">
                    <div class="baths-error"></div>

                    @error('bath_number')
                        <p class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
                </div>


            </div>

            <div class="price-wrapper mb-6">
                <label class="text-2xl block mb-4 font-bold" for="price">Prezzo *</label>
                <input type="number" placeholder="Costo a notte" name="price" min="0" name="price" id="price" required value="{{old('price', $apartment->price)}}"
                class="w-full px-4 py-4 rounded-xl @error('price') border border-red-700 @enderror">
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
            <search-input-component page="edit" class="mb-6" api-key="{{ $key }}"></search-input-component>
            @error('address')
                <p class="text-red-700">
                    {{$message}}
                </p>
            @enderror

            <div class="flex flex-col gap-2 mb-6">

                <label class="text-2xl mr-2 font-bold">Visibilità *</label>
                <div class="rounded-2xl border pl-4 py-4">
                    <div class="mb-2">
                        <input class="p-2" @if($apartment->visible == true) checked @endif type="radio" name="visible" id="visible" value="true">
                        <label class="mr-2" @checked(true) for="visible">Visibile</label>
                    </div>
    
                    <div>
                        <input class="p-2" @if($apartment->visible == false) checked @endif type="radio" name="visible" id="hidden" value="false">
                        <label class="mr-2" for="hidden">Nascosto</label>
                    </div>
                </div>

                @error('visible')
                    <p class="text-red-700">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <div class="flex flex-col gap-2 mb-6">
                <label class="text-2xl font-bold">Servizi</label>
                    <ul class="flex-row  md:flex md:gap-6 md:justify-between border p-3 rounded-lg">
                        @foreach ($services as $service)
                            <li>
                                <input @if(in_array($service->id, old('services', $apartment->services->pluck('id')->all()))) checked @endif class="p-2" type="checkbox" name="services[]" id="{{$service->name}}" value="{{$service->id}}">
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

            {{-- <div class="flex flex-col gap-2 mb-4">
                <label class="mr-2 font-bold">Sponsorizzazione:</label>
                    <ul>
                        @foreach ($sponsors as $sponsor)
                            <li>
                                <input @if(in_array($sponsor->id, old('sponsor', $apartment->sponsors->pluck('id')->all()))) checked @endif class="p-2" type="radio" name="sponsor" id="{{$sponsor->plan}}" value="{{$sponsor->id}}">
                                <label class="mr-2" for="{{$sponsor->plan}}">{{$sponsor->plan}}</label>
                            </li>
                        @endforeach
                    </ul>
                    @error('sponsor')
                        <p  class="text-red-700">
                            {{$message}}
                        </p>
                    @enderror
            </div> --}}
            <input class="cursor-pointer w-full py-4 rounded-xl mb-3 bg-brand-400 hover:bg-brand-500 text-white" type="submit" id="submit" value="Modifica Appartamento">
        </form>
        <div><strong>*</strong> indica un campo obbligatorio</div>
    </section>|
@endsection


<style>

._tooltip {
  position: relative;
  display: inline-block;
}

._tooltip ._tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: #ff385c;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

._tooltip:hover ._tooltiptext {
  visibility: visible;
}

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
</style>