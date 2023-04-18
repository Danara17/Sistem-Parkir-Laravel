<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage Go Parkir</title>
    <!--link css-->
    <link rel="stylesheet" href="{{asset('homepage/style.css')}}">
    <!--box icon-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <!--header-->
    <header>
        <a href="#" class="logo"><img src="{{asset('img/jeep.png')}}" alt=""></a>

        <div class="bx bx-menu" id="menu-icon"></div>

        <ul class="navbar">
            <li><a href="#home">Home</a></li>
            <li><a href="#location">Location</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#reviews">Reviews</a></li>
        </ul>
        <div class="header-btn">
            <a href="{{route('showlogin')}}" class="login">login</a>
        </div>

    </header>
    <!-- home -->
    <section class="home" id="home">
        <div class="text">
            <h1><span>Go</span> <br> Parkir</h1>
            <p>"Parkir Dulu Gak Sih"</p>
        </div>

        <div class="form-container">
            <form action="">
                <div class="input-box">
                    <span>Location</span>
                    <input type="search" name="" id="" placeholder="Search Places">
                </div>
                <div class="input-box">
                    <span>Masuk Parkir</span>
                    <input type="date" name="" id="">
                </div>
                <div class="input-box">
                    <span>Keluar Parkir</span>
                    <input type="date" name="" id="">
                </div>
                <input type="submit" name="" id="" class="btn">
            </form>
        </div>
    </section>
    <!--ride-->
<section class="ride" id="location">
    <div class="heading">
        <span>Tempat Parkir</span>
        <h1> Terdapat Di 3 Mall</h1>
    </div>
    <div class="ride-container">
        <div class="center">
        <div class="box">
            <i class='bx bxs-map'></i>
            <div class="about-img">
                <img style="height: auto; width: 550px;" src="{{asset('img/pakuwon mall.jpg')}}" alt="">
            </div>
            <h2>PAKUWON MALL</h2>
            <p> Pakuwon Mall adalah pusat perbelanjaan terluas di Indonesia menurut Asosiasi Pengelola Pusat Belanja Indonesia. Berdiri
            tahun 2003 dan dikenal sebagai supermall Pakuwon yang dikembangkan oleh PT Pakuwon Jati Tbk. Mall ini didirikan di atas
            tanah seluas 30 hektar dirancang oleh konsultan arsitektur kelas dunia, yaitu DP Architect Singapore. Dilengkapi dengan
            Convention Center, Ballroom, dan Atrium multifungsi. Biasanya digunakan untuk berbagai acara seperti konser, promosi,
            pertunjukan langsung, dan acara meeting perusahaan. Resmi dibuka sebagai pusat perbelanjaan kelas dunia pada tahun 2017.
            Berbagai tenant tidak hanya dari kalangan Indonesia saja.</p>
        </div>
    </div>
    <div class="center">
    <div class="box">
    <i class='bx bxs-map'></i>
    <div class="about-img">
        <img style="height: auto; width: 550px;" src="{{asset('img/galaxy mall.jpg')}}" alt="">
    </div>
        <h2>GALAXY MALL 3</h2>
        <p> Dikembangkan oleh PT Sinar Galaxy, Galaxy Mall Surabaya didirikan tahun 1996 dan berlokasi di Jl. Dharmahusada Indah
        Timur, Mulyorejo, Surabaya. Sekitar satu dekade kemudian, mal yang sangat populer di kota terbesar kedua di Indonesia
        ini melakukan pengembangan dengan membuat Galaxy Mall Extension. Berkonsep family mall, di sini banyak sekali pilihan
        tenant yang menjual berbagai kebutuhan dapur, pakaian, kecantikan, makanan, dan hiburan. Tak hanya brand lokal, banyak
        sekali brand internasional yang mengisi pusat perbelanjaan ini.</p>
    </div>
    </div>
    <div class="center">
    <div class="box">
            <i class='bx bxs-map'></i>
        <div class="about-img">
            <img style="height: auto; width: 550px;" src="{{asset('img/ptc mall.jpg')}}" alt="">
        </div>
        <h2>PTC MALL</h2>
        <p> Pakuwon Trade Center atau PTC adalah pusat perbelanjaan modern yang terletak di kawasan Babatan, Surabaya. PTC
        terintegrasi dengan pusat perbelanjaan terbesar di Surabaya, yaitu Pakuwon Mall. Sudah familiar pula di tengah warga
        Surabaya bahwa PTC telah menjadi bagian dari mal seluas 180.000 meter persegi tersebut. Meski begitu, PTC masih diingat
        oleh warga sebagai salah satu pelopor lahirnya pusat perbelanjaan di kawasan Babatan. Dioperasikan tahun 2002, PTC
        selalu menjadi tujuan utama warga Surabaya, terutama Surabaya Barat, dalam mencari kebutuhan sehari-hari, selain
        memuaskan diri dengan hiburan dan kuliner yang tersedia di dalamnya.</p>
    </div>
    </div>
