<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Đồng bộ sản phẩm từ Lazada</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="sync-content">
            @if (isset($lazadaConnection->getData()['sync']) && !in_array($lazadaConnection->getData()['sync']['status'], ['closed']))
                @if (in_array($lazadaConnection->getData()['sync']['status'], ['done']))
                    <div class="modal-body lazada-sync-progress">
                        <p>Đã đồng bộ <strong class="fw-bold">
                            {{ $lazadaConnection->getData()["sync"]["imported"] }} / {{ $lazadaConnection->getData()["sync"]["total"] }}
                        </strong> sản phẩm từ Lazada</p>
                        
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{ $lazadaConnection->getData()['sync']['progress'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $lazadaConnection->getData()['sync']['progress'] }}%"></div>
                        </div>
                        <label><code class="text-success">{{ trans('messages.connection.sync.status.' . $lazadaConnection->getData()['sync']['status']) }}</code></label>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ action('Client\ConnectionController@lazadaSyncClose') }}" class="btn btn-secondary btn-done">Kết thúc</a>
                    </div>
                    <script>                        
                        $('.btn-done').on('click', function(e) {
                            e.preventDefault();
                    
                            var url = $(this).attr('href');
                    
                            addMaskLoading();
                    
                            $.ajax({
                                url: url, 
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                }
                            }).done(function(res){
                                removeMaskLoading();
                                lazadaSync.hide();
                            }).fail(function(e){
                                
                            });
                        });
                    </script>
                @else
                    <div class="modal-body lazada-sync-progress">
                        <p>Đang đồng bộ <strong class="fw-bold">
                            {{ $lazadaConnection->getData()["sync"]["imported"] }} / {{ $lazadaConnection->getData()["sync"]["total"] }}
                        </strong> sản phẩm từ Lazada</p>
                        
                        <div class="progress lazada-running">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $lazadaConnection->getData()['sync']['progress'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $lazadaConnection->getData()['sync']['progress'] }}%"></div>
                        </div>
                        <label><code class="">{{ trans('messages.connection.sync.status.' . $lazadaConnection->getData()['sync']['status']) }}</code></label>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ action('Client\ConnectionController@lazadaSyncClose') }}" class="btn btn-danger btn-done">Hủy đồng bộ</a>
                        <button type="button" class="btn btn-secondary" onclick="lazadaSync.hide()">Đóng</button>
                    </div>
                    <script>                        
                        $('.btn-done').on('click', function(e) {
                            e.preventDefault();
                    
                            var url = $(this).attr('href');
                    
                            addMaskLoading();
                    
                            $.ajax({
                                url: url, 
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                }
                            }).done(function(res){
                                removeMaskLoading();
                                lazadaSync.hide();
                            }).fail(function(e){
                                
                            });
                        });
                    </script>
                @endif
            @else
                <form enctype="multipart/form-data" action="{{ action('Client\ConnectionController@lazadaSync') }}"
                    method="POST"
                    class="lazada-sync-form"
                >
                    {{ csrf_field() }}
                        <div class="modal-body">
                                <img height="50px" class="mb-4" src="https://laz-img-cdn.alicdn.com/images/ims-web/TB19SB7aMFY.1VjSZFnXXcFHXXa.png" />
                                <p>Hiện tại đang có <strong class="fw-bold">
                                    {{ $lazadaConnection->service()->getProducts()["data"]["total_products"] }}
                                </strong> sản phẩm đang có tại gian hàng kết nối trên Lazada.
                                Nhấn vào nút bên dưới để bắt đầu đồng bộ sản phẩm</p>
                        </div>
                        <div class="modal-footer">
                                <button class="btn btn-primary">Bắt đầu đồng bộ</button>
                                <button type="button" class="btn btn-secondary close">Hủy</button>
                        </div>
                </form>
                <script>
                    $('.lazada-sync-form').submit(function(e) {
                        e.preventDefault();
                
                        var url = $(this).attr('action');
                        var form = $(this);
                
                        addMaskLoading('Đang bắt đầu đồng bộ từ Lazada...');
                
                        $.ajax({
                            url: url, 
                            type: 'POST',
                            data: form.serialize()
                        }).done(function(res){
                            removeMaskLoading();
                            lazadaSync.load();
                            checkHeaderProgress();
                        }).fail(function(e){
                            
                        });
                    });
                </script>
            @endif
        </div>
    </div>
</div>

<script>
    function checkProgress() {
        if ($('.lazada-running').length) {
            $.ajax({
                url: lazadaSync.url, 
                type: 'GET',
            }).done(function(res){
                $('.sync-content').html($('<div>').html(res).find('.sync-content').html());

                setTimeout(function() {
                    checkProgress();
                }, 1000);
            }).fail(function(e){
                
            });
        }
    }

    checkProgress();
</script>