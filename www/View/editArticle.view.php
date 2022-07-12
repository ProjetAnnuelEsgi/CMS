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

<a href="http://localhost/articles">
	<button> Liste des articles</button>
</a>
<button onclick="history.back()">Retour</button>


<div id="contenu">

	<table border="1" cellpadding="15">
		<tr>
			<center>
				<h1>Modifier l'article <?php echo $article->getArticleTitle() ?></h1>
			</center>

			<form id="myform" action="update?id=<?php echo $_GET['id'] ?>" method="post" onsubmit="mysubmit()">

                <?php
                $date = $article->getArticleCreatedAt();
                $date =  date('d-m-Y', strtotime($date));
                ?>

				<input type=text name=article_title placeholder="Titre" value=<?php echo $article->getArticleTitle() ?>>
				<input type=text name=article_slug placeholder="Slug" value=<?php echo $article->getArticleSlug() ?>>
                <br><br>
                <input name="article_content" type="hidden" id="article_content"/>
                <div name="article_content" id="editor" style="width:44cm;height:15cm;background-color:white"><?php echo $article->getArticleContent() ?></div>
                <br><br>
                <input type=submit name=valider value=valider></td>
                <br><br>
                <a href="delete?id=<?php echo $_GET['id'] ?>">
		        <img src="/Medias/icon_delete.png" height="30" width="30"></a>

		</tr>
	</table>
	</form>
</div>

<script>
    var toolbarOptions = [ ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                            ['link', 'image'],
                            ['blockquote', 'code-block'],

                            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                            [{ 'direction': 'rtl' }],                         // text direction

                            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                            [{ 'font': [] }],
                            [{ 'align': [] }],

                            ['clean']  ];
    var options = {
                debug: 'info',
                placeholder: 'Entrez le contenu de l\'article',
                readOnly: false,
                theme: 'snow',
                modules: {
                    toolbar: toolbarOptions
                }
                };

 
    var container = document.getElementById('editor');
    var editor = new Quill(container, options);  

        function mysubmit() 
        {
            var html=document.getElementById('editor').children[0].innerHTML;
            document.getElementById('article_content').value=html;
        };
</script>