<?php
include("db.php");
include("top.php");


?>




<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Text Editors</h1>
                </div>

            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            Game Rule
                        </h3>
                    </div>
                    <div class="card-body">
                        <textarea id="summernote">
                          Write <em>Game</em> <u>Rule</u> <strong>here</strong>
                          </textarea>
                    </div>

                </div>
            </div>
        </div>
    </section>
       
</div>





<?php
include("footer.php");
?>