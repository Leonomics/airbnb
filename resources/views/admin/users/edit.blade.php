@extends('layouts.app')

@section('content')

    <div class="container mx-auto">
        <div class="relative grid grid-cols-1 gap-8">
            <h2 class="font-bold text-3xl text-gray-700">Modifica profilo</h2>
            <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                  <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                        Nome *
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="name" value="{{ old('name', $user->name) }}" id="name" required>
                      @error('name')
                      <div id="name" class="invalid-feedback">
                          {{ $message }}
                      </div>
                    @enderror
                    </div>

                    <div class="w-full md:w-1/2 px-3">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="surname">
                        Cognome *
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="surname" value="{{ old('surname', $user->surname) }}" id="surname" required>
                    </div>
                    @error('surname')
                      <div id="surname" class="invalid-feedback">
                          {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="date_of_birth">
                        Data di nascita
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="date" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}" id="date_of_birth">
                      @error('date_of_birth')
                            <div id="date_of_birth" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                        Email *
                      </label>
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="email" name="email" value="{{ old('email', $user->email) }}" id="email" required>
                        @error('email')
                            <div id="email" class="pt-2 text-red italic text-red-700 invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                        Password
                      </label>
                      <input class=" appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="password" name="password" id="password" placeholder="type new password">
                      @error('password')
                            <div id="password" class="pt-2 text-red italic text-red-700 invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>


                  <div class="flex flex-wrap -mx-3 mt-6">
                    <div class="w-full md:w-3/3 px-3 mb-6 md:mb-0">
                      <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="profile_pic">
                        <span class="uppercase">Immagine Profilo </span> <span class="text-sm">(max 2mb)</span>
                      </label>
                      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="file" name="profile_pic" id="profile_pic">
                      @error('profile_pic')
                            <div id="profile_pic" class="pt-2 text-red italic text-red-700 invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </div>


                <input type="submit" class="bg-red-500 p-3 mt-5 rounded text-white _save" value="Salva">
            </form>
            @if($user->profile_pic)
                <form class="absolute bottom-0 left-20" action="{{ route('admin.users.destroy', $user)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 p-3 mt-5 rounded text-white cursor-pointer"><i class="fa-solid fa-xmark"></i> Elimina immagine</button>
                </form>
            @endif

        </div>
    </div>

@endsection

<style>
  ._save:hover{
    cursor: pointer;
  }
</style>