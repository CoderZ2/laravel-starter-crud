<x-layouts.auth-layout>
    <div class="min-h-screen w-full flex justify-center items-center bg-no-repeat bg-center bg-cover"
         style="background-image: url('{{ asset('images/fruit-background.jpg') }}') ">

        <div
             class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow-md sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <form class="space-y-6"
                  action="#">
                <h5 class="text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h5>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="email">Your email</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                           id="email"
                           name="email"
                           type="email"
                           placeholder="name@company.com"
                           required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                           for="password">Your password</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                           id="password"
                           name="password"
                           type="password"
                           placeholder="••••••••"
                           required>
                </div>
                <div class="flex items-start">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-green-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-green-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                   id="remember"
                                   type="checkbox"
                                   value=""
                                   required>
                        </div>
                        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                               for="remember">Remember me</label>
                    </div>
                    <a class="ml-auto text-sm text-green-700 hover:underline dark:text-green-500"
                       href="#">Lost Password?</a>
                </div>
                <button class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                        type="submit">Login to your account</button>
                <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                    Not registered? <a class="text-green-700 hover:underline dark:text-green-500"
                       href="#">Create account</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.auth-layout>
