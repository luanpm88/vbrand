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
              <div class="text-center m-5 pt-5">
                <svg style="width:200px;height: 200px;" class="my-4 p-3" xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512"><g><g><path d="m351.885 174.784c-59.894 0-49.34 49.409-109.235 49.409-14.465 0-99.378-49.409-113.842-49.409-38.044 0-76.088 0-114.132 0-19.47 111.56-19.47 225.649 0 337.209h337.209c19.47-111.56 19.47-225.649 0-337.209z" fill="#e49542"></path><path d="m69.166 512h-54.49c-19.453-111.569-19.453-225.647 0-337.216h54.49c-19.48 111.569-19.48 225.647 0 337.216z" fill="#e28424"></path><path d="m237.753 316.585-49.401-31.144c-3.099-1.953-7.044-1.953-10.142 0l-34.821 21.952c-6.332 3.992-14.58-.559-14.58-8.044v-124.565h108.945v141.801z" fill="#db5c6e"></path></g><g><g><path d="m402.834.722c-51.926-1.89-103.845-.068-155.764 5.457-14.443 1.533-25.751 13.099-26.904 27.572-7.483 93.835-7.483 187.67 0 281.512 1.154 14.473 12.462 26.039 26.904 27.572 77.442 8.242 154.891 8.242 232.341 0 14.435-1.533 25.751-13.099 26.904-27.572 5.586-70.088 7.005-140.168 4.242-210.248" fill="#ededed"></path><path d="m510.558 105.015c-25.523-.918-51.046-2.74-76.577-5.457-14.435-1.533-25.751-13.099-26.904-27.572-1.897-23.755-3.309-47.509-4.242-71.264 25.522.918 106.789 80.538 107.723 104.293z" fill="#dbdbdb"></path></g><g><path d="m270.882 153.046c-2.768 0-5.33-1.482-6.707-3.893l-12.576-22.009c-2.117-3.705-.83-8.425 2.875-10.542 3.703-2.117 8.423-.83 10.542 2.875l5.493 9.612 16.553-32.354c1.945-3.8 6.601-5.301 10.397-3.359 3.799 1.944 5.303 6.599 3.359 10.397l-23.056 45.065c-1.292 2.525-3.864 4.139-6.699 4.205-.061.002-.121.003-.181.003z" fill="#95d6a4"></path><g fill="#407093"><path d="m392.959 123.701h-73.867c-4.268 0-7.726-3.459-7.726-7.726s3.459-7.726 7.726-7.726h73.867c4.268 0 7.726 3.459 7.726 7.726s-3.459 7.726-7.726 7.726z"></path><path d="m461.622 150.95h-142.53c-4.268 0-7.726-3.459-7.726-7.726s3.459-7.726 7.726-7.726h142.53c4.268 0 7.726 3.459 7.726 7.726s-3.459 7.726-7.726 7.726z"></path></g></g><g><path d="m270.882 228.503c-2.768 0-5.33-1.482-6.707-3.893l-12.576-22.009c-2.117-3.705-.83-8.425 2.875-10.542 3.703-2.117 8.423-.83 10.542 2.875l5.493 9.612 16.553-32.354c1.945-3.8 6.601-5.301 10.397-3.359 3.799 1.944 5.303 6.599 3.359 10.397l-23.056 45.065c-1.292 2.525-3.864 4.14-6.699 4.205-.061.003-.121.003-.181.003z" fill="#95d6a4"></path><g fill="#407093"><path d="m392.959 199.158h-73.867c-4.268 0-7.726-3.459-7.726-7.726s3.459-7.726 7.726-7.726h73.867c4.268 0 7.726 3.459 7.726 7.726s-3.459 7.726-7.726 7.726z"></path><path d="m459.237 226.404h-140.148c-4.268 0-7.726-3.459-7.726-7.726s3.459-7.726 7.726-7.726h140.149c4.268 0 7.726 3.459 7.726 7.726s-3.459 7.726-7.727 7.726z"></path></g></g><g><path d="m270.882 303.96c-2.768 0-5.33-1.482-6.707-3.893l-12.576-22.009c-2.117-3.705-.83-8.425 2.875-10.542 3.703-2.118 8.423-.83 10.542 2.875l5.493 9.612 16.553-32.354c1.945-3.8 6.601-5.302 10.397-3.359 3.799 1.944 5.303 6.599 3.359 10.397l-23.056 45.065c-1.292 2.525-3.864 4.139-6.699 4.205-.061.003-.121.003-.181.003z" fill="#95d6a4"></path><g fill="#407093"><path d="m392.959 274.616h-73.867c-4.268 0-7.726-3.459-7.726-7.726s3.459-7.726 7.726-7.726h73.867c4.268 0 7.726 3.459 7.726 7.726 0 4.266-3.459 7.726-7.726 7.726z"></path><path d="m403.66 301.868h-84.571c-4.268 0-7.726-3.459-7.726-7.726s3.459-7.726 7.726-7.726h84.571c4.268 0 7.726 3.459 7.726 7.726s-3.458 7.726-7.726 7.726z"></path></g></g></g><g><path d="m133.302 471.87c-26.264 2.202-52.528 2.202-78.792 0-7.188-.603-12.874-6.288-13.476-13.476-2.202-26.264-2.202-52.528 0-78.792.603-7.188 6.288-12.874 13.476-13.476 26.264-2.202 52.528-2.202 78.792 0 7.188.603 12.874 6.288 13.476 13.476 2.202 26.264 2.202 52.528 0 78.792-.602 7.188-6.288 12.873-13.476 13.476z" fill="#ededed"></path><g fill="#dbdbdb"><path d="m121.452 411.372h-55.091c-4.267 0-7.726-3.459-7.726-7.726s3.459-7.726 7.726-7.726h55.091c4.267 0 7.726 3.459 7.726 7.726 0 4.266-3.459 7.726-7.726 7.726z"></path><path d="m121.452 442.077h-55.091c-4.267 0-7.726-3.459-7.726-7.726s3.459-7.726 7.726-7.726h55.091c4.267 0 7.726 3.459 7.726 7.726s-3.459 7.726-7.726 7.726z"></path></g></g></g></svg>
                  <p class="text-muted display-4 mt-2" style="font-size: 24px;">No contact selected!</p>
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
                                <p class="m-0 text-muted small"><span class="snippet">` + conversation.data.snippet + `</span> · ` + conversation.updatedTime + `</p>
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

                // loading rightbar
                _this.rightbarLoading();

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
                    _this.currentConversation = new Conversation(data.conversation);
                    
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
                    messenger.scrollChatboxBottom()

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

                    // load rightbar
                    _this.loadRightbar();

                }).fail(function(xhr, textStatus, errorThrown){
                    console.log(xhr);
                });
            }

            appendMessage(message, from, to) {
                var _this = this;

                // remove all pending message
                $('.message-line.pending').remove();

                // append message to bottom
                $('.messenger-chatbox .messages').append(`
                    <div class="message-line ` + (from == '{{ $page->id }}' ? 'own' : '') + `" page-id="{{ $page->id }}" data-from="` + from + `" data-to="` + to + `">
                        <div class="message">` + message + `</div>
                    </div>
                `);
            }

            appendNotSentMessage(message, from, to) {
                var _this = this;

                // append message to bottom
                $('.messenger-chatbox .messages').append(`
                    <div class="message-line pending ` + (from == '{{ $page->id }}' ? 'own' : '') + `" page-id="{{ $page->id }}" data-from="` + from + `" data-to="` + to + `">
                        <div class="spinner-grow text-info" role="status">
                          <span class="sr-only">Loading...</span>
                        </div>
                        <div class="message">` + message + `</div>
                    </div>
                `);
            }

            sendMessage(to, message) {
                var _this = this;

                $(".chatbox-editor textarea").val('');

                // append pending message
                _this.appendNotSentMessage(message, '{{ $page->id }}', to);

                // scroll to bottom
                messenger.scrollChatboxBottom()

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

            rightbarLoading() {
                $('.rightbar').html(`
                    <div class="m-5 text-center">
                    <div class="spinner-border text-info" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    </div>
                `);
            }

            loadRightbar() {
                var _this = this;

                _this.rightbarLoading();

                $.ajax({
                    url: '{{ action('Client\MessageController@rightbar') }}', 
                    type: 'GET',
                    data: {
                        conversationId: _this.currentConversationId
                    }
                }).done(function(res){
                  $('.rightbar').html(res);
                }).fail(function(e){
                    console.log(e);
                });
            }

            scrollChatboxBottom() {
                if (!$(".chatbox-content").length) {
                    return;
                }

                $(".chatbox-content").animate({ scrollTop: $(".chatbox-content")[0].scrollHeight }, 1000);
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
                messenger.scrollChatboxBottom()
            }
        }

        class Contact {
          constructor(attributes) {
            this.conversations = [];

            // attribute default
            if (!attributes) {
                attributes = {};
            }

            // Auto set contact attributes
            var keys =  Object.keys(attributes);
            for (var i = 0; i < keys.length; i += 1) {
                var key = keys[i];
                var value = attributes[key];
                this[key] = value;
            }
          }
        }

        class Order {
            constructor(attributes) {
                // attribute default
                if (!attributes) {
                    attributes = {};
                }

                // Auto set contact attributes
                var keys =  Object.keys(attributes);
                for (var i = 0; i < keys.length; i += 1) {
                    var key = keys[i];
                    var value = attributes[key];
                    this[key] = value;
                }
            }

            load() {
                var _this = this;

                $.ajax({
                    url: _this.url, 
                    type: 'GET'
                }).done(function(res){
                    $('.order-container').html(res);
                }).fail(function(e){
                    console.log(e);
                });
            }

            addProduct(productId) {
                var _this = this;

                $.ajax({
                    url: _this.addProductUrl,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: productId
                    }
                }).done(function(res){
                    order.load();
                }).fail(function(e){
                    console.log(e);
                });
            }

            updateQuantity(detailId, value) {
                var _this = this;

                $.ajax({
                    url: _this.updateQuantityUrl,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        detail_id: detailId,
                        quantity: value
                    }
                }).done(function(res){
                    order.load();
                }).fail(function(e){
                    console.log(e);
                });
            }
        }

        var messenger = new Messenger();
        messenger.loadConversations();
        
    </script>

    
    <script>
        Echo.private('Messenger')
        .listen('MessengerNotification', (e) => {
            console.log('upcoming notification (raw):');
            console.log(e);

            // get conversation data from webhook
            var m = e.data;

            // e.data.forEach(function(m) {
            console.log('upcoming notification:');
            console.log(m);

            // check sender is in conversation
            if (messenger.currentConversation && (messenger.currentConversation.to == m.sender.id || messenger.currentConversation.to == m.recipient.id)) {
                messenger.appendMessage(m.message.text, m.sender.id, m.recipient.id);
            }

            // scroll to bottom
            messenger.scrollChatboxBottom()
            
            // reload conversations list
            messenger.loadConversations(function() {
                // add active
                $('.conversation[data-id="'+messenger.currentConversationId+'"]').addClass('active');
            });
        });
    </script>
@endsection