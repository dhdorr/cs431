<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!DOCTYPE html>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <style>
    .card-img-top {
      width: 100%;
      height: 40vh;
      object-fit: cover;
    }
  </style>
</head>

<body>

  <?php
  // create short variable names
  $pname = trim($_POST["pname"]);
  $date = trim($_POST["date"]);
  $location = trim($_POST["location"]);
  $photoer = trim($_POST["photoer"]);
  #Form handling & checks if image is ok to upload
  $dir = "uploads/";
  $file = $dir . basename($_FILES["uploadfile"]["name"]);
  echo $file;
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
  #check if file exists already
  if (file_exists($file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  #checks if the upload is ok
  if ($uploadOk == 0) {
    echo "File failed to upload";
  } else {
    if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $file)) {
      echo "Good.";
    } else {
      echo "Bad";
    }
  }
  #Photo class so each photo's info can be saved to an array
  class Photo
  {
    public $name;
    public $date;
    public $location;
    public $photographer;
    public $photo_file;

    function set_name($name)
    {
      $this->name = $name;
    }
    function get_name()
    {
      return $this->name;
    }
    function set_date($date)
    {
      $this->date = $date;
    }
    function get_date()
    {
      return $this->date;
    }
    function set_location($location)
    {
      $this->location = $location;
    }
    function get_location()
    {
      return $this->location;
    }
    function set_photographer($photographer)
    {
      $this->photographer = $photographer;
    }
    function get_photographer()
    {
      return $this->photographer;
    }
    function set_photo_file($photo_file)
    {
      $this->photo_file = $photo_file;
    }
    function get_photo_file()
    {
      return $this->photo_file;
    }
  }

  #write to text file
  if ($uploadOk == 1) {
    $my_file = 'uploads/pic_list.txt';
    $txt = basename($_FILES["uploadfile"]["name"]) . "\n" . $pname . "\n" . $date . "\n" . $location . "\n" . $photoer . "\n";
    file_put_contents($my_file, $txt, FILE_APPEND);
  }

  #Check the pic_list.txt for previous uploads and append them to array of Photos
  $pic_array = array();
  $read_file = fopen("uploads/pic_list.txt", "r") or die("Whoops!");
  while (!feof($read_file)) {
    $pic = new Photo();
    for ($x = 0; $x < 5; $x++) {
      if ($x == 0) {
        $pic->set_photo_file(fgets($read_file));
      }
      if ($x == 1) {
        $pic->set_name(fgets($read_file));
      }
      if ($x == 2) {
        $pic->set_date(fgets($read_file));
      }
      if ($x == 3) {
        $pic->set_location(fgets($read_file));
      }
      if ($x == 4) {
        $pic->set_photographer(fgets($read_file));
      }
    }
    if ($pic->get_photo_file() != null) {
      array_push($pic_array, $pic);
    }
  }
  fclose($read_file);
  // Comparator function used for comparator 
  function comparator($object1, $object2)
  {
    return $object1->get_name() > $object2->get_name();
  }
  // Sorting the class objects according select comparator
  usort($pic_array, 'comparator');
  ?>

  <br><br>

  <div class="container">
    <div class="row">
      <div class="col">
        <h1>View All Photos</h1>
      </div>
    </div>

    <br>

    <div class="row justify-content-start">
      <div class="col-auto">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Sort By:</label>
          </div>

          <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Name
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#" id=sortname>Name</a>
              <a class="dropdown-item" href="#" id=sorttime>Time </a>
              <a class="dropdown-item" href="#" id=sortphotoer> Photographer</a>
              <a class="dropdown-item" href="#" id=sortlocation>Location</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-5">
      </div>
      <div class="col-4">
        <a href="index.html" class="btn btn-primary btn-md active" role="button" aria-pressed="true">Upload Photo</a>
      </div>
    </div>


    <br>
    <div class="card-deck">
      <?php foreach ($pic_array as $pic_array) : ?>

        <div class="col-4">
          <div class="card">
            <img class="card-img-top" src=<?php echo $pic_array->get_photo_file(); ?> alt="card image cap">
            <div class="card-body">
              <h5 class="card-title"><?php echo $pic_array->get_name(); ?></h5>
              <p class="card-text"><?php echo $pic_array->get_date(); ?><br><?php echo $pic_array->get_location(); ?><br><?php echo $pic_array->get_photographer(); ?></p>
            </div>
          </div>
        </div>

        <br>
      <?php endforeach; ?>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>

</html>