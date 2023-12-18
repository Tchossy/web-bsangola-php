<?php $this->layout('_theme') ?>

<!-- Page Banner Start -->
<section class="page-banner bgs-cover overlay pt-50" style="background-image: url(/base/images/banner.jpg)">
  <div class="container">
    <div class="banner-inner">
      <h1 class="page-title">Equipe</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Início</a></li>
          <li class="breadcrumb-item active">Equipe</li>
        </ol>
      </nav>
    </div>
  </div>
</section>
<!-- Page Banner End -->
<!-- Team Section Start -->
<section class="team-section-two pt-115 pb-240 rpt-95 pb-90 rpb-70">
  <div class="container">
    <div class="section-title text-center mb-55">
      <span class="sub-title">Membros da equipe</span>
      <h2>Nossa Equipe Incrível</h2>
    </div>
    <!-- ITEMS LIST -->
    <div class="row justify-content-center text-white" id="containerTeam">
      <!-- ITEMS DESCRIPTION -->
      <div class="col-lg-3 col-sm-6">
        <div class="team-member style-two wow fadeInUp delay-0-2s">
          <div class="image">
            <img src="/base/images/team/team-1.jpg" alt="Team Member" />
          </div>
          <div class="member-designation">
            <h5><a href="team-profile.html">Rodney J. Sabo</a></h5>
            <span>Design Lead</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Team Section End -->

<script src="<?= BASE_ACTIONS . "/actions_team.js" ?>"></script>