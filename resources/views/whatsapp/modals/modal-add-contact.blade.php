<!-- modal-1-start -->
<div class="modal fade" id="addContactModal" tabindex="-1" aria-labelledby="addContactModalLabel" aria-hidden="true">
    <div class="modal-dialog app_modal_md">
        <div class="modal-content">
            <form id="addContactForm">
                <div class="modal-header bg-primary-800">
                    <h1 class="modal-title fs-5 text-white" id="addContactModalLabel">Add new contact</h1>
                    <button type="button" class="fs-5 border-0 bg-none text-white" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa-solid fa-xmark fs-3"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3 text-center align-self-center">
                            <img src="../assets/images/modals/04.png" alt="" class="img-fluid b-r-10">
                        </div>
                        <div class="col-lg-9 ps-4">
                            <div class="mb-3">
                                <label for="contactName" class="form-label">Nombre del Contacto</label>
                                <input type="text" class="form-control" id="contactName" name="contact_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="countryCode" class="form-label">Código del País</label>
                                <!-- filepath: /c:/laragon/www/whatsapp-manager/resources/views/whatsapp/modals/modal-add-contact.blade.php -->
                                <select class="form-select" id="countryCode" name="country_code" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="1">+1 United States</option>
                                    <option value="1">+1 Canada</option>
                                    <option value="52">+52 Mexico</option>
                                    <option value="502">+502 Guatemala</option>
                                    <option value="503">+503 El Salvador</option>
                                    <option value="504">+504 Honduras</option>
                                    <option value="505">+505 Nicaragua</option>
                                    <option value="506">+506 Costa Rica</option>
                                    <option value="507">+507 Panama</option>
                                    <option value="51">+51 Peru</option>
                                    <option value="54">+54 Argentina</option>
                                    <option value="55">+55 Brazil</option>
                                    <option value="56">+56 Chile</option>
                                    <option value="57" selected>+57 Colombia</option>
                                    <option value="58">+58 Venezuela</option>
                                    <option value="59">+59 Paraguay</option>
                                    <option value="60">+60 Uruguay</option>
                                    <option value="61">+61 Australia</option>
                                    <option value="62">+62 Indonesia</option>
                                    <option value="63">+63 Philippines</option>
                                    <option value="64">+64 New Zealand</option>
                                    <option value="65">+65 Singapore</option>
                                    <option value="66">+66 Thailand</option>
                                    <option value="67">+67 Brunei</option>
                                    <option value="68">+68 East Timor</option>
                                    <option value="69">+69 Palau</option>
                                    <option value="70">+70 Fiji</option>
                                    <option value="71">+71 Papua New Guinea</option>
                                    <option value="72">+72 Solomon Islands</option>
                                    <option value="73">+73 Vanuatu</option>
                                    <option value="74">+74 Samoa</option>
                                    <option value="75">+75 Tonga</option>
                                    <option value="76">+76 Kiribati</option>
                                    <option value="77">+77 Tuvalu</option>
                                    <option value="78">+78 Nauru</option>
                                    <option value="79">+79 Marshall Islands</option>
                                    <option value="80">+80 Micronesia</option>
                                    <option value="81">+81 Japan</option>
                                    <option value="82">+82 South Korea</option>
                                    <option value="83">+83 North Korea</option>
                                    <option value="84">+84 Vietnam</option>
                                    <option value="85">+85 Hong Kong</option>
                                    <option value="86">+86 China</option>
                                    <option value="87">+87 Taiwan</option>
                                    <option value="88">+88 Bangladesh</option>
                                    <option value="89">+89 Bhutan</option>
                                    <option value="90">+90 India</option>
                                    <option value="91">+91 Nepal</option>
                                    <option value="92">+92 Pakistan</option>
                                    <option value="93">+93 Sri Lanka</option>
                                    <option value="94">+94 Maldives</option>
                                    <option value="95">+95 Afghanistan</option>
                                    <option value="96">+96 Iran</option>
                                    <option value="97">+97 Iraq</option>
                                    <option value="98">+98 Israel</option>
                                    <option value="99">+99 Jordan</option>
                                    <option value="100">+100 Kuwait</option>
                                    <option value="101">+101 Lebanon</option>
                                    <option value="102">+102 Oman</option>
                                    <option value="103">+103 Palestine</option>
                                    <option value="104">+104 Qatar</option>
                                    <option value="105">+105 Saudi Arabia</option>
                                    <option value="106">+106 Syria</option>
                                    <option value="107">+107 United Arab Emirates</option>
                                    <option value="108">+108 Yemen</option>
                                    <option value="109">+109 Armenia</option>
                                    <option value="110">+110 Azerbaijan</option>
                                    <option value="111">+111 Bahrain</option>
                                    <option value="112">+112 Cyprus</option>
                                    <option value="113">+113 Georgia</option>
                                    <option value="114">+114 Kazakhstan</option>
                                    <option value="115">+115 Kyrgyzstan</option>
                                    <option value="116">+116 Tajikistan</option>
                                    <option value="117">+117 Turkmenistan</option>
                                    <option value="118">+118 Uzbekistan</option>
                                    <option value="119">+119 Albania</option>
                                    <option value="120">+120 Andorra</option>
                                    <option value="121">+121 Austria</option>
                                    <option value="122">+122 Belarus</option>
                                    <option value="123">+123 Belgium</option>
                                    <option value="124">+124 Bosnia and Herzegovina</option>
                                    <option value="125">+125 Bulgaria</option>
                                    <option value="126">+126 Croatia</option>
                                    <option value="127">+127 Czech Republic</option>
                                    <option value="128">+128 Denmark</option>
                                    <option value="129">+129 Estonia</option>
                                    <option value="130">+130 Finland</option>
                                    <option value="131">+131 France</option>
                                    <option value="132">+132 Germany</option>
                                    <option value="133">+133 Greece</option>
                                    <option value="134">+134 Hungary</option>
                                    <option value="135">+135 Iceland</option>
                                    <option value="136">+136 Ireland</option>
                                    <option value="137">+137 Italy</option>
                                    <option value="138">+138 Latvia</option>
                                    <option value="139">+139 Liechtenstein</option>
                                    <option value="140">+140 Lithuania</option>
                                    <option value="141">+141 Luxembourg</option>
                                    <option value="142">+142 Malta</option>
                                    <option value="143">+143 Moldova</option>
                                    <option value="144">+144 Monaco</option>
                                    <option value="145">+145 Montenegro</option>
                                    <option value="146">+146 Netherlands</option>
                                    <option value="147">+147 North Macedonia</option>
                                    <option value="148">+148 Norway</option>
                                    <option value="149">+149 Poland</option>
                                    <option value="150">+150 Portugal</option>
                                    <option value="151">+151 Romania</option>
                                    <option value="152">+152 Russia</option>
                                    <option value="153">+153 San Marino</option>
                                    <option value="154">+154 Serbia</option>
                                    <option value="155">+155 Slovakia</option>
                                    <option value="156">+156 Slovenia</option>
                                    <option value="157">+157 Spain</option>
                                    <option value="158">+158 Sweden</option>
                                    <option value="159">+159 Switzerland</option>
                                    <option value="160">+160 Ukraine</option>
                                    <option value="161">+161 United Kingdom</option>
                                    <option value="162">+162 Vatican City</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="contactPhone" class="form-label">Número de Teléfono</label>
                                <input type="text" class="form-control" id="contactPhone" name="phone_number" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-light-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal-1-end -->
