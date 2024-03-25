<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Announcement') }}
        </h2>
    </x-slot>

    <div class="pt-4 px-4"> <a href="/announcement"
            class=" w-fit px-4 py-2 flex items-center gap-2 bg-orange-200 hover:bg-orange-300 rounded-md "><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg></a>
    </div>

    <div class="py-12">
        <div class="flex flex-col items-center shadow-lg rounded-md p-4">

            <form id="form" class="w-96" method="POST"
                action={{ route('announcement.update', $announcement->id) }}>
                @csrf

                <!-- Title -->
                <div class="mb-4">
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                        :value="$announcement->title" required autofocus autocomplete="title" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Body -->
                <!-- Body -->
                <div id="editor" class="mb-4"></div>

                <!-- Hidden input field to store editor content -->
                <textarea name="body" id="body" style="display: none;"></textarea>

                <!-- Update -->
                <div class="mt-4">
                    <button type="submit" class="bg-orange-200 px-4 py-2 rounded-md">Update</button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>

<script>
    // Example Quill content
    var quillContent = "{!! $announcement->body !!}";

    // Initialize Quill in read-only mode
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{
                    'header': [1, 2, false]
                }],
                ['bold', 'italic', 'underline'],
                ['link', 'image'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                ['clean']
            ]
        }
    });

    // Set the HTML content
    quill.root.innerHTML = quillContent;

    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('form'); // Get the form element

        // Add event listener for form submission
        form.addEventListener('submit', function(event) {
            // Retrieve the HTML content of the Quill editor
            var editorContent = document.querySelector('#editor .ql-editor').innerHTML;

            // Set the content of the hidden textarea field
            document.querySelector('#body').value = editorContent;
        });
    });
</script>
