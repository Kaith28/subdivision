<x-app-layout>
    <div class="py-12">
        <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="flex justify-between items-center">
                <form action="{{ route('events') }}" method="GET">
                    <div class="flex gap-4">
                        <input class="rounded-md" type="text" name="title" placeholder="Search by title"
                            value="{{ $title }}">
                        <button class="bg-orange-200 hover:bg-orange-300 px-4 py-2 rounded-md "><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg></button>
                        <a href="{{ route('events') }}"
                            class="border border-black hover:bg-orange-200 px-2 py-2 rounded-md ">Clear</a>
                    </div>
                </form>

</x-app-layout>
