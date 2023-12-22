@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Business Information')


<!-- Container fluid -->
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-3 mb-3">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Business Information</h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Account Settings</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Business Information</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row justify-content-center">
        <div class="col-lg-11 col-12">
            <form method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                @csrf
                <!-- card -->
                <div class="card mb-4">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row">
                            <!-- input -->
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Business Name</label>
                                <input type="text" name="business_name" value="{{ $business->business_name }}"
                                    class="form-control" placeholder="Enter Business Name" required>
                                <div class="invalid-feedback">Please enter business name</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Business Category</label>
                                <select id="category" name="category" class="@error('category') is-invalid @enderror"
                                    data-width="100%" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($business->category_id == $category->id) selected @endif>
                                            {{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select business category</div>
                            </div>
                            <!-- input -->
                            <div class="mb-3 col-md-12 col-12">
                                <label class="form-label">Business Description</label>
                                <textarea id="editor1" name="business_description" class="form-control" placeholder="Business Description" required>@php echo $business->business_description; @endphp</textarea>
                                <div class="invalid-feedback">Please enter business description</div>
                            </div>

                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Business Phone Number</label>
                                <input type="text" name="business_phone" value="{{ $business->business_phone }}"
                                    class="form-control" placeholder="Enter Business Phone Number" required>
                                <div class="invalid-feedback">Please enter business phone number</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Business Email Address</label>
                                <input type="text" name="business_email" value="{{ $business->business_email }}"
                                    class="form-control" placeholder="Enter Business Email Address" required>
                                <div class="invalid-feedback">Please enter business email</div>
                            </div>

                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Country</label>
                                <select id="country" name="country" class="@error('country') is-invalid @enderror"
                                    data-width="100%" required>
                                    <option value="">Select Country</option>
                                    <option value="Afghanistan" @if ($business->country == 'Afghanistan') selected @endif>
                                        Afghanistan</option>
                                    <option value="Albania" @if ($business->country == 'Albania') selected @endif>
                                        Albania</option>
                                    <option value="Algeria" @if ($business->country == 'Algeria') selected @endif>
                                        Algeria</option>
                                    <option value="American Samoa" @if ($business->country == 'American Samoa') selected @endif>
                                        American Samoa</option>
                                    <option value="Andorra" @if ($business->country == 'Andorra') selected @endif>
                                        Andorra</option>
                                    <option value="Angola" @if ($business->country == 'Angola') selected @endif>
                                        Angola
                                    </option>
                                    <option value="Anguilla" @if ($business->country == 'Anguilla') selected @endif>
                                        Anguilla</option>
                                    <option value="Antarctica" @if ($business->country == 'Antarctica') selected @endif>
                                        Antarctica</option>
                                    <option value="Antigua and Barbuda"
                                        @if ($business->country == 'Antigua and Barbuda') selected @endif>
                                        Antigua and Barbuda
                                    </option>
                                    <option value="Argentina" @if ($business->country == 'Argentina') selected @endif>
                                        Argentina</option>
                                    <option value="Armenia" @if ($business->country == 'Armenia') selected @endif>
                                        Armenia</option>
                                    <option value="Aruba" @if ($business->country == 'Aruba') selected @endif>
                                        Aruba</option>
                                    <option value="Australia" @if ($business->country == 'Australia') selected @endif>
                                        Australia</option>
                                    <option value="Austria" @if ($business->country == 'Austria') selected @endif>
                                        Austria</option>
                                    <option value="Azerbaijan" @if ($business->country == 'Azerbaijan') selected @endif>
                                        Azerbaijan</option>
                                    <option value="Bahamas" @if ($business->country == 'Bahamas') selected @endif>
                                        Bahamas</option>
                                    <option value="Bahrain" @if ($business->country == 'Bahrain') selected @endif>
                                        Bahrain</option>
                                    <option value="Bangladesh" @if ($business->country == 'Bangladesh') selected @endif>
                                        Bangladesh</option>
                                    <option value="Barbados" @if ($business->country == 'Barbados') selected @endif>
                                        Barbados</option>
                                    <option value="Belarus" @if ($business->country == 'Belarus') selected @endif>
                                        Belarus</option>
                                    <option value="Belgium" @if ($business->country == 'Belgium') selected @endif>
                                        Belgium</option>
                                    <option value="Belize" @if ($business->country == 'Belize') selected @endif>
                                        Belize</option>
                                    <option value="Benin" @if ($business->country == 'Benin') selected @endif>
                                        Benin</option>
                                    <option value="Bermuda" @if ($business->country == 'Bermuda') selected @endif>
                                        Bermuda</option>
                                    <option value="Bhutan" @if ($business->country == 'Bhutan') selected @endif>
                                        Bhutan</option>
                                    <option value="Bolivia" @if ($business->country == 'Bolivia') selected @endif>
                                        Bolivia</option>
                                    <option value="Bosnia and Herzegowina"
                                        @if ($business->country == 'Bosnia and Herzegowina') selected @endif>
                                        Bosnia and
                                        Herzegowina</option>
                                    <option value="Botswana" @if ($business->country == 'Botswana') selected @endif>
                                        Botswana</option>
                                    <option value="Bouvet Island" @if ($business->country == 'Bouvet Island') selected @endif>
                                        Bouvet Island</option>
                                    <option value="Brazil" @if ($business->country == 'Brazil') selected @endif>
                                        Brazil</option>
                                    <option value="British Indian Ocean Territory"
                                        @if ($business->country == 'British Indian Ocean Territory') selected @endif>
                                        British
                                        Indian Ocean Territory</option>
                                    <option value="Brunei Darussalam"
                                        @if ($business->country == 'Brunei Darussalam') selected @endif>
                                        Brunei Darussalam
                                    </option>
                                    <option value="Bulgaria" @if ($business->country == 'Bulgaria') selected @endif>
                                        Bulgaria</option>
                                    <option value="Burkina Faso" @if ($business->country == 'Burkina Faso') selected @endif>
                                        Burkina Faso</option>
                                    <option value="Burundi" @if ($business->country == 'Burundi') selected @endif>
                                        Burundi</option>
                                    <option value="Cambodia" @if ($business->country == 'Cambodia') selected @endif>
                                        Cambodia</option>
                                    <option value="Cameroon" @if ($business->country == 'Cameroon') selected @endif>
                                        Cameroon</option>
                                    <option value="Canada" @if ($business->country == 'Canada') selected @endif>
                                        Canada</option>
                                    <option value="Cape Verde" @if ($business->country == 'Cape Verde') selected @endif>
                                        Cape
                                        Verde</option>
                                    <option value="Cayman Islands" @if ($business->country == 'Cayman Islands') selected @endif>
                                        Cayman Islands</option>
                                    <option value="Central African Republic"
                                        @if ($business->country == 'Central African Republic') selected @endif>
                                        Central African
                                        Republic</option>
                                    <option value="Chad" @if ($business->country == 'Chad') selected @endif>
                                        Chad
                                    </option>
                                    <option value="Chile" @if ($business->country == 'Chile') selected @endif>
                                        Chile</option>
                                    <option value="China" @if ($business->country == 'China') selected @endif>
                                        China</option>
                                    <option value="Christmas Island"
                                        @if ($business->country == 'Christmas Island') selected @endif>
                                        Christmas Island</option>
                                    <option value="Cocos (Keeling) Islands"
                                        @if ($business->country == 'Cocos (Keeling) Islands') selected @endif>
                                        Cocos (Keeling)
                                        Islands</option>
                                    <option value="Colombia" @if ($business->country == 'Colombia') selected @endif>
                                        Colombia</option>
                                    <option value="Comoros" @if ($business->country == 'Comoros') selected @endif>
                                        Comoros</option>
                                    <option value="Congo" @if ($business->country == 'Congo') selected @endif>
                                        Congo</option>
                                    <option value="The Democratic Republic of the Congo"
                                        @if ($business->country == 'The Democratic Republic of the Congo') selected @endif>
                                        The Democratic Republic of the Congo</option>
                                    <option value="Cook Islands" @if ($business->country == 'the Democratic Republic of the Congo') selected @endif>
                                        Cook
                                        Islands</option>
                                    <option value="Costa Rica" @if ($business->country == 'Costa Rica') selected @endif>
                                        Costa Rica</option>
                                    <option value="Cote d'Ivoire" @if ($business->country == "Cote d'Ivoire") selected @endif>
                                        Cote
                                        d'Ivoire
                                    </option>
                                    <option value="Croatia (Hrvatska)"
                                        @if ($business->country == 'Croatia (Hrvatska)') selected @endif>
                                        Croatia (Hrvatska)
                                    </option>
                                    <option value="Cuba" @if ($business->country == 'Cuba') selected @endif>
                                        Cuba
                                    </option>
                                    <option value="Cyprus" @if ($business->country == 'Cyprus') selected @endif>
                                        Cyprus</option>
                                    <option value="Czech Republic" @if ($business->country == 'Czech Republic') selected @endif>
                                        Czech Republic</option>
                                    <option value="Denmark" @if ($business->country == 'Denmark') selected @endif>
                                        Denmark</option>
                                    <option value="Djibouti" @if ($business->country == 'Djibouti') selected @endif>
                                        Djibouti</option>
                                    <option value="Dominica" @if ($business->country == 'Dominica') selected @endif>
                                        Dominica</option>
                                    <option value="Dominican Republic"
                                        @if ($business->country == 'Dominican Republic') selected @endif>
                                        Dominican Republic
                                    </option>
                                    <option value="East Timor" @if ($business->country == 'East Timor') selected @endif>
                                        East
                                        Timor</option>
                                    <option value="Ecuador" @if ($business->country == 'Ecuador') selected @endif>
                                        Ecuador</option>
                                    <option value="Egypt" @if ($business->country == 'Egypt') selected @endif>
                                        Egypt</option>
                                    <option value="El Salvador" @if ($business->country == 'El Salvador') selected @endif>
                                        El
                                        Salvador</option>
                                    <option value="Equatorial Guinea"
                                        @if ($business->country == 'Equatorial Guinea') selected @endif>
                                        Equatorial Guinea
                                    </option>
                                    <option value="Eritrea" @if ($business->country == 'Eritrea') selected @endif>
                                        Eritrea</option>
                                    <option value="Estonia" @if ($business->country == 'Estonia') selected @endif>
                                        Estonia</option>
                                    <option value="Ethiopia" @if ($business->country == 'Ethiopia') selected @endif>
                                        Ethiopia</option>
                                    <option value="Falkland Islands (Malvinas)"
                                        @if ($business->country == 'Falkland Islands (Malvinas)') selected @endif>
                                        Falkland
                                        Islands (Malvinas)</option>
                                    <option value="Faroe Islands" @if ($business->country == 'Faroe Islands') selected @endif>
                                        Faroe Islands</option>
                                    <option value="Fiji" @if ($business->country == 'Fiji') selected @endif>
                                        Fiji
                                    </option>
                                    <option value="Finland" @if ($business->country == 'Finland') selected @endif>
                                        Finland</option>
                                    <option value="France" @if ($business->country == 'France') selected @endif>
                                        France</option>
                                    <option value="France Metropolitan"
                                        @if ($business->country == 'France Metropolitan') selected @endif>
                                        France Metropolitan
                                    </option>
                                    <option value="French Guiana" @if ($business->country == 'French Guiana') selected @endif>
                                        French Guiana</option>
                                    <option value="French Polynesia"
                                        @if ($business->country == 'French Polynesia') selected @endif>
                                        French Polynesia</option>
                                    <option value="French Southern Territories"
                                        @if ($business->country == 'French Southern Territories') selected @endif>
                                        French Southern
                                        Territories</option>
                                    <option value="Gabon" @if ($business->country == 'Gabon') selected @endif>
                                        Gabon</option>
                                    <option value="Gambia" @if ($business->country == 'Gambia') selected @endif>
                                        Gambia</option>
                                    <option value="Georgia" @if ($business->country == 'Georgia') selected @endif>
                                        Georgia</option>
                                    <option value="Germany" @if ($business->country == 'Germany') selected @endif>
                                        Germany</option>
                                    <option value="Ghana" @if ($business->country == 'Ghana') selected @endif>
                                        Ghana</option>
                                    <option value="Gibraltar" @if ($business->country == 'Gibraltar') selected @endif>
                                        Gibraltar</option>
                                    <option value="Greece" @if ($business->country == 'Greece') selected @endif>
                                        Greece</option>
                                    <option value="Greenland" @if ($business->country == 'Greenland') selected @endif>
                                        Greenland</option>
                                    <option value="Grenada" @if ($business->country == 'Grenada') selected @endif>
                                        Grenada</option>
                                    <option value="Guadeloupe" @if ($business->country == 'Guadeloupe') selected @endif>
                                        Guadeloupe</option>
                                    <option value="Guam" @if ($business->country == 'Guam') selected @endif>
                                        Guam
                                    </option>
                                    <option value="Guatemala" @if ($business->country == 'Guatemala') selected @endif>
                                        Guatemala</option>
                                    <option value="Guinea" @if ($business->country == 'Guinea') selected @endif>
                                        Guinea</option>
                                    <option value="Guinea-Bissau" @if ($business->country == 'Guinea-Bissau') selected @endif>
                                        Guinea-Bissau</option>
                                    <option value="Guyana" @if ($business->country == 'Guyana') selected @endif>
                                        Guyana</option>
                                    <option value="Haiti" @if ($business->country == 'Haiti') selected @endif>
                                        Haiti</option>
                                    <option value="Heard and Mc Donald Islands"
                                        @if ($business->country == 'Heard and Mc Donald Islands') selected @endif>
                                        Heard and Mc
                                        Donald Islands</option>
                                    <option value="Holy See (Vatican City State)"
                                        @if ($business->country == 'Holy See (Vatican City State)') selected @endif>
                                        Holy
                                        See
                                        (Vatican City State)</option>
                                    <option value="Honduras" @if ($business->country == 'Honduras') selected @endif>
                                        Honduras</option>
                                    <option value="Hong Kong" @if ($business->country == 'Hong Kong') selected @endif>
                                        Hong
                                        Kong</option>
                                    <option value="Hungary" @if ($business->country == 'Hungary') selected @endif>
                                        Hungary</option>
                                    <option value="Iceland" @if ($business->country == 'Iceland') selected @endif>
                                        Iceland</option>
                                    <option value="India" @if ($business->country == 'India') selected @endif>
                                        India</option>
                                    <option value="Indonesia" @if ($business->country == 'Indonesia') selected @endif>
                                        Indonesia</option>
                                    <option value="Iran" @if ($business->country == 'Iran') selected @endif>
                                        Iran</option>
                                    <option value="Iraq" @if ($business->country == 'Iraq') selected @endif>
                                        Iraq</option>
                                    <option value="Ireland" @if ($business->country == 'Ireland') selected @endif>
                                        Ireland</option>
                                    <option value="Israel" @if ($business->country == 'Israel') selected @endif>
                                        Israel</option>
                                    <option value="Italy" @if ($business->country == 'Italy') selected @endif>
                                        Italy</option>
                                    <option value="Jamaica" @if ($business->country == 'Jamaica') selected @endif>
                                        Jamaica</option>
                                    <option value="Japan" @if ($business->country == 'Japan') selected @endif>
                                        Japan</option>
                                    <option value="Jordan" @if ($business->country == 'Jordan') selected @endif>
                                        Jordan</option>
                                    <option value="Kazakhstan" @if ($business->country == 'Kazakhstan') selected @endif>
                                        Kazakhstan</option>
                                    <option value="Kenya" @if ($business->country == 'Kenya') selected @endif>
                                        Kenya</option>
                                    <option value="Kiribati" @if ($business->country == 'Kiribati') selected @endif>
                                        Kiribati</option>
                                    <option value="North Korea" @if ($business->country == 'North Korea') selected @endif>
                                        North Korea</option>
                                    <option value="South Korea" @if ($business->country == 'South Korea') selected @endif>
                                        South Korea
                                    </option>
                                    <option value="Kuwait" @if ($business->country == 'Kuwait') selected @endif>
                                        Kuwait</option>
                                    <option value="Kyrgyzstan" @if ($business->country == 'Kyrgyzstan') selected @endif>
                                        Kyrgyzstan</option>
                                    <option value="Lao" @if ($business->country == 'Lao') selected @endif>
                                        Lao</option>
                                    <option value="Latvia" @if ($business->country == 'Latvia') selected @endif>
                                        Latvia</option>
                                    <option value="Lebanon" @if ($business->country == 'Lebanon') selected @endif>
                                        Lebanon</option>
                                    <option value="Lesotho" @if ($business->country == 'Lesotho') selected @endif>
                                        Lesotho</option>
                                    <option value="Liberia" @if ($business->country == 'Liberia') selected @endif>
                                        Liberia</option>
                                    <option value="Libyan Arab Jamahiriya"
                                        @if ($business->country == 'Libyan Arab Jamahiriya') selected @endif>
                                        Libyan Arab
                                        Jamahiriya</option>
                                    <option value="Liechtenstein"
                                        @if ($business->country == 'Liechtenstein') selected @endif>
                                        Liechtenstein</option>
                                    <option value="Lithuania" @if ($business->country == 'Lithuania') selected @endif>
                                        Lithuania</option>
                                    <option value="Luxembourg" @if ($business->country == 'Luxembourg') selected @endif>
                                        Luxembourg</option>
                                    <option value="Macau" @if ($business->country == 'Macau') selected @endif>
                                        Macau</option>
                                    <option value="Macedonia" @if ($business->country == 'Macedonia') selected @endif>
                                        Macedonia</option>
                                    <option value="Madagascar" @if ($business->country == 'Madagascar') selected @endif>
                                        Madagascar</option>
                                    <option value="Malawi" @if ($business->country == 'Malawi') selected @endif>
                                        Malawi</option>
                                    <option value="Malaysia" @if ($business->country == 'Malaysia') selected @endif>
                                        Malaysia</option>
                                    <option value="Maldives" @if ($business->country == 'Maldives') selected @endif>
                                        Maldives</option>
                                    <option value="Mali" @if ($business->country == 'Mali') selected @endif>
                                        Mali</option>
                                    <option value="Malta" @if ($business->country == 'Malta') selected @endif>
                                        Malta</option>
                                    <option value="Marshall Islands"
                                        @if ($business->country == 'Marshall Islands') selected @endif>
                                        Marshall Islands</option>
                                    <option value="Martinique" @if ($business->country == 'Martinique') selected @endif>
                                        Martinique</option>
                                    <option value="Mauritania" @if ($business->country == 'Mauritania') selected @endif>
                                        Mauritania</option>
                                    <option value="Mauritius" @if ($business->country == 'Mauritius') selected @endif>
                                        Mauritius</option>
                                    <option value="Mayotte" @if ($business->country == 'Mayotte') selected @endif>
                                        Mayotte</option>
                                    <option value="Mexico" @if ($business->country == 'Mexico') selected @endif>
                                        Mexico</option>
                                    <option value="Micronesia" @if ($business->country == 'Micronesia') selected @endif>
                                        Micronesia</option>
                                    <option value="Moldova" @if ($business->country == 'Moldova') selected @endif>
                                        Moldova
                                    </option>
                                    <option value="Monaco" @if ($business->country == 'Monaco') selected @endif>
                                        Monaco</option>
                                    <option value="Mongolia" @if ($business->country == 'Mongolia') selected @endif>
                                        Mongolia</option>
                                    <option value="Montserrat" @if ($business->country == 'Montserrat') selected @endif>
                                        Montserrat</option>
                                    <option value="Morocco" @if ($business->country == 'Morocco') selected @endif>
                                        Morocco</option>
                                    <option value="Mozambique" @if ($business->country == 'Mozambique') selected @endif>
                                        Mozambique</option>
                                    <option value="Myanmar" @if ($business->country == 'Myanmar') selected @endif>
                                        Myanmar</option>
                                    <option value="Namibia" @if ($business->country == 'Namibia') selected @endif>
                                        Namibia</option>
                                    <option value="Nauru" @if ($business->country == 'Nauru') selected @endif>
                                        Nauru</option>
                                    <option value="Nepal" @if ($business->country == 'Nepal') selected @endif>
                                        Nepal</option>
                                    <option value="Netherlands" @if ($business->country == 'Netherlands') selected @endif>
                                        Netherlands</option>
                                    <option value="Netherlands Antilles"
                                        @if ($business->country == 'Netherlands Antilles') selected @endif>
                                        Netherlands Antilles
                                    </option>
                                    <option value="New Caledonia"
                                        @if ($business->country == 'New Caledonia') selected @endif>
                                        New Caledonia</option>
                                    <option value="New Zealand" @if ($business->country == 'New Zealand') selected @endif>
                                        New Zealand</option>
                                    <option value="Nicaragua" @if ($business->country == 'Nicaragua') selected @endif>
                                        Nicaragua</option>
                                    <option value="Niger" @if ($business->country == 'Niger') selected @endif>
                                        Niger</option>
                                    <option value="Nigeria" @if ($business->country == 'Nigeria') selected @endif>
                                        Nigeria</option>
                                    <option value="Niue" @if ($business->country == 'Niue') selected @endif>
                                        Niue</option>
                                    <option value="Norfolk Island"
                                        @if ($business->country == 'Norfolk Island') selected @endif>
                                        Norfolk Island</option>
                                    <option value="Northern Mariana Islands"
                                        @if ($business->country == 'Northern Mariana Islands') selected @endif>
                                        Northern Mariana
                                        Islands</option>
                                    <option value="Norway" @if ($business->country == 'Norway') selected @endif>
                                        Norway</option>
                                    <option value="Oman" @if ($business->country == 'Oman') selected @endif>
                                        Oman</option>
                                    <option value="Pakistan" @if ($business->country == 'Pakistan') selected @endif>
                                        Pakistan</option>
                                    <option value="Palau" @if ($business->country == 'Palau') selected @endif>
                                        Palau</option>
                                    <option value="Panama" @if ($business->country == 'Panama') selected @endif>
                                        Panama</option>
                                    <option value="Papua New Guinea"
                                        @if ($business->country == 'Papua New Guinea') selected @endif>
                                        Papua New Guinea</option>
                                    <option value="Paraguay" @if ($business->country == 'Paraguay') selected @endif>
                                        Paraguay</option>
                                    <option value="Peru" @if ($business->country == 'Peru') selected @endif>
                                        Peru</option>
                                    <option value="Philippines" @if ($business->country == 'Philippines') selected @endif>
                                        Philippines</option>
                                    <option value="Pitcairn" @if ($business->country == 'Pitcairn') selected @endif>
                                        Pitcairn</option>
                                    <option value="Poland" @if ($business->country == 'Poland') selected @endif>
                                        Poland</option>
                                    <option value="Portugal" @if ($business->country == 'Portugal') selected @endif>
                                        Portugal</option>
                                    <option value="Puerto Rico" @if ($business->country == 'Puerto Rico') selected @endif>
                                        Puerto Rico</option>
                                    <option value="Qatar" @if ($business->country == 'Qatar') selected @endif>
                                        Qatar</option>
                                    <option value="Reunion" @if ($business->country == 'Reunion') selected @endif>
                                        Reunion</option>
                                    <option value="Romania" @if ($business->country == 'Romania') selected @endif>
                                        Romania</option>
                                    <option value="Russian Federation"
                                        @if ($business->country == 'Russian Federation') selected @endif>
                                        Russian Federation
                                    </option>
                                    <option value="Rwanda" @if ($business->country == 'Rwanda') selected @endif>
                                        Rwanda</option>
                                    <option value="Saint Kitts and Nevis"
                                        @if ($business->country == 'Saint Kitts and Nevis') selected @endif>
                                        Saint Kitts and Nevis
                                    </option>
                                    <option value="Saint Lucia" @if ($business->country == 'Saint Lucia') selected @endif>
                                        Saint Lucia</option>
                                    <option value="Saint Vincent and the Grenadines"
                                        @if ($business->country == 'Saint Vincent and the Grenadines') selected @endif>
                                        Saint
                                        Vincent and the Grenadines</option>
                                    <option value="Samoa" @if ($business->country == 'Samoa') selected @endif>
                                        Samoa</option>
                                    <option value="San Marino" @if ($business->country == 'San Marino') selected @endif>
                                        San Marino</option>
                                    <option value="Sao Tome and Principe"
                                        @if ($business->country == 'Sao Tome and Principe') selected @endif>
                                        Sao Tome and Principe
                                    </option>
                                    <option value="Saudi Arabia" @if ($business->country == 'Saudi Arabia') selected @endif>
                                        Saudi Arabia</option>
                                    <option value="Senegal" @if ($business->country == 'Senegal') selected @endif>
                                        Senegal</option>
                                    <option value="Seychelles" @if ($business->country == 'Seychelles') selected @endif>
                                        Seychelles</option>
                                    <option value="Sierra Leone" @if ($business->country == 'Sierra Leone') selected @endif>
                                        Sierra Leone</option>
                                    <option value="Singapore" @if ($business->country == 'Singapore') selected @endif>
                                        Singapore</option>
                                    <option value="Slovakia (Slovak Republic)"
                                        @if ($business->country == 'Slovakia (Slovak Republic)') selected @endif>
                                        Slovakia (Slovak
                                        Republic)</option>
                                    <option value="Slovenia" @if ($business->country == 'Slovenia') selected @endif>
                                        Slovenia</option>
                                    <option value="Solomon Islands"
                                        @if ($business->country == 'Solomon Islands') selected @endif>
                                        Solomon Islands</option>
                                    <option value="Somalia" @if ($business->country == 'Somalia') selected @endif>
                                        Somalia</option>
                                    <option value="South Africa" @if ($business->country == 'South Africa') selected @endif>
                                        South Africa</option>
                                    <option value="South Georgia and the South Sandwich Islands"
                                        @if ($business->country == 'South Georgia and the South Sandwich Islands') selected @endif>
                                        South Georgia and the South Sandwich Islands
                                    </option>
                                    <option value="Spain" @if ($business->country == 'Spain') selected @endif>
                                        Spain</option>
                                    <option value="Sri Lanka" @if ($business->country == 'Sri Lanka') selected @endif>
                                        Sri Lanka</option>
                                    <option value="St. Helena" @if ($business->country == 'St. Helena') selected @endif>
                                        St. Helena</option>
                                    <option value="St. Pierre and Miquelon"
                                        @if ($business->country == 'St. Pierre and Miquelon') selected @endif>
                                        St. Pierre and
                                        Miquelon</option>
                                    <option value="Sudan" @if ($business->country == 'Sudan') selected @endif>
                                        Sudan</option>
                                    <option value="Suriname" @if ($business->country == 'Suriname') selected @endif>
                                        Suriname</option>
                                    <option value="Svalbard and Jan Mayen Islands"
                                        @if ($business->country == 'Svalbard and Jan Mayen Islands') selected @endif>
                                        Svalbard and
                                        Jan Mayen Islands</option>
                                    <option value="Swaziland" @if ($business->country == 'Swaziland') selected @endif>
                                        Swaziland</option>
                                    <option value="Sweden" @if ($business->country == 'Sweden') selected @endif>
                                        Sweden</option>
                                    <option value="Switzerland" @if ($business->country == 'Switzerland') selected @endif>
                                        Switzerland</option>
                                    <option value="Syrian Arab Republic"
                                        @if ($business->country == 'Syrian Arab Republic') selected @endif>
                                        Syrian Arab Republic
                                    </option>
                                    <option value="Taiwan, Province of China"
                                        @if ($business->country == 'Taiwan, Province of China') selected @endif>
                                        Taiwan, Province
                                        of China</option>
                                    <option value="Tajikistan" @if ($business->country == 'Tajikistan') selected @endif>
                                        Tajikistan</option>
                                    <option value="Tanzania, United Republic of"
                                        @if ($business->country == 'Tanzania, United Republic of') selected @endif>
                                        Tanzania,
                                        United Republic of</option>
                                    <option value="Thailand" @if ($business->country == 'Thailand') selected @endif>
                                        Thailand</option>
                                    <option value="Togo" @if ($business->country == 'Togo') selected @endif>
                                        Togo</option>
                                    <option value="Tokelau" @if ($business->country == 'Tokelau') selected @endif>
                                        Tokelau</option>
                                    <option value="Tonga" @if ($business->country == 'Tonga') selected @endif>
                                        Tonga</option>
                                    <option value="Trinidad and Tobago"
                                        @if ($business->country == 'Trinidad and Tobago') selected @endif>
                                        Trinidad and Tobago
                                    </option>
                                    <option value="Tunisia" @if ($business->country == 'Tunisia') selected @endif>
                                        Tunisia</option>
                                    <option value="Turkey" @if ($business->country == 'Turkey') selected @endif>
                                        Turkey</option>
                                    <option value="Turkmenistan" @if ($business->country == 'Turkmenistan') selected @endif>
                                        Turkmenistan</option>
                                    <option value="Turks and Caicos Islands"
                                        @if ($business->country == 'Turks and Caicos Islands') selected @endif>
                                        Turks and Caicos
                                        Islands</option>
                                    <option value="Tuvalu" @if ($business->country == 'Tuvalu') selected @endif>
                                        Tuvalu</option>
                                    <option value="Uganda" @if ($business->country == 'Uganda') selected @endif>
                                        Uganda</option>
                                    <option value="Ukraine" @if ($business->country == 'Ukraine') selected @endif>
                                        Ukraine</option>
                                    <option value="United Arab Emirates"
                                        @if ($business->country == 'United Arab Emirates') selected @endif>
                                        United Arab Emirates
                                    </option>
                                    <option value="United Kingdom"
                                        @if ($business->country == 'United Kingdom') selected @endif>
                                        United Kingdom</option>
                                    <option value="United States"
                                        @if ($business->country == 'United States') selected @endif>
                                        United States</option>
                                    <option value="United States Minor Outlying Islands"
                                        @if ($business->country == 'United States Minor Outlying Islands') selected @endif>
                                        United
                                        States Minor Outlying Islands</option>
                                    <option value="Uruguay" @if ($business->country == 'Uruguay') selected @endif>
                                        Uruguay</option>
                                    <option value="Uzbekistan" @if ($business->country == 'Uzbekistan') selected @endif>
                                        Uzbekistan</option>
                                    <option value="Vanuatu" @if ($business->country == 'Vanuatu') selected @endif>
                                        Vanuatu</option>
                                    <option value="Venezuela" @if ($business->country == 'Venezuela') selected @endif>
                                        Venezuela</option>
                                    <option value="Vietnam" @if ($business->country == 'Vietnam') selected @endif>
                                        Vietnam</option>
                                    <option value="Virgin Islands (British)"
                                        @if ($business->country == 'Virgin Islands (British)') selected @endif>
                                        Virgin Islands
                                        (British)</option>
                                    <option value="Virgin Islands (U.S.)"
                                        @if ($business->country == 'Virgin Islands (U.S.)') selected @endif>
                                        Virgin Islands (U.S.)
                                    </option>
                                    <option value="Wallis and Futuna Islands"
                                        @if ($business->country == 'Wallis and Futuna Islands') selected @endif>
                                        Wallis and Futuna
                                        Islands</option>
                                    <option value="Western Sahara"
                                        @if ($business->country == 'Western Sahara') selected @endif>
                                        Western Sahara</option>
                                    <option value="Yemen" @if ($business->country == 'Yemen') selected @endif>
                                        Yemen</option>
                                    <option value="Yugoslavia" @if ($business->country == 'Yugoslavia') selected @endif>
                                        Yugoslavia</option>
                                    <option value="Zambia" @if ($business->country == 'Zambia') selected @endif>
                                        Zambia</option>
                                    <option value="Zimbabwe" @if ($business->country == 'Zimbabwe') selected @endif>
                                        Zimbabwe</option>
                                </select>
                                <div class="invalid-feedback">Please select country</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">State</label>
                                <input type="text" name="state" value="{{ $business->state }}"
                                    class="form-control" placeholder="Enter State" required>
                                <div class="invalid-feedback">Please enter state</div>
                            </div>

                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">City</label>
                                <input type="text" name="city" value="{{ $business->city }}"
                                    class="form-control" placeholder="Enter City" required>
                                <div class="invalid-feedback">Please enter city</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Address</label>
                                <input type="text" name="business_address"
                                    value="{{ $business->business_address }}" class="form-control"
                                    placeholder="Enter Business Address" required>
                                <div class="invalid-feedback">Please enter business address</div>
                            </div>

                            <div class="mb-3 col-md-12 col-12">
                                <label class="form-label">Website URL</label>
                                <input type="text" name="website_url" value="{{ $business->website_url }}"
                                    class="form-control" placeholder="Enter Website URL">
                                <div class="invalid-feedback">Please enter website url</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Facebook Profile</label>
                                <input type="text" name="facebook_profile" value="{{ $business->facebook_url }}"
                                    class="form-control" placeholder="Enter Facebook Profile">
                                <div class="invalid-feedback">Please enter facebook profile</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Instagram Profile</label>
                                <input type="text" name="instagram_profile"
                                    value="{{ $business->instagram_url }}" class="form-control"
                                    placeholder="Enter Instagram Profile">
                                <div class="invalid-feedback">Please enter instagram profile</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">Twitter Profile</label>
                                <input type="text" name="twitter_profile" value="{{ $business->twitter_url }}"
                                    class="form-control" placeholder="Enter Twitter Profile">
                                <div class="invalid-feedback">Please enter twitter profile</div>
                            </div>
                            <div class="mb-3 col-md-6 col-12">
                                <label class="form-label">LinkedIn Profile</label>
                                <input type="text" name="linkedin_profile" value="{{ $business->linkedin_url }}"
                                    class="form-control" placeholder="Enter LinkedIn Profile">
                                <div class="invalid-feedback">Please enter linkedin profile</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- button -->
                <div class="">
                    <button type="submit" class="btn btn-primary">Update Business Information</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("navSettings").classList.add('show');
    document.getElementById("busDet").classList.add('active');
</script>
@endsection

@section('customjs')
<script type="text/javascript">
    CKEDITOR.replace('editor1');
</script>
@endsection
