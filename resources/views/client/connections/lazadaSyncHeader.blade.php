<div class="lazadaSyncHeader">
    @if (isset($lazadaConnection->getData()['sync']))
        @if (!in_array($lazadaConnection->getData()['sync']['status'], ['done', 'closed']))
            <div class="alert alert-info d-flex align-items-center">
                <div class="d-flex align-items-center me-auto">
                    <div class="spinner-border text-info me-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div>
                        <p class="mb-0">Đang đồng bộ <strong class="fw-bold">
                            {{ $lazadaConnection->getData()["sync"]["imported"] }} / {{ $lazadaConnection->getData()["sync"]["total"] }}
                        </strong> sản phẩm từ Lazada</p>
                    </div>
                </div>
                <div>
                    <a href="javascript:;" class="btn btn-info" onclick="$('.lazada-sync').click()">Xem chi tiết</a>
                </div>
            </div>
        @elseif (in_array($lazadaConnection->getData()['sync']['status'], ['done']))
            <div class="alert alert-success d-flex align-items-center">
                <div class="d-flex align-items-center me-auto">
                    <div>
                        <p class="mb-0">Đã đồng bộ sản <strong class="fw-bold">
                            {{ $lazadaConnection->getData()["sync"]["total"] }}
                        </strong> sản phẩm từ Lazada</p>
                    </div>
                </div>
                <div>
                    <a href="javascript:;" class="btn btn-success" onclick="$('.lazada-sync').click()">Xem chi tiết</a>
                </div>
            </div>
        @endif
    @endif
</div>

<script>
    function checkHeaderProgress() {
        if ($('.lazadaSyncHeader').length) {
            $.ajax({
                url: '', 
                type: 'GET',
            }).done(function(res){
                $('.lazadaSyncHeader').html($('<div>').html(res).find('.lazadaSyncHeader').html());

                setTimeout(function() {
                    checkHeaderProgress();
                }, 5000);
            }).fail(function(e){
                
            });
        }
    }
</script>