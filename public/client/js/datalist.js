class DataList {
    constructor(options) {
        var _this = this;
        _this.id = '_' + Math.random().toString(36).substr(2, 9);
        _this.options = {};

        if (options) {
            _this.options = options;
        }

        console.log(_this.options);

        // url
        if (_this.options.url) {
            _this.url = _this.options.url;
        }

        // list
        if (_this.options.list) {
            _this.list = _this.options.list;
        }

        // container
        if (_this.options.container) {
            _this.container = _this.options.container;
        }

        // url
        if (_this.options.data) {
            _this.data = _this.options.data;
        } else {
            _this.data = {};
        }
    }
    
    loading() {
        var loadingHtml = `
            <div class="datalist-loading"><div class="spinner-border text-info" role="status">
                <span class="visually-hidden">Loading...</span>
            </div></div>
        `;
        this.container.prepend(loadingHtml);
        this.container.addClass('loading');
    }

    loaded() {
        // apply js for new content
        this.applyJs();
        
        // remove loading effects
        this.container.find('.datalist-loading').remove();        
        this.container.removeClass('loading');
    }
    
    applyJs() {
        var _this = this;

        _this.container.find('.page-link').on('click', function() {
            var page = $(this).attr('data-page');
            
            _this.data.page = page;
            _this.load();
        });
    }
    
    load(options) {
        var _this = this;

        if (!options) {
            options = {};
        }
        
        if (options.url) {
            _this.url = options.url;
        }

        if (options.data) {
            _this.data = $.extend(_this.data, options.data);
        }

        _this.loading();

        // get all params
        var form = $('<form>').html(_this.list.clone());
        console.log(form.serialize());

        // stop previous request
        if (_this.xhr && _this.xhr.readyState != 4) {
            _this.xhr.abort();
        }
        _this.xhr = $.ajax({
            url: _this.url,
            type: 'POST',
            dataType: 'html',
            data: _this.data,
        }).done(function(response) {
            _this.container.html(response);
            
            // callback
            if (options.callback) {
                options.callback();
            }
            
            // after load
            _this.loaded();
        }).fail(function(jqXHR, textStatus, errorThrown){
        });
    }
    
    loadHtml(html) {
        var _this = this;
        
        _this.container.html(html);
        
        // after load
        _this.loaded();
    }
}