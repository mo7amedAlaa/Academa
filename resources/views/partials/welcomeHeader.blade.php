<header class="bg-white shadow-md py-4">
    <div class="mx-auto flex items-center justify-between px-4">
        <div class="flex items-center space-x-4 w-12 h-12 rounded-full">
            <a href="{{ route('welcome') }}" class="w-full h-full rounded-full">
                <img src="{{ asset('logo.webp') }}" alt="Logo"
                    class="text-2xl w-full h-full rounded-full font-bold text-blue-600">
            </a>
        </div>


        <div class="relative mx-5 z-50">
            <button id="categories-button" class="text-gray-600 hover:text-blue-600 flex items-center space-x-2"
                aria-haspopup="true" aria-expanded="false">
                <span>Categories</span>
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>


            <ul id="categories-menu"
                class="absolute left-0 hidden bg-white border border-gray-200 rounded-lg shadow-lg mt-2 w-64">
                @foreach ($categories as $category)
                @if (is_null($category->parent_id))
                <li class="relative">
                    <button class="block px-4 py-2 text-gray-700 hover:bg-gray-100 flex items-center justify-between"
                        onclick="toggleSubcategories({{ $category->id }})">
                        <span>{{ $category->name }}</span>
                        @if ($category->subcategories->count() > 0)
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                        @endif
                    </button>

                    <!-- Subcategories Menu (Level 1) -->
                    @if ($category->subcategories->count() > 0)
                    <ul id="subcategory-{{ $category->id }}"
                        class="hidden absolute left-full top-0 bg-white border border-gray-200 rounded-lg shadow-lg mt-2 w-64">
                        @foreach ($category->subcategories as $subcategory)
                        <li class="relative">
                            <button
                                class="  px-4 py-2 text-gray-700 hover:bg-gray-100 flex items-center justify-between"
                                onclick="toggleSubSubcategories({{ $subcategory->id }})">
                                <span>{{ $subcategory->name }}</span>
                                @if ($subcategory->subcategories->count() > 0)
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                                @endif
                            </button>

                            <!-- Sub-subcategories Menu (Level 2) -->
                            @if ($subcategory->subcategories->count() > 0)
                            <ul id="subsubcategory-{{ $subcategory->id }}"
                                class="hidden absolute left-full top-0 bg-white border border-gray-200 rounded-lg shadow-lg mt-2 w-64">
                                @foreach ($subcategory->subcategories as $subsubcategory)
                                <li>
                                    <a href="{{ route('categories.courses', $subsubcategory->id) }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{
                                        $subsubcategory->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endif
                @endforeach
            </ul>
        </div>

        <div class="flex-1 mx-4 relative">
            <form action="{{ route('search') }}" method="GET" class="w-full">
                <input type="text" name="query" id="search-input" placeholder="Search..." value="{{ request('query') }}"
                    autocomplete="off"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10">

                @error('query')
                <ul
                    class="text-sm text-red-600 absolute right-0 w-full bg-white border border-gray-200 rounded-lg shadow-lg z-50 max-h-96 overflow-y-scroll">
                    <li class="block px-4 py-2">{{ $message }}</li>
                </ul>
                @enderror

                <button type="submit"
                    class="p-2 bg-blue-500 right-0 top-1/2 transform absolute -translate-y-1/2 cursor-pointer text-white rounded-r-lg hover:bg-blue-600 transition">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>

            @if(!empty(request('query')) && isset($searchResult) && ($searchResult['courses']->isNotEmpty() ||
            $searchResult['categories']->isNotEmpty() || $searchResult['instructors']->isNotEmpty()))
            <div
                class="absolute right-0 w-full bg-white border border-gray-200 rounded-lg shadow-lg z-50 max-h-96 overflow-y-scroll">
                <ul class="p-4 space-y-2">
                    @foreach($searchResult['courses'] as $course)
                    <li>
                        <a href="{{ route('courses.show', $course->id) }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            {{ $course->title }} (course)
                        </a>
                    </li>
                    @endforeach

                    @foreach($searchResult['categories'] as $category)
                    <li>

                        <a href="{{ route('categories.courses', $category->id) }}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            {{ $category->name }} (categories)
                        </a>
                    </li>
                    @endforeach

                    @foreach($searchResult['instructors'] as $instructor)
                    <li>
                        <a href=" {{route('instructor.review',$instructor->id)}}"
                            class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            {{ $instructor->user->name }} (instructor)
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @elseif(!empty(request('query')))
            <div
                class="absolute right-0 w-full bg-white border border-gray-200 rounded-lg shadow-lg z-50 max-h-96 overflow-y-scroll">
                <p class="text-center p-4 text-gray-700">No results found for "{{ request('query') }}".</p>
            </div>
            @endif
        </div>

        <nav class="flex items-center space-x-4">


            <ul class="flex space-x-6 items-center">
                @auth
                @if(auth()->user()->hasRole('student'))
                <li><a href="{{ route('student.dashboard') }}" class="hover:text-indigo-300">Dashboard</a></li>
                @elseif(auth()->user()->hasRole('instructor'))
                <li><a href="{{ route('instructors.dashboard') }}" class="hover:text-blue-300">Dashboard</a>
                </li>
                @endif
                <li><a href="{{ route('logout') }}" class="hover:text-red-300">Logout</a></li>
                @else
                <li><a href="{{route('instructors.create')}}"
                        class="text-gray-600 hover:text-blue-600 font-medium">instructor</a></li>
                <a href="{{ route('login') }}"
                    class="text-gray-600 hover:text-blue-600 font-medium border-2 px-4 py-2 rounded-lg block">Login</a>
                <a href="{{ route('register') }}"
                    class="text-gray-600 hover:text-blue-600 font-medium border-2 px-4 py-2 rounded-lg block">Register</a>
                @endauth
            </ul>

    </div>
    </div>
</header>

<script>
    // Toggle subcategory visibility (Level 1)
    function toggleSubcategories(categoryId) {
        const subcategoryMenu = document.getElementById('subcategory-' + categoryId);
        subcategoryMenu.classList.toggle('hidden');
    }


    function toggleSubSubcategories(subcategoryId) {
        const subSubcategoryMenu = document.getElementById('subsubcategory-' + subcategoryId);
        subSubcategoryMenu.classList.toggle('hidden');
    }


    document.getElementById('categories-button').addEventListener('click', function (event) {
        event.stopPropagation();
        const categoriesMenu = document.getElementById('categories-menu');
        categoriesMenu.classList.toggle('hidden');
    });


    document.addEventListener('click', function (event) {
        const categoriesMenu = document.getElementById('categories-menu');
        if (!categoriesMenu.contains(event.target) && !event.target.matches('#categories-button')) {
            categoriesMenu.classList.add('hidden');
        }
    });
</script>