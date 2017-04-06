<html>
    <head>
        <title></title>
    </head>
    <body>
        <form action="<?php echo base_url('image/postData'); ?>" name="frmImage" id="frmImage" enctype="multipart/form-data" method="post">
            Upload Image:
            <input type="file" name="uploadfile[]" multiple=""></br>
            <input type="submit" value="Submit" name="imgSubmit" id="imgSubmit">
        </form>
    </body>
</html>