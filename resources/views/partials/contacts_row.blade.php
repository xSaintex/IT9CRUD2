<tr id="contact-{{ $contact->id }}">
    <td>{{ $contact->name }}</td>
    <td>{{ $contact->email }}</td>
    <td>{{ $contact->phone }}</td>
    <td>{{ $contact->address }}</td>
    <td class="d-flex gap-2">
        <button class="btn btn-warning btn-sm"
                hx-get="{{ route('contacts.edit', $contact->id) }}"
                hx-push-url="{{ route('contacts.edit', $contact->id) }}" hx-target="body" hx-swap="innerHTML">
            Edit
        </button>

        <form method="POST"
              hx-delete="{{ route('contacts.destroy', $contact->id) }}"
              hx-target="#contact-{{ $contact->id }}"
              hx-swap="outerHTML"
              hx-confirm="Are you sure you want to delete this contact?">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
    </td>
</tr>