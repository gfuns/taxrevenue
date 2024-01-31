@extends('business.layouts.app')

@section('content')
@section('title', env('APP_NAME') . ' | Profile Information')

<!-- Container fluid -->
<section class="container-fluid p-4">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div class="border-bottom pb-4 d-lg-flex align-items-center justify-content-between">
                <div class="mb-2 mb-lg-0">
                    <h1 class="mb-0 h2 fw-bold">Profile Information </h1>
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('business.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Account Settings</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Profile Information
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <div class="py-6">
        <!-- row -->
        <div class="row">
            <div class="offset-xl-2 col-xl-8 col-md-12 col-12">
                <!-- card -->
                <div class="card">
                    <!-- card body -->
                    <div class="card-body p-lg-6">
                        <!-- form -->
                        <form method="post" action="{{ route('business.updateProfile') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- form group -->
                                <div class="mb-3 col-md-6 col-12">
                                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" value="{{ Auth::user()->first_name }}"
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        placeholder="Enter First Name" required>
                                    @error('first_name')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6 col-12">
                                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" value="{{ Auth::user()->last_name }}"
                                        class="form-control @error('first_name') is-invalid @enderror"
                                        placeholder="Enter Last Name" required>
                                    @error('last_name')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6 col-12">
                                    <label class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter Last Name" required>
                                    @error('email')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6 col-12">
                                    <label class="form-label">Phone Number<span class="text-danger">*</span></label>
                                    <input type="text" name="phone" value="{{ Auth::user()->phone }}"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        placeholder="Enter Phone Number" required>
                                    @error('phone')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6 col-12">
                                    <label class="form-label">Gender<span class="text-danger">*</span></label>
                                    <select id="gender" name="gender"
                                        class="selectpicker @error('gender') is-invalid @enderror" data-width="100%"
                                        required>
                                        <option value="">Select Gender</option>
                                        <option value="Male" @if (Auth::user()->gender == 'Male') selected @endif>Male
                                        </option>
                                        <option value="Female" @if (Auth::user()->gender == 'Female') selected @endif>Female
                                        </option>
                                    </select>
                                    @error('gender')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6 col-12">
                                    <label class="form-label">Country<span class="text-danger">*</span></label>
                                    <select id="country" name="country" class="@error('country') is-invalid @enderror"
                                        data-width="100%" required>
                                        <option value="">Select Country</option>
                                        <option value="Afghanistan" @if (Auth::user()->country == 'Afghanistan') selected @endif>
                                            Afghanistan</option>
                                        <option value="Albania" @if (Auth::user()->country == 'Albania') selected @endif>
                                            Albania</option>
                                        <option value="Algeria" @if (Auth::user()->country == 'Algeria') selected @endif>
                                            Algeria</option>
                                        <option value="American Samoa"
                                            @if (Auth::user()->country == 'American Samoa') selected @endif>
                                            American Samoa</option>
                                        <option value="Andorra" @if (Auth::user()->country == 'Andorra') selected @endif>
                                            Andorra</option>
                                        <option value="Angola" @if (Auth::user()->country == 'Angola') selected @endif>
                                            Angola
                                        </option>
                                        <option value="Anguilla" @if (Auth::user()->country == 'Anguilla') selected @endif>
                                            Anguilla</option>
                                        <option value="Antarctica" @if (Auth::user()->country == 'Antarctica') selected @endif>
                                            Antarctica</option>
                                        <option value="Antigua and Barbuda"
                                            @if (Auth::user()->country == 'Antigua and Barbuda') selected @endif>
                                            Antigua and Barbuda
                                        </option>
                                        <option value="Argentina" @if (Auth::user()->country == 'Argentina') selected @endif>
                                            Argentina</option>
                                        <option value="Armenia" @if (Auth::user()->country == 'Armenia') selected @endif>
                                            Armenia</option>
                                        <option value="Aruba" @if (Auth::user()->country == 'Aruba') selected @endif>
                                            Aruba</option>
                                        <option value="Australia" @if (Auth::user()->country == 'Australia') selected @endif>
                                            Australia</option>
                                        <option value="Austria" @if (Auth::user()->country == 'Austria') selected @endif>
                                            Austria</option>
                                        <option value="Azerbaijan" @if (Auth::user()->country == 'Azerbaijan') selected @endif>
                                            Azerbaijan</option>
                                        <option value="Bahamas" @if (Auth::user()->country == 'Bahamas') selected @endif>
                                            Bahamas</option>
                                        <option value="Bahrain" @if (Auth::user()->country == 'Bahrain') selected @endif>
                                            Bahrain</option>
                                        <option value="Bangladesh" @if (Auth::user()->country == 'Bangladesh') selected @endif>
                                            Bangladesh</option>
                                        <option value="Barbados" @if (Auth::user()->country == 'Barbados') selected @endif>
                                            Barbados</option>
                                        <option value="Belarus" @if (Auth::user()->country == 'Belarus') selected @endif>
                                            Belarus</option>
                                        <option value="Belgium" @if (Auth::user()->country == 'Belgium') selected @endif>
                                            Belgium</option>
                                        <option value="Belize" @if (Auth::user()->country == 'Belize') selected @endif>
                                            Belize</option>
                                        <option value="Benin" @if (Auth::user()->country == 'Benin') selected @endif>
                                            Benin</option>
                                        <option value="Bermuda" @if (Auth::user()->country == 'Bermuda') selected @endif>
                                            Bermuda</option>
                                        <option value="Bhutan" @if (Auth::user()->country == 'Bhutan') selected @endif>
                                            Bhutan</option>
                                        <option value="Bolivia" @if (Auth::user()->country == 'Bolivia') selected @endif>
                                            Bolivia</option>
                                        <option value="Bosnia and Herzegowina"
                                            @if (Auth::user()->country == 'Bosnia and Herzegowina') selected @endif>
                                            Bosnia and
                                            Herzegowina</option>
                                        <option value="Botswana" @if (Auth::user()->country == 'Botswana') selected @endif>
                                            Botswana</option>
                                        <option value="Bouvet Island"
                                            @if (Auth::user()->country == 'Bouvet Island') selected @endif>
                                            Bouvet Island</option>
                                        <option value="Brazil" @if (Auth::user()->country == 'Brazil') selected @endif>
                                            Brazil</option>
                                        <option value="British Indian Ocean Territory"
                                            @if (Auth::user()->country == 'British Indian Ocean Territory') selected @endif>
                                            British
                                            Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam"
                                            @if (Auth::user()->country == 'Brunei Darussalam') selected @endif>
                                            Brunei Darussalam
                                        </option>
                                        <option value="Bulgaria" @if (Auth::user()->country == 'Bulgaria') selected @endif>
                                            Bulgaria</option>
                                        <option value="Burkina Faso"
                                            @if (Auth::user()->country == 'Burkina Faso') selected @endif>
                                            Burkina Faso</option>
                                        <option value="Burundi" @if (Auth::user()->country == 'Burundi') selected @endif>
                                            Burundi</option>
                                        <option value="Cambodia" @if (Auth::user()->country == 'Cambodia') selected @endif>
                                            Cambodia</option>
                                        <option value="Cameroon" @if (Auth::user()->country == 'Cameroon') selected @endif>
                                            Cameroon</option>
                                        <option value="Canada" @if (Auth::user()->country == 'Canada') selected @endif>
                                            Canada</option>
                                        <option value="Cape Verde" @if (Auth::user()->country == 'Cape Verde') selected @endif>
                                            Cape
                                            Verde</option>
                                        <option value="Cayman Islands"
                                            @if (Auth::user()->country == 'Cayman Islands') selected @endif>
                                            Cayman Islands</option>
                                        <option value="Central African Republic"
                                            @if (Auth::user()->country == 'Central African Republic') selected @endif>
                                            Central African
                                            Republic</option>
                                        <option value="Chad" @if (Auth::user()->country == 'Chad') selected @endif>
                                            Chad
                                        </option>
                                        <option value="Chile" @if (Auth::user()->country == 'Chile') selected @endif>
                                            Chile</option>
                                        <option value="China" @if (Auth::user()->country == 'China') selected @endif>
                                            China</option>
                                        <option value="Christmas Island"
                                            @if (Auth::user()->country == 'Christmas Island') selected @endif>
                                            Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands"
                                            @if (Auth::user()->country == 'Cocos (Keeling) Islands') selected @endif>
                                            Cocos (Keeling)
                                            Islands</option>
                                        <option value="Colombia" @if (Auth::user()->country == 'Colombia') selected @endif>
                                            Colombia</option>
                                        <option value="Comoros" @if (Auth::user()->country == 'Comoros') selected @endif>
                                            Comoros</option>
                                        <option value="Congo" @if (Auth::user()->country == 'Congo') selected @endif>
                                            Congo</option>
                                        <option value="The Democratic Republic of the Congo"
                                            @if (Auth::user()->country == 'The Democratic Republic of the Congo') selected @endif>
                                            The Democratic Republic of the Congo</option>
                                        <option value="Cook Islands"
                                            @if (Auth::user()->country == 'the Democratic Republic of the Congo') selected @endif>
                                            Cook
                                            Islands</option>
                                        <option value="Costa Rica" @if (Auth::user()->country == 'Costa Rica') selected @endif>
                                            Costa Rica</option>
                                        <option value="Cote d'Ivoire"
                                            @if (Auth::user()->country == "Cote d'Ivoire") selected @endif>
                                            Cote
                                            d'Ivoire
                                        </option>
                                        <option value="Croatia (Hrvatska)"
                                            @if (Auth::user()->country == 'Croatia (Hrvatska)') selected @endif>
                                            Croatia (Hrvatska)
                                        </option>
                                        <option value="Cuba" @if (Auth::user()->country == 'Cuba') selected @endif>
                                            Cuba
                                        </option>
                                        <option value="Cyprus" @if (Auth::user()->country == 'Cyprus') selected @endif>
                                            Cyprus</option>
                                        <option value="Czech Republic"
                                            @if (Auth::user()->country == 'Czech Republic') selected @endif>
                                            Czech Republic</option>
                                        <option value="Denmark" @if (Auth::user()->country == 'Denmark') selected @endif>
                                            Denmark</option>
                                        <option value="Djibouti" @if (Auth::user()->country == 'Djibouti') selected @endif>
                                            Djibouti</option>
                                        <option value="Dominica" @if (Auth::user()->country == 'Dominica') selected @endif>
                                            Dominica</option>
                                        <option value="Dominican Republic"
                                            @if (Auth::user()->country == 'Dominican Republic') selected @endif>
                                            Dominican Republic
                                        </option>
                                        <option value="East Timor" @if (Auth::user()->country == 'East Timor') selected @endif>
                                            East
                                            Timor</option>
                                        <option value="Ecuador" @if (Auth::user()->country == 'Ecuador') selected @endif>
                                            Ecuador</option>
                                        <option value="Egypt" @if (Auth::user()->country == 'Egypt') selected @endif>
                                            Egypt</option>
                                        <option value="El Salvador"
                                            @if (Auth::user()->country == 'El Salvador') selected @endif>
                                            El
                                            Salvador</option>
                                        <option value="Equatorial Guinea"
                                            @if (Auth::user()->country == 'Equatorial Guinea') selected @endif>
                                            Equatorial Guinea
                                        </option>
                                        <option value="Eritrea" @if (Auth::user()->country == 'Eritrea') selected @endif>
                                            Eritrea</option>
                                        <option value="Estonia" @if (Auth::user()->country == 'Estonia') selected @endif>
                                            Estonia</option>
                                        <option value="Ethiopia" @if (Auth::user()->country == 'Ethiopia') selected @endif>
                                            Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)"
                                            @if (Auth::user()->country == 'Falkland Islands (Malvinas)') selected @endif>
                                            Falkland
                                            Islands (Malvinas)</option>
                                        <option value="Faroe Islands"
                                            @if (Auth::user()->country == 'Faroe Islands') selected @endif>
                                            Faroe Islands</option>
                                        <option value="Fiji" @if (Auth::user()->country == 'Fiji') selected @endif>
                                            Fiji
                                        </option>
                                        <option value="Finland" @if (Auth::user()->country == 'Finland') selected @endif>
                                            Finland</option>
                                        <option value="France" @if (Auth::user()->country == 'France') selected @endif>
                                            France</option>
                                        <option value="France Metropolitan"
                                            @if (Auth::user()->country == 'France Metropolitan') selected @endif>
                                            France Metropolitan
                                        </option>
                                        <option value="French Guiana"
                                            @if (Auth::user()->country == 'French Guiana') selected @endif>
                                            French Guiana</option>
                                        <option value="French Polynesia"
                                            @if (Auth::user()->country == 'French Polynesia') selected @endif>
                                            French Polynesia</option>
                                        <option value="French Southern Territories"
                                            @if (Auth::user()->country == 'French Southern Territories') selected @endif>
                                            French Southern
                                            Territories</option>
                                        <option value="Gabon" @if (Auth::user()->country == 'Gabon') selected @endif>
                                            Gabon</option>
                                        <option value="Gambia" @if (Auth::user()->country == 'Gambia') selected @endif>
                                            Gambia</option>
                                        <option value="Georgia" @if (Auth::user()->country == 'Georgia') selected @endif>
                                            Georgia</option>
                                        <option value="Germany" @if (Auth::user()->country == 'Germany') selected @endif>
                                            Germany</option>
                                        <option value="Ghana" @if (Auth::user()->country == 'Ghana') selected @endif>
                                            Ghana</option>
                                        <option value="Gibraltar" @if (Auth::user()->country == 'Gibraltar') selected @endif>
                                            Gibraltar</option>
                                        <option value="Greece" @if (Auth::user()->country == 'Greece') selected @endif>
                                            Greece</option>
                                        <option value="Greenland" @if (Auth::user()->country == 'Greenland') selected @endif>
                                            Greenland</option>
                                        <option value="Grenada" @if (Auth::user()->country == 'Grenada') selected @endif>
                                            Grenada</option>
                                        <option value="Guadeloupe" @if (Auth::user()->country == 'Guadeloupe') selected @endif>
                                            Guadeloupe</option>
                                        <option value="Guam" @if (Auth::user()->country == 'Guam') selected @endif>
                                            Guam
                                        </option>
                                        <option value="Guatemala" @if (Auth::user()->country == 'Guatemala') selected @endif>
                                            Guatemala</option>
                                        <option value="Guinea" @if (Auth::user()->country == 'Guinea') selected @endif>
                                            Guinea</option>
                                        <option value="Guinea-Bissau"
                                            @if (Auth::user()->country == 'Guinea-Bissau') selected @endif>
                                            Guinea-Bissau</option>
                                        <option value="Guyana" @if (Auth::user()->country == 'Guyana') selected @endif>
                                            Guyana</option>
                                        <option value="Haiti" @if (Auth::user()->country == 'Haiti') selected @endif>
                                            Haiti</option>
                                        <option value="Heard and Mc Donald Islands"
                                            @if (Auth::user()->country == 'Heard and Mc Donald Islands') selected @endif>
                                            Heard and Mc
                                            Donald Islands</option>
                                        <option value="Holy See (Vatican City State)"
                                            @if (Auth::user()->country == 'Holy See (Vatican City State)') selected @endif>
                                            Holy
                                            See
                                            (Vatican City State)</option>
                                        <option value="Honduras" @if (Auth::user()->country == 'Honduras') selected @endif>
                                            Honduras</option>
                                        <option value="Hong Kong" @if (Auth::user()->country == 'Hong Kong') selected @endif>
                                            Hong
                                            Kong</option>
                                        <option value="Hungary" @if (Auth::user()->country == 'Hungary') selected @endif>
                                            Hungary</option>
                                        <option value="Iceland" @if (Auth::user()->country == 'Iceland') selected @endif>
                                            Iceland</option>
                                        <option value="India" @if (Auth::user()->country == 'India') selected @endif>
                                            India</option>
                                        <option value="Indonesia"
                                            @if (Auth::user()->country == 'Indonesia') selected @endif>
                                            Indonesia</option>
                                        <option value="Iran" @if (Auth::user()->country == 'Iran') selected @endif>
                                            Iran</option>
                                        <option value="Iraq" @if (Auth::user()->country == 'Iraq') selected @endif>
                                            Iraq</option>
                                        <option value="Ireland" @if (Auth::user()->country == 'Ireland') selected @endif>
                                            Ireland</option>
                                        <option value="Israel" @if (Auth::user()->country == 'Israel') selected @endif>
                                            Israel</option>
                                        <option value="Italy" @if (Auth::user()->country == 'Italy') selected @endif>
                                            Italy</option>
                                        <option value="Jamaica" @if (Auth::user()->country == 'Jamaica') selected @endif>
                                            Jamaica</option>
                                        <option value="Japan" @if (Auth::user()->country == 'Japan') selected @endif>
                                            Japan</option>
                                        <option value="Jordan" @if (Auth::user()->country == 'Jordan') selected @endif>
                                            Jordan</option>
                                        <option value="Kazakhstan"
                                            @if (Auth::user()->country == 'Kazakhstan') selected @endif>
                                            Kazakhstan</option>
                                        <option value="Kenya" @if (Auth::user()->country == 'Kenya') selected @endif>
                                            Kenya</option>
                                        <option value="Kiribati" @if (Auth::user()->country == 'Kiribati') selected @endif>
                                            Kiribati</option>
                                        <option value="North Korea"
                                            @if (Auth::user()->country == 'North Korea') selected @endif>
                                            North Korea</option>
                                        <option value="South Korea"
                                            @if (Auth::user()->country == 'South Korea') selected @endif>
                                            South Korea
                                        </option>
                                        <option value="Kuwait" @if (Auth::user()->country == 'Kuwait') selected @endif>
                                            Kuwait</option>
                                        <option value="Kyrgyzstan"
                                            @if (Auth::user()->country == 'Kyrgyzstan') selected @endif>
                                            Kyrgyzstan</option>
                                        <option value="Lao" @if (Auth::user()->country == 'Lao') selected @endif>
                                            Lao</option>
                                        <option value="Latvia" @if (Auth::user()->country == 'Latvia') selected @endif>
                                            Latvia</option>
                                        <option value="Lebanon" @if (Auth::user()->country == 'Lebanon') selected @endif>
                                            Lebanon</option>
                                        <option value="Lesotho" @if (Auth::user()->country == 'Lesotho') selected @endif>
                                            Lesotho</option>
                                        <option value="Liberia" @if (Auth::user()->country == 'Liberia') selected @endif>
                                            Liberia</option>
                                        <option value="Libyan Arab Jamahiriya"
                                            @if (Auth::user()->country == 'Libyan Arab Jamahiriya') selected @endif>
                                            Libyan Arab
                                            Jamahiriya</option>
                                        <option value="Liechtenstein"
                                            @if (Auth::user()->country == 'Liechtenstein') selected @endif>
                                            Liechtenstein</option>
                                        <option value="Lithuania"
                                            @if (Auth::user()->country == 'Lithuania') selected @endif>
                                            Lithuania</option>
                                        <option value="Luxembourg"
                                            @if (Auth::user()->country == 'Luxembourg') selected @endif>
                                            Luxembourg</option>
                                        <option value="Macau" @if (Auth::user()->country == 'Macau') selected @endif>
                                            Macau</option>
                                        <option value="Macedonia"
                                            @if (Auth::user()->country == 'Macedonia') selected @endif>
                                            Macedonia</option>
                                        <option value="Madagascar"
                                            @if (Auth::user()->country == 'Madagascar') selected @endif>
                                            Madagascar</option>
                                        <option value="Malawi" @if (Auth::user()->country == 'Malawi') selected @endif>
                                            Malawi</option>
                                        <option value="Malaysia" @if (Auth::user()->country == 'Malaysia') selected @endif>
                                            Malaysia</option>
                                        <option value="Maldives" @if (Auth::user()->country == 'Maldives') selected @endif>
                                            Maldives</option>
                                        <option value="Mali" @if (Auth::user()->country == 'Mali') selected @endif>
                                            Mali</option>
                                        <option value="Malta" @if (Auth::user()->country == 'Malta') selected @endif>
                                            Malta</option>
                                        <option value="Marshall Islands"
                                            @if (Auth::user()->country == 'Marshall Islands') selected @endif>
                                            Marshall Islands</option>
                                        <option value="Martinique"
                                            @if (Auth::user()->country == 'Martinique') selected @endif>
                                            Martinique</option>
                                        <option value="Mauritania"
                                            @if (Auth::user()->country == 'Mauritania') selected @endif>
                                            Mauritania</option>
                                        <option value="Mauritius"
                                            @if (Auth::user()->country == 'Mauritius') selected @endif>
                                            Mauritius</option>
                                        <option value="Mayotte" @if (Auth::user()->country == 'Mayotte') selected @endif>
                                            Mayotte</option>
                                        <option value="Mexico" @if (Auth::user()->country == 'Mexico') selected @endif>
                                            Mexico</option>
                                        <option value="Micronesia"
                                            @if (Auth::user()->country == 'Micronesia') selected @endif>
                                            Micronesia</option>
                                        <option value="Moldova" @if (Auth::user()->country == 'Moldova') selected @endif>
                                            Moldova
                                        </option>
                                        <option value="Monaco" @if (Auth::user()->country == 'Monaco') selected @endif>
                                            Monaco</option>
                                        <option value="Mongolia" @if (Auth::user()->country == 'Mongolia') selected @endif>
                                            Mongolia</option>
                                        <option value="Montserrat"
                                            @if (Auth::user()->country == 'Montserrat') selected @endif>
                                            Montserrat</option>
                                        <option value="Morocco" @if (Auth::user()->country == 'Morocco') selected @endif>
                                            Morocco</option>
                                        <option value="Mozambique"
                                            @if (Auth::user()->country == 'Mozambique') selected @endif>
                                            Mozambique</option>
                                        <option value="Myanmar" @if (Auth::user()->country == 'Myanmar') selected @endif>
                                            Myanmar</option>
                                        <option value="Namibia" @if (Auth::user()->country == 'Namibia') selected @endif>
                                            Namibia</option>
                                        <option value="Nauru" @if (Auth::user()->country == 'Nauru') selected @endif>
                                            Nauru</option>
                                        <option value="Nepal" @if (Auth::user()->country == 'Nepal') selected @endif>
                                            Nepal</option>
                                        <option value="Netherlands"
                                            @if (Auth::user()->country == 'Netherlands') selected @endif>
                                            Netherlands</option>
                                        <option value="Netherlands Antilles"
                                            @if (Auth::user()->country == 'Netherlands Antilles') selected @endif>
                                            Netherlands Antilles
                                        </option>
                                        <option value="New Caledonia"
                                            @if (Auth::user()->country == 'New Caledonia') selected @endif>
                                            New Caledonia</option>
                                        <option value="New Zealand"
                                            @if (Auth::user()->country == 'New Zealand') selected @endif>
                                            New Zealand</option>
                                        <option value="Nicaragua"
                                            @if (Auth::user()->country == 'Nicaragua') selected @endif>
                                            Nicaragua</option>
                                        <option value="Niger" @if (Auth::user()->country == 'Niger') selected @endif>
                                            Niger</option>
                                        <option value="Nigeria" @if (Auth::user()->country == 'Nigeria') selected @endif>
                                            Nigeria</option>
                                        <option value="Niue" @if (Auth::user()->country == 'Niue') selected @endif>
                                            Niue</option>
                                        <option value="Norfolk Island"
                                            @if (Auth::user()->country == 'Norfolk Island') selected @endif>
                                            Norfolk Island</option>
                                        <option value="Northern Mariana Islands"
                                            @if (Auth::user()->country == 'Northern Mariana Islands') selected @endif>
                                            Northern Mariana
                                            Islands</option>
                                        <option value="Norway" @if (Auth::user()->country == 'Norway') selected @endif>
                                            Norway</option>
                                        <option value="Oman" @if (Auth::user()->country == 'Oman') selected @endif>
                                            Oman</option>
                                        <option value="Pakistan" @if (Auth::user()->country == 'Pakistan') selected @endif>
                                            Pakistan</option>
                                        <option value="Palau" @if (Auth::user()->country == 'Palau') selected @endif>
                                            Palau</option>
                                        <option value="Panama" @if (Auth::user()->country == 'Panama') selected @endif>
                                            Panama</option>
                                        <option value="Papua New Guinea"
                                            @if (Auth::user()->country == 'Papua New Guinea') selected @endif>
                                            Papua New Guinea</option>
                                        <option value="Paraguay" @if (Auth::user()->country == 'Paraguay') selected @endif>
                                            Paraguay</option>
                                        <option value="Peru" @if (Auth::user()->country == 'Peru') selected @endif>
                                            Peru</option>
                                        <option value="Philippines"
                                            @if (Auth::user()->country == 'Philippines') selected @endif>
                                            Philippines</option>
                                        <option value="Pitcairn" @if (Auth::user()->country == 'Pitcairn') selected @endif>
                                            Pitcairn</option>
                                        <option value="Poland" @if (Auth::user()->country == 'Poland') selected @endif>
                                            Poland</option>
                                        <option value="Portugal" @if (Auth::user()->country == 'Portugal') selected @endif>
                                            Portugal</option>
                                        <option value="Puerto Rico"
                                            @if (Auth::user()->country == 'Puerto Rico') selected @endif>
                                            Puerto Rico</option>
                                        <option value="Qatar" @if (Auth::user()->country == 'Qatar') selected @endif>
                                            Qatar</option>
                                        <option value="Reunion" @if (Auth::user()->country == 'Reunion') selected @endif>
                                            Reunion</option>
                                        <option value="Romania" @if (Auth::user()->country == 'Romania') selected @endif>
                                            Romania</option>
                                        <option value="Russian Federation"
                                            @if (Auth::user()->country == 'Russian Federation') selected @endif>
                                            Russian Federation
                                        </option>
                                        <option value="Rwanda" @if (Auth::user()->country == 'Rwanda') selected @endif>
                                            Rwanda</option>
                                        <option value="Saint Kitts and Nevis"
                                            @if (Auth::user()->country == 'Saint Kitts and Nevis') selected @endif>
                                            Saint Kitts and Nevis
                                        </option>
                                        <option value="Saint Lucia"
                                            @if (Auth::user()->country == 'Saint Lucia') selected @endif>
                                            Saint Lucia</option>
                                        <option value="Saint Vincent and the Grenadines"
                                            @if (Auth::user()->country == 'Saint Vincent and the Grenadines') selected @endif>
                                            Saint
                                            Vincent and the Grenadines</option>
                                        <option value="Samoa" @if (Auth::user()->country == 'Samoa') selected @endif>
                                            Samoa</option>
                                        <option value="San Marino"
                                            @if (Auth::user()->country == 'San Marino') selected @endif>
                                            San Marino</option>
                                        <option value="Sao Tome and Principe"
                                            @if (Auth::user()->country == 'Sao Tome and Principe') selected @endif>
                                            Sao Tome and Principe
                                        </option>
                                        <option value="Saudi Arabia"
                                            @if (Auth::user()->country == 'Saudi Arabia') selected @endif>
                                            Saudi Arabia</option>
                                        <option value="Senegal" @if (Auth::user()->country == 'Senegal') selected @endif>
                                            Senegal</option>
                                        <option value="Seychelles"
                                            @if (Auth::user()->country == 'Seychelles') selected @endif>
                                            Seychelles</option>
                                        <option value="Sierra Leone"
                                            @if (Auth::user()->country == 'Sierra Leone') selected @endif>
                                            Sierra Leone</option>
                                        <option value="Singapore"
                                            @if (Auth::user()->country == 'Singapore') selected @endif>
                                            Singapore</option>
                                        <option value="Slovakia (Slovak Republic)"
                                            @if (Auth::user()->country == 'Slovakia (Slovak Republic)') selected @endif>
                                            Slovakia (Slovak
                                            Republic)</option>
                                        <option value="Slovenia" @if (Auth::user()->country == 'Slovenia') selected @endif>
                                            Slovenia</option>
                                        <option value="Solomon Islands"
                                            @if (Auth::user()->country == 'Solomon Islands') selected @endif>
                                            Solomon Islands</option>
                                        <option value="Somalia" @if (Auth::user()->country == 'Somalia') selected @endif>
                                            Somalia</option>
                                        <option value="South Africa"
                                            @if (Auth::user()->country == 'South Africa') selected @endif>
                                            South Africa</option>
                                        <option value="South Georgia and the South Sandwich Islands"
                                            @if (Auth::user()->country == 'South Georgia and the South Sandwich Islands') selected @endif>
                                            South Georgia and the South Sandwich Islands
                                        </option>
                                        <option value="Spain" @if (Auth::user()->country == 'Spain') selected @endif>
                                            Spain</option>
                                        <option value="Sri Lanka"
                                            @if (Auth::user()->country == 'Sri Lanka') selected @endif>
                                            Sri Lanka</option>
                                        <option value="St. Helena"
                                            @if (Auth::user()->country == 'St. Helena') selected @endif>
                                            St. Helena</option>
                                        <option value="St. Pierre and Miquelon"
                                            @if (Auth::user()->country == 'St. Pierre and Miquelon') selected @endif>
                                            St. Pierre and
                                            Miquelon</option>
                                        <option value="Sudan" @if (Auth::user()->country == 'Sudan') selected @endif>
                                            Sudan</option>
                                        <option value="Suriname" @if (Auth::user()->country == 'Suriname') selected @endif>
                                            Suriname</option>
                                        <option value="Svalbard and Jan Mayen Islands"
                                            @if (Auth::user()->country == 'Svalbard and Jan Mayen Islands') selected @endif>
                                            Svalbard and
                                            Jan Mayen Islands</option>
                                        <option value="Swaziland"
                                            @if (Auth::user()->country == 'Swaziland') selected @endif>
                                            Swaziland</option>
                                        <option value="Sweden" @if (Auth::user()->country == 'Sweden') selected @endif>
                                            Sweden</option>
                                        <option value="Switzerland"
                                            @if (Auth::user()->country == 'Switzerland') selected @endif>
                                            Switzerland</option>
                                        <option value="Syrian Arab Republic"
                                            @if (Auth::user()->country == 'Syrian Arab Republic') selected @endif>
                                            Syrian Arab Republic
                                        </option>
                                        <option value="Taiwan, Province of China"
                                            @if (Auth::user()->country == 'Taiwan, Province of China') selected @endif>
                                            Taiwan, Province
                                            of China</option>
                                        <option value="Tajikistan"
                                            @if (Auth::user()->country == 'Tajikistan') selected @endif>
                                            Tajikistan</option>
                                        <option value="Tanzania, United Republic of"
                                            @if (Auth::user()->country == 'Tanzania, United Republic of') selected @endif>
                                            Tanzania,
                                            United Republic of</option>
                                        <option value="Thailand" @if (Auth::user()->country == 'Thailand') selected @endif>
                                            Thailand</option>
                                        <option value="Togo" @if (Auth::user()->country == 'Togo') selected @endif>
                                            Togo</option>
                                        <option value="Tokelau" @if (Auth::user()->country == 'Tokelau') selected @endif>
                                            Tokelau</option>
                                        <option value="Tonga" @if (Auth::user()->country == 'Tonga') selected @endif>
                                            Tonga</option>
                                        <option value="Trinidad and Tobago"
                                            @if (Auth::user()->country == 'Trinidad and Tobago') selected @endif>
                                            Trinidad and Tobago
                                        </option>
                                        <option value="Tunisia" @if (Auth::user()->country == 'Tunisia') selected @endif>
                                            Tunisia</option>
                                        <option value="Turkey" @if (Auth::user()->country == 'Turkey') selected @endif>
                                            Turkey</option>
                                        <option value="Turkmenistan"
                                            @if (Auth::user()->country == 'Turkmenistan') selected @endif>
                                            Turkmenistan</option>
                                        <option value="Turks and Caicos Islands"
                                            @if (Auth::user()->country == 'Turks and Caicos Islands') selected @endif>
                                            Turks and Caicos
                                            Islands</option>
                                        <option value="Tuvalu" @if (Auth::user()->country == 'Tuvalu') selected @endif>
                                            Tuvalu</option>
                                        <option value="Uganda" @if (Auth::user()->country == 'Uganda') selected @endif>
                                            Uganda</option>
                                        <option value="Ukraine" @if (Auth::user()->country == 'Ukraine') selected @endif>
                                            Ukraine</option>
                                        <option value="United Arab Emirates"
                                            @if (Auth::user()->country == 'United Arab Emirates') selected @endif>
                                            United Arab Emirates
                                        </option>
                                        <option value="United Kingdom"
                                            @if (Auth::user()->country == 'United Kingdom') selected @endif>
                                            United Kingdom</option>
                                        <option value="United States"
                                            @if (Auth::user()->country == 'United States') selected @endif>
                                            United States</option>
                                        <option value="United States Minor Outlying Islands"
                                            @if (Auth::user()->country == 'United States Minor Outlying Islands') selected @endif>
                                            United
                                            States Minor Outlying Islands</option>
                                        <option value="Uruguay" @if (Auth::user()->country == 'Uruguay') selected @endif>
                                            Uruguay</option>
                                        <option value="Uzbekistan"
                                            @if (Auth::user()->country == 'Uzbekistan') selected @endif>
                                            Uzbekistan</option>
                                        <option value="Vanuatu" @if (Auth::user()->country == 'Vanuatu') selected @endif>
                                            Vanuatu</option>
                                        <option value="Venezuela"
                                            @if (Auth::user()->country == 'Venezuela') selected @endif>
                                            Venezuela</option>
                                        <option value="Vietnam" @if (Auth::user()->country == 'Vietnam') selected @endif>
                                            Vietnam</option>
                                        <option value="Virgin Islands (British)"
                                            @if (Auth::user()->country == 'Virgin Islands (British)') selected @endif>
                                            Virgin Islands
                                            (British)</option>
                                        <option value="Virgin Islands (U.S.)"
                                            @if (Auth::user()->country == 'Virgin Islands (U.S.)') selected @endif>
                                            Virgin Islands (U.S.)
                                        </option>
                                        <option value="Wallis and Futuna Islands"
                                            @if (Auth::user()->country == 'Wallis and Futuna Islands') selected @endif>
                                            Wallis and Futuna
                                            Islands</option>
                                        <option value="Western Sahara"
                                            @if (Auth::user()->country == 'Western Sahara') selected @endif>
                                            Western Sahara</option>
                                        <option value="Yemen" @if (Auth::user()->country == 'Yemen') selected @endif>
                                            Yemen</option>
                                        <option value="Yugoslavia"
                                            @if (Auth::user()->country == 'Yugoslavia') selected @endif>
                                            Yugoslavia</option>
                                        <option value="Zambia" @if (Auth::user()->country == 'Zambia') selected @endif>
                                            Zambia</option>
                                        <option value="Zimbabwe" @if (Auth::user()->country == 'Zimbabwe') selected @endif>
                                            Zimbabwe</option>
                                    </select>
                                    @error('country')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-12 mb-4">
                                    <div>
                                        <!-- logo -->
                                        <h5 class="mb-3">Profile Photo </h5>
                                        <div class="icon-shape icon-xxl border rounded position-relative">
                                            <span class="position-absolute">
                                                <img alt="avatar"
                                                    src="{{ Auth::user()->photo == null ? asset('assets/images/avatar/avatar.webp') : Auth::user()->photo }}"
                                                    style="max-height:140px; max-width: 75px">
                                            </span>


                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 col-12 mb-4">
                                    <h5 class="mb-3">&nbsp; </h5>
                                    <input type="file" name="profile_photo" class="form-control">
                                </div>
                                <div class="col-md-8"></div>
                                <!-- button -->
                                <div class="col-12">
                                    <button class="btn btn-primary" type="button"
                                        onClick="this.disabled=true; this.innerHTML='Submiting request, please wait...';this.form.submit();">Save
                                        Changes</button>

                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    document.getElementById("navSettings").classList.add('show');
    document.getElementById("profile").classList.add('active');
</script>

@endsection

@section('customjs')
<script type="text/javascript">
    $(document).ready(function() {
        $('#country').select2();
    });
</script>

@endsection
