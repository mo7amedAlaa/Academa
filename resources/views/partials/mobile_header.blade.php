<header class="bg-white md:hidden shadow-md py-4">
    <div class="mx-auto flex items-center justify-between px-4">
        <div class="flex items-center space-x-4 w-12 h-12 rounded-full">
            <a href="{{ route('welcome') }}" class="w-full h-full rounded-full">
                <img src="{{ asset($settings['site_logo'] ?? 'logos/default-logo.png') }}" alt="Logo"
                    class="w-full h-full rounded-full font-bold text-blue-600">
            </a>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-blue-600">
                <i class="fas fa-shopping-cart text-lg"></i>
            </a>

            <button id="search-button" class="text-gray-600 hover:text-blue-600">
                <i class="fas fa-search text-lg"></i>
            </button>

            <button id="mobile-menu-button" class="text-gray-600 hover:text-blue-600">
                <i class="fas fa-bars text-lg"></i>
            </button>
        </div>
    </div>

    <div id="search-input-container" class="w-full px-4 py-2 bg-white border rounded-md shadow-lg hidden">
        <form action="{{ route('search') }}" method="GET" class="w-full">
            <input type="text" name="query" id="search-input" placeholder="Search..." value="{{ request('query') }}"
                autocomplete="off"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10">
            <button type="submit"
                class="p-2 bg-blue-500 right-0 top-1/2 transform absolute -translate-y-1/2 cursor-pointer text-white rounded-r-lg hover:bg-blue-600 transition">
                <i class="fas fa-search"></i> Search
            </button>
        </form>

        @if(request('query'))
        <ul class="mt-4">
            @foreach($searchResult['courses'] as $course)
            <li>
                <a href="{{ route('courses.show', $course->id) }}" class="block text-gray-700 hover:text-blue-600">
                    {{ $course->title }} (Course)
                </a>
            </li>
            @endforeach

            @foreach($searchResult['categories'] as $category)
            <li>
                <a href="{{ route('categories.courses', $category->id) }}"
                    class="block text-gray-700 hover:text-blue-600">
                    {{ $category->name }} (Category)
                </a>
            </li>
            @endforeach

            @foreach($searchResult['instructors'] as $instructor)
            <li>
                <a href="{{ route('instructor.review', $instructor->id) }}"
                    class="block text-gray-700 hover:text-blue-600">
                    {{ $instructor->user->name }} (Instructor)
                </a>
            </li>
            @endforeach
        </ul>
        @endif
    </div>

    <div id="mobile-menu" class="hidden bg-white border-t border-gray-200">
        <ul class="space-y-2 p-4">
            <li class="relative">
                <button id="categories-button"
                    class="w-full text-gray-600 hover:text-blue-600 flex items-center justify-between">
                    <span>Categories</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <ul id="categories-dropdown" class="hidden space-y-2 bg-white pl-4">
                    @foreach ($categories as $category)
                    @if (is_null($category->parent_id))
                    <li class="relative">
                        <button class="text-gray-600 hover:text-blue-600"
                            onclick="toggleSubcategories({{ $category->id }})">
                            {{ $category->name }}
                        </button>
                        @if ($category->subcategories->count() > 0)
                        <ul id="subcategory-{{ $category->id }}" class="hidden pl-4">
                            @foreach ($category->subcategories as $subcategory)
                            <li>
                                <button class="text-gray-600 hover:text-blue-600"
                                    onclick="toggleSubSubcategories({{ $subcategory->id }})">
                                    {{ $subcategory->name }}
                                </button>
                                @if ($subcategory->subcategories->count() > 0)
                                <ul id="subsubcategory-{{ $subcategory->id }}" class="hidden pl-4">
                                    @foreach ($subcategory->subcategories as $subsubcategory)
                                    <li>
                                        <a href="{{ route('categories.courses', $subsubcategory->id) }}"
                                            class="block text-gray-600 hover:text-blue-600">
                                            {{ $subsubcategory->name }}
                                        </a>
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
            </li>

            <li><a href="{{ route('instructors.create') }}" class="text-gray-600 hover:text-blue-600">Become an
                    Instructor</a></li>

            @auth
            @if(auth()->user()->hasRole('student'))
            <li><a href="{{ route('student.dashboard') }}" class="text-gray-600 hover:text-blue-600">Dashboard</a></li>
            @elseif(auth()->user()->hasRole('instructor'))
            <li><a href="{{ route('instructors.dashboard') }}" class="text-gray-600 hover:text-blue-600">Instructor
                    Dashboard</a></li>
            @endif
            <li><a href="{{ route('logout') }}" class="text-gray-600 hover:text-red-600">Logout</a></li>
            @else
            <li><a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Login</a></li>
            <li><a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600">Register</a></li>
            @endauth
        </ul>
    </div>

</header>
<script>
    // Toggle search bar visibility for mobile
    document.getElementById('search-button').addEventListener('click', function () {
        document.getElementById('search-input-container').classList.toggle('hidden');
    });

    // Toggle mobile menu visibility
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    // Toggle subcategories in mobile header
    function toggleSubcategories(categoryId) {
        const subcategoryMenu = document.getElementById('subcategory-' + categoryId);
        subcategoryMenu.classList.toggle('hidden');
    }

    // Toggle sub-subcategories in mobile header
    function toggleSubSubcategories(subcategoryId) {
        const subSubcategoryMenu = document.getElementById('subsubcategory-' + subcategoryId);
        subSubcategoryMenu.classList.toggle('hidden');
    }

</script>