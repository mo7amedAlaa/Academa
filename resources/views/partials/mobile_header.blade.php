<header class="bg-white lg:hidden shadow-md py-4 ">
    <div class="mx-auto flex items-center justify-between px-4">
        <div class="flex items-center space-x-4 w-12 h-12 rounded-full">
            <a href="{{ route('welcome') }}" class="w-full h-full rounded-full">
                <img src="{{ asset($settings['site_logo'] ?? 'logos/default-logo.png') }}" alt="Logo"
                    class="w-full h-full rounded-full font-bold text-blue-600">
            </a>
        </div>

        <div class="flex items-center space-x-4">
            <button id="search-button"
                class="text-gray-600 hover:text-blue-600 transition-all duration-200 ease-in-out text-lg sm:text-xl">
                <i class="fas fa-search"></i>
            </button>

            @auth
            <div class="relative group  ">
                <a href="#"
                    class=" text-gray-600 hover:text-blue-600 transition-all duration-200 ease-in-out text-lg sm:text-xl">
                    <i class="fas fa-bell"></i><span
                        class="absolute w-5 h-5 rounded-full bg-red-500 p-1  flex items-center justify-center -top-2 -right-2 bg-red text-white text-xs sm:text-sm">
                        {{$user->notifications->count()}}
                    </span>
                </a>

                <div
                    class="p-4 notifications absolute max-h-96 md:right-0 -right-12   w-96 bg-white border border-gray-200 rounded-lg shadow-lg hidden group-hover:block overflow-y-auto z-50 text-sm sm:text-base">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold">Notifications</h4>
                        <form action="{{ route('notifications.clear') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs sm:text-sm text-red-500 hover:underline">Clear
                                All</button>
                        </form>
                    </div>
                    <ul class="space-y-2">
                        @forelse($user->notifications as $notification)
                        @php
                        $type = class_basename($notification->type);
                        @endphp

                        @if($type === 'ReviewNotification')
                        <li>
                            <a href="{{ route('notification.read', $notification->id) }}"
                                class="block p-4 {{ $notification->read_at != null ? '' : 'bg-gray-100' }}">

                                @if(!empty($notification->data['course_id']))
                                <p><strong>Course:</strong> {{ $notification->data['course'] ?? 'N/A' }}</p>
                                <p><strong>Rating:</strong> {{ $notification->data['rating'] }} / 5</p>
                                <p><strong>Comment:</strong> {{ $notification->data['comment'] }}</p>
                                <p><strong>By:</strong> {{ $notification->data['user'] }}</p>
                                @elseif(!empty($notification->data['instructor_id']))
                                <p><strong>{{ $notification->data['user'] }}</strong> reviewed you by:<strong>{{
                                        $notification->data['rating'] }} / 5 </strong> with comment: <strong> {{
                                        $notification->data['comment']
                                        }}</strong></p>
                                @else
                                <p><strong>Notification:</strong> Details not available</p>
                                @endif

                                <small class="text-gray-500">
                                    {{ $notification->created_at->diffForHumans() }}
                                </small>
                            </a>
                        </li>
                        @elseif($type === 'CourseRegistrationNotification')
                        <li>
                            <a href="{{ route('notification.read', $notification->id) }}"
                                class="block p-4 {{ $notification->read_at != null ? '' : 'bg-gray-100' }}">
                                <p><strong>Course:</strong> {{ $notification->data['course_name'] ?? 'N/A' }}</p>
                                <p><strong>Student:</strong> {{ $notification->data['student_name'] }}</p>
                                <p><strong>Registration Date:</strong> {{ $notification->data['registration_date'] }}
                                </p>
                                <small class="text-gray-500">
                                    {{ $notification->created_at->diffForHumans() }}
                                </small>
                            </a>
                        </li>
                        @elseif($type === 'NewLessonNotification')
                        <li>
                            <a href="{{ route('notification.read', $notification->id) }}"
                                class="block p-4 {{ $notification->read_at != null ? '' : 'bg-gray-100' }}">
                                <p>A new lesson titled "{{ $notification->data['lesson_title'] }}" has been added to the
                                    course "{{
                                    $notification->data['course_name'] }}" by instructor "{{
                                    $notification->data['course_instructor'] }}".</p>
                                <small>Received on {{ $notification->created_at->diffForHumans() }}</small>
                            </a>
                        </li>
                        @elseif($type === 'NewCourseEnrolled')
                        <li>
                            <a href="{{ route('notification.read', $notification->id) }}"
                                class="block p-4 {{ $notification->read_at != null ? '' : 'bg-gray-100' }}">
                                <p>A new course titled "{{ $notification->data['course_title'] }}" has been
                                    enrolled, Check your Learning.
                                    <small>Received on {{ $notification->created_at->diffForHumans() }}</small>
                            </a>
                        </li>

                        @else
                        <li>
                            <a href="{{ route('notification.read', $notification->id) }}"
                                class="block p-4 {{ $notification->read_at != null ? '' : 'bg-gray-100' }}">
                                <p>New notification received.</p>
                                <small class="text-gray-500">
                                    {{ $notification->created_at->diffForHumans() }}
                                </small>
                            </a>
                        </li>
                        @endif

                        @empty
                        <li>No notifications yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            @endauth

            <button id="mobile-menu-button"
                class="text-gray-600 hover:text-blue-600 transition-all duration-200 ease-in-out text-lg sm:text-xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <div id="search-input-container" class="w-full px-4 py-2 bg-white border rounded-md shadow-lg hidden relative">
        <form action="{{ route('search') }}" method="GET" class="w-full">
            <input type="text" name="query" id="search-input" placeholder="Search..." value="{{ request('query') }}"
                autocomplete="off"
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 pl-10 text-sm sm:text-base">
        </form>

        <div id="search-results"
            class="absolute w-[90%] bg-white border rounded-md shadow-lg mt-2 {{ request('query') ? '' : 'hidden' }} text-sm sm:text-base">
            @if(request('query') && $searchResult && (
            count($searchResult['courses']) > 0 ||
            count($searchResult['categories']) > 0 ||
            count($searchResult['instructors']) > 0
            ))
            <div class="max-h-72 overflow-auto w-full bg-white border border-gray-300 rounded-lg shadow-md p-4">
                <ul class="space-y-4 text-sm sm:text-base">
                    @foreach($searchResult['courses'] as $course)
                    <li>
                        <a href="{{ route('courses.show', $course->id) }}"
                            class="flex items-center text-gray-700 hover:text-blue-600">
                            <i class="fas fa-book mr-2"></i>{{ $course->title }} (Course)
                        </a>
                    </li>
                    @endforeach
                    @foreach($searchResult['categories'] as $category)
                    <li>
                        <a href="{{ route('categories.courses', $category->id) }}"
                            class="flex items-center text-gray-700 hover:text-blue-600">
                            <i class="fas fa-list mr-2"></i>{{ $category->name }} (Category)
                        </a>
                    </li>
                    @endforeach
                    @foreach($searchResult['instructors'] as $instructor)
                    <li>
                        <a href="{{ route('instructor.review', $instructor->id) }}"
                            class="flex items-center text-gray-700 hover:text-blue-600">
                            <i class="fas fa-user mr-2"></i>{{ $instructor->user->name }} (Instructor)
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @else
            <p class="text-center p-4 text-gray-700">No results found for "{{ request('query') }}."</p>
            @endif
        </div>
    </div>

    <div id="mobile-menu" class="hidden bg-white border-t border-gray-200 absolute left-0 right-0 z-[100]">
        <ul class="space-y-2 p-4">
            <li class="relative bg-gray-300 p-2 max-h-screen z-[100] overflow-y-auto">
                <button id="categories-button2"
                    class="w-full text-gray-600 hover:text-blue-600 flex items-center justify-between text-sm sm:text-base">
                    <i class="fa-solid fa-table"></i>
                    <span>Categories</span>
                </button>
                <ul id="categories-dropdown" class="hidden space-y-2 bg-white pl-4">
                    @foreach ($categories as $category)
                    @if (is_null($category->parent_id))
                    <li class="relative">
                        <button class="text-gray-600 hover:text-blue-600 text-sm sm:text-base"
                            onclick="toggleSubcategoriesMobile({{ $category->id }})">
                            {{ $category->name }}
                        </button>
                        @if ($category->subcategories->count() > 0)
                        <ul id="subcategory-mobile-{{ $category->id }}" class="hidden pl-4">
                            @foreach ($category->subcategories as $subcategory)
                            <li>
                                <button class="text-gray-600 hover:text-blue-600 text-sm sm:text-base"
                                    onclick="toggleSubSubcategoriesMobile({{ $subcategory->id }})">
                                    {{ $subcategory->name }}
                                </button>
                                @if ($subcategory->subcategories->count() > 0)
                                <ul id="subsubcategory-mobile-{{ $subcategory->id }}" class="hidden pl-4">
                                    @foreach ($subcategory->subcategories as $subsubcategory)
                                    <li>
                                        <a href="{{ route('categories.courses', $subsubcategory->id) }}"
                                            class="block text-gray-600 hover:text-blue-600 text-sm sm:text-base">
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

            @auth
            <li><span class="text-gray-600">Hi, {{ auth()->user()->name }}</span></li>

            @if(auth()->user()->hasRole('student'))
            <li><a href="{{ route('student.dashboard') }}"
                    class="flex items-center text-gray-600 hover:text-blue-600 {{ request()->routeIs('student.dashboard') ? 'font-bold text-blue-600' : '' }} text-sm sm:text-base">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>
            <li><a href="{{ route('my-learning') }}"
                    class="flex items-center text-gray-600 hover:text-blue-600 transition-all duration-200 ease-in-out {{ request()->routeIs('my-learning') ? 'font-bold text-blue-600' : '' }} text-sm sm:text-base">
                    <i class="fas fa-book-open mr-2"></i>My Learning</a></li>
            <li><a href="{{ route('cart.index') }}"
                    class="flex items-center text-gray-600 hover:text-blue-600 transition-all duration-200 ease-in-out {{ request()->routeIs('cart.index') ? 'font-bold text-blue-600' : '' }} text-sm sm:text-base">
                    <i class="fas fa-shopping-cart mr-2"></i>Cart</a></li>
            <li><a href="{{ route('favorites.index') }}"
                    class="flex items-center text-gray-600 hover:text-blue-600 transition-all duration-200 ease-in-out {{ request()->routeIs('favorites.index') ? 'font-bold text-blue-600' : '' }} text-sm sm:text-base">
                    <i class="fas fa-heart mr-2"></i>Favorite</a></li>
            <li><a href="{{ route('instructors.create') }}"
                    class="flex items-center text-gray-600 hover:text-blue-600 transition-all duration-200 ease-in-out {{ request()->routeIs('instructors.create') ? 'font-bold text-blue-600' : '' }} text-sm sm:text-base">
                    <i class="fas fa-user-plus mr-2"></i>Become an Instructor</a></li>
            @endif
            @if(auth()->user()->hasRole('instructor'))
            <li><a href="{{ route('instructors.dashboard') }}"
                    class="flex items-center text-gray-600 hover:text-blue-600 {{ request()->routeIs('instructors.dashboard') ? 'font-bold text-blue-600' : '' }} text-sm sm:text-base">
                    <i class="fas fa-tachometer-alt mr-2"></i>Instructor Dashboard</a></li>
            @endif

            <li><a href="{{ route('profile.show') }}"
                    class="flex items-center text-gray-600 hover:text-blue-600 {{ request()->routeIs('profile.index') ? 'font-bold text-blue-600' : '' }} text-sm sm:text-base">
                    <i class="fas fa-user-circle mr-2"></i>Profile</a></li>
            <li><a href="{{ route('logout') }}"
                    class="flex items-center text-gray-600 hover:text-blue-600 transition-all duration-200 ease-in-out text-sm sm:text-base">
                    <i class="fas fa-sign-out-alt mr-2"></i>Logout</a></li>
            @else
            <li><a href="{{ route('login') }}"
                    class="flex items-center text-gray-600 hover:text-blue-600 transition-all duration-200 ease-in-out text-sm sm:text-base">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login</a></li>
            <li><a href="{{ route('register') }}"
                    class="flex items-center text-gray-600 hover:text-blue-600 transition-all duration-200 ease-in-out text-sm sm:text-base">
                    <i class="fas fa-user-plus mr-2"></i>Register</a></li>
            @endauth
        </ul>
    </div>
</header>




<script>
    document.getElementById('search-button').addEventListener('click', function () {
        document.getElementById('search-input-container').classList.toggle('hidden');
    });

    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    document.getElementById('categories-button2').addEventListener('click', function (event) {
        event.stopPropagation();
        const categoriesMenu = document.getElementById('categories-dropdown');
        categoriesMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', function (event) {
        const categoriesMenu = document.getElementById('categories-dropdown');
        if (!categoriesMenu.contains(event.target) && !event.target.matches('#categories-button2')) {
            categoriesMenu.classList.add('hidden');
        }
    });

    function toggleSubcategoriesMobile(categoryId) {
        const subcategoryMenu = document.getElementById('subcategory-mobile-' + categoryId);
        subcategoryMenu.classList.toggle('hidden');
    }

    function toggleSubSubcategoriesMobile(subcategoryId) {
        const subSubcategoryMenu = document.getElementById('subsubcategory-mobile-' + subcategoryId);
        subSubcategoryMenu.classList.toggle('hidden');
    }
    window.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        if (searchInput.value.trim() !== "") {
            document.getElementById('search-results').classList.remove('hidden');
            document.getElementById('search-input-container').classList.remove('hidden');


        }
    });

</script>