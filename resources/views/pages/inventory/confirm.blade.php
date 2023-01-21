<x-layouts.app-layout>
    @inject('category', 'App\Models\Category')
    <div class="container">
        <div class="flex justify-center">
            <div class="max-w-[500px] w-[100%] p-[30px] border border-dashed border-green-400 mb-6">
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="name">Product name</label>
                    <input class="bg-gray-50 border focus:outline-none border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700  dark:text-white "
                           id="name"
                           type="name"
                           value="{{ session('createData')['name'] }}"
                           placeholder="Straw Berry"
                           readonly>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="price">Price</label>
                    <input class="bg-gray-50 border focus:outline-none border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 dark:bg-gray-700  dark:text-white "
                           id="price"
                           type="number"
                           value="{{ session('createData')['price'] }}"
                           readonly>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="name">Category</label>
                    <input class="bg-gray-50 border focus:outline-none border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700  dark:text-white "
                           id="name"
                           type="name"
                           value="{{ $category->find(session('createData')['category_id'])->name }}"
                           placeholder="Straw Berry"
                           readonly>
                </div>
                @if (session('createData')['description'] ?? false)
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                               for="message">Description</label>
                        <div class="focus:outline-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                             wrap="physical"
                             placeholder="Write your thoughts here...">
                            {{ session('createData')['description'] ?? null }}
                        </div>
                    </div>
                @endif
                <div class="grid grid-cols-3 gap-3 mb-6">
                    @foreach (session('base64Images', []) as $image)
                        <div
                             class="block h-[100px] p-2 cursor-pointer bg-white border border-gray-200 rounded-lg shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <img class="w-[100%] h-[100%]"
                                 src="{{ $image['url'] }}"
                                 alt="image">
                        </div>
                    @endforeach
                </div>
                <div class="flex -mx-2 justify-end mb-6">
                    <a class="text-white mx-2 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-red-700 dark:focus:ring-green-800"
                       type="submit"
                       href="{{ route('inventory.create') }}">Cancel</a>
                    <form action="{{ route('inventory.store') }}"
                          method="POST">
                        @csrf
                        @method('POST')
                        <button class="text-white mx-2 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app-layout>
