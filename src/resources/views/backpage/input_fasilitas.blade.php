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
                        Masukkan Data Fasilitas
                    </h4>
                    <form enctype="multipart/form-data"
                        action="{{(isset($data))?route('fasilitas.update',$data->id):route('fasilitas.store')}}"
                        method="POST">
                        @csrf
                        @if(isset($data))@method('PUT')@endif
                        <div class="grid grid-cols-2 grid-rows-1 gap-8">
                            <div class="">
                            <div class="mb-6">
                                    <label for="kelas"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">Kelas</label>
                                    <select id="kelas" name="kelas_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        @foreach($kelas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ (isset($data) && $data->id == $item->id) || old('id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kelas }}
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
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Nama Fasilitas
                                            </label>
                                        <input type="text" id="nm_fasilitas" name="nm_fasilitas"
                                            value="{{(isset($data))?$data->nm_fasilitas:old('nm_fasilitas')}}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        </input>
                                        @error('nama_kelas')
                                        <div class="text-xs text-red-800">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <label for="foto"
                                        class="block mb-2 text-sm font-medium text-gray-900 ">File</label>
                                    <input type="file" id="foto" name="foto"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    @error('foto')
                                    <div class="text-xs text-red-800">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="">
                                <div>
                                    <div class="mb-6">
                                        <label for="default-input"
                                            class="block mb-2 text-sm font-medium text-gray-900 ">Kapasitas
                                            </label>
                                        <input type="text" id="jadwal" name="kapasitas"
                                            value="{{(isset($data))?$data->kapasitas:old('kapasitas')}}"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                        @error('kapasitas')
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

