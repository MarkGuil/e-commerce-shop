<style type="text/css">
    .search-box {
        position: relative;
        font-size: 14px;
    }

    .search-box input[type="text"] {
        padding: 6px 10px;
        border: 1px solid #CCCCCC;
        font-size: 16px;
    }

    .result {
        position: absolute;
        z-index: 999;
        top: 100%;
        left: 0;
        background: white;
    }

    .search-box input[type="text"],
    .result {
        width: 100%;
        box-sizing: border-box;
    }

    .result p {
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
    }

    .result p:hover {
        background: #f2f2f2;
    }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.search-box input[type="text"]').on("keyup input", function() {
            /* Get input value on change */
            var inputVal = $(this).val();
            var resultDropdown = $(this).siblings(".result");
            if (inputVal.length) {
                $.get("php/backend-search.php", {
                    term: inputVal
                }).done(function(data) {
                    // Display the returned data in browser
                    resultDropdown.html(data);
                });
            } else {
                resultDropdown.empty();
            }
        });

        // Set search input value on click of result item
        $(document).on("click", ".result p", function() {
            $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".result").empty();
        });
    });
</script>

<div class="search-box w-75">
    <input class="form-control" type="text" autocomplete="off" placeholder="Search..." name="reslt" />
    <div class="result"></div>
</div>
