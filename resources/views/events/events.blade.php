<x-app-layout>
    <div class="py-12">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4">
            <div id="calendar"></div>
        </div>
    </div>
    <div id="modal" class="hidden absolute top-0 z-50 w-full h-full bg-black/50 flex justify-center items-center">
        <form action={{ route('events.store') }} method="POST">
            @csrf
            <div class="bg-white w-96 p-5 rounded-md flex flex-col gap-4">
                <h2 class="font-bold">Add Event</h2>
                <div class="w-full flex flex-col gap-2">
                    <input type="text" name="organizer" placeholder="Organizer" class="w-full rounded-md">
                    <input type="text" name="address" placeholder="Address" class="w-full rounded-md">
                    <input type="text" name="contact_no" placeholder="Contact no." class="w-full rounded-md">
                    <input type="text" name="event_location" placeholder="Event location" class="w-full rounded-md">
                    <input type="text" name="event_purpose" placeholder="Event purpose" class="w-full rounded-md">
                    <input type="number" name="estimated_attendees" placeholder="Est attendees"
                        class="w-full rounded-md">
                    <input type="text" name="time" placeholder="Time" class="w-full rounded-md">

                    <input id="date" type="date" name="date" placeholder="Date" class="w-full rounded-md"
                        readonly>
                    <div class=" flex  flex-col justify-center w-full gap-2">
                        <button class="px-4 py-2  gap-2 bg-orange-200 hover:bg-orange-300 rounded-md"
                            onclick="addEvent()">Add</button>
                        <button class="px-4 py-2  gap-2 bg-red-400 hover:bg-red-500 rounded-md"
                            onclick="cancel()">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <script>
        const modal = document.getElementById('modal')

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($list),
                selectable: true,
                select: function(selectInfo) {
                    modal.style.display = "flex"
                    const dateInput = document.getElementById("date")
                    const startDate = new Date(selectInfo.start)
                    startDate.setDate(startDate.getDate() + 1);
                    dateInput.value = startDate.toISOString().slice(0, 10)
                }
            });
            calendar.render();
        });



        const addEvent = () => {
            console.log('add event')
        }

        const cancel = () => {
            modal.style.display = "none"
        }
    </script>
</x-app-layout>
