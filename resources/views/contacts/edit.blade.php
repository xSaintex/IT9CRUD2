<x-app-layout>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/htmx.org@1.9.5"></script>
    @vite('resources/css/customCSS.css')

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Edit Contact</h2>

                <form method="POST" hx-post="{{ route('contacts.update', $contact->id) }}" hx-target="body"
                    hx-swap="innerHTML" hx-push-url="{{ route('contacts.index') }}"
                    hx-on::after-request="if (event.detail.successful) { window.location.href = '{{ route('contacts.index') }}'; }">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $contact->name) }}" required>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email', $contact->email) }}" required>
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="form-control"
                            value="{{ old('phone', $contact->phone) }}" required>
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control" rows="2"
                            required>{{ old('address', $contact->address) }}</textarea>
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Update and Cancel Buttons Centered -->
                    <div class="mb-3 text-center">
                        <x-primary-button type="submit" class="w-50">
                            Update Contact
                        </x-primary-button>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('contacts.index') }}" class="btn btn-secondary w-50"
                            hx-get="{{ route('contacts.index') }}" hx-push-url="{{ route('contacts.index') }}"
                            hx-target="body" hx-swap="innerHTML">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>