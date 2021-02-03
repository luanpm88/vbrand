@extends('client.layouts.message')

@section('title')
    vBRand Messages
@endsection

@section('content')
    <div class="row mt-5">
        <div class="col-2"></div>
        <div class="col-8 text-center">
            <script>

                function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
                    console.log('statusChangeCallback');
                    console.log(response);                   // The current login status of the person.

                  if (response.status === 'connected') {   // Logged into your webpage and Facebook.
                    testAPI();  
                  } else {                                 // Not logged into your webpage or we are unable to tell.
                    document.getElementById('status').innerHTML = 'Please log ' +
                      'into this webpage.';
                  }
                }
              
              
                function checkLoginState() {               // Called when a person is finished with the Login Button.
                  FB.getLoginStatus(function(response) {   // See the onlogin handler
                    statusChangeCallback(response);

                    // save token
                    $.ajax({
                        url: '{{ action('Client\MessageController@saveToken') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            data: response,
                        },
                    }).done(function(response) {
                        window.location = '{{ action('Client\MessageController@index') }}';
                    }).fail(function(jqXHR, textStatus, errorThrown){
                    });
                  });
                }
              
              
                window.fbAsyncInit = function() {
                  FB.init({
                    appId      : '{{ $messenger->appId }}',
                    cookie     : true,                     // Enable cookies to allow the server to access the session.
                    xfbml      : true,                     // Parse social plugins on this webpage.
                    version    : 'v9.0'           // Use this Graph API version for this call.
                  });
              
              
                  FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
                    statusChangeCallback(response);        // Returns the login status.
                  });
                };
               
                function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
                    console.log('Welcome!  Fetching your information.... ');
                    FB.api('/me', function(response) {
                        console.log('Successful login for: ' + response.name);
                        document.getElementById('status').innerHTML =
                        'Thanks for logging in, ' + response.name + '!';
                    });
                }
              
              </script>
              
              
              <!-- The JS SDK Login Button -->
              <fb:login-button scope="read_insights,public_profile,email,pages_messaging,pages_read_engagement,pages_manage_metadata,pages_read_user_content" onlogin="checkLoginState();">
              </fb:login-button>
              
              <div id="status">
              </div>
              
              <!-- Load the JS SDK asynchronously -->
              <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
        </div>
    </div>
@endsection