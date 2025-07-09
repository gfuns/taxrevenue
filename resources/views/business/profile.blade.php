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
                                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" value="{{ Auth::user()->last_name }}"
                                        class="form-control @error('last_name') is-invalid @enderror"
                                        placeholder="Enter Last Name" required>
                                    @error('last_name')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6 col-12">
                                    <label class="form-label">Other Names <span class="text-danger">*</span></label>
                                    <input type="text" name="other_names" value="{{ Auth::user()->other_names }}"
                                        class="form-control @error('other_names') is-invalid @enderror"
                                        placeholder="Enter Other Names" required>
                                    @error('other_names')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-6 col-12">
                                    <label class="form-label">Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Enter Last Name" required readonly>
                                    @error('email')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6 col-12">
                                    <label class="form-label">Phone Number<span class="text-danger">*</span></label>
                                    <input type="text" name="phone_number" value="{{ Auth::user()->phone_number }}"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        placeholder="Enter Phone Number" required>
                                    @error('phone_number')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6 col-12">
                                    <label class="form-label">Gender<span class="text-danger">*</span></label>
                                    <select id="gender" name="gender"
                                        class="@error('gender') is-invalid @enderror" data-width="100%"
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
                                    <label class="form-label">Marital Status<span class="text-danger">*</span></label>
                                    <select id="maritalStatus" name="marital_status"
                                        class="@error('marital_status') is-invalid @enderror" data-width="100%"
                                        required>
                                        <option value="">Select Marital Status</option>
                                        <option value="Single" @if (Auth::user()->marital_status == 'Single') selected @endif>Single
                                        </option>
                                        <option value="Married" @if (Auth::user()->marital_status == 'Married') selected @endif>Married
                                        </option>
                                        <option value="Divorced" @if (Auth::user()->marital_status == 'Divorced') selected @endif>Divorced
                                        </option>
                                        <option value="Widow/Widower" @if (Auth::user()->marital_status == 'Widow/Widower') selected @endif>Widow/Widower
                                        </option>
                                    </select>
                                    @error('marital_status')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6 col-12">
                                    <label class="form-label">Date of Birth<span class="text-danger">*</span></label>
                                    <input type="date" name="dob" value="{{ Auth::user()->dob }}"
                                        class="form-control @error('dob') is-invalid @enderror"
                                        placeholder="Enter Date of Birth" required>
                                    @error('dob')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6 col-12">
                                    <label class="form-label">nationality<span class="text-danger">*</span></label>
                                    <select id="nationality" name="nationality" class="@error('nationality') is-invalid @enderror"
                                        data-width="100%" required>
                                        <option value="">Select nationality</option>
                                        <option value="Afghanistan" @if (Auth::user()->nationality == 'Afghanistan') selected @endif>
                                            Afghanistan</option>
                                        <option value="Albania" @if (Auth::user()->nationality == 'Albania') selected @endif>
                                            Albania</option>
                                        <option value="Algeria" @if (Auth::user()->nationality == 'Algeria') selected @endif>
                                            Algeria</option>
                                        <option value="American Samoa"
                                            @if (Auth::user()->nationality == 'American Samoa') selected @endif>
                                            American Samoa</option>
                                        <option value="Andorra" @if (Auth::user()->nationality == 'Andorra') selected @endif>
                                            Andorra</option>
                                        <option value="Angola" @if (Auth::user()->nationality == 'Angola') selected @endif>
                                            Angola
                                        </option>
                                        <option value="Anguilla" @if (Auth::user()->nationality == 'Anguilla') selected @endif>
                                            Anguilla</option>
                                        <option value="Antarctica" @if (Auth::user()->nationality == 'Antarctica') selected @endif>
                                            Antarctica</option>
                                        <option value="Antigua and Barbuda"
                                            @if (Auth::user()->nationality == 'Antigua and Barbuda') selected @endif>
                                            Antigua and Barbuda
                                        </option>
                                        <option value="Argentina" @if (Auth::user()->nationality == 'Argentina') selected @endif>
                                            Argentina</option>
                                        <option value="Armenia" @if (Auth::user()->nationality == 'Armenia') selected @endif>
                                            Armenia</option>
                                        <option value="Aruba" @if (Auth::user()->nationality == 'Aruba') selected @endif>
                                            Aruba</option>
                                        <option value="Australia" @if (Auth::user()->nationality == 'Australia') selected @endif>
                                            Australia</option>
                                        <option value="Austria" @if (Auth::user()->nationality == 'Austria') selected @endif>
                                            Austria</option>
                                        <option value="Azerbaijan" @if (Auth::user()->nationality == 'Azerbaijan') selected @endif>
                                            Azerbaijan</option>
                                        <option value="Bahamas" @if (Auth::user()->nationality == 'Bahamas') selected @endif>
                                            Bahamas</option>
                                        <option value="Bahrain" @if (Auth::user()->nationality == 'Bahrain') selected @endif>
                                            Bahrain</option>
                                        <option value="Bangladesh" @if (Auth::user()->nationality == 'Bangladesh') selected @endif>
                                            Bangladesh</option>
                                        <option value="Barbados" @if (Auth::user()->nationality == 'Barbados') selected @endif>
                                            Barbados</option>
                                        <option value="Belarus" @if (Auth::user()->nationality == 'Belarus') selected @endif>
                                            Belarus</option>
                                        <option value="Belgium" @if (Auth::user()->nationality == 'Belgium') selected @endif>
                                            Belgium</option>
                                        <option value="Belize" @if (Auth::user()->nationality == 'Belize') selected @endif>
                                            Belize</option>
                                        <option value="Benin" @if (Auth::user()->nationality == 'Benin') selected @endif>
                                            Benin</option>
                                        <option value="Bermuda" @if (Auth::user()->nationality == 'Bermuda') selected @endif>
                                            Bermuda</option>
                                        <option value="Bhutan" @if (Auth::user()->nationality == 'Bhutan') selected @endif>
                                            Bhutan</option>
                                        <option value="Bolivia" @if (Auth::user()->nationality == 'Bolivia') selected @endif>
                                            Bolivia</option>
                                        <option value="Bosnia and Herzegowina"
                                            @if (Auth::user()->nationality == 'Bosnia and Herzegowina') selected @endif>
                                            Bosnia and
                                            Herzegowina</option>
                                        <option value="Botswana" @if (Auth::user()->nationality == 'Botswana') selected @endif>
                                            Botswana</option>
                                        <option value="Bouvet Island"
                                            @if (Auth::user()->nationality == 'Bouvet Island') selected @endif>
                                            Bouvet Island</option>
                                        <option value="Brazil" @if (Auth::user()->nationality == 'Brazil') selected @endif>
                                            Brazil</option>
                                        <option value="British Indian Ocean Territory"
                                            @if (Auth::user()->nationality == 'British Indian Ocean Territory') selected @endif>
                                            British
                                            Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam"
                                            @if (Auth::user()->nationality == 'Brunei Darussalam') selected @endif>
                                            Brunei Darussalam
                                        </option>
                                        <option value="Bulgaria" @if (Auth::user()->nationality == 'Bulgaria') selected @endif>
                                            Bulgaria</option>
                                        <option value="Burkina Faso"
                                            @if (Auth::user()->nationality == 'Burkina Faso') selected @endif>
                                            Burkina Faso</option>
                                        <option value="Burundi" @if (Auth::user()->nationality == 'Burundi') selected @endif>
                                            Burundi</option>
                                        <option value="Cambodia" @if (Auth::user()->nationality == 'Cambodia') selected @endif>
                                            Cambodia</option>
                                        <option value="Cameroon" @if (Auth::user()->nationality == 'Cameroon') selected @endif>
                                            Cameroon</option>
                                        <option value="Canada" @if (Auth::user()->nationality == 'Canada') selected @endif>
                                            Canada</option>
                                        <option value="Cape Verde" @if (Auth::user()->nationality == 'Cape Verde') selected @endif>
                                            Cape
                                            Verde</option>
                                        <option value="Cayman Islands"
                                            @if (Auth::user()->nationality == 'Cayman Islands') selected @endif>
                                            Cayman Islands</option>
                                        <option value="Central African Republic"
                                            @if (Auth::user()->nationality == 'Central African Republic') selected @endif>
                                            Central African
                                            Republic</option>
                                        <option value="Chad" @if (Auth::user()->nationality == 'Chad') selected @endif>
                                            Chad
                                        </option>
                                        <option value="Chile" @if (Auth::user()->nationality == 'Chile') selected @endif>
                                            Chile</option>
                                        <option value="China" @if (Auth::user()->nationality == 'China') selected @endif>
                                            China</option>
                                        <option value="Christmas Island"
                                            @if (Auth::user()->nationality == 'Christmas Island') selected @endif>
                                            Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands"
                                            @if (Auth::user()->nationality == 'Cocos (Keeling) Islands') selected @endif>
                                            Cocos (Keeling)
                                            Islands</option>
                                        <option value="Colombia" @if (Auth::user()->nationality == 'Colombia') selected @endif>
                                            Colombia</option>
                                        <option value="Comoros" @if (Auth::user()->nationality == 'Comoros') selected @endif>
                                            Comoros</option>
                                        <option value="Congo" @if (Auth::user()->nationality == 'Congo') selected @endif>
                                            Congo</option>
                                        <option value="The Democratic Republic of the Congo"
                                            @if (Auth::user()->nationality == 'The Democratic Republic of the Congo') selected @endif>
                                            The Democratic Republic of the Congo</option>
                                        <option value="Cook Islands"
                                            @if (Auth::user()->nationality == 'the Democratic Republic of the Congo') selected @endif>
                                            Cook
                                            Islands</option>
                                        <option value="Costa Rica" @if (Auth::user()->nationality == 'Costa Rica') selected @endif>
                                            Costa Rica</option>
                                        <option value="Cote d'Ivoire"
                                            @if (Auth::user()->nationality == "Cote d'Ivoire") selected @endif>
                                            Cote
                                            d'Ivoire
                                        </option>
                                        <option value="Croatia (Hrvatska)"
                                            @if (Auth::user()->nationality == 'Croatia (Hrvatska)') selected @endif>
                                            Croatia (Hrvatska)
                                        </option>
                                        <option value="Cuba" @if (Auth::user()->nationality == 'Cuba') selected @endif>
                                            Cuba
                                        </option>
                                        <option value="Cyprus" @if (Auth::user()->nationality == 'Cyprus') selected @endif>
                                            Cyprus</option>
                                        <option value="Czech Republic"
                                            @if (Auth::user()->nationality == 'Czech Republic') selected @endif>
                                            Czech Republic</option>
                                        <option value="Denmark" @if (Auth::user()->nationality == 'Denmark') selected @endif>
                                            Denmark</option>
                                        <option value="Djibouti" @if (Auth::user()->nationality == 'Djibouti') selected @endif>
                                            Djibouti</option>
                                        <option value="Dominica" @if (Auth::user()->nationality == 'Dominica') selected @endif>
                                            Dominica</option>
                                        <option value="Dominican Republic"
                                            @if (Auth::user()->nationality == 'Dominican Republic') selected @endif>
                                            Dominican Republic
                                        </option>
                                        <option value="East Timor" @if (Auth::user()->nationality == 'East Timor') selected @endif>
                                            East
                                            Timor</option>
                                        <option value="Ecuador" @if (Auth::user()->nationality == 'Ecuador') selected @endif>
                                            Ecuador</option>
                                        <option value="Egypt" @if (Auth::user()->nationality == 'Egypt') selected @endif>
                                            Egypt</option>
                                        <option value="El Salvador"
                                            @if (Auth::user()->nationality == 'El Salvador') selected @endif>
                                            El
                                            Salvador</option>
                                        <option value="Equatorial Guinea"
                                            @if (Auth::user()->nationality == 'Equatorial Guinea') selected @endif>
                                            Equatorial Guinea
                                        </option>
                                        <option value="Eritrea" @if (Auth::user()->nationality == 'Eritrea') selected @endif>
                                            Eritrea</option>
                                        <option value="Estonia" @if (Auth::user()->nationality == 'Estonia') selected @endif>
                                            Estonia</option>
                                        <option value="Ethiopia" @if (Auth::user()->nationality == 'Ethiopia') selected @endif>
                                            Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)"
                                            @if (Auth::user()->nationality == 'Falkland Islands (Malvinas)') selected @endif>
                                            Falkland
                                            Islands (Malvinas)</option>
                                        <option value="Faroe Islands"
                                            @if (Auth::user()->nationality == 'Faroe Islands') selected @endif>
                                            Faroe Islands</option>
                                        <option value="Fiji" @if (Auth::user()->nationality == 'Fiji') selected @endif>
                                            Fiji
                                        </option>
                                        <option value="Finland" @if (Auth::user()->nationality == 'Finland') selected @endif>
                                            Finland</option>
                                        <option value="France" @if (Auth::user()->nationality == 'France') selected @endif>
                                            France</option>
                                        <option value="France Metropolitan"
                                            @if (Auth::user()->nationality == 'France Metropolitan') selected @endif>
                                            France Metropolitan
                                        </option>
                                        <option value="French Guiana"
                                            @if (Auth::user()->nationality == 'French Guiana') selected @endif>
                                            French Guiana</option>
                                        <option value="French Polynesia"
                                            @if (Auth::user()->nationality == 'French Polynesia') selected @endif>
                                            French Polynesia</option>
                                        <option value="French Southern Territories"
                                            @if (Auth::user()->nationality == 'French Southern Territories') selected @endif>
                                            French Southern
                                            Territories</option>
                                        <option value="Gabon" @if (Auth::user()->nationality == 'Gabon') selected @endif>
                                            Gabon</option>
                                        <option value="Gambia" @if (Auth::user()->nationality == 'Gambia') selected @endif>
                                            Gambia</option>
                                        <option value="Georgia" @if (Auth::user()->nationality == 'Georgia') selected @endif>
                                            Georgia</option>
                                        <option value="Germany" @if (Auth::user()->nationality == 'Germany') selected @endif>
                                            Germany</option>
                                        <option value="Ghana" @if (Auth::user()->nationality == 'Ghana') selected @endif>
                                            Ghana</option>
                                        <option value="Gibraltar" @if (Auth::user()->nationality == 'Gibraltar') selected @endif>
                                            Gibraltar</option>
                                        <option value="Greece" @if (Auth::user()->nationality == 'Greece') selected @endif>
                                            Greece</option>
                                        <option value="Greenland" @if (Auth::user()->nationality == 'Greenland') selected @endif>
                                            Greenland</option>
                                        <option value="Grenada" @if (Auth::user()->nationality == 'Grenada') selected @endif>
                                            Grenada</option>
                                        <option value="Guadeloupe" @if (Auth::user()->nationality == 'Guadeloupe') selected @endif>
                                            Guadeloupe</option>
                                        <option value="Guam" @if (Auth::user()->nationality == 'Guam') selected @endif>
                                            Guam
                                        </option>
                                        <option value="Guatemala" @if (Auth::user()->nationality == 'Guatemala') selected @endif>
                                            Guatemala</option>
                                        <option value="Guinea" @if (Auth::user()->nationality == 'Guinea') selected @endif>
                                            Guinea</option>
                                        <option value="Guinea-Bissau"
                                            @if (Auth::user()->nationality == 'Guinea-Bissau') selected @endif>
                                            Guinea-Bissau</option>
                                        <option value="Guyana" @if (Auth::user()->nationality == 'Guyana') selected @endif>
                                            Guyana</option>
                                        <option value="Haiti" @if (Auth::user()->nationality == 'Haiti') selected @endif>
                                            Haiti</option>
                                        <option value="Heard and Mc Donald Islands"
                                            @if (Auth::user()->nationality == 'Heard and Mc Donald Islands') selected @endif>
                                            Heard and Mc
                                            Donald Islands</option>
                                        <option value="Holy See (Vatican City State)"
                                            @if (Auth::user()->nationality == 'Holy See (Vatican City State)') selected @endif>
                                            Holy
                                            See
                                            (Vatican City State)</option>
                                        <option value="Honduras" @if (Auth::user()->nationality == 'Honduras') selected @endif>
                                            Honduras</option>
                                        <option value="Hong Kong" @if (Auth::user()->nationality == 'Hong Kong') selected @endif>
                                            Hong
                                            Kong</option>
                                        <option value="Hungary" @if (Auth::user()->nationality == 'Hungary') selected @endif>
                                            Hungary</option>
                                        <option value="Iceland" @if (Auth::user()->nationality == 'Iceland') selected @endif>
                                            Iceland</option>
                                        <option value="India" @if (Auth::user()->nationality == 'India') selected @endif>
                                            India</option>
                                        <option value="Indonesia"
                                            @if (Auth::user()->nationality == 'Indonesia') selected @endif>
                                            Indonesia</option>
                                        <option value="Iran" @if (Auth::user()->nationality == 'Iran') selected @endif>
                                            Iran</option>
                                        <option value="Iraq" @if (Auth::user()->nationality == 'Iraq') selected @endif>
                                            Iraq</option>
                                        <option value="Ireland" @if (Auth::user()->nationality == 'Ireland') selected @endif>
                                            Ireland</option>
                                        <option value="Israel" @if (Auth::user()->nationality == 'Israel') selected @endif>
                                            Israel</option>
                                        <option value="Italy" @if (Auth::user()->nationality == 'Italy') selected @endif>
                                            Italy</option>
                                        <option value="Jamaica" @if (Auth::user()->nationality == 'Jamaica') selected @endif>
                                            Jamaica</option>
                                        <option value="Japan" @if (Auth::user()->nationality == 'Japan') selected @endif>
                                            Japan</option>
                                        <option value="Jordan" @if (Auth::user()->nationality == 'Jordan') selected @endif>
                                            Jordan</option>
                                        <option value="Kazakhstan"
                                            @if (Auth::user()->nationality == 'Kazakhstan') selected @endif>
                                            Kazakhstan</option>
                                        <option value="Kenya" @if (Auth::user()->nationality == 'Kenya') selected @endif>
                                            Kenya</option>
                                        <option value="Kiribati" @if (Auth::user()->nationality == 'Kiribati') selected @endif>
                                            Kiribati</option>
                                        <option value="North Korea"
                                            @if (Auth::user()->nationality == 'North Korea') selected @endif>
                                            North Korea</option>
                                        <option value="South Korea"
                                            @if (Auth::user()->nationality == 'South Korea') selected @endif>
                                            South Korea
                                        </option>
                                        <option value="Kuwait" @if (Auth::user()->nationality == 'Kuwait') selected @endif>
                                            Kuwait</option>
                                        <option value="Kyrgyzstan"
                                            @if (Auth::user()->nationality == 'Kyrgyzstan') selected @endif>
                                            Kyrgyzstan</option>
                                        <option value="Lao" @if (Auth::user()->nationality == 'Lao') selected @endif>
                                            Lao</option>
                                        <option value="Latvia" @if (Auth::user()->nationality == 'Latvia') selected @endif>
                                            Latvia</option>
                                        <option value="Lebanon" @if (Auth::user()->nationality == 'Lebanon') selected @endif>
                                            Lebanon</option>
                                        <option value="Lesotho" @if (Auth::user()->nationality == 'Lesotho') selected @endif>
                                            Lesotho</option>
                                        <option value="Liberia" @if (Auth::user()->nationality == 'Liberia') selected @endif>
                                            Liberia</option>
                                        <option value="Libyan Arab Jamahiriya"
                                            @if (Auth::user()->nationality == 'Libyan Arab Jamahiriya') selected @endif>
                                            Libyan Arab
                                            Jamahiriya</option>
                                        <option value="Liechtenstein"
                                            @if (Auth::user()->nationality == 'Liechtenstein') selected @endif>
                                            Liechtenstein</option>
                                        <option value="Lithuania"
                                            @if (Auth::user()->nationality == 'Lithuania') selected @endif>
                                            Lithuania</option>
                                        <option value="Luxembourg"
                                            @if (Auth::user()->nationality == 'Luxembourg') selected @endif>
                                            Luxembourg</option>
                                        <option value="Macau" @if (Auth::user()->nationality == 'Macau') selected @endif>
                                            Macau</option>
                                        <option value="Macedonia"
                                            @if (Auth::user()->nationality == 'Macedonia') selected @endif>
                                            Macedonia</option>
                                        <option value="Madagascar"
                                            @if (Auth::user()->nationality == 'Madagascar') selected @endif>
                                            Madagascar</option>
                                        <option value="Malawi" @if (Auth::user()->nationality == 'Malawi') selected @endif>
                                            Malawi</option>
                                        <option value="Malaysia" @if (Auth::user()->nationality == 'Malaysia') selected @endif>
                                            Malaysia</option>
                                        <option value="Maldives" @if (Auth::user()->nationality == 'Maldives') selected @endif>
                                            Maldives</option>
                                        <option value="Mali" @if (Auth::user()->nationality == 'Mali') selected @endif>
                                            Mali</option>
                                        <option value="Malta" @if (Auth::user()->nationality == 'Malta') selected @endif>
                                            Malta</option>
                                        <option value="Marshall Islands"
                                            @if (Auth::user()->nationality == 'Marshall Islands') selected @endif>
                                            Marshall Islands</option>
                                        <option value="Martinique"
                                            @if (Auth::user()->nationality == 'Martinique') selected @endif>
                                            Martinique</option>
                                        <option value="Mauritania"
                                            @if (Auth::user()->nationality == 'Mauritania') selected @endif>
                                            Mauritania</option>
                                        <option value="Mauritius"
                                            @if (Auth::user()->nationality == 'Mauritius') selected @endif>
                                            Mauritius</option>
                                        <option value="Mayotte" @if (Auth::user()->nationality == 'Mayotte') selected @endif>
                                            Mayotte</option>
                                        <option value="Mexico" @if (Auth::user()->nationality == 'Mexico') selected @endif>
                                            Mexico</option>
                                        <option value="Micronesia"
                                            @if (Auth::user()->nationality == 'Micronesia') selected @endif>
                                            Micronesia</option>
                                        <option value="Moldova" @if (Auth::user()->nationality == 'Moldova') selected @endif>
                                            Moldova
                                        </option>
                                        <option value="Monaco" @if (Auth::user()->nationality == 'Monaco') selected @endif>
                                            Monaco</option>
                                        <option value="Mongolia" @if (Auth::user()->nationality == 'Mongolia') selected @endif>
                                            Mongolia</option>
                                        <option value="Montserrat"
                                            @if (Auth::user()->nationality == 'Montserrat') selected @endif>
                                            Montserrat</option>
                                        <option value="Morocco" @if (Auth::user()->nationality == 'Morocco') selected @endif>
                                            Morocco</option>
                                        <option value="Mozambique"
                                            @if (Auth::user()->nationality == 'Mozambique') selected @endif>
                                            Mozambique</option>
                                        <option value="Myanmar" @if (Auth::user()->nationality == 'Myanmar') selected @endif>
                                            Myanmar</option>
                                        <option value="Namibia" @if (Auth::user()->nationality == 'Namibia') selected @endif>
                                            Namibia</option>
                                        <option value="Nauru" @if (Auth::user()->nationality == 'Nauru') selected @endif>
                                            Nauru</option>
                                        <option value="Nepal" @if (Auth::user()->nationality == 'Nepal') selected @endif>
                                            Nepal</option>
                                        <option value="Netherlands"
                                            @if (Auth::user()->nationality == 'Netherlands') selected @endif>
                                            Netherlands</option>
                                        <option value="Netherlands Antilles"
                                            @if (Auth::user()->nationality == 'Netherlands Antilles') selected @endif>
                                            Netherlands Antilles
                                        </option>
                                        <option value="New Caledonia"
                                            @if (Auth::user()->nationality == 'New Caledonia') selected @endif>
                                            New Caledonia</option>
                                        <option value="New Zealand"
                                            @if (Auth::user()->nationality == 'New Zealand') selected @endif>
                                            New Zealand</option>
                                        <option value="Nicaragua"
                                            @if (Auth::user()->nationality == 'Nicaragua') selected @endif>
                                            Nicaragua</option>
                                        <option value="Niger" @if (Auth::user()->nationality == 'Niger') selected @endif>
                                            Niger</option>
                                        <option value="Nigeria" @if (Auth::user()->nationality == 'Nigeria') selected @endif>
                                            Nigeria</option>
                                        <option value="Niue" @if (Auth::user()->nationality == 'Niue') selected @endif>
                                            Niue</option>
                                        <option value="Norfolk Island"
                                            @if (Auth::user()->nationality == 'Norfolk Island') selected @endif>
                                            Norfolk Island</option>
                                        <option value="Northern Mariana Islands"
                                            @if (Auth::user()->nationality == 'Northern Mariana Islands') selected @endif>
                                            Northern Mariana
                                            Islands</option>
                                        <option value="Norway" @if (Auth::user()->nationality == 'Norway') selected @endif>
                                            Norway</option>
                                        <option value="Oman" @if (Auth::user()->nationality == 'Oman') selected @endif>
                                            Oman</option>
                                        <option value="Pakistan" @if (Auth::user()->nationality == 'Pakistan') selected @endif>
                                            Pakistan</option>
                                        <option value="Palau" @if (Auth::user()->nationality == 'Palau') selected @endif>
                                            Palau</option>
                                        <option value="Panama" @if (Auth::user()->nationality == 'Panama') selected @endif>
                                            Panama</option>
                                        <option value="Papua New Guinea"
                                            @if (Auth::user()->nationality == 'Papua New Guinea') selected @endif>
                                            Papua New Guinea</option>
                                        <option value="Paraguay" @if (Auth::user()->nationality == 'Paraguay') selected @endif>
                                            Paraguay</option>
                                        <option value="Peru" @if (Auth::user()->nationality == 'Peru') selected @endif>
                                            Peru</option>
                                        <option value="Philippines"
                                            @if (Auth::user()->nationality == 'Philippines') selected @endif>
                                            Philippines</option>
                                        <option value="Pitcairn" @if (Auth::user()->nationality == 'Pitcairn') selected @endif>
                                            Pitcairn</option>
                                        <option value="Poland" @if (Auth::user()->nationality == 'Poland') selected @endif>
                                            Poland</option>
                                        <option value="Portugal" @if (Auth::user()->nationality == 'Portugal') selected @endif>
                                            Portugal</option>
                                        <option value="Puerto Rico"
                                            @if (Auth::user()->nationality == 'Puerto Rico') selected @endif>
                                            Puerto Rico</option>
                                        <option value="Qatar" @if (Auth::user()->nationality == 'Qatar') selected @endif>
                                            Qatar</option>
                                        <option value="Reunion" @if (Auth::user()->nationality == 'Reunion') selected @endif>
                                            Reunion</option>
                                        <option value="Romania" @if (Auth::user()->nationality == 'Romania') selected @endif>
                                            Romania</option>
                                        <option value="Russian Federation"
                                            @if (Auth::user()->nationality == 'Russian Federation') selected @endif>
                                            Russian Federation
                                        </option>
                                        <option value="Rwanda" @if (Auth::user()->nationality == 'Rwanda') selected @endif>
                                            Rwanda</option>
                                        <option value="Saint Kitts and Nevis"
                                            @if (Auth::user()->nationality == 'Saint Kitts and Nevis') selected @endif>
                                            Saint Kitts and Nevis
                                        </option>
                                        <option value="Saint Lucia"
                                            @if (Auth::user()->nationality == 'Saint Lucia') selected @endif>
                                            Saint Lucia</option>
                                        <option value="Saint Vincent and the Grenadines"
                                            @if (Auth::user()->nationality == 'Saint Vincent and the Grenadines') selected @endif>
                                            Saint
                                            Vincent and the Grenadines</option>
                                        <option value="Samoa" @if (Auth::user()->nationality == 'Samoa') selected @endif>
                                            Samoa</option>
                                        <option value="San Marino"
                                            @if (Auth::user()->nationality == 'San Marino') selected @endif>
                                            San Marino</option>
                                        <option value="Sao Tome and Principe"
                                            @if (Auth::user()->nationality == 'Sao Tome and Principe') selected @endif>
                                            Sao Tome and Principe
                                        </option>
                                        <option value="Saudi Arabia"
                                            @if (Auth::user()->nationality == 'Saudi Arabia') selected @endif>
                                            Saudi Arabia</option>
                                        <option value="Senegal" @if (Auth::user()->nationality == 'Senegal') selected @endif>
                                            Senegal</option>
                                        <option value="Seychelles"
                                            @if (Auth::user()->nationality == 'Seychelles') selected @endif>
                                            Seychelles</option>
                                        <option value="Sierra Leone"
                                            @if (Auth::user()->nationality == 'Sierra Leone') selected @endif>
                                            Sierra Leone</option>
                                        <option value="Singapore"
                                            @if (Auth::user()->nationality == 'Singapore') selected @endif>
                                            Singapore</option>
                                        <option value="Slovakia (Slovak Republic)"
                                            @if (Auth::user()->nationality == 'Slovakia (Slovak Republic)') selected @endif>
                                            Slovakia (Slovak
                                            Republic)</option>
                                        <option value="Slovenia" @if (Auth::user()->nationality == 'Slovenia') selected @endif>
                                            Slovenia</option>
                                        <option value="Solomon Islands"
                                            @if (Auth::user()->nationality == 'Solomon Islands') selected @endif>
                                            Solomon Islands</option>
                                        <option value="Somalia" @if (Auth::user()->nationality == 'Somalia') selected @endif>
                                            Somalia</option>
                                        <option value="South Africa"
                                            @if (Auth::user()->nationality == 'South Africa') selected @endif>
                                            South Africa</option>
                                        <option value="South Georgia and the South Sandwich Islands"
                                            @if (Auth::user()->nationality == 'South Georgia and the South Sandwich Islands') selected @endif>
                                            South Georgia and the South Sandwich Islands
                                        </option>
                                        <option value="Spain" @if (Auth::user()->nationality == 'Spain') selected @endif>
                                            Spain</option>
                                        <option value="Sri Lanka"
                                            @if (Auth::user()->nationality == 'Sri Lanka') selected @endif>
                                            Sri Lanka</option>
                                        <option value="St. Helena"
                                            @if (Auth::user()->nationality == 'St. Helena') selected @endif>
                                            St. Helena</option>
                                        <option value="St. Pierre and Miquelon"
                                            @if (Auth::user()->nationality == 'St. Pierre and Miquelon') selected @endif>
                                            St. Pierre and
                                            Miquelon</option>
                                        <option value="Sudan" @if (Auth::user()->nationality == 'Sudan') selected @endif>
                                            Sudan</option>
                                        <option value="Suriname" @if (Auth::user()->nationality == 'Suriname') selected @endif>
                                            Suriname</option>
                                        <option value="Svalbard and Jan Mayen Islands"
                                            @if (Auth::user()->nationality == 'Svalbard and Jan Mayen Islands') selected @endif>
                                            Svalbard and
                                            Jan Mayen Islands</option>
                                        <option value="Swaziland"
                                            @if (Auth::user()->nationality == 'Swaziland') selected @endif>
                                            Swaziland</option>
                                        <option value="Sweden" @if (Auth::user()->nationality == 'Sweden') selected @endif>
                                            Sweden</option>
                                        <option value="Switzerland"
                                            @if (Auth::user()->nationality == 'Switzerland') selected @endif>
                                            Switzerland</option>
                                        <option value="Syrian Arab Republic"
                                            @if (Auth::user()->nationality == 'Syrian Arab Republic') selected @endif>
                                            Syrian Arab Republic
                                        </option>
                                        <option value="Taiwan, Province of China"
                                            @if (Auth::user()->nationality == 'Taiwan, Province of China') selected @endif>
                                            Taiwan, Province
                                            of China</option>
                                        <option value="Tajikistan"
                                            @if (Auth::user()->nationality == 'Tajikistan') selected @endif>
                                            Tajikistan</option>
                                        <option value="Tanzania, United Republic of"
                                            @if (Auth::user()->nationality == 'Tanzania, United Republic of') selected @endif>
                                            Tanzania,
                                            United Republic of</option>
                                        <option value="Thailand" @if (Auth::user()->nationality == 'Thailand') selected @endif>
                                            Thailand</option>
                                        <option value="Togo" @if (Auth::user()->nationality == 'Togo') selected @endif>
                                            Togo</option>
                                        <option value="Tokelau" @if (Auth::user()->nationality == 'Tokelau') selected @endif>
                                            Tokelau</option>
                                        <option value="Tonga" @if (Auth::user()->nationality == 'Tonga') selected @endif>
                                            Tonga</option>
                                        <option value="Trinidad and Tobago"
                                            @if (Auth::user()->nationality == 'Trinidad and Tobago') selected @endif>
                                            Trinidad and Tobago
                                        </option>
                                        <option value="Tunisia" @if (Auth::user()->nationality == 'Tunisia') selected @endif>
                                            Tunisia</option>
                                        <option value="Turkey" @if (Auth::user()->nationality == 'Turkey') selected @endif>
                                            Turkey</option>
                                        <option value="Turkmenistan"
                                            @if (Auth::user()->nationality == 'Turkmenistan') selected @endif>
                                            Turkmenistan</option>
                                        <option value="Turks and Caicos Islands"
                                            @if (Auth::user()->nationality == 'Turks and Caicos Islands') selected @endif>
                                            Turks and Caicos
                                            Islands</option>
                                        <option value="Tuvalu" @if (Auth::user()->nationality == 'Tuvalu') selected @endif>
                                            Tuvalu</option>
                                        <option value="Uganda" @if (Auth::user()->nationality == 'Uganda') selected @endif>
                                            Uganda</option>
                                        <option value="Ukraine" @if (Auth::user()->nationality == 'Ukraine') selected @endif>
                                            Ukraine</option>
                                        <option value="United Arab Emirates"
                                            @if (Auth::user()->nationality == 'United Arab Emirates') selected @endif>
                                            United Arab Emirates
                                        </option>
                                        <option value="United Kingdom"
                                            @if (Auth::user()->nationality == 'United Kingdom') selected @endif>
                                            United Kingdom</option>
                                        <option value="United States"
                                            @if (Auth::user()->nationality == 'United States') selected @endif>
                                            United States</option>
                                        <option value="United States Minor Outlying Islands"
                                            @if (Auth::user()->nationality == 'United States Minor Outlying Islands') selected @endif>
                                            United
                                            States Minor Outlying Islands</option>
                                        <option value="Uruguay" @if (Auth::user()->nationality == 'Uruguay') selected @endif>
                                            Uruguay</option>
                                        <option value="Uzbekistan"
                                            @if (Auth::user()->nationality == 'Uzbekistan') selected @endif>
                                            Uzbekistan</option>
                                        <option value="Vanuatu" @if (Auth::user()->nationality == 'Vanuatu') selected @endif>
                                            Vanuatu</option>
                                        <option value="Venezuela"
                                            @if (Auth::user()->nationality == 'Venezuela') selected @endif>
                                            Venezuela</option>
                                        <option value="Vietnam" @if (Auth::user()->nationality == 'Vietnam') selected @endif>
                                            Vietnam</option>
                                        <option value="Virgin Islands (British)"
                                            @if (Auth::user()->nationality == 'Virgin Islands (British)') selected @endif>
                                            Virgin Islands
                                            (British)</option>
                                        <option value="Virgin Islands (U.S.)"
                                            @if (Auth::user()->nationality == 'Virgin Islands (U.S.)') selected @endif>
                                            Virgin Islands (U.S.)
                                        </option>
                                        <option value="Wallis and Futuna Islands"
                                            @if (Auth::user()->nationality == 'Wallis and Futuna Islands') selected @endif>
                                            Wallis and Futuna
                                            Islands</option>
                                        <option value="Western Sahara"
                                            @if (Auth::user()->nationality == 'Western Sahara') selected @endif>
                                            Western Sahara</option>
                                        <option value="Yemen" @if (Auth::user()->nationality == 'Yemen') selected @endif>
                                            Yemen</option>
                                        <option value="Yugoslavia"
                                            @if (Auth::user()->nationality == 'Yugoslavia') selected @endif>
                                            Yugoslavia</option>
                                        <option value="Zambia" @if (Auth::user()->nationality == 'Zambia') selected @endif>
                                            Zambia</option>
                                        <option value="Zimbabwe" @if (Auth::user()->nationality == 'Zimbabwe') selected @endif>
                                            Zimbabwe</option>
                                    </select>
                                    @error('nationality')
                                        <span class="" role="alert">
                                            <strong style="color: #b02a37; font-size:12px">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3 col-md-12 col-12">
                                    <label class="form-label">Contact Address<span class="text-danger">*</span></label>
                                    <input type="text" name="contact_address" value="{{ Auth::user()->contact_address }}"
                                        class="form-control @error('contact_address') is-invalid @enderror"
                                        placeholder="Enter Contact Addresss" required>
                                    @error('contact_address')
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
                                                    src="{{ Auth::user()->profile_photo == null ? asset('assets/images/avatar/avatar.webp') : Auth::user()->profile_photo }}"
                                                    style="max-height:140px; max-width: 150px">
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
        $('#nationality').select2();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#gender').select2();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#maritalStatus').select2();
    });
</script>

@endsection
