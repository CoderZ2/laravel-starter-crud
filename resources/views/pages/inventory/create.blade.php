<x-layouts.app-layout>
    <div class="container">
        <div class="flex justify-center">
            <form class="max-w-[520px] w-[100%] border p-[30px] border-dashed border-green-400 mb-6"
                  action="{{ route('inventory.postConfirm') }}"
                  method="POST">
                @method('POST')
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="name">Product name</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                           id="name"
                           name="name"
                           type="name"
                           value="{{ session('createData')['name'] ?? old('name') }}"
                           placeholder="Straw Berry">
                    @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="price">Price</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                           id="price"
                           name="price"
                           type="number"
                           value="{{ session('createData')['price'] ?? old('price') }}">
                    @error('price')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="countries">Select an option</label>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            id="category_id"
                            name="category_id">
                        <option>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                    @selected(session('createData')['category_id'] ?? old('category_id') == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="message">Description</label>
                    <textarea class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                              id="message"
                              name="description"
                              rows="4"
                              placeholder="Write your thoughts here...">{{ session('createData')['description'] ?? old('description') }}</textarea>
                </div>
                <div x-data="storeCreate">
                    <input type="file"
                           hidden
                           x-ref="upload"
                           @click="$el.value=''"
                           @change="storeImage($el)">
                    <div class="grid grid-cols-3 gap-3 mb-6">
                        @foreach (session('base64Images', []) as $image)
                            <div
                                 class="block h-[100px] p-2 cursor-pointer bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <img class="w-[100%] h-[100%]"
                                     src="{{ $image['url'] }}"
                                     alt="image">
                            </div>
                        @endforeach
                        <template x-for="image in serverImages">
                            <div
                                 class="block h-[100px] p-2 cursor-pointer bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <img class="w-[100%] h-[100%]"
                                     alt="image"
                                     x-bind:src="image.url">
                            </div>
                        </template>
                        <div class="border-dashed h-[100px] cursor-pointer  border border-green-400 flex justify-center items-center"
                             x-show="maxImage"
                             @click="$refs.upload.click()">
                            <svg class="w-6 h-6"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button class="text-white mb-6 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                        type="submit">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <x-slot:scripts>
        <script>
            const serverData = {
                image: @json(session('base64Images', []))
            }
        </script>
        @vite(['resources/js/store/create.js'])
    </x-slot:scripts>
</x-layouts.app-layout>
