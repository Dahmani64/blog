CKEDITOR.editorConfig = function(config) {
    config.height = 400
    config.filebrowserImageBrowseUrl = '/laravel-filemanager?type=Images',
    config.filebrowserImageUploadUrl = '/laravel-filemanager/upload?type=Images&_token=',
    config.filebrowserBrowseUrl = '/laravel-filemanager?type=Files',
    config.filebrowserUploadUrl = '/laravel-filemanager/upload?type=Files&_token='
    config.toolbarGroups = [
        { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
        { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
        { name: 'links' },
        { name: 'insert' },
        { name: 'forms' },
        { name: 'tools' },
        { name: 'document',     groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'others' },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
        { name: 'styles' },
        { name: 'colors' }
    ]
}