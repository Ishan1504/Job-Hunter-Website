<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 

    if(isset($_GET['id'])) {


        $id = $_GET['id'];

        $select = $conn->query("SELECT * FROM users WHERE id = '$id'");
        $select->execute();
        $profile = $select->fetch(PDO::FETCH_OBJ);


        //jobs created by this company 

        $jobs = $conn->query("SELECT * FROM jobs WHERE company_id = '$id' AND status = 0 LIMIT 5");
        $jobs->execute();
        $moreJobs = $jobs->fetchAll(PDO::FETCH_OBJ);
        $jobs1 = $conn->query("SELECT jobs.* FROM jobs JOIN saved_jobs ON jobs.id = saved_jobs.job_id WHERE saved_jobs.worker_id ='$id'");
        $jobs1->execute();
        $moreJobs1 = $jobs1->fetchAll(PDO::FETCH_OBJ);
        $jobs2 = $conn->query("SELECT * FROM job_applications WHERE company_id = '$id'");
        $jobs2->execute();
        $moreJobs2 = $jobs2->fetchAll(PDO::FETCH_OBJ);

    } else {
        echo "404";
    }

?>

   <!-- HOME -->
<section class="section-hero overlay inner-page bg-image" style="background-image: url('<?php echo APPURL; ?>/images/hero_1.jpg');" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="text-white font-weight-bold"><?php echo $profile->username; ?></h1>
            <div class="custom-breadcrumbs">
              <a href="#">Home</a> <span class="mx-2 slash">/</span>
              <span class="text-white"><strong><?php echo $profile->username; ?></strong></span>
            </div>
          </div>
        </div>
      </div>
</section>

<section class="site-section" style="" id="home-section">
      <div class="container">
        <div class="row d-flex justify-content-center">
          <div class="col-md-7">
            <div class="card p-3 py-4">

                    <div class="text-center mt-3">
                        <h5 class="mt-2 mb-0"><?php echo $profile->username; ?></h5>
                        <div class="px-4 mt-1">
                            <p class="fonts"><?php echo $profile->title; ?></p>
                        </div>
                        <div class="px-4 mt-1">
                            <p class="fonts"><?php echo $profile->bio; ?></p>
                        </div>
                        
                        <div class="px-3">
                            <a href="<?php echo $profile->facebook; ?>" class="pt-3 pb-3 pr-3 pl-0 underline-none"><span class="icon-facebook"></span></a>
                            <a href="<?php echo $profile->twitter; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                            <a href="<?php echo $profile->linkedin; ?>" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                        </div>
   
                    </div>

                </div>

            </div>

        </div>

      </div>
</section>

<section class="site-section">
      <div class="container">
        <!--  AND $_SESSION['id'] == $id -->
        <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Worker" AND $_SESSION['id'] == $id) : ?>
          <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
              <h2 class="section-title mb-2">Jobs Saved by you</h2>
            </div>
          </div>
        <?php endif; ?>
        
        <ul class="job-listings mb-5">
          <?php foreach($moreJobs1 as $oneJob1) : ?>
            <br>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="<?php echo APPURL; ?>/jobs/job-single.php?id=<?php echo $oneJob1->id; ?>"></a>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?php echo $oneJob1->job_title; ?></h2>
                <strong><?php echo $oneJob1->company_name; ?></strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> <?php echo $oneJob1->job_region; ?>
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-<?php if($oneJob1->job_type == 'Part Time') { echo 'danger'; } else { echo 'success'; } ?>"><?php echo $oneJob1->job_type; ?></span>
              </div>
            </div>
            
          </li>
          
        <?php endforeach; ?>
      </ul>
   <div>
</section>

<section class="site-section">
      <div class="container">
        <!--  AND $_SESSION['id'] == $id -->
        <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Company" AND $_SESSION['id'] == $id) : ?>
          <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
              <h2 class="section-title mb-2">Jobs Posted by you</h2>
            </div>
          </div>
        <?php endif; ?>
        
        <ul class="job-listings mb-5">
          <?php foreach($moreJobs as $oneJob) : ?>
            <br>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="<?php echo APPURL; ?>/jobs/job-single.php?id=<?php echo $oneJob->id; ?>"></a>

            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?php echo $oneJob->job_title; ?></h2>
                <strong><?php echo $oneJob->company_name; ?></strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> <?php echo $oneJob->job_region; ?>
              </div>
              <div class="job-listing-meta">
                <span class="badge badge-<?php if($oneJob->job_type == 'Part Time') { echo 'danger'; } else { echo 'success'; } ?>"><?php echo $oneJob->job_type; ?></span>
              </div>
            </div>            
          </li>
        <?php endforeach; ?>
      </ul>
   <div>
</section>

<section class="site-section">
      <div class="container">
        <!--  AND $_SESSION['id'] == $id -->
        <?php if(isset($_SESSION['type']) AND $_SESSION['type'] == "Company" AND $_SESSION['id'] == $id) : ?>
          <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
              <h2 class="section-title mb-2">Applications received by you</h2>
            </div>
          </div>
        <?php endif; ?>
        
        <ul class="job-listings mb-5">
          <?php foreach($moreJobs2 as $oneJob2) : ?>
          <br>
          <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
            <a href="<?php echo APPURL; ?>/gerneral/workers.php"></a>
            <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
              <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                <h2><?php echo $oneJob2->job_title; ?></h2>
                <strong><?php echo $oneJob2->username; ?></strong>
              </div>
              <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                <span class="icon-room"></span> <?php echo $oneJob2->email; ?>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
   <div>
</section>

<?php require "../includes/footer.php"; ?>
