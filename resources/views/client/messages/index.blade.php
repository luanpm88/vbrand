@extends('client.layouts.message')

@section('title')
    vBRand Messages
@endsection

@section('content')
    <main>
        <div class="row">
            <div class="col-3 messenger-sidebar">
                <div class="py-3">
                    <div class="d-flex align-items-center header">
                        <img class="avatar" src="{{ $page->data['picture']['url'] }}" />
                        <div class="ml-2">
                            <h4 class="m-0 font-weight-bold">{{ $page->data['name'] }}</h4>
                        </div>
                        <div class="ml-auto">
                          <a href="javascript:;" class="action">
                            <svg viewBox="0 0 36 36" class="a8c37x1j ms05siws hwsy1cff b7h9ocf4" height="28" width="28"><path d="M12.5 18A2.25 2.25 0 118 18a2.25 2.25 0 014.5 0zm7.75 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm5.5 2.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z"></path></svg>
                          </a>
                        </div>
                    </div>
                    <div class="my-4">
                        <input type="text" class="form-control messenger-search-box" placeholder="Search Messenger" />
                    </div>
                    <div class="conversations">
                        <div class="m-5 text-center">
                            <div class="spinner-border text-info" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5 messenger-chatbox p-0">
                <div class="text-center m-5 pt-5">
                    <svg style="width:200px" class="my-4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"> <g id="XMLID_6291_"> <g id="XMLID_6482_"> <g id="XMLID_5876_"> <path id="XMLID_6597_" style="fill:#C4C8F7;" d="M358.4,134.938c-0.01,0.33-0.041,0.69-0.093,1.061 c-1.288,9.529-38.137,18.626-65.272,36.747c-7.438,4.955-14.134,10.59-19.182,17.101l-22.819-22.819l-22.86-22.87 c2.256-6.604,4.955-15.041,7.448-24.178c5.089-18.564,9.333-40.023,7.263-54.96c-4.409-31.812,25.497-11.878,33.388,10.127 c7.891,22.015,24.704-0.628,44.432,28.66C339.836,132.198,358.792,124.08,358.4,134.938z"></path> <path id="XMLID_6300_" style="fill:#A6AEF2;" d="M358.4,134.938c-0.01,0.33-0.041,0.69-0.093,1.061 c-1.288,9.529-38.137,18.626-65.272,36.747c-7.438,4.955-14.134,10.59-19.182,17.101l-22.819-22.819 C280.879,139.337,320.778,128.644,358.4,134.938z"></path> <path id="XMLID_6832_" style="fill:#A6AEF2;" d="M272.331,145.458c8.316,8.316,15.219,17.511,20.707,27.285 c-7.438,4.959-14.135,10.596-19.18,17.1l-45.681-45.681c2.249-6.609,4.952-15.044,7.45-24.183 C248.934,126.022,261.392,134.519,272.331,145.458z"></path> <g id="XMLID_6824_"> <path id="XMLID_561_" style="fill:#A6AEF2;" d="M249.178,159.853c-1.359,0-2.736-0.359-3.985-1.113 c-3.653-2.205-4.827-6.953-2.623-10.606l0,0c0.075-0.124,7.591-12.642,16.072-31.061c1.785-3.876,6.374-5.57,10.25-3.786 c3.876,1.785,5.571,6.374,3.786,10.25c-8.868,19.258-16.555,32.046-16.878,32.58 C254.349,158.523,251.796,159.853,249.178,159.853z"></path> </g> <g id="XMLID_5900_"> <path id="XMLID_560_" style="fill:#A6AEF2;" d="M262.557,169.588c-2.05,0-4.095-0.81-5.615-2.417 c-2.932-3.1-2.796-7.99,0.304-10.922c0.962-0.91,23.788-22.433,43.012-34.611c3.605-2.285,8.378-1.212,10.662,2.392 c2.283,3.605,1.212,8.378-2.392,10.662c-17.949,11.37-40.438,32.57-40.663,32.783 C266.371,168.888,264.462,169.588,262.557,169.588z"></path> </g> </g> <g id="XMLID_5903_"> <path id="XMLID_6833_" style="fill:#FFA6B7;" d="M93.914,280.369l50.745,50.745c-1.912,5.6-4.118,12.39-6.279,19.797 c-6.454,22.027-12.627,49.593-10.054,68.125c4.89,35.34-28.325,13.2-37.09-11.25c-8.765-24.451-27.447,0.685-49.362-31.832 C19.958,343.424-1.74,354.02,0.11,340.184c1.47-10.926,45.095-21.348,75.432-42.84C82.626,292.342,88.986,286.729,93.914,280.369 z"></path> <path id="XMLID_6831_" style="fill:#FC819C;" d="M93.914,280.369l50.745,50.745c-1.912,5.6-4.118,12.39-6.279,19.797 c-15.761-6.105-30.537-15.524-43.257-28.244c-7.762-7.762-14.284-16.278-19.579-25.323 C82.626,292.342,88.986,286.729,93.914,280.369z"></path> <g id="XMLID_5922_"> <path id="XMLID_556_" style="fill:#FC819C;" d="M103.017,365.346c-1.081,0-2.18-0.228-3.227-0.71 c-3.876-1.785-5.571-6.374-3.786-10.25c9.831-21.349,18.347-35.515,18.704-36.108c2.204-3.653,6.953-4.826,10.605-2.623 c3.653,2.204,4.828,6.952,2.625,10.606c-0.083,0.138-8.454,14.077-17.898,34.588 C108.737,363.679,105.94,365.346,103.017,365.346z"></path> </g> <g id="XMLID_5905_"> <path id="XMLID_555_" style="fill:#FC819C;" d="M60.002,356.614c-2.559,0-5.064-1.271-6.535-3.593 c-2.283-3.605-1.212-8.378,2.393-10.661c20.036-12.692,45.05-36.281,45.301-36.518c3.1-2.933,7.989-2.796,10.923,0.304 c2.932,3.1,2.796,7.99-0.304,10.923c-1.066,1.009-26.364,24.862-47.651,38.346C62.846,356.227,61.415,356.614,60.002,356.614z"></path> </g> </g> <path id="XMLID_6595_" style="fill:#C4C8F7;" d="M279.674,281.78c-5.027,10.116-11.754,19.604-20.192,28.031 c-8.468,8.478-18.008,15.236-28.186,20.264c-40.064,19.862-89.955,13.104-123.323-20.264 c-30.359-30.359-38.694-74.41-24.972-112.269c5.172-14.32,13.495-27.753,24.982-39.229c41.836-41.836,109.663-41.836,151.498,0 c0.288,0.288,0.577,0.577,0.845,0.876C293.004,192.587,299.443,242.046,279.674,281.78z"></path> <path id="XMLID_6301_" style="fill:#A6AEF2;" d="M279.674,281.78c-5.027,10.116-11.754,19.604-20.192,28.031 c-8.468,8.478-18.008,15.236-28.186,20.264c-22.365-33.841-26.826-76.038-13.361-113.196c6.13-16.967,15.999-32.894,29.607-46.502 c4.069-4.069,8.334-7.798,12.785-11.188C293.004,192.587,299.443,242.046,279.674,281.78z"></path> <path id="XMLID_6577_" style="fill:#FFA6B7;" d="M279.674,281.78c-10.786-34.367-33.635-60.76-58.514-72.957 c-20.573-10.085-42.536-10.446-60.235,2.431c-34.047,24.786-64.531,0.433-77.923-13.712c5.172-14.32,13.495-27.753,24.982-39.229 c41.836-41.836,109.663-41.836,151.498,0c0.288,0.288,0.577,0.577,0.845,0.876C293.004,192.587,299.443,242.046,279.674,281.78z"></path> <path id="XMLID_6302_" style="fill:#FC819C;" d="M279.674,281.78c-10.786-34.367-33.635-60.76-58.514-72.957 c6.161-13.949,14.948-27.011,26.383-38.446c4.069-4.069,8.334-7.798,12.785-11.188 C293.004,192.587,299.443,242.046,279.674,281.78z"></path> <path id="XMLID_6898_" style="fill:#FC819C;" d="M259.48,158.309c27.74,27.74,37.09,66.904,28.039,102.331 c-2.971-32.449-19.417-66.96-41.413-88.957c-39.588-39.588-102.443-41.719-144.53-6.385c2.012-2.398,4.149-4.734,6.404-6.989 C149.817,116.472,217.643,116.472,259.48,158.309z"></path> </g> <g id="XMLID_6484_"> <g id="XMLID_6888_"> <path id="XMLID_6893_" style="fill:#8FE5D8;" d="M511.901,162.099c-1.283,9.531-38.137,18.626-65.266,36.748 c-7.438,4.959-14.135,10.596-19.18,17.1l-45.681-45.681c2.249-6.609,4.952-15.044,7.45-24.183 c5.083-18.564,9.325-40.024,7.257-54.963c-4.404-31.814,25.497-11.88,33.39,10.129c7.886,22.015,24.706-0.623,44.428,28.655 C494.035,159.184,513.564,149.646,511.901,162.099z"></path> <path id="XMLID_6892_" style="fill:#63CEC1;" d="M425.928,171.562c8.316,8.316,15.219,17.511,20.707,27.285 c-7.438,4.959-14.135,10.596-19.18,17.1l-45.681-45.681c2.249-6.609,4.952-15.044,7.45-24.183 C402.53,152.126,414.989,160.623,425.928,171.562z"></path> <g id="XMLID_6890_"> <path id="XMLID_551_" style="fill:#63CEC1;" d="M402.775,185.957c-1.359,0-2.736-0.359-3.985-1.113 c-3.653-2.205-4.827-6.953-2.623-10.606l0,0c0.075-0.124,7.591-12.642,16.072-31.061c1.785-3.876,6.374-5.57,10.25-3.786 c3.876,1.785,5.571,6.374,3.786,10.25c-8.868,19.258-16.555,32.046-16.878,32.58 C407.946,184.627,405.392,185.957,402.775,185.957z"></path> </g> <g id="XMLID_6889_"> <path id="XMLID_550_" style="fill:#63CEC1;" d="M416.154,195.692c-2.05,0-4.095-0.81-5.615-2.417 c-2.932-3.1-2.796-7.99,0.304-10.922c0.962-0.91,23.788-22.432,43.012-34.61c3.604-2.284,8.378-1.213,10.662,2.392 c2.283,3.605,1.212,8.378-2.392,10.662c-17.95,11.37-40.438,32.57-40.663,32.783 C419.968,194.992,418.059,195.692,416.154,195.692z"></path> </g> </g> <g id="XMLID_6495_"> <path id="XMLID_6887_" style="fill:#8FE5D8;" d="M247.51,306.473l50.745,50.745c-1.912,5.6-4.118,12.39-6.279,19.797 c-6.454,22.027-12.627,49.593-10.054,68.125c4.89,35.34-28.325,13.2-37.09-11.25c-8.765-24.451-27.447,0.685-49.362-31.832 c-21.915-32.53-43.612-21.934-41.762-35.77c1.47-10.926,45.095-21.348,75.432-42.84 C236.222,318.446,242.583,312.833,247.51,306.473z"></path> <path id="XMLID_6502_" style="fill:#63CEC1;" d="M247.51,306.473l50.745,50.745c-1.912,5.6-4.118,12.39-6.279,19.797 c-15.761-6.105-30.537-15.524-43.257-28.244c-7.762-7.762-14.284-16.278-19.579-25.323 C236.222,318.446,242.583,312.833,247.51,306.473z"></path> <g id="XMLID_6497_"> <path id="XMLID_546_" style="fill:#63CEC1;" d="M256.613,391.45c-1.081,0-2.18-0.228-3.227-0.71 c-3.876-1.785-5.571-6.374-3.786-10.25c9.831-21.35,18.347-35.516,18.705-36.108c2.205-3.652,6.954-4.825,10.605-2.622 c3.653,2.204,4.828,6.952,2.625,10.606c-0.083,0.138-8.454,14.077-17.899,34.589C262.333,389.783,259.536,391.45,256.613,391.45 z"></path> </g> <g id="XMLID_6496_"> <path id="XMLID_545_" style="fill:#63CEC1;" d="M213.599,382.719c-2.56,0-5.063-1.271-6.535-3.593 c-2.283-3.605-1.212-8.378,2.392-10.662c20.012-12.677,45.051-36.282,45.302-36.519c3.1-2.932,7.989-2.795,10.922,0.305 c2.932,3.1,2.796,7.99-0.304,10.922c-1.066,1.009-26.364,24.861-47.65,38.346C216.443,382.331,215.012,382.719,213.599,382.719z "></path> </g> </g> <path id="XMLID_6494_" style="fill:#FFC988;" d="M413.077,184.413c33.409,33.409,40.143,83.387,20.196,123.468 c-5.027,10.123-11.761,19.61-20.19,28.039c-41.843,41.843-109.676,41.837-151.513,0c-30.362-30.362-38.691-74.411-24.974-112.273 c5.17-14.315,13.499-27.752,24.98-39.233C303.413,142.576,371.24,142.576,413.077,184.413z"></path> <path id="XMLID_6487_" style="fill:#FFB64D;" d="M413.077,184.413c27.74,27.74,37.09,66.904,28.039,102.331 c-2.971-32.449-19.417-66.96-41.413-88.957c-39.588-39.588-102.443-41.719-144.53-6.385c2.012-2.398,4.149-4.734,6.404-6.989 C303.413,142.576,371.24,142.576,413.077,184.413z"></path> </g> <circle id="XMLID_7159_" style="fill:#63CEC1;" cx="361.713" cy="297.455" r="26.008"></circle> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                    <p class="text-muted display-4 mt-2" style="font-size: 24px;">No conversation selected!</p>
                </div>
            </div>
            <div class="col-4 rightbar">
                <ul class="nav nav-pills mt-3">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">Khách hàng</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Đơn hàng</a>
                    </li>
                  </ul>

                  <div class="row mt-4">
                    <div class="col-md-12 order-md-1">
                        <div class="d-flex align-items-center sidebar-contact">
                            <img class="avatar" src="https://platform-lookaside.fbsbx.com/platform/profilepic/?psid=3788656437867402&width=1024&ext=1615134286&hash=AeRDIEoOewRHv3Zi1SU" />
                            <div class="ml-3">
                                <h4 class="mb-0">Luan Pham</h4>
                                <p class="text-muted mb-0">luanpm@live.com</p>
                            </div>
                        </div>
                      <form class="needs-validation" novalidate="">
                        <div class="row mt-3">
                          <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                            <div class="invalid-feedback">
                              Valid first name is required.
                            </div>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                            <div class="invalid-feedback">
                              Valid last name is required.
                            </div>
                          </div>
                        </div>
                
                        <div class="mb-3">
                          <label for="username">Username</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" id="username" placeholder="Username" required="">
                            <div class="invalid-feedback" style="width: 100%;">
                              Your username is required.
                            </div>
                          </div>
                        </div>
                
                        <div class="mb-3">
                          <label for="email">Email <span class="text-muted">(Optional)</span></label>
                          <input type="email" class="form-control" id="email" placeholder="you@example.com">
                          <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                          </div>
                        </div>
                
                        <div class="mb-3">
                          <label for="address">Address</label>
                          <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                          <div class="invalid-feedback">
                            Please enter your shipping address.
                          </div>
                        </div>
                
                        <div class="mb-3">
                          <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                          <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                        </div>
                
                        <div class="row">
                          <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" id="country" required="">
                              <option value="">Choose...</option>
                              <option>United States</option>
                            </select>
                            <div class="invalid-feedback">
                              Please select a valid country.
                            </div>
                          </div>
                          <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select class="custom-select d-block w-100" id="state" required="">
                              <option value="">Choose...</option>
                              <option>California</option>
                            </select>
                            <div class="invalid-feedback">
                              Please provide a valid state.
                            </div>
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="" required="">
                            <div class="invalid-feedback">
                              Zip code required.
                            </div>
                          </div>
                        </div>
                        <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="same-address">
                          <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="save-info">
                          <label class="custom-control-label" for="save-info">Save this information for next time</label>
                        </div>
                        <hr class="mb-4">
                
                        <h4 class="mb-3">Payment</h4>
                
                        <div class="d-block my-3">
                          <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                            <label class="custom-control-label" for="credit">Credit card</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                            <label class="custom-control-label" for="debit">Debit card</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                            <label class="custom-control-label" for="paypal">PayPal</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                              Name on card is required
                            </div>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                            <div class="invalid-feedback">
                              Credit card number is required
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                            <div class="invalid-feedback">
                              Expiration date required
                            </div>
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                            <div class="invalid-feedback">
                              Security code required
                            </div>
                          </div>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                      </form>
                    </div>
                  </div>
            </div>
        </div>
    </main>

    <script>
        class Messenger {
            constructor(attributes) {
                this.conversations = [];

                // attribute default
                if (!attributes) {
                    attributes = {};
                }

                // Set messenger attributes
                var keys =  Object.keys(attributes);
                for (var i = 0; i < keys.length; i += 1) {
                    var key = keys[i];
                    var value = attributes[key];
                    this[key] = value;
                }
            }

            getConversations(callback) {
                var _this = this;

                $.ajax({
                    url: '{{ action('Client\MessageController@getConversations') }}', 
                    type: 'GET'
                }).done(function(data){                   
                    console.log('load conversations:');
                    console.log(data);

                    data.forEach(function(item) {
                        var conversation = new Conversation();
                        _this.conversations.push(item);
                    })

                    if (callback) {
                        callback();
                    }
                }).fail(function(xhr, textStatus, errorThrown){
                    console.log(xhr);
                });
            }

            renderConversations() {
                var _this = this;

                $('.conversations').html('');
                _this.conversations.forEach(function(conversation) {
                    $('.conversations').append(`
                        <div class="conversation d-flex align-items-center p-2" data-id="` + conversation.id + `">
                            <img class="avatar" src="` + conversation.picture + `" />
                            <div class="ml-3">
                                <label class="m-0">Luan Pham</label>
                                <p class="m-0 text-muted">` + conversation.data.snippet + ` · ` + conversation.updatedTime + `</p>
                            </div>
                            <span class="badge badge-danger unread_count">` + (conversation.data.unread_count ? conversation.data.unread_count : '' ) + `</span>
                        </div>
                    `);

                    _this.loadEvents();
                })
            }

            loadConversations(callback) {
                var _this = this;
                _this.conversations = [];

                this.getConversations(function() {
                    _this.renderConversations();

                    if (callback) {
                        callback();
                    }
                });
            }

            loadEvents() {
                var _this = this;

                $('.conversation').on('click', function() {
                    var conversationId = $(this).attr('data-id');
                    
                    _this.openChatbox(conversationId);
                });
            }

            openChatbox(conversationId) {
                var _this = this;

                // add active
                $('.conversation').removeClass('active');
                $('.conversation[data-id="'+conversationId+'"]').addClass('active');

                _this.loadChatbox(conversationId);
            }

            loadChatbox(conversationId) {
                var _this = this;
                _this.currentConversationId = conversationId;

                $('.messenger-chatbox').html(`
                    <div class="m-5 text-center">
                        <div class="spinner-border text-info" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                `);

                $.ajax({
                    url: '{{ action('Client\MessageController@getConversation') }}', 
                    type: 'GET',
                    data: {
                        id: _this.currentConversationId
                    }
                }).done(function(data) {                    
                    console.log('load conversation:');
                    console.log(data);

                    // set current conversation
                    _this.currentConversation = data.conversation;
                    
                    $('.messenger-chatbox').html(`
                        <div class="d-flex align-items-center header py-3 px-3">
                            <img class="avatar" src="` + data.conversation.picture + `" />
                            <div class="ml-2">
                                <h4 class="m-0 font-weight-bold">` + data.conversation.name + `</h4>
                            </div>
                        </div>
                        <div class="chatbox-content p-3">
                            <div></div>
                            <div class="messages">
                                
                            </div>
                        </div>
                        <div class="chatbox-editor p-3">
                            <div class="textarea-cover">
                                <textarea rows="1" placeholder="Nhập nội dung trò chuyện"></textarea>
                            </div>
                        </div>
                    `);
                    
                    // render messages
                    data.messages.forEach(function(message) {
                        _this.appendMessage(message.message, message.from.id, message.to[0].id);
                    });

                    // scroll to bottom
                    $(".chatbox-content").animate({ scrollTop: $(".chatbox-content")[0].scrollHeight }, 1000);

                    // chatbox event
                    $(".chatbox-editor textarea").on('keypress', function(e) {
                        var code = (e.keyCode ? e.keyCode : e.which);
                        
                        if (code == 13) {
                            e.preventDefault();

                            var message = $(this).val();
                            _this.sendMessage(data.conversation.id, message);
                            return true;
                        }
                    });

                }).fail(function(xhr, textStatus, errorThrown){
                    console.log(xhr);
                });
            }

            appendMessage(message, from, to) {
                var _this = this;

                console.log(to);

                // append message to bottom
                $('.messenger-chatbox .messages').append(`
                    <div class="message-line ` + (from == '{{ $page->id }}' ? 'own' : '') + `" page-id="{{ $page->id }}" data-from="` + from + `" data-to="` + to + `">
                        <div class="message">` + message + `</div>
                    </div>
                `);
            }

            sendMessage(to, message) {
                $(".chatbox-editor textarea").val('');

                $.ajax({
                    url: '{{ action('Client\MessageController@sendMessage') }}', 
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        message: message,
                        to: to
                    }
                }).done(function(res){
                    console.log(res);
                }).fail(function(e){
                    console.log(e);
                });
            }
        }

        class Conversation {
            constructor(attributes) {
                this.conversations = [];

                // attribute default
                if (!attributes) {
                    attributes = {};
                }

                // Set messenger attributes
                var keys =  Object.keys(attributes);
                for (var i = 0; i < keys.length; i += 1) {
                    var key = keys[i];
                    var value = attributes[key];
                    this[key] = value;
                }
            }

            renderMessages() {
                
            }
        }

        var messenger = new Messenger();
        messenger.loadConversations();
        
    </script>

    
    <script>
        Echo.private('Messenger')
        .listen('MessengerNotification', (e) => {
            e.data.forEach(function(m) {
                // upcoming notification
                console.log('upcoming notification:');
                console.log(m);

                // check sender is in conversation
                if (messenger.currentConversation && (messenger.currentConversation.to == m.sender.id || messenger.currentConversation.to == m.recipient.id)) {
                    messenger.appendMessage(m.message.text, m.sender.id, m.recipient.id);
                } else {
                    messenger.loadConversations(function() {
                        // add active
                        $('.conversation').removeClass('active');
                        $('.conversation[data-id="'+messenger.currentConversation.id+'"]').addClass('active');
                    });
                }
            });

            // scroll to bottom
            $(".chatbox-content").animate({ scrollTop: $(".chatbox-content")[0].scrollHeight }, 1000);
        });
    </script>
@endsection