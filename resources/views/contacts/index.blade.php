<x-app-layout>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Include HTMX -->
    <script src="https://unpkg.com/htmx.org@1.9.6"></script>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white shadow-md rounded-lg p-4">
            <h5 class="text-lg font-semibold text-gray-700 mb-3">Create Contact</h5>
            
            <form id="contactForm" 
                  method="POST" 
                  action="{{ route('contacts.store') }}"
                  hx-post="{{ route('contacts.store') }}"
                  hx-target="#contactTableBody"
                  hx-swap="beforeend"
                  hx-on::after-request="this.reset()">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" rows="2" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>

        <div class="bg-white shadow-md rounded-lg p-4 mt-5">
            <h5 class="text-lg font-semibold text-gray-700 mb-3">Contact List</h5>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="bg-gray-200">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="contactTableBody">
                        @foreach ($contacts as $contact)
                            @include('partials.contacts_row', ['contact' => $contact])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
