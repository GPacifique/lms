@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        <div class="bg-white p-4 rounded-xl shadow">
            <h4 class="text-gray-500">Participants</h4>
            <p class="text-2xl font-bold">{{ $totalParticipants }}</p>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <h4 class="text-gray-500">Modules</h4>
            <p class="text-2xl font-bold">{{ $totalModules }}</p>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <h4 class="text-gray-500">Seminars</h4>
            <p class="text-2xl font-bold">{{ $totalSeminars }}</p>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <h4 class="text-gray-500">Submissions</h4>
            <p class="text-2xl font-bold">{{ $totalSubmissions }}</p>
        </div>

    </div>

    <!-- CHARTS -->
    <div class="grid md:grid-cols-2 gap-6">

        <div class="bg-white p-4 rounded-xl shadow">
            <h3 class="mb-2 font-semibold">Monthly Submissions</h3>
            <canvas id="submissionsChart"></canvas>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <h3 class="mb-2 font-semibold">Attendance</h3>
            <canvas id="attendanceChart"></canvas>
        </div>

    </div>

    <!-- PARTICIPANTS TABLE -->
    <div class="bg-white p-4 rounded-xl shadow">
        <h3 class="font-semibold mb-3">Participants Performance</h3>

        <div class="overflow-x-auto">
            <table class="w-full text-sm border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">Name</th>
                        <th>Modules</th>
                        <th>Seminars</th>
                        <th>Average Marks</th>
                        <th>Attendance %</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($participants as $p)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-2">{{ $p->name }}</td>
                        <td>{{ $p->modules_count }}</td>
                        <td>{{ $p->seminars_count }}</td>
                        <td>{{ $p->average_marks }}</td>
                        <td>
                            <span class="
                                px-2 py-1 rounded text-white
                                {{ $p->attendance_rate >= 75 ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $p->attendance_rate }}%
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>

<!-- CHART SCRIPT -->
<script>
new Chart(document.getElementById('submissionsChart'), {
    type: 'bar',
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'Submissions',
            data: @json($data)
        }]
    }
});

new Chart(document.getElementById('attendanceChart'), {
    type: 'pie',
    data: {
        labels: ['Present', 'Absent'],
        datasets: [{
            data: [
                {{ $attendanceStats['present'] }},
                {{ $attendanceStats['absent'] }}
            ]
        }]
    }
});
</script>

@endsection