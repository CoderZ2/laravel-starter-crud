<x-layouts.app-layout>
    <div class="container">
        <div class="grid grid-cols-4 gap-5 mb-5">
            @foreach ($stores as $store)
                <div
                     class="max-w-sm relative bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                     <div class="absolute top-2 right-3 bg-lime-500 py-[0.2rem] px-2 flex items-center text-white rounded-md leading-0">1kg/ {{ $store->price }}$</div>
                    <a href="{{ route('inventory.edit', ['id' => $store->id]) }}">
                        <img class="rounded-t-lg w-full"
                             src="{{  Storage::url($store->images->first()->url) }}"
                             alt="image" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $store->name }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise
                            technology acquisitions of 2021 so far, in reverse chronological order.</p>
                        <a class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-lime-700 rounded-lg hover:bg-lime-800 focus:ring-4 focus:outline-none focus:ring-lime-300 dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800"
                           href="#">
                            Read more
                            <svg class="w-4 h-4 ml-2 -mr-1"
                                 aria-hidden="true"
                                 fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.app-layout>
