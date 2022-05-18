<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Watch all requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Id</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Theme</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Message</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Name</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Email</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">File</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Created</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Actions</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @foreach($formRequests as $request)
                                <tr>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $request->id }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ Str::limit($request->theme, 10, '...') }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ Str::limit($request->message, 30, '...') }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $request->author->name }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">{{ $request->author->email }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-center">
                                            <a href="{{ url($request->file_path) }}" target="_blank" id="">
                                                <button class="p-2 pl-5 pr-5 bg-blue-500 text-gray-100 text-xs rounded-lg focus:border-4 border-blue-300">
                                                    Watch
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-center">{{ $request->created_at }}</div>
                                    </td>
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-center text-sm" x-data>
                                            @if(!$request->processed)
                                                <button @click="send_processed_status('{{ $request->id }}')" class="text-xs p-2 px-5 bg-transparent border-2 border-blue-500 text-blue-500 text-sm rounded-lg hover:bg-blue-500 hover:text-gray-100 focus:border-4 focus:border-blue-300">
                                                    Process
                                                </button>
                                            @else
                                                <div class="text-center">Processed</div>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function send_processed_status(id) {
                let default_url = '{{ route('form-request.update', '@id@') }}'
                let url = default_url.replace('@id@', id)

                axios.put(url, {
                    processed: true,
                })
                    .then(function (response) {
                        window.location.reload();
                    })
                    .catch(function (error) {
                        alert('error');
                    });
            }
        </script>
    @endpush
</x-app-layout>
