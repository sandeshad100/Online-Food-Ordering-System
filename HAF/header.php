
<header>
        <h1 class="logo" onclick="goToHome();">NamasteFood</h1>
        
        <nav>
            <ul class="nav_links">
                <li><a href="clienthome.php">Home</a></li>
                <!-- <li><a href="#"></a></li> -->
                <li><a href="about.php">About Us</a></li>
                <li><a href="#">Contact</a></li>

            </ul>
        </nav>
        <div class="navRight">
            <a class="cart" href="Cart.php?n=1"><button> <i class="fa-solid fa-cart-shopping"></i>Cart</button></a>
            <a class="trackOrder_btn" href="orderTrack.php"><button>Track Order</button></a>
            <a class="login" href="login.php?u=0"><button>LogOut</button></a>
            <!-- <a class="signUp" href="register.php"><button>Register</button></a> -->
            <small><p><?php echo $_SESSION['user_email']; ?></p></small>
        </div>
        
    </header>
    <script>
        function goToHome(){
            window.location.replace("./clienthome.php");
        }
    </script>