<form action="php/savecategory.php" method="post" enctype="multipart/form-data">
    <center>
        <h4><i class="icon-plus-sign icon-large"></i> Add Category</h4>
    </center>
    <hr>
    <div id="ac">
        <span>Category Name : </span><input type="text" style="width:230px; height:30px;" name="code" Required><br>
        <span>Picture : </span><input type="file" name="picture" id="picture" style="margin-top:1%;" required><br><br>
        <hr>
        <div style="text-align:center">
            <button class="btn btn-success btn-block btn-large" style="width:267px;" name="save">Save</button>
        </div>
    </div>
</form>