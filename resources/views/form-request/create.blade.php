<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create new request') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        @if (session('msg'))
                            <div class="alert mb-4 bg-indigo-50 rounded-lg py-5 px-6 mb-3 text-base text-yellow-70 inline-flex items-center w-full alert-dismissible fade show" role="alert">
                                <strong class="mr-2">
                                    {{ session('msg') }}
                                </strong>
                            </div>
                        @endif
                        @error('msg')
                            <div class="alert mb-4 bg-gray-800 rounded-lg py-5 px-6 mb-3 text-base text-white inline-flex items-center w-full alert-dismissible fade show" role="alert">
                                <strong class="mr-2">
                                    {{ $message }}
                                </strong>
                            </div>
                        @enderror
                        <div class="md:grid md:grid-cols-3 md:gap-6">

                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">New Request</h3>
                                    <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so be careful what you share.</p>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="{{ route('form-request.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                            <div class="col-span-6">
                                                <label for="theme" class="block text-sm font-medium text-gray-700"> Theme </label>
                                                <input type="text" name="theme" value="{{ old('theme') }}" id="theme" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('theme') border-red-500 @enderror">
                                                @error('theme')
                                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label for="message" class="block text-sm font-medium text-gray-700"> Message </label>
                                                <div class="mt-1">
                                                    <textarea id="message" name="message" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md @error('message') border-red-500 @enderror" placeholder="Your message...">
                                                        {{ old('message') }}
                                                    </textarea>
                                                </div>
                                                @error('message')
                                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>

                                            <div>
                                                <label class="block text-sm font-medium text-gray-700"> File </label>
                                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md @error('file') border-red-500 @enderror">
                                                    <input type="file" name="file" value="{{ old('file') }}">
                                                </div>
                                                @error('file')
                                                    <span class="flex items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
