<!-- Contact Section -->
<section id="contact" class="contact section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Contact</h2>
    <p>We are here to assist you with any inquiries or support you need. Reach out to us!</p>
  </div><!-- End Section Title -->

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">

      <div class="col-lg-5">

        <div class="info-wrap">
          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div>
              <h3>Address</h3>
              <p>Bikondo Kribi II, South Cameroon</p>
            </div>
          </div><!-- End Info Item -->

          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
            <i class="bi bi-telephone flex-shrink-0"></i>
            <div>
              <h3>Call Us</h3>
              <p>+237 699 512 438</p>
            </div>
          </div><!-- End Info Item -->

          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
            <i class="bi bi-envelope flex-shrink-0"></i>
            <div>
              <h3>Email Us</h3>
              <p>nkenmandenga@gmail.com</p>
            </div>
          </div><!-- End Info Item -->

          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63750.570857284736!2d9.908885689335886!3d2.983417900588049!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1062fe888d56205d%3A0xa337828392133397!2sBikondo!5e0!3m2!1sen!2scm!4v1723938483370!5m2!1sen!2scm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>

      <div class="col-lg-7">
        <?php

        use application\core\Session;

        $model->begin_form('post', "/") ?>
        <div class="row gy-4">
          <div class="col-md-6">
            <?php $model->form_input_field('name', "text") ?>
          </div>
          <div class="col-md-6">
            <?php $model->form_input_field('email', "email") ?>
          </div>

          <div class="col-md-12">
            <?php $model->form_input_field('subject', 'text') ?>
          </div>

          <div class="col-md-12">
            <?php $model->form_textarea_field('message') ?>
          </div>

          <div class="col-md-12 text-center">
            <?php if (Session::get_flash('message_sent')) : ?>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            <?php endif; ?>
            <button type="submit">Send Message</button>
          </div>

        </div>
        <?php $model->end_form() ?>
      </div><!-- End Contact Form -->

    </div>

  </div>

</section><!-- /Contact Section -->