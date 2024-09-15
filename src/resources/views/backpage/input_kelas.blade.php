@extends('components.admin-layout')

@section('admin-content')
    <div>
        <div>
            <!--<h4 class="mb-4 text-lg font-semibold text-gray-600 ">
                Input Data Batik
            </h4> -->
            <div class="px-6">
                <div class="min-w-0 p-6 bg-white rounded-lg shadow-xl ">
                    <h4 class="mb-4 font-semibold text-gray-600 ">
                        Masukkan Data kelas
                    </h4>
                    <form enctype="multipart/form-data"
                        action="{{(isset($data))?route('kelas.update',$data->id):route('kelas.store')}}"
                        method="POST">
                        @csrf
                        @if(isset($data))@method('PUT')@endif
                        <div class="grid grid-cols-2 grid-rows-1 gap-8">
                            <div class="">
                            <div class="mb-6">
                                    <label for="trainer"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Kelas</label>
                                    <select id="trainer" name="trainer_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        @foreach($trainer as $item)
                                        <option value="{{ $item->id }}"
                                            {{ (isset($data) && $data->id == $item->id) || old('id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id')
                                    <div class="text-xs text-red-800">{{ $message }}</div>
                                    @enderror
                                    <!-- Add more options as needed -->
                                    </select>
                                </div>
                                <div>
                                    <div class="mb-6">
                                        <label for="default-input"
                                            class="block mb-2 text-sm font-medium text-gray-900">Nama Kelas
                                            </label>
                                        <input type="text" id="nama_kelas" name="nama_kelas"
                                            value="{{(isset($data))?$data->nama_kelas:old('nama_kelas')}}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        </input>
                                        @error('nama_kelas')
                                        <div class="text-xs text-red-800">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label for="default-input"
                                        class="block mb-2 text-sm font-medium text-gray-900">Jadwal
                                        </label>
                                    <input type="text" id="jadwal" name="jadwal"
                                        value="{{(isset($data))?$data->jadwal:old('jadwal')}}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    @error('jadwal')
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
                                <div>
                                    <div class="mb-6">
                                        <label for="harga_perbulan"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Harga Perbulan
                                        </label>
                                        <input type="number" id="harga_perbulan" name="harga_perbulan"
                                            value="{{(isset($data))?$data->harga_perbulan:old('harga_perbulan')}}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        @error('harga_perbulan')
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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
