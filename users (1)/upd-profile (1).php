<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>

<?php 


    if(isset($_GET['id'])) {

        $id = $_GET['id'];
        $select = $conn->query("SELECT * FROM users WHERE id = '$id'");
        $select->execute();
        $singleJob = $select->fetch(PDO::FETCH_OBJ);

    } else {
      header("location: ".APPURL."/404.php");
    }

    if(isset($_POST['submit'])) {

        if(empty($_POST['username']) OR empty($_POST['email']) OR empty($_POST['password']) OR empty($_POST['re-password'])) {
            echo "<script>alert('some inputs are empty')</script>";
          } else {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repassword = $_POST['re-password'];
            $title= $_POST['title'];
            $bio= $_POST['bio'];
            $facebook= $_POST['facebook'];
            $twitter= $_POST['twitter'];
            $linkedin= $_POST['linkedin'];
            //checking for password match
            if($password == $repassword) {
                
              //checking for username 
              if(strlen($email) > 50 OR strlen($username) > 30 ) {
                echo "<script>alert('email or username is too big')</script>";
      
              } else {
                $update = $conn->prepare("UPDATE users SET username = :username, email = :email,mypassword= :mypassword, title = :title,
                bio = :bio, facebook = :facebook, twitter = :twitter, linkedin = :linkedin WHERE id='$id'");
                $update->execute([
                  ':username' =>  $username,
                  ':email' =>  $email,
                  ':mypassword' =>  password_hash($password, PASSWORD_DEFAULT),
                  ':title' => $title,
                  ':bio' => $bio,
                  ':facebook' => $facebook,
                  ':twitter' => $twitter,
                  ':linkedin' => $linkedin
                ]);  
      
                header("location: ../auth/login.php");
                 
              }
            } else {
              echo "<script>alert('passwords are not matching')</script>";
      
            }
      
          }
    }

?>

<!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('../images/hero_1.jpg');" id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">Update Profile</h1>
                <div class="custom-breadcrumbs">
                    <a href="<?php echo APPURL; ?>">Home</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>Update Profile</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5">
                <form action="upd-profile.php?id=<?php echo $id; ?>" class="p-4 border rounded" method="POST">
                    <!-- Your form fields here -->
                    <!-- Example: -->
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="username">Username</label>
                            <input type="text" id="username" class="form-control" placeholder="Username" name="username" value="<?php echo $_SESSION['username']; ?>" readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-12 mb-3 mb-md-0">
                        <label class="text-black" for="fname">Email</label>
                        <input type="email" id="fname" class="form-control" placeholder="Email address" name="email" value="<?php echo $_SESSION['email']; ?>">
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-12 mb-3 mb-md-0">
                        <label class="text-black" for="fname">Title</label>
                        <input type="text" id="fname" class="form-control" placeholder="Title" name="title" value="<?php echo $singleJob->title; ?>">
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-12 mb-3 mb-md-0">
                        <label class="text-black" for="fname">Bio</label>
                        <input type="text" id="fname" class="form-control" placeholder="Bio" name="bio" value="<?php echo $singleJob->bio; ?>">
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-12 mb-3 mb-md-0">
                        <label class="text-black" for="fname">Facebook</label>
                        <input type="text" id="fname" class="form-control" placeholder="Facebook" name="facebook" value="<?php echo $singleJob->facebook; ?>">
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-12 mb-3 mb-md-0">
                        <label class="text-black" for="fname">Twitter</label>
                        <input type="text" id="fname" class="form-control" placeholder="Twitter" name="twitter" value="<?php echo $singleJob->twitter; ?>">
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col-md-12 mb-3 mb-md-0">
                        <label class="text-black" for="fname">Linkedin</label>
                        <input type="text" id="fname" class="form-control" placeholder="Linkedin" name="linkedin" value="<?php echo $singleJob->linkedin; ?>">
                      </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="fname">Password</label>
                            <input type="password" id="fname" class="form-control" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="row form-group mb-4">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="fname">Re-Type Password</label>
                            <input type="password" id="fname" class="form-control" placeholder="Re-type Password" name="re-password">
                        </div>
                    </div>
                    <!-- Other form fields... -->
                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" name="submit" value="Update Profile" class="btn px-4 btn-primary text-white">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>   
<?php require "../includes/footer.php"; ?>