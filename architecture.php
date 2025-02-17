<?php
require_once "hfm/header.php";
require_once "hfm/manu.php";
?>
<section class="site-section py-sm">
    <div class="container" style="padding-top: 16%">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-md navbar-light" style="background-color: #FBE7BD;">
                    <div class="container">
                        <div class="collapse navbar-collapse" id="navbarMenu">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="interior.php"><b>|Interior|</b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="architecture.php"><b>|Architecture|</b></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="installation.php"><b>|Installation Art|</b></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

<section class="site-section py-sm">
    <div class="container" style="padding-top: 4%">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row blog-entries">
            <div class="col-md-12 col-lg-12 main-content">
                <div class="row">
                    <?php
                    $conn = new mysqli('localhost', 'root', '', 'intdesign');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT filepath, description FROM images2";
                    $result = $conn->query($sql);
                    if ($result === false) {
                        die("Error executing the query: " . mysqli_error($conn));
                    }

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $image_path = $row["filepath"];
                            $description = $row["description"];
                            ?>
                            <div class="col-md-4">
                                <a href="#" class="blog-entry element-animate" data-toggle="modal" data-target="#imageModal" data-image="<?php echo $image_path; ?>" data-description="<?php echo $description; ?>">
                                    <img src="<?php echo $image_path; ?>" alt="Image placeholder" height="300px" width="400px">
                                </a>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No images found.";
                    }
                    $conn->close(); 
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Image" class="img-fluid mb-3">
                <p id="modalDescription"></p>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $('#imageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var imageSrc = button.data('image');
        var description = button.data('description');
        var modal = $(this);
        modal.find('#modalImage').attr('src', imageSrc);
        modal.find('#modalDescription').text(description);
    });
</script>

<?php
require_once "hfm/footer.php";
?>

<a href="bot.php" class="chatbox-icon" title="Chat with us">
  <img src="images/chat.png" alt="Chat Icon" style="width: 50px; height: 50px;">
</a>

<style>
.chatbox-icon {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 1000;
}

.chatbox-icon img {
  width: 50px;
  height: 50px;
}
</style>
