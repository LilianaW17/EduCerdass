<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCerdas</title>
    <style>
    .hidden {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .show {
        opacity: 1;
        transform: translateY(0);
    }
        * {
            text-combine-upright: none;
            margin: 0;
            padding: 0;
        }

        body {
            margin: auto;
            padding: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            background-color: white;
        }

        .wrapper {
            width: 1100px;
            margin: auto;
            position: relative;
        }

        img {
            max-width: 600px;
            border-radius: 10%;
        }

        .logo a {
            font-size: 50px;
            font-weight: 900;
            float: left;
            font-family: 'Comic Sans', Comic, monospace;
            color: #364f6b;
            text-decoration: none;
        }

        .menu {
            float: right;
        }

        nav {
            width: 100%;
            margin: auto;
            display: flex;
            line-height: 80px;
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
            border-bottom: 1px solid #364f6b;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        nav ul li {
            float: left;
        }

        nav ul li a {
            color: black;
            font-weight: bold;
            text-align: center;
            padding: 0px 16px 0px 16px;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        section {
            margin: auto;
            display: flex;
            margin-bottom: 50px;
        }

        .kolom {
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .kolom .deskripsi {
            font-size: 20px;
            font-weight: bold;
            font-family: 'comic sans ms';
            color: #364f6b;
        }

        h2 {
            font-family: 'comic sans ms';
            font-weight: 800;
            font-size: 45px;
            margin-bottom: 20px;
            color: #364f6b;
            width: 100%;
            line-height: 50px;
        }

        a.tbl-biru {
            background: #3f72af;
            border-radius: 20px;
            margin-top: 20px;
            padding: 15px 20px 15px 20px;
            color: #FFFFFF;
            cursor: pointer;
            font-weight: bold;
        }

        a.tbl-biru:hover {
            background: #fc5185;
            text-decoration: none;
        }

        a.tbl-pink {
            background: #fc5185;
            border-radius: 20px;
            margin-top: 20px;
            padding: 15px 20px 15px 20px;
            color: #FFFFFF;
            cursor: pointer;
            font-weight: bold;
        }

        a.tbl-pink:hover {
            background: #3f72af;
            text-decoration: none;
        }

        p {
            margin: 10px 0px 10px 0px;
            padding: 10px 0px 10px 0px;
        }

        .tengah {
            text-align: center;
            width: 100%;
        }

        .Tutors-list {
            width: 100%;
            position: relative;
            display: flex;
            flex-wrap: wrap;
        }

        .kartu-tutor {
            width: 20%;
            margin: 0 auto;
        }

        .kartu-tutor img {
            width: 80%;
            border-radius: 50%;
        }

        .kartu-tutor p {
            font-family: 'comic sans ms';
            font-weight: 800;
            font-size: 25px;
            text-align: center;
            color: #364f6b;
        }

        #about {
            background: #dedede;
            padding: 50px 0px 50px 0px;
        }

        .footer {
            width: 100%;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            margin: auto;
        }

        .footer-section {
            width: 20%;
            margin: 0 auto;
        }

        h3 {
            font-family: 'comic sans ms';
            font-weight: 800;
            font-size: 20px;
            margin-bottom: 20px;
            color: #364f6b;
            width: 100%;
            line-height: 50px;
        }

        #copyright {
            text-align: center;
            width: 100%;
            padding: 50px 0px 50px 0px;
            margin-top: 50px;
        }

        @media screen and (max-width: 991.98px) {
            .wrapper {
                width: 90%;
            }

            .logo a {
                display: block;
                width: 100%;
                text-align: center;
            }

            nav .menu {
                width: 100%;
                margin: 0;
            }

            nav .menu ul {
                text-align: center;
                margin: auto;
                line-height: 60px;
            }

            nav .menu ul li {
                display: inline-block;
                float: none;
            }

            section {
                display: block;
            }

            section img {
                display: block;
                width: 100%;
                height: auto;
            }

            .kartu-tutor {
                width: 50%;
            }

            .kartu-partner {
                width: 50%;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo">
                <a href="">EduCerdas</a>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#courses">Courses</a></li>
                    <li><a href="#tutors">Tutors</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="login.php" class="tbl-biru">Log In</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
    <section id="home" class="hidden">
    <img src="aset/Learn How to Code_ A Beginners Guide.jpeg" />
    <div class="kolom">
        <p class="deskripsi">Belajar Programming Bersama EduCerdas</p>
        <h2>Ayo bangun website mu sendiri</h2>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem earum exercitationem aut distinctio sed obcaecati corporis quibusdam? Impedit dolorem eius nihil cupiditate. Quo, repudiandae facere aliquid quisquam cumque doloremque incidunt!</p>
        <p><a href="daftar.php" class="tbl-pink">Pelajari Lebih Lanjut</a></p>
    </div>
</section>

<section id="courses" class="hidden">
    <div class="kolom">
        <p class="deskripsi">You will need this</p>
        <h2>Online Courses</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, repudiandae dolorem soluta voluptate consequatur culpa amet id ipsa cum eum officia repellat, quaerat libero et odio illo quasi impedit ipsum.</p>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum eaque vero dignissimos, mollitia vel ut corrupti veniam voluptatem voluptates consequatur nulla? Et itaque voluptatem enim, qui eaque quo tenetur laborum!</p>
        <p><a href="daftar.php" class="tbl-biru">Daftar Sekarang</a></p>
    </div>
    <img src="aset/code.jpg" alt="deskripsi gambar" class="styleimage">
</section>

<section id="tutors" class="hidden">
    <div class="tengah">
        <div class="kolom">
            <p class="deskripsi">Our Top Tutors</p>
            <h2>Tutors</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit tempore, atque pariatur accusantium dicta, nihil ullam repellat quaerat voluptatibus, iure similique! Odio velit rem reiciendis illo aliquam minima voluptatem eos?</p>
        </div>
        <div class="Tutors-list">
            <div class="kartu-tutor">
                <img src="aset/jiro.jpeg" />
                <p>Adietya Eka Firmansyah</p>
            </div>
            <div class="kartu-tutor">
                <img src="aset/ajeng.jpeg" />
                <p>Ajeng Sakinah Wulandari</p>
            </div>
            <div class="kartu-tutor">
                <img src="aset/wina.jpeg" />
                <p>Winarti Solehani</p>
            </div>
        </div>
        <div class="tengah">
            <p><a href="login.php" class="tbl-pink">Login sebagai Tutor</a></p>
        </div>
    </div>
</section>

        <div id="about">
            <div class="wrapper">
                <div class="footer">
                    <div class="footer-section">
                        <h3>EduCerdas</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint, culpa!</p>
                    </div>
                    <div class="footer-section">
                        <h3>About</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint, culpa!</p>
                    </div>
                    <div class="footer-section">
                        <h3>Contact</h3>
                        <p>Jl. Majapahit No.62, Gomong, Kec. Selaparang, Kota Mataram, Nusa Tenggara Bar.</p>
                        <p>Kode Pos: 83155</p>
                    </div>
                    <div class="footer-section">
                        <h3>Social</h3>
                        <p><b>instagram: </b>EduCerdas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var elements = document.querySelectorAll('.hidden');

        function checkVisibility() {
            elements.forEach(function (element) {
                var rect = element.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    element.classList.add('show');
                } else {
                    element.classList.remove('show');
                }
            });
        }

        window.addEventListener('scroll', checkVisibility);
        checkVisibility();
    });
</script>
</body>
</html>