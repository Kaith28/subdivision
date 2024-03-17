<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Guest') }}
        </h2>
    </x-slot>
    <div class="pt-4 px-4"> <a href="/resident"
            class=" w-fit px-4 py-2 flex items-center gap-2 bg-orange-200 hover:bg-orange-300 rounded-md "><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg></a>
    </div>

    <div class="py-12">
        <div class="flex flex-col items-center shadow-lg rounded-md p-4">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <!-- Upload photo -->
                <div class="mt-4">
                    <label class="text-sm">Add Picture</label>
                    <div class="font-bold text-xs justify text-gray-400 italic">* We will use this to identify if you
                        are
                        really the one using your car.
                    </div>
                    {{-- <input type="file" id="photo" name="photo"
                        class="w-full mt-1 p-2 border border-gray-300 rounded focus:outline-none focus:border-orange-300"> --}}
                    <input id="photo" type="hidden" name="photo">
                    <img id="preview" width="400" height="300" class="hidden" />
                    <video id="video" width="400" height="300" autoplay></video>
                    <button id="flipButton">Flip Camera</button>
                    <div class="flex justify-center  bg-orange-300 rounded-md py-2 my-2 ">
                        <button id="capture">Capture</button>
                        <button id="re-capture" class="hidden">Re-Capture</button>
                    </div>
                </div>
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Contact no. -->
                <div class="mt-4">
                    <x-input-label for="contact_no" :value="__('Contact no.')" />
                    <x-text-input id="contact_no" class="block mt-1 w-full" type="text" name="contact_no"
                        :value="old('contact_no')" required autofocus autocomplete="contact_no" />
                    <x-input-error :messages="$errors->get('contact_no')" class="mt-2" />
                </div>

                <!-- Add -->
                <div class=" mt-4">
                    <x-primary-button>
                        {{ __('Add') }}
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>

<script>
    const video = document.getElementById('video');
    const flipButton = document.getElementById('flipButton');
    const captureButton = document.getElementById('capture');
    const recaptureButton = document.getElementById('re-capture')
    const capturedImageInput = document.getElementById('photo');
    const preview = document.getElementById('preview')

    let facingMode = 'user'

    // Access the camera and stream the video
    navigator.mediaDevices.getUserMedia({
            video: true
        })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(err => {
            console.error('Error accessing the camera:', err);
        });
    // Capture an image from the video stream
    captureButton.addEventListener('click', (event) => {
        event.preventDefault();
        const canvas = document.createElement('canvas');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        const imageUrl = canvas.toDataURL('image/png');
        // Set the captured image data to the hidden input field
        capturedImageInput.value = imageUrl;
        preview.src = imageUrl;
        // Optionally, hide the video element
        video.style.display = 'none';
        preview.style.display = 'block';
        captureButton.style.display = 'none';
        recaptureButton.style.display = 'block';
    });
    recaptureButton.addEventListener('click', (event) => {
        event.preventDefault();
        video.style.display = 'block';
        preview.style.display = 'none';
        captureButton.style.display = 'block';
        recaptureButton.style.display = 'none';
    })

    flipButton.addEventListener('click', async () => {
        event.preventDefault();

        const currentStream = video.srcObject;
        const tracks = currentStream.getTracks();

        for (const track of tracks) {
            track.stop();
        }

        currentFacingMode = currentFacingMode === 'user' ? 'environment' : 'user';

        const newStream = await navigator.mediaDevices.getUserMedia({
            video: {
                facingMode
            }
        });

        video.srcObject = newStream;
    });
</script>
