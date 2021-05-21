<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/speakingurl/14.0.1/speakingurl.min.js"></script>
<script>
    $(function() {
        $.fn.filemanager = function(type, options) {
          type = type || 'file';
          this.on('click', function(e) {
            var route_prefix = (options && options.prefix) ? options.prefix : '/laravel/laravel_8_blog_breeze/public/filemanager';
            var target_input = $('#' + $(this).data('input'));
            var target_preview = $('#' + $(this).data('preview'));
            window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
            window.SetUrl = function (items) {
              var file_path = items.map(function (item) {
                return item.url;
              }).join(',');
              // set the value of the desired input to image url
              target_input.val('').val(file_path).trigger('change');
              // clear previous preview
              target_preview.html('');
              // set or change the preview image src
              items.forEach(function (item) {
                target_preview.append(
                  $('<img>').attr('src', item.thumb_url)
                );
              });
              // trigger change event
              target_preview.trigger('change');
            };
            return false;
          });
        }
        $('#lfm').filemanager('image');
        $('#slug').keyup(function () {
          $(this).val(getSlug($(this).val()))
        })
        $('#title').keyup(function () {
          $('#slug').val(getSlug($(this).val()))
        })
    });
    CKEDITOR.replace('body', { customConfig: '{{ asset("js/ckeditor.js") }}' });
</script>