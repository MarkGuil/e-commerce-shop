<div class="row2 position-relative">
    <div class="position-absolute top-50 start-0 translate-middle-y z-3 mt-4 ms-1">
        <button class=" btn btn-info rounded-circle px-1 py-0" id="slideLeft">
            <i class='bx bx-chevron-left pt-1'></i>
        </button>
    </div>
    <div style="text-align:left;">
        <span class="category text-secondary-emphasis" style="font-weight: 600; letter-spacing: 1.5px">Category</span>
        <br>
        <div class="overflow-x-hidden d-flex position-relative mx-2" id="category_container" style="padding: 0 2px; transition: all .1s cubic-bezier(.4,0,.6,1);">

            <?php
                if ($result = mysqli_query($link, $sqlCat)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {

                        echo "
                            <div class=''>
                            <div class='px-2 py-1 card d-flex flex-column text-center h-100 rounded-0' style='width:120px;' onMouseOver='this.style.borderColor=`#1b9397`' onMouseOut='this.style.borderColor=`rgba(0,0,0,.17)`'>
                                <a href='category.php?id=" . $row['category_id'] . "' class='stretched-link'></a>
                                <img src ='images/" . $row['picture'] . "' style = 'height: 70px; width:100%'>
                                <span class=' mt-2'><small class='m-0'>" . $row['category_name'] . "</small></span>
                            </div>
                            </div>";
                        }
                        mysqli_free_result($result);
                    } else {
                        echo "<p class='lead'><em>No records were found.</em></p>";
                    }
                } else {
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }
            ?>

        </div>
    </div>
    <div class="position-absolute top-50 end-0 translate-middle-y z-3 mt-4 me-1">
        <button class=" btn btn-info rounded-circle px-1 py-0" id="slideRight">
            <i class='bx bx-chevron-right pt-1'></i>
        </button>
    </div>
</div>

