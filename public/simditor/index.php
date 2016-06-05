<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>HTML5的标题</title>
    <link rel="stylesheet" type="text/css" href="styles/simditor.css" />
    <script type="text/javascript" src="scripts/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/module.js"></script>
    <script type="text/javascript" src="scripts/hotkeys.js"></script>
    <script type="text/javascript" src="scripts/uploader.js"></script>
    <script type="text/javascript" src="scripts/simditor.js"></script>
    <script>

        $(function(){
            var editor = new Simditor({
                textarea: $('#editor'),
                //optional options
                toolbar:[
                    'title',
                    'bold',
                    'italic',
                    'underline',
                    'strikethrough',
                    'color',
                    'ol',
                    'ul',
                    'blockquote',
                    'code',
                    'table',
                    'link',
                    'image',
                    'hr',
                    'indent',
                    'outdent',
                    'alignment',
                ],
            });
        })

    </script>
</head>
<body>
<textarea id="editor" placeholder="Balabala" autofocus></textarea>
</body>
</html>