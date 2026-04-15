<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS System</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<!-- NAVBAR -->
<nav class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-blue-600">LMS</h1>

    <div>
        @auth
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="px-4 py-2 mr-2 border rounded">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Register</a>
        @endauth
    </div>
</nav>

<!-- HERO SECTION -->
<section class="text-center py-20 bg-blue-600 text-white">
    <h2 class="text-4xl font-bold mb-4">Seminar & Learning Management System</h2>
    <p class="text-lg mb-6">Manage seminars, modules, exams, and participants in one powerful platform.</p>

    @auth
        <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 px-6 py-3 rounded font-semibold">
            Go to Dashboard
        </a>
    @else
        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-6 py-3 rounded font-semibold">
            Get Started
        </a>
    @endauth
</section>

<!-- FEATURES -->
<section class="py-16 px-6">
    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white p-6 shadow rounded text-center">
            <h3 class="text-xl font-bold mb-2">Participants</h3>
            <p>Register and manage students efficiently.</p>
        </div>

        <div class="bg-white p-6 shadow rounded text-center">
            <h3 class="text-xl font-bold mb-2">Modules & Lessons</h3>
            <p>Create structured learning content.</p>
        </div>

        <div class="bg-white p-6 shadow rounded text-center">
            <h3 class="text-xl font-bold mb-2">Exams & Grading</h3>
            <p>Conduct tests and automatically grade results.</p>
        </div>

        <div class="bg-white p-6 shadow rounded text-center">
            <h3 class="text-xl font-bold mb-2">Attendance</h3>
            <p>Track seminar attendance easily.</p>
        </div>

        <div class="bg-white p-6 shadow rounded text-center">
            <h3 class="text-xl font-bold mb-2">Reports</h3>
            <p>Generate insights and performance reports.</p>
        </div>

        <div class="bg-white p-6 shadow rounded text-center">
            <h3 class="text-xl font-bold mb-2">Dashboard</h3>
            <p>Visualize data with charts and analytics.</p>
        </div>

    </div>
</section>

<!-- FOOTER -->
<footer class="bg-gray-800 text-white text-center p-4">
    <p>© {{ date('Y') }} LMS System. All rights reserved.</p>
</footer>

</body>
</html>