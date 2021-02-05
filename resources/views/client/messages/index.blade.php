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
                    </div>
                    <div class="my-3">
                        <input type="text" class="form-control" placeholder="Search Messenger" />
                    </div>
                    <div class="conversations">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 messenger-chatbox p-0">

            </div>
            <div class="col-3">
                <ul class="nav nav-pills mt-3">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">Khách hàng</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Đơn hàng</a>
                    </li>
                  </ul>
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
                                <p class="m-0 text-muted">` + conversation.data.snippet + `</p>
                            </div>
                            <span class="badge badge-danger unread_count">` + (conversation.data.unread_count ? conversation.data.unread_count : '' ) + `</span>
                        </div>
                    `);

                    _this.loadEvents();
                })
            }

            loadConversations() {
                var _this = this;
                _this.conversations = [];

                this.getConversations(function() {
                    _this.renderConversations();
                });
            }

            loadEvents() {
                var _this = this;

                $('.conversation').on('click', function() {
                    var conversationId = $(this).attr('data-id');

                    // add active
                    $(this).addClass('active');

                    _this.loadChatbox(conversationId);
                });
            }

            loadChatbox(conversationId) {
                var _this = this;
                _this.currentConversationId = conversationId;

                $('.messenger-chatbox').html(`
                    <div class="spinner-border m-3" role="status">
                        <span class="sr-only">Loading...</span>
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
                    
                    $('.messenger-chatbox').html(`
                        <div class="d-flex align-items-center header py-3 px-3">
                            <img class="avatar" src="` + data.conversation.picture + `" />
                            <div class="ml-2">
                                <h4 class="m-0 font-weight-bold">` + data.conversation.name + `</h4>
                            </div>
                        </div>
                        <div class="chatbox-content p-3">
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
            // $('.notification').html(e.message);
            // console.log(e.data);
            // var data = JSON.parse(e);

            e.data.forEach(function(m) {
                messenger.appendMessage(m.message.text, m.sender.id, m.recipient.id);
            });

            // scroll to bottom
            $(".chatbox-content").animate({ scrollTop: $(".chatbox-content")[0].scrollHeight }, 1000);
        });
    </script>
@endsection