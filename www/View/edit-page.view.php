<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
</body>
</html>

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

<button class="bi bi-arrow-return-right" type="button" onclick="history.back()"> <img src="/Medias/icon_arrow_return_left.png" height ="20" width="35" /></button>

<div id="contenu">

    <table border="1" cellpadding="15">
        <tr>
            <center>
                <h1>Modifier la page <?php echo $page->getPageTitle() ?></h1>
            </center>

            <form action="update?id=<?php echo $_GET['id'] ?>" method="post" onsubmit="mysubmit()">

                <?php
                $date = $page->getPageCreatedAt();
                $date =  date('d-m-Y', strtotime($date));
                ?>

                <input type=text name=page_title placeholder="Titre" value=<?php echo $page->getPageTitle() ?>>
                <input type=text name=page_slug placeholder="Slug" value=<?php echo $page->getPageSlug() ?>>
                <input name="page_content" type="hidden" id="page_content" />
                <div name="page_content" id="editor" style="width:44cm;height:15cm;background-color:white"><?php echo $page->getPageContent() ?></div>
                <br><br>
                <input type=submit class="btn btn-success" name=valider value=valider></td>
                <br><br>
                <a href="delete?id=<?php echo $_GET['id'] ?>">
                    <img src="/Medias/icon_delete.png" height="30" width="30"></a>
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