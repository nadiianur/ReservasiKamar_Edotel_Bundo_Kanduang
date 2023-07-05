<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stayscape</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>

<body>
    <header>
        <nav class="top-navbar">
            <div class="container">
                <div class="top-navbar-content">
                    <div class="buttons">
                        <a href="/signIn" class="btn">SignIn</a>
                        <a href="/signUp" class="btn">SignUp</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <nav class="middle-navbar">
            <div class="container">
                <div class="middle-navbar-content">
                    <br><br><br>
                    <h1 class="logo">Stayscape</h1>
                    <p class="text">Tired of the mundane? Itching for an unforgettable retreat? Search no further!</p>
                    <p class="text">Dive into our wonderful world of unique lodging options that’ll take your vacation
                        to the next level.</p>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="middle-navbar-content">
                <hr><br><br><br>
                <h1 id="our-services" style="color: #13315C;font-weight:700; text-align:center">Our Services
                </h1><br><br><br>
                <table>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <img src="{{ asset('5.png') }}" class="card-img-top" alt="Room Image"
                                style="border-radius: 25px; width:400px">
                        </td>
                        <td>
                            <p style="margin-right: 100px"></p>
                        </td>
                        <td>
                            <img src="{{ asset('1.png') }}" class="card-img-top" alt="Room Image"
                                style="border-radius: 25px; width:400px">
                        </td>
                        <td>
                            <p style="margin-right: 100px"></p>
                        </td>
                        <td>
                            <img src="{{ asset('4.png') }}" class="card-img-top" alt="Room Image"
                                style="border-radius: 25px; width:400px">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <h4 class="furnitures_text">Gym</h4>
                        </td>
                        <td>
                            <p style="margin-right: 100px"></p>
                        </td>
                        <td>
                            <h4 class="furnitures_text">Swimming Pool</h4>
                        </td>
                        <td>
                            <p style="margin-right: 100px"></p>
                        </td>
                        <td>
                            <h4 class="furnitures_text">Restaurant</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p style="margin-right: 10px"></p>
                        </td>
                        <td>
                            <p class="dummy_text">StayScape provides a fully equipped gym facility with modern
                                equipment. Enjoy
                                a wide
                                range of comprehensive fitness equipment for cardio, strength training,
                                and agility exercises.</p>
                        </td>
                        <td>
                            <p style="margin-right: 100px"></p>
                        </td>
                        <td>
                            <p class="dummy_text">StayScape features a beautiful and refreshing swimming pool. Our
                                swimming pool
                                is
                                designed to provide a comfortable and enjoyable swimming
                                experience for guests.</p>
                        </td>
                        <td>
                            <p style="margin-right: 100px"></p>
                        </td>
                        <td>
                            <p class="dummy_text">StayScape offers a delightful dining experience at our restaurant.
                                Enjoy a
                                wide
                                selection of delicious dishes made from fresh, locally sourced
                                ingredients.</p>
                        </td>
                    </tr>
                </table>
                <br><br><br><br><br><br>
            </div>
        </div>
</body>
</main>

<footer>
    <nav class="bottom-navbar">
        <div class="container">
            <p class="footer-text">© 2023 Stayscape Inc. All rights reserved.</p>
            <p class="footer-text"> Magang - LEA</p>
        </div>
    </nav>
</footer>
</body>

</html>
