(function ($) {
    function insertIntoClassicEditor(textToInsert) {
        if (typeof window.tinymce !== 'undefined') {
            var activeEditor = window.tinymce.activeEditor;
            if (activeEditor && !activeEditor.isHidden()) {
                activeEditor.execCommand('mceInsertContent', false, textToInsert);
                return true;
            }
        }
        var $textarea = $('#content');
        if ($textarea.length) {
            var textarea = $textarea.get(0);
            var start = textarea.selectionStart || 0;
            var end = textarea.selectionEnd || 0;
            var current = textarea.value;
            textarea.value = current.substring(0, start) + textToInsert + current.substring(end);
            // Move caret to end of inserted text
            var newPos = start + textToInsert.length;
            textarea.selectionStart = textarea.selectionEnd = newPos;
            textarea.focus();
            return true;
        }
        return false;
    }

    $(document).on('click', '#inlinedoon-insert-shortcode', function () {
        var shortcode = $(this).data('shortcode');
        insertIntoClassicEditor(shortcode);
    });
})(jQuery);


