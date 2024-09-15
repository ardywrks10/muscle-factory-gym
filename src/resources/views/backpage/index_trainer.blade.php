@extends('components.admin-layout')

@section('admin-content')
    <script src="https://cdn.tailwindcss.com"></script>
    <div class="container">
        <h4 class="mb-4 text-lg font-semibold text-gray-600 ">
        </h4>
        <div class="grid mb-8 mt-18 ">
            <div class="min-w-0 p-6 bg-white shadow-soft-xl rounded-lg shadow-xs ">
                <h4 class="mb-4 font-semibold text-gray-600 ">
                    TABEL DATA TRAINER
                </h4>
                <div class="flex">
                    <div class="w-1/6">
                        <span>
                        <a href="{{route('trainer.create')}}" class="inline-block w-full px-2 py-3 my-4 text-xs font-bold text-center text-white uppercase align-middle transition-all ease-in border-0 rounded-lg select-none shadow-soft-md bg-150 bg-x-25 leading-pro bg-gradient-to-tl from-black to-green-500 hover:shadow-soft-2xl hover:scale-102">Tambah </a>
                        </span>
                    </div>
                </div>
                <table class="mt-8 w-full border-collapse border border-gray-400 table-auto">
                    <tbody>
                        <div class="relative overflow-x-auto shadow-md rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Gambar
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nama
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            No. Telp
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Alamat
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $item)
                                    <tr class="odd:bg-white even:bg-gray-50 border-b ">
                                        <td class=" px-4 py-2">
                                            <img src="{{ asset($item->foto) }}" alt=""
                                             class="w-full md:h-[60px] md:w-[60px]  h-48 inset-0 object-cover object-top rounded-lg"
                                             loading="lazy" />
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->nama }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->no_telp }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->alamat }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $item->email }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <span class="flex">
                                                <a href="{{ route('trainer.edit', $item->id) }}" <button
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white text-center rounded-lg bg-gradient-to-tl from-black to-green-500  active:bg-purple-600 hover:bg-yellow-400 focus:outline-none focus:shadow-outline-purple"
                                                    aria-label="Like">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                        fill="currentColor" class="bi bi-pencil-square text-white-600"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd"
                                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg>
                                                    </button>
                                                </a>

                                                <form action="{{ route('trainer.destroy', $item->id) }}" method="POST"
                                                    class="ml-2 flex items-center font-medium text-red-600  hover:underline mr-2">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Aapakah anda Yakin ingin menghapus data Produk?')"
                                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-white text-center bg-gradient-to-tl from-black to-green-500 rounded-lg active:bg-purple-600 hover:bg-red-500 focus:outline-none focus:shadow-outline-purple"
                                                        aria-label="Like">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                            fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                            <path
                                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6a.5.5 0 0 0-1 0Z" />
                                                            <path
                                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </tbody>
                </table>
                <div>
                    <div class="m-4">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
