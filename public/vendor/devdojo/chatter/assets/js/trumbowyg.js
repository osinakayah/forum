function initializeNewTrumbowyg(id){
    $('#'+id).trumbowyg({
        fullscreenable: false,
        btnsDef: {
            // Create a new dropdown
            image: {
                dropdown: ['insertImage', 'upload'],
                ico: 'insertImage'
            }
        },
        btns: [
            ['viewHTML'],
            ['formatting'],
            'btnGrp-semantic',
            ['link'],
            ['image'],
            'btnGrp-justify',
            'btnGrp-lists',
            ['horizontalRule'],
            ['removeformat'],
            ['preformatted'],
            ['fullscreen']
        ],
        plugins: {
            upload: {
                serverPath: '/post_image',
                fileFieldName: 'image',
            }
        }
    });
}

$('document').ready(function() {
    $('.trumbowyg').trumbowyg({
        fullscreenable: false,
        btnsDef: {
            // Create a new dropdown
            image: {
                dropdown: ['insertImage', 'upload'],
                ico: 'insertImage'
            }
        },
        btns: [
            ['viewHTML'],
            ['formatting'],
            'btnGrp-semantic',
            ['link'],
            ['image'],
            'btnGrp-justify',
            'btnGrp-lists',
            ['horizontalRule'],
            ['removeformat'],
            ['preformatted'],
            ['fullscreen']
        ],
        plugins: {
            upload: {
                serverPath: '/post_image',
                fileFieldName: 'image',
            }
        }
    });

    document.getElementById('new_discussion_loader').style.display = "none";
    document.getElementById('chatter_form_editor').style.display = "block";

    // check if user is in discussion view
    if ($('#new_discussion_loader_in_discussion_view').length > 0) {
        document.getElementById('new_discussion_loader_in_discussion_view').style.display = "none";
        document.getElementById('chatter_form_editor_in_discussion_view').style.display = "block";
    }
});
