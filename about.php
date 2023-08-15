<?php
require_once("autoload.php");

generateHeader(); ?>

<section class="about animate__animated animate__backInLeft">
    <div class="container">
        <div class="about__wrap">
            <h2>Our Story</h2>
            <p>Welcome to our company! We are dedicated to providing high-quality solutions for all your needs.
                Founded in 20XX, our team of experts has been working tirelessly to deliver innovative products and
                services.</p>
        </div>
    </div>
</section>

<section class="mission">
    <div class="container">
        <div class="mission__wrap">
            <h2>Our Mission</h2>
            <p>Our mission is to empower individuals and businesses with top-notch solutions that enhance productivity
                and
                success.</p>
        </div>
    </div>
</section>

<section class="team">
    <div class="container">
        <div class="team__wrap">
            <h2>Meet Our Team</h2>
            <div class="team-member">
                <img src="team-member1.jpg" alt="Team Member 1">
                <h3>John Doe</h3>
                <p>Co-Founder & CEO</p>
            </div>
            <div class="team-member">
                <img src="team-member2.jpg" alt="Team Member 2">
                <h3>Jane Smith</h3>
                <p>Lead Designer</p>
            </div>
        </div>
    </div>
</section>

<section class="values">
    <div class="container">
        <div class="values__wrap">
            <ul>
                <li>Excellence</li>
                <li>Innovation</li>
                <li>Integrity</li>
                <li>Customer-Centric Approach</li>
            </ul>
            <h2>Our Values</h2>
        </div>
    </div>
</section>

<?php generateFooter(); ?>