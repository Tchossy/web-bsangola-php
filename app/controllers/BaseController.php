<?php

namespace app\controllers;

use app\controllers\BaseTemplateController;

class BaseController
{
  public function home()
  {
    return BaseTemplateController::view("home");
  }
  public function about()
  {
    return BaseTemplateController::view("about");
  }
  public function contact()
  {
    return BaseTemplateController::view("contact");
  }
  public function products()
  {
    return BaseTemplateController::view("products");
  }
  public function productDetails()
  {
    return BaseTemplateController::view("product_details");
  }

  public function services()
  {
    return BaseTemplateController::view("services");
  }
  public function serviceDetails()
  {
    return BaseTemplateController::view("service_details");
  }

  public function portfolioDetails()
  {
    return BaseTemplateController::view("portfolio_details");
  }
  public function portfolio()
  {
    return BaseTemplateController::view("portfolio");
  }
  public function team()
  {
    return BaseTemplateController::view("team");
  }
  public function testimonials()
  {
    return BaseTemplateController::view("testimonials");
  }

  // blog
  public function blog()
  {
    return BaseTemplateController::view("blog");
  }
  public function blogDetails()
  {
    return BaseTemplateController::view("blog_details");
  }

  // Login / Register
  public function login()
  {
    return BaseTemplateController::view("login");
  }
  public function register()
  {
    return BaseTemplateController::view("register");
  }

  // 404
  public function notFound()
  {
    return BaseTemplateController::view("404");
  }
}