</section>
<!--About-->
<section class="about" id="about">
    <div class="heading">
        <span> About Us</span>
        <h1>Latar Belakang Website Ini Dibuat</h1>
    </div>
    <br 1>
    <div class="about-container">
        <div class="about-img">
            <img src="{{asset('img/about.png')}}" alt="">
        </div>
        <div class="about-text"> 
        <p>     Website ini dibuat dengan tujuan untuk memenuhi tugas project ETS mata kuliah Pengembangan Aplikasi Web (B).</p>
        <p> Semoga nantinya website ini bisa berkembang bagi masyrakat dan kami nantinya akan terus mengembangkan fitur yang ada di
        website kami supaya bisa lebih optimal dari sebelumnya.</p>
        <a href="#" class="btn">Learn More</a>
        </div>
    </div>
</section>
<!--Reviews-->
<section class="reviews" id="reviews">
    <div class="heading">
        <span >Reviews</span>
        <h1>Apa Yang Users Kami Katakan</h1>
        <p>Dengan adanya survei ini harapannya kami bisa membenahi kekurangan di website kam</p>
    </div>
    <div class="reviews-container">
        <div class="box">
            <div class="rev-img">
            <img src="{{asset('img/danara.jpg')}}" alt="">
        </div>
        <h2>1462100146_Danara Dhana Caesa</h2>
        <div class="stars">
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
        </div>
        <p> AKU BELUM GLORY PAK</p>
    </div>
</div>

<div class="reviews-container" id="about">
    <div class="box">
        <div class="rev-img">
            <img src="{{asset('img/dhika.png')}}" alt="">
        </div>
        <h2>1462100152_Dhika Bayu Pratama</h2>
        <div class="stars">
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
        </div>
        <p> PAK UDAH PAK</p>
    </div>
</div>

<div class="reviews-container">
    <div class="box">
        <div class="rev-img">
            <img src="{{asset('img/orang.png')}}" alt="">
        </div>
        <h2>Anonimus</h2>
        <div class="stars">
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
            <i class='bx bxs-star'></i>
        </div>
        <p> OVERAL BAGUS TINGKATIN LAGI YA</p>
    </div>
</div>
</section>
<!--Subrek-->
<section class="newslatter">
    <h2> Subcribe To Newslatter</h2>
    <div class="box">
        <input type="text" placeholder="Enter Your email...">
        <a href="#" class="btn">Subcribe</a>
    </div>
</section>
<div class="copyright">
    <p>#Web Parkir 2K23</p>
    <div class="social">
        <a href="#"><i class='bx bxl-facebook'></i></a>
        <a href="#"><i class='bx bxl-instagram'></i></a>
    </div>
</div>

<!--Scroller-->
<script src="{{url('https://unpkg.com/scrollreveal')}}"></script>

<!--link to js-->
    <script src="{{asset('main.js')}}"></script>
</body>
</html>