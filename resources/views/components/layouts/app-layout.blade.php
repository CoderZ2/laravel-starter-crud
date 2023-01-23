@props([
    'scripts' => null,
])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <title>Home</title>
    @vite(['resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>
    <div id="root">
        <header id="header" class="sticky z-20 top-0 bg-opacity-[0.95] bg-white">
            <nav id="nav" class="py-4 mb-6 w-[100%] shadow-sm">
                <div class="container flex justify-between">
                    <h1>
                        <a class="italic flex justify-center items-center text-lime-500 text-3xl"
                           href="/"><span class="mr-1">Spring</span>
                            <svg id="Layer_1"
                                 height="35px"
                                 width="35px"
                                 version="1.1"
                                 xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                 viewBox="0 0 504.125 504.125"
                                 xml:space="preserve">
                                <path style="fill:#3A7F0D;"
                                      d="M339.772,0c0,0,44.536,108.954-146.337,182.138C89.719,221.893,10.059,323.789,105.173,481.193
                          c7.877-70.357,41.653-225.485,186.888-260.884c0,0-135.176,50.546-147.117,279.347c69.459,9.752,232.361,16.305,280.726-125.062
                          C489.536,187.817,339.772,0,339.772,0z" />
                                <path style="fill:#49A010;"
                                      d="M145.007,498.704c147.456-58.849,254.748-196.71,269.556-361.283C384.418,56.107,339.772,0,339.772,0
                          s44.536,108.954-146.337,182.138C89.719,221.893,10.059,323.789,105.173,481.193c7.877-70.357,41.653-225.485,186.888-260.884
                          C292.053,220.31,157.279,270.73,145.007,498.704z" />
                                <circle style="fill:#3A7F0D;"
                                        cx="90.459"
                                        cy="171.985"
                                        r="13.785" />
                                <g>
                                    <circle style="fill:#49A010;"
                                            cx="133.782"
                                            cy="158.2"
                                            r="9.846" />
                                    <circle style="fill:#49A010;"
                                            cx="124.921"
                                            cy="64.662"
                                            r="24.615" />
                                    <circle style="fill:#49A010;"
                                            cx="200.736"
                                            cy="120.785"
                                            r="7.877" />
                                    <circle style="fill:#49A010;"
                                            cx="266.713"
                                            cy="76.477"
                                            r="22.646" />
                                </g>
                            </svg>
                        </a>
                    </h1>
                    <form class="flex items-center"
                          action="{{ route('inventory.index') }}">
                        <label class="sr-only"
                               for="simple-search">Search</label>
                        <div class="relative w-[400px]">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                     aria-hidden="true"
                                     fill="currentColor"
                                     viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-lime-500 focus:border-lime-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-lime-500 dark:focus:border-lime-500"
                                   id="simple-search"
                                   name="search"
                                   type="text"
                                   value="{{ request('search') }}"
                                   placeholder="Search">
                        </div>
                        <button class="p-2.5 ml-2 text-sm font-medium text-white bg-lime-500 rounded-lg border border-lime-700 hover:bg-lime-800 focus:ring-4 focus:outline-none focus:ring-lime-300 dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800"
                                type="submit">
                            <svg class="w-5 h-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </form>

                    <ul class="flex items-center -mx-3">
                        @auth
                            <li class="mx-3">

                                <button class="text-white bg-lime-500 hover:bg-lime-800  focus:outline-none  font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800"
                                        id="dropdownDividerButton"
                                        data-dropdown-toggle="dropdownDivider"
                                        type="button">
                                    <svg class="w-6 h-6"
                                         xmlns="http://www.w3.org/2000/svg"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>

                                <!-- Dropdown menu -->
                                <div class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600"
                                     id="dropdownDivider">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                        aria-labelledby="dropdownDividerButton">
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                               href="{{ route('inventory.create') }}">Create Inventory</a>
                                        </li>
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                               href="#">Receipe</a>
                                        </li>
                                        <li>
                                            <a class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                               href="#">Earnings</a>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <form action="{{ route('auth.logout') }}"
                                              method="POST">
                                            @csrf
                                            @method('POST')
                                            <button class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                                                    href="/">Logout</button>
                                        </form>
                                    </div>
                                </div>

                            </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </header>
        <div id="content">
            {{ $slot }}
        </div>
    </div>

    {{ $scripts }}
</body>

</html>
