<?php $this->layout('_theme') ?>

<!-- Page Banner Start -->
<section class="page-banner bgs-cover overlay pt-50" style="background-image: url(/base/images/banner.jpg)">
  <div class="container">
    <div class="banner-inner">
      <h1 class="page-title">Contate-nos</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Início</a></li>
          <li class="breadcrumb-item active">Contato</li>
        </ol>
      </nav>
    </div>
  </div>
</section>
<!-- Page Banner End -->

<!-- Contact Section Start -->
<section class="contact-page py-120 rpy-100">
  <div class="container">
    <div class="contact-info-area mb-80">
      <div class="contact-info-item wow fadeInUp delay-0-2s">
        <i class="far fa-map"></i>
        <p>Luanda, Mutamba Rua 535022, Angola

        </p>
      </div>
      <div class="contact-info-item wow fadeInUp delay-0-4s">
        <i class="far fa-envelope"></i>
        <p>
          <a href="mailto:geral@bsangola.com">geral@bsangola.com</a>
        </p>
      </div>
      <div class="contact-info-item wow fadeInUp delay-0-6s">
        <i class="fas fa-phone-alt"></i>
        <p>
          <a href="callto:+244931075826">+244 931 075 826</a>
          <br />
          <a href="callto:+244942809846">+244 942 809 846</a>
        </p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="contact-form-left bgs-cover h-100 wow fadeInLeft delay-0-2s" style="
                  background-image: url(/base/images/contact/contact-page.jpg);
                ">
          <h2>Deixe um recado</h2>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="contact-form ml-40 rml-0 rmt-55 wow fadeInRight delay-0-2s">
          <h3 class="comment-title mb-35">Envie uma mensagem</h3>
          <p>
            Preencha o formulário de contato fornecido nesta página com suas informações e mensagem. Nossa equipe
            responderá prontamente ao seu pedido.
          </p>
          <form id="comment-form" class="comment-form mt-35" name="comment-form" action="#" method="post">
            <div class="row clearfix justify-content-center">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="full-name"><i class="far fa-user"></i></label>
                  <input type="text" id="full-name" name="full-name" class="form-control" value=""
                    placeholder="Seu nome completo" required="" />
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="email"><i class="far fa-envelope"></i></label>
                  <input type="email" id="email" name="email" class="form-control" value="" placeholder="Seu email"
                    required="" />
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="comments"><i class="fas fa-pencil-alt"></i></label>
                  <textarea name="comments" id="comments" class="form-control" rows="4" placeholder="Escrever mensagem"
                    required=""></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group mb-0">
                  <button type="submit" class="theme-btn">
                    Enviar mensagem
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Contact Section End -->

<!--======== Map =========-->
<div class="contact-page-map">
  <div class="our-location">
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1970.9233936755052!2d13.198254601522354!3d-8.893833106967879!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-PT!2sao!4v1691112722015!5m2!1spt-PT!2sao"
      height="650" style="border: 0; width: 100%" allowfullscreen="" loading="lazy"></iframe>
  </div>
</div>
<!--======== Map =========-->