<!-- header section starts  -->

<header class="header">

   <nav class="navbar nav-1">
      <section class="flex">
         <a href="home.php" class="logo"><i class="fas fa-house"></i>REAL ESTATE</a>
       
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               <li class="nav-item">
               <a class="nav-link me-2" href="home.php">Home</a>
               </li>
               <li class="nav-item">
               <a class="nav-link me-2" href="services.php">Our Services</a>
               </li>
               <li class="nav-item">
               <a class="nav-link me-2" href="contact.php">Contact us</a>
               </li>
               <li class="nav-item">
               <a class="nav-link me-2" href="contact.php#faq">FAQs</a>
               </li>
               <li class="nav-item">
               <a class="nav-link" href="about.php">About</a>
               </li> 
            </div>   
             
      </section>
   </nav>

   <nav class="navbar nav-2">
      <section class="flex">
         <div id="menu-btn" class="fas fa-bars"></div>

         <div class="menu">
            <ul>
               <li><a href="dashboard.php">Dashboard</a>  </li>
               <li><a href="search.php">Search</a>  </li>
               <li><a href="listings.php">Listings</a>  </li>
               <li><a href="contact.php">help</a>  </li>   
            </ul>
         </div>

         <ul>
            <li><a href="saved.php">saved <i class="far fa-heart"></i></a></li>
            <li><a href="#">account <i class="fas fa-angle-down"></i></a>
               <ul>
                  <li><a href="login.php">login now</a></li>
                  <li><a href="register.php">register new</a></li>
                  <?php if($user_id != ''){ ?>
                  <li><a href="update.php">update profile</a></li>
                  <li><a href="components/user_logout.php" onclick="return confirm('logout from this website?');">logout</a>
                  <?php } ?></li>
               </ul>
            </li>
         </ul>
      </section>
   </nav>

</header>

<!-- header section ends -->