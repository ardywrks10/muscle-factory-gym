<x-admin-layout>
    <h2 class="mb-6 text-2xl font-semibold text-gray-700">
        Dashboard
    </h2>

    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3">
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
            <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full ">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 ">Total Users</p>
                <p class="text-lg font-semibold text-gray-700 ">{{$userCount}}</p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs ">
            <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full ">
                <i class="las la-film"></i>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 ">Total Movies</p>
                <p class="text-lg font-semibold text-gray-700 ">{{$movieCount}}</p>
            </div>
        </div>
        <!-- Card -->
        <div class="flex items-center p-4 bg-white rounded-lg shadow-sm">
            <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full ">
                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512" class="w-5 h-5">
                    <path fill="#0b65da" d="M345 39.1L472.8 168.4c52.4 53 52.4 138.2 0 191.2L360.8 472.9c-9.3 9.4-24.5 9.5-33.9 .2s-9.5-24.5-.2-33.9L438.6 325.9c33.9-34.3 33.9-89.4 0-123.7L310.9 72.9c-9.3-9.4-9.2-24.6 .2-33.9s24.6-9.2 33.9 .2zM0 229.5V80C0 53.5 21.5 32 48 32H197.5c17 0 33.3 6.7 45.3 18.7l168 168c25 25 25 65.5 0 90.5L277.3 442.7c-25 25-65.5 25-90.5 0l-168-168C6.7 262.7 0 246.5 0 229.5zM144 144a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/>
                </svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600 ">Total Genre</p>
                <p class="text-lg font-semibold text-gray-700 ">{{$genreCount}}</p>
            </div>
        </div>
        <!-- Card -->
    </div>

    <section>
        <div class="w-full overflow-hidden rounded-lg shadow-xs space-y-4 bg-white px-5 py-5">
            <h4 class="mb-4 text-lg font-semibold text-gray-600 ">
                Table Users
            </h4>
            <div class="w-full overflow-x-auto rounded-lg shadow-xs">
                <table class="w-full">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">User Image</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Role</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y ">
                        @foreach ($user as $key=>$item)
                            <tr class="text-gray-700 ">
                                <td class="px-4 py-3 text-sm">
                                    {{$loop->iteration}}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    <div class="w-20 rounded-full">
                                        @if ($item->user_img)
                                            <img src="{{ $item->user_img }}" class="object-cover w-12 h-12 border rounded-full border-neutral-200" />
                                        @else
                                            <div class="object-cover w-10 h-10 border text-2xl rounded-full bg-slate-50 text-slate-400 border-neutral-200 flex justify-center items-center">
                                                <i class="las la-user"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    {{$item->name}}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    {{$item->email}}
                                </td>

                                <td class="px-4 py-3 text-sm">
                                    {{$item->role}}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </section>
</x-admin-layout>

