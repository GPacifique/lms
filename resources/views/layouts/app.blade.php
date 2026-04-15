<!DOCTYPE html>
<html>
<head>
    <title>LMS System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white p-4 hidden md:block">
        <h2 class="text-xl font-bold mb-6 text-center">LMS</h2>

        <ul class="space-y-2">
            <li><a href="{{ route('dashboard') }}" class="block p-2 hover:bg-gray-700 rounded">🏠 Dashboard</a></li>
            <li><a href="{{ route('participants.index') }}" class="block p-2 hover:bg-gray-700 rounded">Participants</a></li>
            <li><a href="{{ route('modules.index') }}" class="block p-2 hover:bg-gray-700 rounded">Modules</a></li>
            <li><a href="{{ route('seminars.index') }}" class="block p-2 hover:bg-gray-700 rounded">Seminars</a></li>
            <li><a href="{{ route('exams.index') }}" class="block p-2 hover:bg-gray-700 rounded">Exams</a></li>
            <li><a href="{{ route('marks.index') }}" class="block p-2 hover:bg-gray-700 rounded">Marks</a></li>
            <li><a href="{{ route('attendance.index') }}" class="block p-2 hover:bg-gray-700 rounded">Attendance</a></li>
            <li><a href="{{ route('submissions.index') }}" class="block p-2 hover:bg-gray-700 rounded">Submissions</a></li>
        @role('Admin')
<li>
    <a href="{{ route('admin.users.index') }}">User Management</a>
</li>
@endrole
        </ul>


    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Top Navbar -->
        <div class="bg-white shadow p-4 flex justify-between items-center">

            <h1 class="text-lg font-bold text-gray-800">LMS System</h1>

            <div class="flex items-center gap-4">

                <!-- Dashboard Button -->
                <a href="{{ route('dashboard') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                    Dashboard
                </a>

                <!-- Profile -->
                <div class="relative">
                    <button id="profileBtn"
                        class="flex items-center gap-2 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-full">

                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                             class="w-8 h-8 rounded-full">

                        <span class="text-sm font-medium hidden sm:block">
                            {{ auth()->user()->name }}
                        </span>
                    </button>

                    <!-- Dropdown -->
                    <div id="profileMenu"
                        class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border z-50">

                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-2 hover:bg-gray-100">
                            ⚙ Profile Settings
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                🚪 Logout
                            </button>
                        </form>

                    </div>
                </div>

            </div>
        </div>

        <!-- Page Content -->
        <main class="flex-1 p-6">

            <!-- Back + Dashboard Buttons -->
            <x-nav-buttons />

            <!-- Alerts -->
            @include('components.alert')

            <!-- Dynamic Content -->
            @yield('content')

        </main>

        <!-- Footer -->
        <x-footer />

    </div>

</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<script>
document.getElementById('profileBtn').addEventListener('click', function () {
    document.getElementById('profileMenu').classList.toggle('hidden');
});

window.addEventListener('click', function(e) {
    if (!document.getElementById('profileBtn').contains(e.target)) {
        document.getElementById('profileMenu').classList.add('hidden');
    }
});
</script>

</body>
</html>