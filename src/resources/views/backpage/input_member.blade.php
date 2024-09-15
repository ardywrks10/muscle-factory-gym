@extends('components.admin-layout')

@section('admin-content')
    <div>
        <div>
            <!--<h4 class="mb-4 text-lg font-semibold text-gray-600">
                Input Data Batik
            </h4> -->
            <div class="px-6">
                <div class="min-w-0 p-6 bg-white rounded-lg shadow-xl ">
                    <h4 class="mb-4 font-semibold text-gray-600 ">
                        Masukkan Data Member
                    </h4>
                    <form enctype="multipart/form-data"
                        action="{{(isset($data))?route('member.update',$data->id):route('member.store')}}"
                        method="POST">
                        @csrf
                        @if(isset($data))@method('PUT')@endif
                        <div class="grid grid-cols-2 grid-rows-1 gap-8">
                            <div class="">
                                <div>
                                    <div class="mb-6">
                                        <label for="default-input"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Nama
                                            Member</label>
                                        <input type="text" id="nama" name="nama"
                                            value="{{(isset($data))?$data->nama:old('nama')}}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        @error('nama')
                                        <div class="text-xs text-red-800">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div>
                                    <div class="mb-6">
                                        <label for="default-input"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">No Telepon
                                            </label>
                                        <input type="text" id="no_telp" name="no_telp"
                                            value="{{(isset($data))?$data->no_telp:old('no_telp')}}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        </input>
                                        @error('no_telp')
                                        <div class="text-xs text-red-800">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label for="default-input"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Alamat
                                        </label>
                                    <input type="text" id="alamat" name="alamat"
                                        value="{{(isset($data))?$data->alamat:old('alamat')}}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    @error('alamat')
                                    <div class="text-xs text-red-800">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <button type="submit"
                                        class="text-white text-center bg-gradient-to-tl from-black to-green-500  font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                        Simpan Data
                                    </button>
                                </div>
                            </div>
                            <div class="">
                                <div class="mb-6">
                                    <label for="foto"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">File</label>
                                    <input type="file" id="foto" name="foto"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    @error('foto')
                                    <div class="text-xs text-red-800">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <div class="mb-6">
                                        <label for="default-input"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Email
                                            </label>
                                        <input type="text" id="email" name="email"
                                            value="{{(isset($data))?$data->email:old('email')}}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        </input>
                                        @error('email')
                                        <div class="text-xs text-red-800">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
