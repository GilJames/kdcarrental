@extends('layouts.rentcar')
@section('title', 'Home')
@section('content')
    <div class="slider">
        <div id="slide">
            <div class="item" style="background-image: url(1.jpg);">
                <div class="content">
                    <div class="name">K & D</div>
                    <div class="des">
                        Explore your perfect ride with K & D Car Rental Services – designed just for you. Whether you like
                        sophistication or
                        power, our team ensures a personalized driving experience. Your dream car is waiting for you with K
                        & D.
                        Start exploring now and find your perfect match. Embark on a unique journey with K & D Car Rental
                        Services.</div>
                    <button style="color:red;">See more</button>
                </div>
            </div>
            <div class="item" style="background-image: url(4.jpg);">
                <div class="content">
                    <div class="name">K & D</div>
                    <div class="des">Explore your perfect ride with K & D Car Rental Services – designed just for you.
                        Whether you like sophistication or
                        power, our team ensures a personalized driving experience. Your dream car is waiting for you with K
                        & D.
                        Start exploring now and find your perfect match. Embark on a unique journey with K & D Car Rental
                        Services.</div>
                    <button style="color:red;">See more</button>
                </div>
            </div>
            <div class="item" style="background-image: url(3.jpg);">
                <div class="content">
                    <div class="name">K & D</div>
                    <div class="des">Explore your perfect ride with K & D Car Rental Services – designed just for you.
                        Whether you like sophistication or
                        power, our team ensures a personalized driving experience. Your dream car is waiting for you with K
                        & D.
                        Start exploring now and find your perfect match. Embark on a unique journey with K & D Car Rental
                        Services.</div>
                    <button style="color:red;">See more</button>
                </div>
            </div>
            <div class="item" style="background-image: url(4.jpg);">
                <div class="content">
                    <div class="name">K & D</div>
                    <div class="des">Explore your perfect ride with K & D Car Rental Services – designed just for you.
                        Whether you like sophistication or
                        power, our team ensures a personalized driving experience. Your dream car is waiting for you with K
                        & D.
                        Start exploring now and find your perfect match. Embark on a unique journey with K & D Car Rental
                        Services.</div>
                    <button style="color:red;">See more</button>
                </div>
            </div>
            <div class="item" style="background-image: url(5.jpg);">
                <div class="content">
                    <div class="name">K & D</div>
                    <div class="des">Explore your perfect ride with K & D Car Rental Services – designed just for you.
                        Whether you like sophistication or
                        power, our team ensures a personalized driving experience. Your dream car is waiting for you with K
                        & D.
                        Start exploring now and find your perfect match. Embark on a unique journey with K & D Car Rental
                        Services.</div>
                    <button style="color:red;">See more</button>
                </div>
            </div>
            <div class="item" style="background-image: url(6.jpg);">
                <div class="content">
                    <div class="name">K & D</div>
                    <div class="des">Explore your perfect ride with K & D Car Rental Services – designed just for you.
                        Whether you like sophistication or
                        power, our team ensures a personalized driving experience. Your dream car is waiting for you with K
                        & D.
                        Start exploring now and find your perfect match. Embark on a unique journey with K & D Car Rental
                        Services.</div>
                    <button style="color:red;">See more</button>
                </div>
            </div>
            <div class="buttons">
                <button id="prev"><i class="fa-solid fa-angle-left"></i></button>
                <button id="next"><i class="fa-solid fa-angle-right"></i></button>
            </div>
        </div>
    </div>
    <script>
        let currentIndex = 0;
        const intervalTime = 4000; // Change this value to set the interval time in milliseconds

        function slideNext() {
            let lists = document.querySelectorAll('.item');
            document.getElementById('slide').appendChild(lists[0]);
        }

        function slidePrev() {
            let lists = document.querySelectorAll('.item');
            document.getElementById('slide').prepend(lists[lists.length - 1]);
        }

        function autoSlide() {
            slideNext(); // You can change this to slidePrev() if you want to start in the opposite direction
            currentIndex++;
            if (currentIndex === document.querySelectorAll('.item').length) {
                currentIndex = 0;
            }
        }

        document.getElementById('next').onclick = function() {
            slideNext();
        };

        document.getElementById('prev').onclick = function() {
            slidePrev();
        };

        setInterval(autoSlide, intervalTime);
    </script>




@endsection
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;

    }

    #slide {}

    .item {
        width: 200px;
        height: 300px;
        background-position: 50% 50%;
        display: inline-block;
        transition: 0.5s;
        background-size: cover;
        position: absolute;
        z-index: -1;
        top: 50%;
        transform: translate(0, -50%);
        border-radius: 20px;
        box-shadow: 0 30px 50px #505050;
    }

    .item:nth-child(1),
    .item:nth-child(2) {
        left: 0;
        top: 0;
        transform: translate(0, 0);
        border-radius: 0;
        width: 100%;
        height: 100%;
        box-shadow: none;
    }

    .item:nth-child(3) {
        left: 50%;
    }

    .item:nth-child(4) {
        left: calc(50% + 220px);
    }

    .item:nth-child(5) {
        left: calc(50% + 440px);
    }

    .item:nth-child(n+6) {
        left: calc(50% + 660px);
        opacity: 0;
    }

    .item .content {
        position: absolute;
        top: 50%;
        left: 100px;
        width: 300px;
        text-align: left;
        padding: 0;
        color: #eee;
        transform: translate(0, -50%);
        display: none;
        font-family: system-ui;
    }

    .item:nth-child(2) .content {
        display: block;
        z-index: 11111;
    }

    .item .name {
        font-size: 40px;
        font-weight: bold;
        opacity: 0;
        animation: showcontent 1s ease-in-out 1 forwards
    }

    .item .des {
        margin: 20px 0;
        opacity: 0;
        font-size: 20px;
        animation: showcontent 1s ease-in-out 0.3s 1 forwards
    }

    .item button {
        padding: 10px 20px;
        border: none;
        opacity: 0;
        animation: showcontent 1s ease-in-out 0.6s 1 forwards
    }

    @keyframes showcontent {
        from {
            opacity: 0;
            transform: translate(0, 100px);
            filter: blur(33px);
        }

        to {
            opacity: 1;
            transform: translate(0, 0);
            filter: blur(0);
        }
    }

    .buttons {
        position: absolute;
        bottom: 30px;
        z-index: 222222;
        text-align: center;
        width: 100%;
    }

    .buttons button {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 1px solid #555;
        transition: 0.5s;
    }

    .buttons button:hover {
        background-color: #bac383;
    }

    .slider {
        width: 100%;
        height: 748px;
        overflow: hidden;
    }

    @media(width: 768px) {
        .item {
            z-index: 0;
        }

        .item .content {
            min-width: 40%;
        }

    }
</style>
