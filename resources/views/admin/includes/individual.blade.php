<div class="pt-4 ps-4 pe-4 col-md-12">
    <table class="table table-hover table-centered table-bordered">
        <thead class="table-light">
            <tr>
                <th class="betty" colspan="4"> TAX PAYER'S DETAILS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th width="20%">Last Name</th>
                <td width="30%">{{ $taxPayer->user->individual->last_name }}</td>
                <th width="20%">Other Names</th>
                <td width="30%">{{ $taxPayer->user->individual->other_names }}</td>
                {{-- <td rowspan="8" style="vertical-align: top !important"><img
                                        src="{{ $taxPayer->user->profile_photo }}" style="height: 150px" /></td> --}}
            </tr>
            <tr>
                <th>Email Address</th>
                <td>{{ $taxPayer->user->email }}</td>
                <th>Phone Number</th>
                <td>{{ $taxPayer->user->phone_number }}</td>
            </tr>
            <tr>
                <th>Date Of Birth</th>
                <td>{{ date_format(new DateTime($taxPayer->user->individual->dob), 'jS F Y') }}</td>
                <th>Gender</th>
                <td>{{ ucwords($taxPayer->user->individual->gender) }}</td>
            </tr>
            <tr>
                <th>Marital Status</th>
                <td>{{ $taxPayer->user->individual->marital_status }}</td>
                <th>Nationality</th>
                <td>{{ $taxPayer->user->individual->nationality }}</td>
            </tr>
            <tr>
                <th>State Of Origin</th>
                <td>{{ $taxPayer->user->individual->state_origin }}</td>
                <th>LGA Of Origin</th>
                <td>{{ $taxPayer->user->individual->lga_origin }}</td>
            </tr>
            <tr>
                <th>State Of Residence</th>
                <td>{{ $taxPayer->user->individual->state_residence }}</td>
                <th>LGA Of Residence</th>
                <td>{{ $taxPayer->user->individual->lga_residence }}</td>
            </tr>
            <tr>
                <th>City Of Residence</th>
                <td>{{ $taxPayer->user->individual->city_residence }}</td>
                <th>Address </th>
                <td>{{ $taxPayer->user->individual->house_number }}
                    {{ $taxPayer->user->individual->street_name }}</td>
            </tr>
            <tr>
                <th>Means Of Identification </th>
                <td>{{ strtoupper($taxPayer->user->individual->identification_type) }}</td>
                <th>Identification number</th>
                <td>{{ $taxPayer->user->individual->identification_number }}</td>
            </tr>
            <tr>
                <th>Public Servant </th>
                <td>{{ ucwords($taxPayer->user->individual->public_servant) }}</td>
                <th>TIN</th>
                <td>{{ $taxPayer->user->individual->tin }}</td>
            </tr>

        </tbody>
    </table>
</div>

@if (count($taxPayer->familyMembers()) > 0)
    <div class="pt-3 ps-4 pe-4 table-responsive">
        <table class="table mb-0 text-nowrap table-hover table-centered table-with-checkbox" style="font-size: 14px">
            <!-- Table Head -->
            <thead class="table-light">
                <tr>
                    <th class="betty" colspan="8"> FAMILY RELATIONS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Relationship</th>
                    <th>B-TIN</th>
                    <th>Date Of Birth</th>
                    <th>Occupation</th>
                    <th>Business Name</th>
                    <th>Business Address</th>
                </tr>
                @foreach ($taxPayer->familyMembers() as $family)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $family->name }}</td>
                        <td>{{ $family->relationship }}</td>
                        <td>{{ $family->btin ?? 'Nil' }}</td>
                        <td>{{ $family->dob }}</td>
                        <td>{{ $family->occupation }}</td>
                        <td>{{ $family->business_name ?? 'Nil' }}</td>
                        <td>{{ $family->business_address ?? 'Nil' }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>
@endif
