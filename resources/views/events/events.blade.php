<x-app-layout>
    <div class="py-12">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4">
            <div class="flex justify-end">
                <a href={{ route('events.create') }}>Create event</a>
            </div>
            <div id="calendar"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                slotMinTime: '8:00:00',
                slotMaxTime: '19:00:00',
                events: @json($list),
            });
            calendar.render();
        });
    </script>
</x-app-layout>
