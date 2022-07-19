<!-- Main Quill library -->
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

<?php

use App\Controller\Authenticator;

$auth = new Authenticator();
$auth->authenticated(true);
?>

<a href="<?php echo ONLINE_DOMAIN ?>/pages">
    <button> Liste des pages</button>
</a>
<button onclick="history.back()">Retour</button>

<div id="contenu">
    <table border="1" cellpadding="15">
        <tr>
            <center>
                <h1>Ajouter une page</h1>
            </center>

            <form action="" method="post" onsubmit="mysubmit()">

                <input type=text name=page_title placeholder="Titre de la page">
                <!-- Espace &#160 -->
                &#160;
                <input type=text name=page_slug placeholder="Slug de la page">
                <br><br>
                <input name="page_content" type="hidden" id="page_content" />
                <div name="page_content" id="editor" style="width:44cm;height:15cm;background-color:white"></div>
                <br><br>
                <input type=submit name=valider value=valider>
        </tr>
    </table>
    </form>
</div>

<script>
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
        ['link', 'image'],
        ['blockquote', 'code-block'],

        [{
            'header': 1
        }, {
            'header': 2
        }], // custom button values
        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],
        [{
            'script': 'sub'
        }, {
            'script': 'super'
        }], // superscript/subscript
        [{
            'indent': '-1'
        }, {
            'indent': '+1'
        }], // outdent/indent
        [{
            'direction': 'rtl'
        }], // text direction

        [{
            'size': ['small', false, 'large', 'huge']
        }], // custom dropdown
        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],

        [{
            'color': []
        }, {
            'background': []
        }], // dropdown with defaults from theme
        [{
            'font': []
        }],
        [{
            'align': []
        }],

        ['clean']
    ];
    var options = {
        debug: 'info',
        placeholder: 'Entrez le contenu de la page',
        readOnly: false,
        theme: 'snow',
        modules: {
            toolbar: toolbarOptions
        }
    };


    var container = document.getElementById('editor');
    var editor = new Quill(container, options);

    function mysubmit() {
        var html = document.getElementById('editor').children[0].innerHTML;
        document.getElementById('page_content').value = html;
    };
</script>