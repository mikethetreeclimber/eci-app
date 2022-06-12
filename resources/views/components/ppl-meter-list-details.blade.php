<div class="p-2 bg-white border border-slate-200">
    @php
        $contact = Modules\Crm\Entities\Contacts::find($id)
    @endphp
    <div>Primary Phone: {{ $contact->primary_phone }}</div>
    <div>Alt Phone: {{ $contact->alt_phone }}</div>
    <div>Email Address: {{ $contact->email_address }}</div>
    <div>Substation Name: {{ $contact->substation_name }}</div>
    <div>Mailing Address: {{ $contact->mailing_address }}</div>
    <div>Region: {{ $contact->region }}</div>
</div>