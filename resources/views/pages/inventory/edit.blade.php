<x-layouts.app-layout>
    <div class="container">
        <div class="flex justify-center">
            <form class="max-w-[520px] w-[100%] border p-[30px] border-dashed border-lime-400 mb-6"
                  id="editInventoryForm"
                  action="{{ route('inventory.updateConfirm') }}"
                  method="POST">
                @method('POST')
                @csrf
                @if (session('editInventoryData')['deleteImageIds'] ?? false)
                    @foreach (session('editInventoryData')['deleteImageIds'] as $id)
                        <input name="deleteImageIds[]"
                               type="hidden"
                               value="{{ $id }}">
                    @endforeach
                @endif
                <input name="id"
                       type="hidden"
                       value="{{ request('id') }}">
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="name">Product name</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-500 dark:focus:border-lime-500"
                           id="name"
                           name="name"
                           type="name"
                           value="{{ old('name', session('editInventoryData')['name'] ?? $store->name) }}"
                           placeholder="Straw Berry">
                    @error('name')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="price">Price</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-500 dark:focus:border-lime-500"
                           id="price"
                           name="price"
                           type="number"
                           value="{{ old('price', session('editInventoryData')['price'] ?? $store->price) }}"
                           placeholder="100">
                    @error('price')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="countries">Select an option</label>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-500 dark:focus:border-lime-500"
                            id="category_id"
                            name="category_id">
                        <option>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                    @selected(old('category_id', session('editInventoryData')['category_id'] ?? $store->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="message">Description</label>
                    <textarea class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-lime-500 focus:border-lime-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-500 dark:focus:border-lime-500"
                              id="message"
                              name="description"
                              rows="4"
                              placeholder="Write your thoughts here...">{{ old('description', session('editInventoryData')['description'] ?? $store->description) }}</textarea>
                </div>
                <div x-data="inventoryEdit">
                    <input type="file"
                           hidden
                           x-ref="upload"
                           @click="$el.value=''"
                           @change="storeImage($el)">
                    <div class="grid grid-cols-3 gap-3 mb-6">
                        <div class="block h-[100px] relative p-2  bg-white border border-gray-200 rounded-lg shadow-md  dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                             x-cloak
                             x-show="Object.keys(uploadImageProgress).length">
                            <div
                                 class="absolute z-10 bg-gray-300 bg-opacity-60 w-[100%] top-0 left-0 h-[100%] px-5 flex justify-center items-center">
                                <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div class="bg-lime-600 text-xs  font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                         x-transition
                                         x-bind:style="`width:${uploadImageProgress.percent}%`"
                                         x-text="uploadImageProgress.percent + '%'">0%</div>
                                </div>
                            </div>
                            <img class="w-[100%] h-[100%]"
                                 alt="image"
                                 x-bind:src="uploadImageProgress.url"
                                 loading="lazy">
                        </div>
                        @foreach ($store->images as $image)
                            <div class="block relative h-[100px] p-2 cursor-pointer bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700"
                                 x-ref="image-{{ $image->id }}">
                                <div
                                     class="hover:bg-slate-200 group/item absolute top-0 left-0 w-[100%] h-[100%] z-10 flex justify-center items-center">
                                    <svg class="w-6 h-6 text-red-500 invisible group-hover/item:visible"
                                         @click="removeDataImage('{{ $image->id }}')"
                                         xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </div>
                                <img class="w-[100%] h-[100%]"
                                     src="{{ asset($image->url) }}"
                                     alt="image"
                                     loading="lazy">
                            </div>
                        @endforeach
                        @foreach (session('base64Images', []) as $image)
                            <div
                                 class="block h-[100px] p-2 cursor-pointer bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                <img class="w-[100%] h-[100%]"
                                     src="{{ $image['url'] }}"
                                     alt="image"
                                     loading="lazy">
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
                        <div class="border-dashed h-[100px] cursor-pointer  border border-lime-400 flex justify-center items-center"
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
                        <button class="text-white mb-6 bg-lime-700 hover:bg-lime-800 focus:ring-4 focus:outline-none focus:ring-lime-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800"
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
        @vite(['resources/js/store/edit.js'])
    </x-slot:scripts>
</x-layouts.app-layout>
