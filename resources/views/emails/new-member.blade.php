<x-mail::message>
# New Community Member Registration

You have a new community member registration!

**Member Details:**
- **Name:** {{ $member->name }}
- **Email:** {{ $member->email }}
@if($member->phone)
- **Phone:** {{ $member->phone }}
@endif

@if($book)
**Book Information:**
- **Title:** {{ $book->title }}
- **Author:** {{ $book->author }}
@endif

@if($member->how_found)
**How they found the book:** {{ $member->how_found }}
@endif

@if($member->message)
**Their message:**
> {{ $member->message }}
@endif

**Registration Date:** {{ $member->registered_at->format('F j, Y \a\t g:i A') }}

<x-mail::button :url="config('app.url') . '/admin/community-members/' . $member->id">
View Member Details
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
